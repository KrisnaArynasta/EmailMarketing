<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailOutbox extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');
		$this->load->Model('EmailOutboxModel');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper("file");
    }
	
	public function index(){
		if($this->session->userdata('login_status')!=="login"){
			redirect(base_url(),'location');
		}	
		$user_id = $this->session->userdata('user_id');	
		
		$search = $this->input->post('search');
		if($search){
			$total_records = $this->EmailOutboxModel->get_filter($user_id,$search);
		}else {
			$total_records = $this->EmailOutboxModel->get_total($user_id);
		}
			
			
			// init params
			$params = array();
			$limit_per_page = 10;
			$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$page = $start_index / $limit_per_page + 1;
   
	 
			if ($total_records > 0) {
				// get current page records
				if($search){
					$params['email_outbox']=$this->EmailOutboxModel->get_current_page_records_filter($user_id, $limit_per_page, $start_index, $search);
				}else{
					$params['email_outbox']=$this->EmailOutboxModel->get_current_page_records($user_id, $limit_per_page, $start_index);
				}

				
				$config['base_url'] = base_url().'EmailOutbox/index';
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
				$config['num_tag_open']     = '<li class=""><span class="page-link">';
				$config['num_tag_close']    = '</span></li>';
				$config['cur_tag_open']     = '<li class="active"><span class="page-link">';
				$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
				$config['next_tag_open']    = '<li class=""><span class="page-link">';
				$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
				$config['prev_tag_open']    = '<li class=""><span class="page-link">';
				$config['prev_tagl_close']  = '</span>Next</li>';
				$config['first_tag_open']   = '<li class=""><span class="page-link">';
				$config['first_tagl_close'] = '</span></li>';
				$config['last_tag_open']    = '<li class=""><span class="page-link">';
				$config['last_tagl_close']  = '</span></li>';
				 
				$this->pagination->initialize($config);
				 
				// build paging links
				$params["links"] = $this->pagination->create_links();
				
			}
			 
			$this->load->view('email/email-outbox',$params);
	}
	
	public function load_email_body($outbox_id){
		$data['data_email_body'] = $this->EmailOutboxModel->email_body($outbox_id);
		echo json_encode($data); 
	}
	
}


