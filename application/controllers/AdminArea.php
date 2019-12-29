<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminArea extends CI_Controller {
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
		
		$data['data_proved_user'] = $this->AdminModel->check_proved_user();
		$data['data_user'] = $this->AdminModel->get_user();
		$data['data_event'] = $this->AdminModel->get_event();
		$data['data_questionnaire'] = $this->AdminModel->get_questionnaire();
		$data['data_guest'] = $this->AdminModel->get_guest();
		$this->load->view('admin_area/dashboard',$data);
		
	}
 

}


?>