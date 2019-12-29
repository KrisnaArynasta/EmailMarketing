<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserData extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->Model('AdminModel');
		$this->load->library('session');
    }
	
	public function index(){
		if($this->session->userdata('admin_login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$data['data_user'] = $this->AdminModel->get_user_all();
		$this->load->view('admin_area/user_data',$data);
		
	}
	
	public function view_detail_user($id){
		if($this->session->userdata('admin_login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$data['data_user'] = $this->AdminModel->get_user_detail($id);
		echo json_encode($data);
		
	}
	
	public function user_status(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}

		$id = $this->input->post('id'); 
		$data = array(
		  "user_status_active" => $this->input->post('aktif_sts'),
		  "admin_id_approver" => $this->session->userdata('admin_id')
		);	 
		$this->AdminModel->user_status($id,$data); 
		echo "success";
	}
 

}


?>