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
		
		$config['upload_path']          = './images/event_photos/event_main_photos/';
		$config['allowed_types']        = 'jpg|png|jpeg';
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
			
			// JIKA BERJASIL INSERT KE TABLE EVENT
			$event_id = $this->EventModel->insert($data);
			if($event_id){


				//echo count($_FILES["event_photos"]["name"]);
				// LOOPING BUAT NGUPLOAD FOTO KE TABEL FOTO EVENT	
				for($count = 0; $count<count($_FILES["event_photos"]["name"]); $count++){
					
					$config['upload_path']          = './images/event_photos/events_photos/';
					$config['allowed_types']        = 'jpg|png|jpeg';
					$config['file_name']        	= 'Event_photos_'.$event_id.'_'.$this->input->post('event_name').'_'.date("Ymdhis").'.jpg';
					 
					//set custom objek (event_photos_config maksdnya) untuk foto-foto event karena diatas udh make yg default buat upload main foto
					$this->load->library('upload', $config, 'event_photos_config'); 
					 
					$_FILES["file"]["name"] = $_FILES["event_photos"]["name"][$count];
					$_FILES["file"]["type"] = $_FILES["event_photos"]["type"][$count];
					$_FILES["file"]["tmp_name"] = $_FILES["event_photos"]["tmp_name"][$count];
					$_FILES["file"]["error"] = $_FILES["event_photos"]["error"][$count];
					$_FILES["file"]["size"] = $_FILES["event_photos"]["size"][$count]; 
					 
					if( !$this->event_photos_config->do_upload('file')){
						$error = $this->event_photos_config->display_errors();
						//echo $error;
						//echo "error upload event photo";	
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

						// DATA KE TABLE EVENT PHOTOS
						$data = array(
										  "event_id" 						=> $event_id,
										  "event_photo" 					=> $file_name_event_photo,
										  "event_photo_upload_date" 		=> date('Y-m-d')
										);
										
						$this->EventModel->insert_to_event_photos($data);										
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
		$result['data_edit_event_photos'] = $this->EventModel->view_event_photos_by_id($id);
		$this->load->view('Event/edit_event',$result);
	}
	
}


