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
 

}


?>