<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));;
		$this->load->Model('EventModel');
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->load->library('pagination');
		$this->load->helper("file");
    }
	
	public function index(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$user_id = $this->session->userdata('user_id');	
		
		$search = $this->input->post('search');
		if($search){
			$total_records = $this->EventModel->get_filter($user_id,$search);
		}else {
			$total_records = $this->EventModel->get_total($user_id);
		}
			
			
			// init params
			$params = array();
			$limit_per_page = 6;
			$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$page = $start_index / $limit_per_page + 1;
   
	 
			if ($total_records > 0) {
				// get current page records
				if($search){
					$params['event']=$this->EventModel->get_current_page_records_filter($user_id, $limit_per_page, $start_index, $search);
				}else{
					$params['event']=$this->EventModel->get_current_page_records($user_id, $limit_per_page, $start_index);
				}

				
				$config['base_url'] = base_url().'Event/index';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				//bootstrap class
				$config['first_link']       = '<i class="fe fe-chevrons-left"></i>';
				$config['last_link']        = '<i class="fe fe-chevrons-right"></i>';
				$config['next_link']        = '<i class="fe fe-chevron-right"></i>';
				$config['prev_link']        = '<i class="fe fe-chevron-left"></i>';
				$config['full_tag_open']    = '<div class="pagging text-center"><nav style="border-right:0"><ul class="pagination justify-content-center">';
				$config['full_tag_close']   = '</ul></nav></div>';
				$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
				$config['num_tag_close']    = '</span></li>';
				$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
				$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
				$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
				$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['prev_tagl_close']  = '</span>Next</li>';
				$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
				$config['first_tagl_close'] = '</span></li>';
				$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['last_tagl_close']  = '</span></li>';
				 
				$this->pagination->initialize($config);
				 
				// build paging links
				$params["links"] = $this->pagination->create_links();
				
			}
			 
			//$hasil['data']=$this->ManometerModel->view_all_manometer();
			$this->load->view('event/view_event',$params);
			
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
			if($_FILES["event_photos"]["name"]){


				//echo count($_FILES["event_photos"]["name"]);
				// LOOPING BUAT NGUPLOAD FOTO KE PATH DAN INSERT KE TABEL FOTO EVENT	
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
		$this->load->view('event/edit_event',$result);
	}
	
	public function update(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$config['upload_path']          = './images/event_photos/event_main_photos/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['file_name']        	= 'Event_'.$this->session->userdata('user_id').'_'.$this->input->post('edit_event_name').'_'.date("Ymdhis").'.jpg';
		//$config['max_size']             = 100;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;
	 
		$this->load->library('upload', $config);  
		
		// CEK KALO MAIN FOTO ADA ATAU ENGGAK(BISA JADI GK DIISI ATAU MASIH MAKE YANG LAMA) 
		// KALO MISAL GAK ISI KASI NAMA FILE = FILE LAMA, FOTO LAMA JUGA GK DIHAPUS
		if( !$this->upload->do_upload('edit_event_main_photo')){
				$error = $this->upload->display_errors();
				//echo $error;
				//echo "main photo is empty";	
				$file_name = $this->input->post('old_main_photo');
		}else{
  			//dapatkan data file foto event utama yg d upload
			$upload_data = $this->upload->data();
			
			//HAPUS FILE LAMA YANG NAMANYA DI AMBIL DARI HIDDEN INPUT KALO MAIN FOTO DIPERBAHARUI
			$path = './images/event_photos/event_main_photos/'.$this->input->post('old_main_photo');
			unlink($path);
			
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
 
			//dapatkan nama foto event utama baru
			$file_name = $upload_data['file_name'];
		}
		
		// data ke tabel event
		$data = array(
			  "user_id" 						=> $this->session->userdata('user_id'),
			  "event_name" 						=> $this->input->post('edit_event_name'),
			  "event_date" 						=> $this->input->post('edit_event_date'),
			  "message_send_before"				=> date_diff(date_create($this->input->post('edit_event_date')),date_create($this->input->post('edit_send_on')))->format("%a"),
			  "event_description"				=> $this->input->post('edit_event_desc'),
			  "event_message"					=> $this->input->post('edit_event_email'),
			  "event_main_photo"				=> $file_name,
			  "event_status_active"				=> '1'
			);	
		
		// JIKA BERHASIL UPDATE KE TABLE EVENT
		$id = $this->input->post('event_id');
		
		if($this->EventModel->update($id,$data)){
			
			//DAPETIN NAMA FOTO EVENT LAMA YANG DIINPUT LAGI DARI INPUT TYPE HIDDEN
			if($this->input->post('old_event_photo')){
				foreach($this->input->post('old_event_photo') as $old_event_photo){
					//SIMPAN NAMA FOTO EVENT LAMA YANG DI INPUT KEMBALI D VAR ARRAY
					$undelete_photos[] = $old_event_photo;
				}
				
			}else{
				$undelete_photos[] = "";
			}
				//DELETE DATA FOTO EVENT LAMA YANG TIDAK DI UPLOAD ULANG D TABLE EVENT PHOTOS
				$this->EventModel->delete_old_event_photos($id,$undelete_photos);
			
			//SELECT FOTO YANG HARUS D HAPUS DI FOLDER (BRARTI YANG GK DIUPLOAD ULANG)
			// $delete_photos['delete_photos'] = $this->EventModel->view_event_photos_by_name($id,$undelete_photos);
			// foreach($delete_photos['delete_photos'] as $delete_photo){
				// echo $delete_photo->event_photo;
				// $path = './images/event_photos/events_photos/'.$delete_photo->event_photo;
				// unlink($path);
			// }
			
					
			// LOOPING BUAT UPDATE KE TABEL FOTO EVENT	
			for($count = 0; $count<count($_FILES["edit_event_photos"]["name"]); $count++){
				
				$config['upload_path']          = './images/event_photos/events_photos/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['file_name']        	= 'Event_photos_'.$id.'_'.$this->input->post('edit_event_name').'_'.date("Ymdhis").'.jpg';
				 
				//set custom objek (edit_event_photos_config maksdnya) untuk foto-foto event karena diatas udh make yg default buat upload main foto
				$this->load->library('upload', $config, 'edit_event_photos_config'); 
				 
				$_FILES["file"]["name"] 	= $_FILES["edit_event_photos"]["name"][$count];
				$_FILES["file"]["type"] 	= $_FILES["edit_event_photos"]["type"][$count];
				$_FILES["file"]["tmp_name"] = $_FILES["edit_event_photos"]["tmp_name"][$count];
				$_FILES["file"]["error"]	= $_FILES["edit_event_photos"]["error"][$count];
				$_FILES["file"]["size"] 	= $_FILES["edit_event_photos"]["size"][$count]; 
				 
				if( !$this->edit_event_photos_config->do_upload('file')){
					$error = $this->edit_event_photos_config->display_errors();
					//echo $error;
					//echo "error upload event photo";	
				}else{			
			
					//dapatkan data file foto-foto event yg d upload
					$edit_event_photos_config = $this->edit_event_photos_config->data();
					
					//comprase foto-foto event  
					$configer['image_library'] = 'gd2';
					$configer['source_image'] = $edit_event_photos_config['full_path'];
					$configer['create_thumb'] = FALSE;
					$configer['maintain_ration'] = FALSE;
					$configer['width'] = 1280;
					$configer['new_image'] = $edit_event_photos_config['full_path'];
					
					$this->image_lib->clear();
					$this->image_lib->initialize($configer);
					$this->image_lib->resize();
		 
					//dapatkan nama foto-foto event 
					$edit_file_name_event_photo = $edit_event_photos_config['file_name'];		

					// DATA KE TABLE EVENT PHOTOS
					$data = array(
									  "event_id" 						=> $id,
									  "event_photo" 					=> $edit_file_name_event_photo,
									  "event_photo_upload_date" 		=> date('Y-m-d')
									);
					
					// INSERT DATA BARU KE TABEL EVENT PHOTOS
					$this->EventModel->insert_to_event_photos($data);										
				}
			}	
			echo "success";
		}else{
			echo "fail";
		}

	}
	
	public function view_event_email($event_id){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}		
		
		$data['data_detail']=$this->EventModel->view_event_email($event_id);
		echo json_encode($data);
	}
	
	public function aktif(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}

		$id = $this->input->post('id'); 
		$data = array(
		  "event_status_active" => $this->input->post('aktif_sts')
		);	 
		$this->EventModel->aktif($id,$data); 
		echo "success";
	}
	
	public function delete(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}

		$id = $this->input->post('id'); 
		$data = array(
		  "event_status_delete" => $this->input->post('delete_sts')
		);	 
		$this->EventModel->delete($id,$data); 
		echo "success";
	}
	
}


