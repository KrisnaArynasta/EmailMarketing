<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->Model('GuestModel');
		$this->load->library('session');
    }
	
	public function index(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		//SET USER ID YANG LOGIN
		$user_id = $this->session->userdata('user_id');	
		
		$data['guest_data'] = $this->GuestModel->get_guest($user_id);
		$this->load->view('guest/view_guest',$data);
		
	}
 
	public function save_guest(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$data = array(
				  "user_id" 					=> $this->session->userdata('user_id'),
				  "guest_user_id" 				=> $this->input->post('hotel_id'),
				  "guest_name" 					=> $this->input->post('guest_name'),
				  "guest_email"					=> $this->input->post('guest_email'),
				  "guest_country"				=> $this->input->post('guest_country'),
				  "guest_active_status"			=> 1,
				  "guest_insert_date"			=> date("Y-m-d"),
				  "guest_last_update"			=> date("Y-m-d")
				);	
		
		$this->GuestModel->save_guest($data);
		echo "success";
	}

	// LOAD DATA GUEST PAS EDIT
	public function view_guest_by_id($id){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$edit_guest['data_edit']=$this->GuestModel->get_guest_by_id($id);
		echo json_encode($edit_guest);
	}	
	
	public function update_guest(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$id = $this->input->post('edit_guest_id');
		
		$data = array(
				  "user_id" 					=> $this->session->userdata('user_id'),
				  "guest_user_id" 				=> $this->input->post('edit_hotel_id'),
				  "guest_name" 					=> $this->input->post('edit_guest_name'),
				  "guest_email"					=> $this->input->post('edit_guest_email'),
				  "guest_country"				=> $this->input->post('edit_guest_country'),
				  "guest_last_update"			=> date("Y-m-d")
				);	
		
		$this->GuestModel->update_guest($id,$data);
		echo "success";
	}

	// GANTI STATUS AKTIF GUEST
	public function guest_active_status(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}

		$id = $this->input->post('id'); 
		$data = array(
		  "guest_active_status" => $this->input->post('aktif_sts')
		);	 
		$this->GuestModel->guest_active_status($id,$data); 
		echo "success";
	}	

}


?>