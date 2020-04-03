<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->Model('DashboardModel');
		$this->load->library('session');
    }
	
	public function index(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		//SET USER ID YANG LOGIN
		$user_id = $this->session->userdata('user_id');	
		
		$data['data_outbox'] = $this->DashboardModel->get_email_sent($user_id);
		$data['data_event'] = $this->DashboardModel->get_event_waiting($user_id);
		$data['data_questionnaire'] = $this->DashboardModel->get_questionnaire($user_id);
		$data['data_guest'] = $this->DashboardModel->get_guest($user_id);
		$data['data_inbox'] = $this->DashboardModel->get_inbox($user_id);
		$this->load->view('dashboard/dashboard',$data);
		
	}
 

}


?>