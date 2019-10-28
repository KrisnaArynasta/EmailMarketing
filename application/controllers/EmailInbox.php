<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailInbox extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->Model('EmailInboxModel');
		$this->email->set_newline("\r\n");
		$this->load->library('session');
    }
	
	public function index(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}	
		
		$user_id=1;
		
		$data_email_account = $this->EmailInboxModel->email_account($user_id);	
		foreach($data_email_account as $row_email){

			$user_id = $row_email->user_id;
			$hostname = $row_email->inbox_host;
			$username = $row_email->email;
			$password = $row_email->password;
			
			//konek ke imap inbox dengan email user terdaftar
			$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Email server: ' . imap_last_error());
			
			// mendapatkan data tamu user yang login
			$data_guest = $this->EmailInboxModel->guest_email($user_id);
			foreach($data_guest as $row_guest){
				
				// dapatkan tanggal log terakhir user untuk di jadikan sebagai parameter load email apabila sudah pernah load sebelumnya
				$data_last_log_inbox = $this->EmailInboxModel->last_log_inbox($user_id);	
				
				//hitung jumlah data, jika user belum pernah load email maka log akan kosong
				$cek_log=$data_last_log_inbox->num_rows(); 
				
				foreach($data_last_log_inbox->result() as $row_load){
					// set tanggal load email terakhir 
					$last_log_inbox = $row_load->last_load_date;
				}
				
				if ($cek_log>0){
					// jika user sudah pernah load email inboxnya, maka load seluruh email masuk dari tamu MULAI DARI tanggal terakhir user load email sebelumnya
					$parameter = 'SINCE "'.$last_log_inbox.'" FROM "'.$row_guest->guest_email.'"';
					$emails = imap_search($inbox, ''.$parameter.'');
				}else{	
					// jika belum pernah, maka load semua email dari tamu user
					$emails = imap_search($inbox, 'FROM '.$row_guest->guest_email.'');
				}
				
				
				if($emails) {
			
						/* begin output var */
						$output = '';
						
						/* put the newest emails on top */
						rsort($emails);
						
						/* for every email... */
						foreach($emails as $email_number) {
							
							/* get information specific to this email */
							$overview = imap_fetch_overview($inbox,$email_number,0);
							$message  = imap_fetchbody($inbox,$email_number,2);
							$message  = str_replace("=", "", $message);
							$message  = str_replace("\\r", "\\\\r", $message);
							$message  = str_replace("\\n", "\\\\n", $message);
							//$message = str_replace("'", "\'", $message);
							//$message = str_replace( array( "\n", "\r" ), array( "\\n", "\\r" ), $message );
							//$message = json_encode($message);
							
							
							$message_id		= $overview[0]->message_id;
							$subject		= $overview[0]->subject;
							$from			= $overview[0]->from;
							$to				= $row_email->email;
							$guest_id		= $row_guest->guest_id;
							$guest_name		= $row_guest->guest_name;
							$seen			= $overview[0]->seen;
							$answered		= $overview[0]->answered;
							$inbox_date		= $overview[0]->date;
							$body			= $message;
							
							// update duplicate_status di tbl inbox jadi = 1 where id pesannya sama dengan yang baru diambil (duplikat) alias datanya emailnya udah ada sebelumnya 
							//(ini terjadi karena load di tanggal yang sama, karena IMAP gk bisa ngambil email dengan range tanggal + waktu, hanya bisa tanggal saja)
							$data_update_duplicate_status = array(
										"duplicate_status" => 1
									);										
							$this->EmailInboxModel->update_duplicate_status($message_id,$data_update_duplicate_status);
							
							// delete semua email yang status duplikatnya 1 
							// ini dilakukan biar gk ada email yang sama di tabel (sebenernya biar tabelnya lebih rapi aja dgn gk ada duplikat data)
							$this->EmailInboxModel->delete_duplicate_email();
							
							// insert ke tabel inbox email baru yang di dapat
							$value_insert_inbox = array(
								'user_id' => $user_id,
								'message_id' => $message_id,
								'inbox_subject' => $subject,
								'guest_id' => $guest_id,
								'inbox_guest_name' => $guest_name,
								'inbox_from' => $from,
								'inbox_to' => $to,
								'inbox_body' => $body,
								'seen_status' => $seen,
								'answered_status' => $answered,
								'inbox_date' => $inbox_date,
								'duplicate_status' => 0,
							); 
							$this->EmailInboxModel->insert_inbox($value_insert_inbox);
						}
				}
			}
		}
		
		// fungsi insert k table log sesuai tanggal saat load 
		$mm = date("m");
		switch ($mm) {
			case 1:
				$month = 'Jan';
				break;
			case 2:
				$month = 'Feb';
				break;

			case 3:
				$month = 'Mar';
				break;
			case 4:
				$month = 'Apr';
				break;
			case 5:
				$month = 'May';
				break;
			case 6:
				$month = 'Jun';
				break;
			case 7:
				$month = 'Jul';
				break;
			case 8:
				$month = 'Aug';
				break;
			case 9:
				$month = 'Sep';
				break;
			case 10:
				$month = 'Oct';
				break;
			case 11:
				$month = 'Nov';
				break;
			case 12:
				$month = 'Dec';
				break;
			default:
				$month = 'Not a valid month!';
				break;
		}
		$date_last_log = date("d")."-".$month."-".date("Y") ;
		$time_last_log = date("H:i:s");
		
		$value_new_log = array(
							'user_id' => $user_id,
							'last_load_date' => $date_last_log,
							'last_load_time' => $time_last_log,
						);
		// input data log baru(tanggal dan waktu saat ini) ke tabel log load inbox 				
		$this->EmailInboxModel->insert_new_log_inbox($value_new_log);

		imap_close($inbox);

								
		// get seluruh data inbox user terkait				
		$data['data_inbox_email'] = $this->EmailInboxModel->inbox_email($user_id);	
		$data['data_email_sender'] = $this->EmailInboxModel->email_sender($user_id);	
		$this->load->view('email-inbox',$data);
	}
	
	public function load_email_body($inbox_id){
		$data['data_email_body'] = $this->EmailInboxModel->email_body($inbox_id);
		echo json_encode($data); 
	}
		
}


