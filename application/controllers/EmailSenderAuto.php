<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailSenderAuto extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->Model('EmailSenderAutoModel');
		$this->email->set_newline("\r\n");
    }
	
	public function index(){

		// get email dari outbox yang akan di kirimkan berdasaraakan status email = 0
		foreach ($this->EmailSenderAutoModel->get_outbox() as $row_email_to_send){

			// jika email sender yg sedang di looping saat ini telah mengirim lebih dari limit email maka sender akan di ganti
			if ($this->EmailSenderAutoModel->get_inbox_count($row_email_to_send->email_sender_id) < $row_email_to_send->limit_email){
				// set email sender and server
				$config = Array(
							'protocol' => 'smtp',
							'smtp_host' => $row_email_to_send->sender_host,
							'smtp_port' => 465,
							'smtp_user' => $row_email_to_send->email,
							'smtp_pass' => $row_email_to_send->password,
							'mailtype'  => 'html', 
							'charset' => 'utf-8',
							'wordwrap' => TRUE
						);
				$this->email->initialize($config);
				
				//set konten email
				$htmlContent = $row_email_to_send->message_send;
				
				$this->email->to($row_email_to_send->email_send_to);
				$this->email->from($row_email_to_send->outbox_from);
				$this->email->subject($row_email_to_send->outbox_subject);
				$this->email->message($htmlContent);
				if (!$this->email->send()) {
					show_error($this->email->print_debugger()); 
				}else {
					// update to tbl_outbox data send to model
					$outbox_id = $row_email_to_send->outbox_id;
					$data = array(
						  "send_date" => date("Y-m-d"),
						  "send_time" => date("H:i:s"),
						  "sent_status" => 1
						);
					$this->EmailSenderAutoModel->update_outbox($outbox_id,$data);
					echo "email sent <br>";
				}			
			}else{
				echo "outbox number :".$row_email_to_send->outbox_id." cannot be sent. email <b>".$row_email_to_send->email.
				"</b> is out of send email limit for today, email will be send on next day <br>";
				break;
			}	
		}
		
		echo "no email to send";
	
	}
	
	public function input_to_outbox(){
		
		$data = array(
					  "user_id" => $this->session->userdata('user_id'),
					  "guest_id" => $this->input->post('guest_id'),
					  "email_send_to" => $this->input->post('to'),
					  "email_sender_id" => $this->input->post('sender'),
					  "outbox_from" => 'Hotel Name Here',
					  "outbox_subject" =>  $this->input->post('subject'),
					  "message_send" => $this->input->post('email_builder'),
					  "sent_status" => 0
					);
		
		$this->EmailSenderAutoModel->input_email($data); 
		echo "success";	
	}
}


