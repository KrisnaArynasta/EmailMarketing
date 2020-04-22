<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QuestionnaireData extends CI_Controller {
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
		
		$data['data_questionnaire'] = $this->AdminModel->get_questionnaire_all();
		$this->load->view('admin_area/questionnaire_data',$data);
		
	}
	
	public function view_detail_user($id){
		if($this->session->userdata('admin_login_status')!=="login"){
			redirect(base_url('AdminArea'),'location');
		}
		
		$data['data_user'] = $this->AdminModel->get_user_detail($id);
		echo json_encode($data);
		
	}
}


?>