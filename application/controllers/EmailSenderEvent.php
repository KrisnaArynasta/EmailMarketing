<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailSenderEvent extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->Model('EmailSenderEventModel');
		$this->email->set_newline("\r\n");
    }
	
	public function index(){
		
		// dapatakan email untuk ngirim dan email tujuan (email tamu)
		$user_id=1;
		
		// get event
		foreach ($this->EmailSenderEventModel->get_event_current_date($user_id) as $row_event){ 
			
			// get email sender			
			foreach ($this->EmailSenderEventModel->get_user_email($user_id) as $row_email){

				// get guest yang akan di kirimkan email
				foreach ($this->EmailSenderEventModel->get_user_guest($user_id,$row_event->event_id) as $row_guest){

					// jika email sender yg sedang di looping saat ini telah mengirim lebih dari limit email maka sender akan di ganti
					if ($this->EmailSenderEventModel->get_inbox_count($row_email->email_sender_id) < $row_email->limit_email){
						// set email sender and server
						$config = Array(
									'protocol' => 'smtp',
									'smtp_host' => $row_email->sender_host,
									'smtp_port' => 465,
									'smtp_user' => $row_email->email,
									'smtp_pass' => $row_email->password,
									'mailtype'  => 'html', 
									'charset' => 'utf-8',
									'wordwrap' => TRUE
								);
						$this->email->initialize($config);
						
						//set konten email
						$htmlContent =		'</center>';			
						$htmlContent .=		'<H1>SPECIAL PROMO FOR '.$row_event->event_name.'</h1>';
						$htmlContent .=			'Hallo Mr/Ms. <b>'.$row_guest->guest_name.'</b><br>';
						$htmlContent .=			$row_event->event_message.'</b><br><br><br>';
						$htmlContent .=		'</center>';
						
						$this->email->to($row_guest->guest_email);
						$this->email->from($row_email->email,'Hotel Name Here');
						$this->email->subject($row_event->event_name);
						$this->email->message($htmlContent);
						if (!$this->email->send()) {
							
							show_error($this->email->print_debugger()); 
							
							// save to tbl_outbox kalo email gagal di kirim dengan status sent 0 XXXXXXXXXXXXXXXXX
							// gk jadi isi ini soalnya di atas udh d cek event mana aja yg harus d kirim ke mana aja 
							// $data = array(
								  // "send_date" => date("Y-m-d"),
								  // "send_time" => date("H:i:s"),
								  // "event_id" => $row_event->event_id,
								  // "guest_id" => $row_guest->guest_id,
								  // "email_send_to" => $row_guest->guest_email,
								  // "email_sender_id" => $row_email->email_sender_id,
								  // "outbox_from" => $row_email->email." ,'Hotel Name Here",
								  // "outbox_subject" => $row_event->event_name,
								  // "message_send" => $row_event->event_message,
								  // "sent_status" => 0
								// );
							// $this->EmailSenderEventModel->insert_to_outbox($data);
							// echo "fail <br>";
						}else {
							// save to tbl_outbox kalo email berhasil dikirim dengan status sent 1
							$data = array(
								  "user_id" => $this->session->userdata('user_id'),
								  "send_date" => date("Y-m-d"),
								  "send_time" => date("H:i:s"),
								  "event_id" => $row_event->event_id,
								  "guest_id" => $row_guest->guest_id,
								  "email_send_to" => $row_guest->guest_email,
								  "email_sender_id" => $row_email->email_sender_id,
								  "outbox_from" => $row_email->email." ,'Hotel Name Here",
								  "outbox_subject" => $row_event->event_name,
								  "message_send" => $row_event->event_message,
								  "sent_status" => 1
								);
							$this->EmailSenderEventModel->insert_to_outbox($data);
							echo "email sent! <br>";
						}			
					}else{
						break;
					}	
				}
			}
		}
	}
}


