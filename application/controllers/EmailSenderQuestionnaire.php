<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailSenderQuestionnaire extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->Model('EmailSenderQuestionnaireModel');
		$this->load->Model('QuestionnaireModel');
		$this->load->library('session');
		$this->email->set_newline("\r\n");
    }
	
	public function index(){
		
		// get semua user
		foreach ($this->EmailSenderQuestionnaireModel->get_all_user() as $row_user){ 
		$user_id = $row_user->user_id;
		
    		// get semua questionnaire dengan parameter user_id yang sedang d looping saat ini
    		foreach ($this->EmailSenderQuestionnaireModel->get_questionnaire_current_date($user_id) as $row_questionnaire){ 
    			
    			// get email sender	dengan parameter user_id		
    			foreach ($this->EmailSenderQuestionnaireModel->get_user_email($user_id) as $row_email){
    
    				// get guest yang akan di kirimkan email dengan parameter user_id dan questionnaire_id (buat cek apa guestnya itu sudah di kirimkan email dengan questionnaire ini blm)
    				foreach ($this->EmailSenderQuestionnaireModel->get_user_guest($user_id,$row_questionnaire->questionnaire_id) as $row_guest){

						//enkripsi guest_id pake md5 biar urlnya gk terdeteksi
						$link_unsubscribe = md5($row_guest->guest_id);
						$data_send_questionnaire = array(
    								  "questionnaire_id" => $row_questionnaire->questionnaire_id,
    								  "guest_id" => $row_guest->guest_id
    								);
						//insert ke tabel send questionnaire trus dapetin id send questionnairenya buat jadi link questionnaire nanti pas dikirim lewat email
						$id_link_questionnaire = $this->EmailSenderQuestionnaireModel->insert_to_send_questionnaire($data_send_questionnaire);
						$id_link_questionnaire =  md5($id_link_questionnaire);
						
    					// jika email sender yg sedang di looping saat ini telah mengirim lebih dari limit email maka sender akan di ganti
    					if ($this->EmailSenderQuestionnaireModel->get_inbox_count($row_email->email_sender_id) < $row_email->limit_email){
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
    						
    						$questionnaire_data['data_detail'] = $this->QuestionnaireModel->view_questionnaire_email($row_questionnaire->questionnaire_id,$user_id);
    						
    						foreach($questionnaire_data['data_detail'] as $questionnaire_row_data){
    							$property_logo		 		 = $questionnaire_row_data->property_logo;
    							$property_address 			 = $questionnaire_row_data->property_address;
    							$property_name 				 = $questionnaire_row_data->property_name;
    							$property_website 		 	 = $questionnaire_row_data->property_website;
    							$questionnaire_name 		 = $questionnaire_row_data->questionnaire_name;
    							$questionnaire_message 		 = $questionnaire_row_data->questionnaire_message;
    							$questionnaire_status_delete = $questionnaire_row_data->questionnaire_status_delete;
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
							$htmlContent   .=	'<br>';
							$htmlContent   .=	'<p>Dear Mr/Mrs '.$row_guest->guest_name.'</p>';
							$htmlContent   .=	'<br>';
							$htmlContent   .=	'<p class="mb-0 mt-4">'.$questionnaire_message.'</p>';
							$htmlContent   .=	'<br>';
							$htmlContent   .= 	'<p class="mb-0 mt-4">Questionnaire link: '.base_url().'Questionnaire/fill/'.$id_link_questionnaire.'</p>';

    						$htmlContent   .=	'</div>';
    						$htmlContent   .=	'</div>';
							$htmlContent   .=	'<p style="margin-top:40px">if you don&apos;t want to obtain this kind of email anymore, <a href="'.base_url().'Unsubscribe/Unsubscribe/'.$link_unsubscribe.'">klik here</a></p>';
    						$this->email->to($row_guest->guest_email);
    						$this->email->from($row_email->email,$property_name);
    						$this->email->subject($questionnaire_name);
    						$this->email->message($htmlContent);
    						if (!$this->email->send()) {
    							
    							show_error($this->email->print_debugger()); 
    							
    						}else {
    							// save to tbl_outbox kalo email berhasil dikirim dengan status sent 1
    							$data = array(
    								  "user_id" => $user_id,
    								  "send_date" => date("Y-m-d"),
    								  "send_time" => date("H:i:s"),
    								  "questionnaire_id" => $row_questionnaire->questionnaire_id,
    								  "guest_id" => $row_guest->guest_id,
    								  "email_send_to" => $row_guest->guest_email,
    								  "email_sender_id" => $row_email->email_sender_id,
    								  "outbox_from" => $row_email->email." ,".$property_name,
    								  "outbox_subject" => $questionnaire_name,
    								  "message_send" => $htmlContent,
    								  "sent_status" => 1
    								);
    							$this->EmailSenderQuestionnaireModel->insert_to_outbox($data);
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