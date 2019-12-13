<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questionnaire extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->Model('QuestionnaireModel');
		$this->load->library('session');
		$this->load->library('pagination');
    }
	
	public function index(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		//$this->load->view('questionnaire/view_questionnaire');
		
		$user_id = $this->session->userdata('user_id');	
		
		$search = $this->input->post('search');
		if($search){
			$total_records = $this->QuestionnaireModel->get_filter($user_id,$search);
		}else {
			$total_records = $this->QuestionnaireModel->get_total($user_id);
		}
			
			
			// init params
			$params = array();
			$limit_per_page = 6;
			$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$page = $start_index / $limit_per_page + 1;
   
	 
			if ($total_records > 0) {
				// get current page records
				if($search){
					$params['questionnaire']=$this->QuestionnaireModel->get_current_page_records_filter($user_id, $limit_per_page, $start_index, $search);
				}else{
					$params['questionnaire']=$this->QuestionnaireModel->get_current_page_records($user_id, $limit_per_page, $start_index);
				}

				
				$config['base_url'] = base_url().'Questionnaire/index';
				$config['total_rows'] = $total_records;
				$config['per_page'] = $limit_per_page;
				$config["uri_segment"] = 3;

				//bootstrap class
				$config['first_link']       = '<i class="fe fe-chevrons-left"></i>';
				$config['last_link']        = '<i class="fe fe-chevrons-right"></i>';
				$config['next_link']        = '<i class="fe fe-chevron-right"></i>';
				$config['prev_link']        = '<i class="fe fe-chevron-left"></i>';
				$config['full_tag_open']    = '<div class="pagging text-center"><nav style="border-right:0"><ul class="pagination justify-content-center">';
				$config['full_tag_close']   = '</ul></nav></div>';
				$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
				$config['num_tag_close']    = '</span></li>';
				$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
				$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
				$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
				$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['prev_tagl_close']  = '</span>Next</li>';
				$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
				$config['first_tagl_close'] = '</span></li>';
				$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
				$config['last_tagl_close']  = '</span></li>';
				 
				$this->pagination->initialize($config);
				 
				// build paging links
				$params["links"] = $this->pagination->create_links();
				
			}
			 
			//$hasil['data']=$this->ManometerModel->view_all_manometer();
			$this->load->view('Questionnaire/view_questionnaire',$params);
			
	}

	public function create(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		  
		$this->load->view('questionnaire/create_questionnaire');
	}
	
	public function insert_questionnaire(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$data = array(
			  "user_id" 						=> $this->session->userdata('user_id'),
			  "questionnaire_name" 				=> $this->input->post('question_name'),
			  "questionnaire_date_create" 		=> date("Y-m-d"),
			  "questionnaire_send_on"			=> $this->input->post('send_on'),
			  "questionnaire_message"			=> $this->input->post('question_email')
			);	

			//QUERY UNTUK NYIMPEN DATA Questionnaire DAN MENDAPATKAN Questionnaire_Id PALING AKHIR (ARTINYA YANG BARU DIINPUTIN) Questionnaire_Id KEMUDIAN DI SIMPEN DI VARIABLE ID
			$id = $this->QuestionnaireModel->insert_questionnaire($data);	
			//redirect ke FUNCTION create_question DENGAN PARAMETER Questionnaire_Id
			redirect(base_url("Questionnaire/create_question/".$id),'location');	
	}
		
	public function edit($id){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$result['data_edit'] = $this->EventModel->view_event_by_id($id);
		$result['data_edit_event_photos'] = $this->EventModel->view_event_photos_by_id($id);
		$this->load->view('Event/edit_event',$result);
	}
	
	public function create_question($id){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		//$user DIBUAT UNTUK MEMASTIKAN KALAU Questionnaire YANG MAU DI BUAT QUESTIONNYA ITU DARI USER YANG BENER
		$user = $this->session->userdata('user_id');
		$result['data_questionnaire'] = $this->QuestionnaireModel->view_question_option($id,$user);
		$this->load->view('questionnaire/create_question',$result);
	}
	
	public function insert_question(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}
		
		$data_question = array(
			  "questionnaire_id" 				=> $this->input->post('questionnaire_id'),
			  "question"				 		=> $this->input->post('question')
		);	
		
		//QUERY UNTUK NYIMPEN DATA QUESTION DAN MENDAPATKAN QUESTION_ID PALING AKHIR (ARTINYA YANG BARU DIINPUTIN) QUESTION_ID KEMUDIAN DI SIMPEN DI VARIABLE ID_QUESTION
		$id_question = $this->QuestionnaireModel->insert_question($data_question);	
		
		//PERULANGAN BUAT INSERT KE TABEL QUESTION OPTION 
		foreach ($this->input->post('option') as $key => $option) {
			
			$data_option = array(
			  "question_id" 				=> $id_question,
			  "question_option_value"		=> $option
			);
			
			$this->QuestionnaireModel->insert_option($data_option);
			
		}
		
		echo "success";
	}
	
	public function view_event_email($event_id){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}		
		
		$data['data_detail']=$this->EventModel->view_event_email($event_id);
		echo json_encode($data);
	}
	
	public function aktif(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}

		$id = $this->input->post('id'); 
		$data = array(
		  "event_status_active" => $this->input->post('aktif_sts')
		);	 
		$this->EventModel->aktif($id,$data); 
		echo "success";
	}
	
	public function delete(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}

		$id = $this->input->post('id'); 
		$data = array(
		  "event_status_delete" => $this->input->post('delete_sts')
		);	 
		$this->EventModel->delete($id,$data); 
		echo "success";
	}
	
}


