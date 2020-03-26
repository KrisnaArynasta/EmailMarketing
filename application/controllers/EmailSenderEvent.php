<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailSenderEvent extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->Model('EmailSenderEventModel');
		$this->load->Model('EventModel');
		$this->load->library('session');
		$this->email->set_newline("\r\n");
    }
	
	public function index(){
		
		// get semua user
		foreach ($this->EmailSenderEventModel->get_all_user() as $row_user){ 
		$user_id = $row_user->user_id;
		
    		// get semua event tanpa parameter event 
    		foreach ($this->EmailSenderEventModel->get_event_current_date($user_id) as $row_event){ 
    			
    			// get email sender	dengan parameter row_event->user_id		
    			foreach ($this->EmailSenderEventModel->get_user_email($user_id) as $row_email){
    
    				// get guest yang akan di kirimkan email dengan parameter row_event->user_id dan event_id (buat cek apa guestnya itu sudah di kirimkan email dengan event ini blm)
    				foreach ($this->EmailSenderEventModel->get_user_guest($user_id,$row_event->event_id) as $row_guest){
						//enkripsi guest_id pake md5 biar urlnya gk terdeteksi
						$link_unsubscribe = md5($row_guest->guest_id);
						
    					// jika email sender yg sedang di looping saat ini telah mengirim lebih dari limit email maka sender akan di ganti
    					if ($this->EmailSenderEventModel->get_inbox_count($row_email->email_sender_id) < $row_email->limit_email){
    						// set email sender and server
    						$config = Array(
    									'protocol' 	=> 'smtp',
    									'smtp_host' => $row_email->sender_host,
    									'smtp_port' => 465,
    									'smtp_user' => $row_email->email,
    									'smtp_pass' => $row_email->password,
    									'mailtype'  => 'html', 
    									'charset' 	=> 'utf-8',
    									'wordwrap' 	=> TRUE
    								);
    						$this->email->initialize($config);
    						
    						$event_data['data_detail']=$this->EventModel->view_event_email($row_event->event_id);
    						
    						foreach($event_data['data_detail'] as $event_row){
    							$property_logo		= $event_row->property_logo;
    							$property_address 	= $event_row->property_address;
    							$property_name 		= $event_row->property_name;
    							$property_website 	= $event_row->property_website;
    							$event_name 		= $event_row->event_name;
    							$event_date 		= $event_row->event_date;
    							$event_main_photo 	= $event_row->event_main_photo;
    							$event_message 		= $event_row->event_message;
    						}
    						
    						if($property_logo){ 
    							$property_logo = '<div class="col-md-6"><img width="20%" src="'.base_url().'images/property_logo/'.$property_logo.'"></div>';
    						}else{
    							$property_logo = '<div class="col-md-6"><h2><b>'.$property_name.'</b></h2></div>';
    						}
    
    						//SET ISI EMAIL
    						$htmlContent	=	'<div class="col-md-12" style="border-bottom:1px solid #0000003b; padding-bottom:10px">';
    						$htmlContent   .=	'<div class="row">';
    						$htmlContent   .=	$property_logo;
    						$htmlContent   .=	'<div class="col-md-6 text-right" style="top: 0.6rem;"><h4>'.$property_name.'<br>';
    						$htmlContent   .=	'<small>'.$property_address;
    						$htmlContent   .=	$property_website;
    						$htmlContent   .=	'</small></h4></div>';
    						$htmlContent   .=	'</div>';
    						$htmlContent   .=	'</div>';
    						$htmlContent   .=	'<strong><h2 class="mb-4 mt-4" align="center">'.$event_name.'<br><small>'.$event_date.'</small></h2></strong>';
    						$htmlContent   .=	'<div class="col-md-12">';
    						$htmlContent   .=	'<img class="col-md-12" src="'.base_url().'images/event_photos/event_main_photos/'.$event_main_photo.'">';
    						$htmlContent   .=	'</div>';
    						$htmlContent   .=	'<p class="mb-0 mt-4">'.$event_message.'</p>';
    						$htmlContent   .=	'<div class="col-md-12">';
    						$htmlContent   .=	'<h4 align="center" style="margin-top:40px; border-top:1px solid #0000003b; padding-top:10px" >Event&apos;s Photo(s)</h4>';
    						$htmlContent   .=	'<div class="row" id="eventPhotos">';
    						//FOTO EVENT
    						if($event_row->event_photo_id){
    							foreach($event_data['data_detail'] as $event_photo){
    								$htmlContent   .=	'<img width="24%" style="margin:1px" src="'.base_url().'images/event_photos/events_photos/'.$event_photo->event_photo.'">';	
    							}
    						}
    						$htmlContent   .=	'</div>';
    						$htmlContent   .=	'</div>';
							$htmlContent   .=	'<p style="margin-top:40px">if you don&apos;t want to obtain this kind of email anymore, <a href="'.base_url().'Unsubscribe/Unsubscribe/'.$link_unsubscribe.'">klik here</a></p>';
    						$this->email->to($row_guest->guest_email);
    						$this->email->from($row_email->email,$property_name);
    						$this->email->subject($row_event->event_name);
    						$this->email->message($htmlContent);
    						if (!$this->email->send()) {
    							
    							show_error($this->email->print_debugger()); 
    							
    							// save to tbl_outbox kalo email sender telah limit gagal di kirim dengan status sent 0 XXXXXXXXXXXXXXXXX
    							// gk jadi isi ini soalnya di atas udh d cek event mana aja yg harus d kirim ke mana aja 
    							// $data = array(
    								  //"user_id" => $this->session->userdata('user_id'),
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
    								  "user_id" => $user_id,
    								  "send_date" => date("Y-m-d"),
    								  "send_time" => date("H:i:s"),
    								  "event_id" => $row_event->event_id,
    								  "guest_id" => $row_guest->guest_id,
    								  "email_send_to" => $row_guest->guest_email,
    								  "email_sender_id" => $row_email->email_sender_id,
    								  "outbox_from" => $row_email->email." ,".$property_name,
    								  "outbox_subject" => $row_event->event_name,
    								  "message_send" => $htmlContent,
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
}


?>