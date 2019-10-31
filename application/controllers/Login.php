<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->Model('UserModel');
		$this->email->set_newline("\r\n");
		$this->load->library('session');
    }
	
public function index(){
  		if($this->session->userdata('login_status') != "login"){
			$this->load->view('login/login');
		}else{
			echo 'loged';
			//$hasil['data']=$this->AdminModel->view_content();
			//$this->load->view('Admin/dashboard',$hasil);
		}
  }
 
  public function login(){
    $user=$this->input->post('email');
    $pass=$this->input->post('pass');
	$where = array(
	'email' => $user,
	'password' => $pass
	);
	
	$hasil=$this->UserModel->login($where);
	
	$cek = $hasil['nums_row'];
	$user_id = $hasil['user_id'];
	$user_email = $hasil['user_email'];
	$property_name = $hasil['property_name'];
	$property_logo = $hasil['property_logo'];
	$API_key = $hasil['API_key'];
	$secret_key = $hasil['secret_key'];
	 
	
	if( $cek == 1){
		$data_session = array(
			'user_id' => $user_id,
			'user_email' => $user_email,
			'property_name' =>$property_name,
			'property_logo' =>$property_logo,
			'API_key' =>$API_key,
			'secret_key' =>$secret_key,
			'login_status' => "login"
			);
 
		$this->session->set_userdata($data_session);
		echo $this->session->userdata('login_status');
		echo $this->session->userdata('user_id');
		echo $this->session->userdata('user_email');
		echo $this->session->userdata('property_name');
		echo $this->session->userdata('property_logo');
		echo $this->session->userdata('API_key');
		echo $this->session->userdata('secret_key');
		
	
	}else{
		echo "<script>alert('Login Failed'); window.history.back();</script>";	
	}
  }
 
	public function logout(){
		$this->session->set_userdata('login_status', "");
		redirect(base_url('Login'));
	}

}


