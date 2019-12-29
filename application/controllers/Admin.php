<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->Model('AdminModel');
		$this->load->library('session');
    }
	
	public function index(){
			if($this->session->userdata('admin_login_status') != "login"){
				$this->load->view('login/admin_login');
			}else{
				redirect(base_url('AdminArea'),'location');
			}
	  }
 
	public function login(){
		$user = $this->input->post('username');
		$pass = $this->input->post('pass');
		$where = array(
			'admin_username' => $user,
			'admin_password' => $pass
		);

		$hasil=$this->AdminModel->login($where);

		$cek = $hasil['nums_row'];
		$admin_id = $hasil['admin_id'];
		$admin_user = $hasil['admin_username'];
		$admin_password = $hasil['admin_password'];
		$admin_name = $hasil['admin_name'];

		if( $cek == 1){
			$data_session = array(
				'admin_id' => $admin_id,
				'admin_user' => $admin_user,
				'admin_password' => $admin_password,
				'admin_name' =>$admin_name,
				'admin_login_status' => "login"
			);

			$this->session->set_userdata($data_session);
			redirect(base_url('AdminArea'),'location');
			
			
		}else{
			echo "<script>alert('Login Failed'); window.history.back();</script>";	

		}
	}
 
	public function logout(){
		$this->session->set_userdata('admin_login_status', "");
		redirect(base_url('Admin'));
	}

}


?>