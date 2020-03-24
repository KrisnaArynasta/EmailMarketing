<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventData extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->Model('AdminModel');
		$this->load->library('session');
    }
	
	public function index(){
		if($this->session->userdata('admin_login_status')!=="login"){
			redirect(base_url('AdminArea'),'location');
		}
		
		$data['data_event'] = $this->AdminModel->get_event_all();
		$this->load->view('admin_area/event_data',$data);
		
	}
}


?>