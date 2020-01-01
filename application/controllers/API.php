<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class API extends CI_Controller {
		function __construct() {
			parent::__construct(); 
			$this->load->helper(array('form', 'url'));
			$this->load->library('email');
			$this->load->Model('UserModel');
			$this->load->Model('EmailInboxModel');
			$this->load->library('session');
			$this->load->library('image_lib');
			$this->load->helper("file");
		}
		
		public function index(){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}
			
			$id=$this->session->userdata('user_id');
			$data['data_key']=$this->UserModel->get_key($id);
			$this->load->view('API/view_api',$data);
		}
		
	}
?>

