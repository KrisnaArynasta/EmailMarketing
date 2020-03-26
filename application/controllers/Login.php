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
			redirect(base_url('Dashboard'),'location');
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
	$user_password = $hasil['user_password'];
	$property_name = $hasil['property_name'];
	$property_address = $hasil['property_address'];
	$property_website = $hasil['property_website'];
	$property_logo = $hasil['property_logo'];
	$API_key = $hasil['API_key'];
	$secret_key = $hasil['secret_key'];
	 
	
	if( $cek == 1){
		$data_session = array(
			'user_id' => $user_id,
			'user_email' => $user_email,
			'user_password' => $user_password,
			'property_name' =>$property_name,
			'property_address' =>$property_address,
			'property_website' =>$property_website,
			'property_logo' =>$property_logo,
			'API_key' =>$API_key,
			'secret_key' =>$secret_key,
			'login_status' => "login"
			);
 
		$this->session->set_userdata($data_session);
		redirect(base_url('Dashboard'));
		
	
	}else{
		echo "<script>alert('Login Failed'); window.history.back();</script>";	

	}
  }
 
	public function logout(){
		$this->session->set_userdata('login_status', "");
		redirect(base_url('Login'));
	}
	
	public function register(){
		
		//CAPTCHA
		$secretKey="6Lf2jMAUAAAAABrNgdHt9tpZjWh0eicT6UOAEexd";
		$captcha = $this->input->post('g-recaptcha-response');
		$respond=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
		
		if(isset($captcha)){
	
			$cek_capt=json_decode($respond,true);

			//cek apakah jawaban dari captcha benar
			if($cek_capt["success"]==true){
			
				$API = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU1234567890"),0,100);
				$API = date('hisYmd').$API.date('Ymdhis');
				$secret = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU1234567890"),0,100);
				$secret = date('hisYmd').$API.date('Ymdhis');
				
				$data = array(
						  "email" 						=> $this->input->post('email'),
						  "password" 					=> $this->input->post('password'),
						  "property_name"				=> $this->input->post('property_name'),
						  "API_key"						=> $API,
						  "secret_key"					=> $secret,
						  "user_status_active"			=> 0
						);	
				
				$this->UserModel->register($data);
				echo "success";
				
			}else echo "fail"; //fail captcha respone 
		}else echo "fail"; // captcha kosong
	}

}


?>