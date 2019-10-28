<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));;
		$this->load->Model('EventModel');
		$this->load->library('session');
		$this->load->library('image_lib');
    }
	
	public function index(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$data['event'] = $this->EventModel->view_event($this->session->userdata('user_id'));	
		$this->load->view('event/view_event',$data);
	}

	public function create(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		  
		$this->load->view('event/create_event');
	}
	
	public function insert(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$config['upload_path']          = './images/event_photos/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']        	= 'Event_'.$this->session->userdata('user_id').'_'.$this->input->post('event_name').'_'.date("Ymdhis").'.jpg';
		//$config['max_size']             = 100;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
	 
		$this->load->library('upload', $config);  
		
		// cek jika fungsi upload foto event utama tidak berkerja
		if( !$this->upload->do_upload('event_main_photo')){
				$error = $this->upload->display_errors();
				//echo $error;
				echo "main photo is empty";	
		}else{
  			//dapatkan data file foto event utama yg d upload
			$upload_data = $this->upload->data();
			
  			//comprase foto event utama 
			$configer['image_library'] = 'gd2';
			$configer['source_image'] = $upload_data['full_path'];
			$configer['create_thumb'] = FALSE;
			$configer['maintain_ration'] = FALSE;
			$configer['width'] = 1280;
			$configer['new_image'] = $upload_data['full_path'];
			
			$this->image_lib->clear();
			$this->image_lib->initialize($configer);
			$this->image_lib->resize();
 
			//dapatkan nama foto event utama
			$file_name = $upload_data['file_name'];
  
			// data ke tabel event
			$data = array(
				  "user_id" 						=> $this->session->userdata('user_id'),
				  "event_name" 						=> $this->input->post('event_name'),
				  "event_date" 						=> $this->input->post('event_date'),
				  "message_send_before"				=> date_diff(date_create($this->input->post('event_date')),date_create($this->input->post('send_on')))->format("%a"),
				  "event_description"				=> $this->input->post('event_desc'),
				  "event_message"					=> $this->input->post('event_email'),
				  "event_main_photo"				=> $file_name,
				  "event_status_active"				=> '1'
				);	
				
			$this->EventModel->insert($data); 
			
			if($this->EventModel->insert($data)){
			
				$event_photos = $this->input->post('event_photos');
				
				// looping buat ngupload foto ke tabel foto event	
				foreach($event_photos as $event_photo){
				//echo $event_photo
				
					$config['upload_path']          = './images/event_photos/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['file_name']        	= 'Event_photos_'.$this->session->userdata('user_id').'_'.$this->input->post('event_name').'_'.date("Ymdhis").'.jpg';
					 
					//set custom objek untuk foto-foto event
					$this->load->library('upload', $config, 'event_photos_config'); 
					 
					if( !$this->event_photos_config->do_upload('event_photos')){
						$error = $this->event_photos_config->display_errors();
						//echo $error;
						echo "error upload event photo";	
					}else{			

					
						//dapatkan data file foto-foto event yg d upload
						$event_photos_config = $this->event_photos_config->data();
						
						//comprase foto-foto event  
						$configer['image_library'] = 'gd2';
						$configer['source_image'] = $event_photos_config['full_path'];
						$configer['create_thumb'] = FALSE;
						$configer['maintain_ration'] = FALSE;
						$configer['width'] = 1280;
						$configer['new_image'] = $event_photos_config['full_path'];
						
						$this->image_lib->clear();
						$this->image_lib->initialize($configer);
						$this->image_lib->resize();
			 
						//dapatkan nama foto-foto event 
						$file_name_event_photo = $event_photos_config['file_name'];		
						echo $file_name_event_photo;				
					}
				}
					
				
				
				echo "success";
			}else{
				echo "fail";
			}
		
		}
	}
		
	public function edit($id){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$result['data_edit'] = $this->EventModel->view_event_by_id($id);
		$this->load->view('Event/edit_event',$result);
	}
	
}


