<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Account extends CI_Controller {
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
			$user['data_edit']=$this->UserModel->get_by_id($id);
			$this->load->view('user/edit_account',$user);
		}
		
		public function edit_profile(){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}
			
			$id=$this->session->userdata('user_id');
			$user['data_edit']=$this->UserModel->get_by_id($id);
			$this->load->view('user/edit_account',$user);
		}
		
		//UPADATE PROPERTY PROFILE
		public function update(){

			$config['upload_path']          = './images/property_logo/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['file_name']        	= 'Logo_'.$this->session->userdata('user_id').'_'.$this->input->post('property_name').'_'.date("Ymdhis").'.jpg';

		 
			$this->load->library('upload', $config);  
			
			// CEK KALO LOGO FOTO ADA ATAU ENGGAK(BISA JADI GK DIISI ATAU MASIH MAKE YANG LAMA) 
			// KALO MISAL GAK ISI KASI NAMA FILE = FILE LAMA, FOTO LAMA JUGA GK DIHAPUS
			if( !$this->upload->do_upload('property_logo')){
					$error = $this->upload->display_errors();
					//echo $error;
					//echo "main photo is empty";	
					$file_name = $this->input->post('property_logo_old');
			}else{
				//dapatkan data file foto event utama yg d upload
				$upload_data = $this->upload->data();
				
				//HAPUS FILE LAMA YANG NAMANYA DI AMBIL DARI HIDDEN INPUT KALO MAIN FOTO DIPERBAHARUI
				$path = './images/property_logo/'.$this->input->post('property_logo_old');
				unlink($path);
				
				//comprase foto event utama 
				$configer['image_library'] = 'gd2';
				$configer['source_image'] = $upload_data['full_path'];
				$configer['create_thumb'] = FALSE;
				$configer['maintain_ration'] = FALSE;
				$configer['width'] = 1280;
				$configer['new_image'] = $upload_data['full_path'];
				
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
	 
				//dapatkan nama foto event utama baru
				$file_name = $upload_data['file_name'];
			}
		
			$id = $this->input->post('user_id');
			
			$data = array(
					  "property_name" 						=> $this->input->post('property_name'),
					  "property_address" 					=> $this->input->post('property_address'),
					  "property_website"					=> $this->input->post('property_web'),
					  "property_logo"						=> $file_name
					);	
			
			$this->UserModel->update($data,$id);
			echo "success";

		}
		
		public function email_account(){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}
			
			$id=$this->session->userdata('user_id');
			$emails['data']=$this->UserModel->email_account($id);
			$this->load->view('user/email_account',$emails);
		}

		public function save_local_email(){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}
			
			//include_once __DIR__.'/xmlapi-php-master/xmlapi.php';
			include_once (APPPATH . 'xmlapi-php-master/xmlapi.php');
			

			$ip = 'krisnaarynasta.com'; // nama domain atau ip cpanel
			$account = "krisnaar"; // nama user cpanel
			$domain = "krisnaarynasta.com"; // domain email setelah @
			$account_pass = "wh0sy0urdaddy?"; // passwrod cpanel
			$new_email = $this->input->post('local_email'); //nama user email
			$email_password ='wh0sy0urdaddy?'; //nama user email

			$xmlapi = new xmlapi($ip);
			$xmlapi->password_auth($account, $account_pass);
			$xmlapi->set_output('json');
			$xmlapi->set_port('2083'); // Need to Change.
			$xmlapi->set_debug(1);

			$results = json_decode($xmlapi->api2_query("serverusername", "Email", "addpop", 
														array('domain' => $domain, 
																'email' => $new_email, 
																'password' => $email_password, 
																'quota' => 'unlimited')
														), true);
			// JIKA EMAIL AKUN D CPANEL UDH D BUAT													
			if($results['cpanelresult']['data'][0]['result']){
				//DATA YANG DIINSERT KE TABEL EMAIL SENDER
				$data = array(
						  "user_id" 					=> $this->session->userdata('user_id'),
						  "email" 						=> $this->input->post('local_email').'@'.$domain,
						  "password" 					=> $email_password,
						  "inbox_host"					=> '{mail.krisnaarynasta.com:993/imap/ssl/novalidate-cert}INBOX',
						  "sender_host"					=> 'ssl://mail.krisnaarynasta.com',
						  "limit_email"					=> '100'
						);	
				
				
				
				$this->UserModel->save_email_account($data);
				echo "success";
			} else {
				echo "Error creating email account:\n".$results['cpanelresult']['data'][0]['reason'];
				//echo "Error";
			}
			
		}	
		
		public function save_email_account(){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}
			
			$data = array(
					  "user_id" 					=> $this->session->userdata('user_id'),
					  "email" 						=> $this->input->post('account_email'),
					  "password" 					=> $this->input->post('account_password'),
					  "inbox_host"					=> $this->input->post('imap_host'),
					  "sender_host"					=> $this->input->post('smtp_host'),
					  "limit_email"					=> $this->input->post('sending_limit')
					);	
			
			$this->UserModel->save_email_account($data);
			echo "success";
		}	
		
		public function email_account_status(){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}

			$id = $this->input->post('id'); 
			$data = array(
			  "email_status_active" => $this->input->post('aktif_sts')
			);	 
			$this->UserModel->email_account_status($id,$data); 
			echo "success";
		}
		
		public function view_email_account_by_id($id){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}
			
			$edit_email['data_edit']=$this->UserModel->get_email_account_by_id($id);
			echo json_encode($edit_email);
		}
		
		public function update_email_account(){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}
			
			$id = $this->input->post('edit_account_email_id');
			
			$data = array(
					  "email" 						=> $this->input->post('edit_account_email'),
					  "password" 					=> $this->input->post('edit_account_password'),
					  "inbox_host"					=> $this->input->post('edit_imap_host'),
					  "sender_host"					=> $this->input->post('edit_smtp_host'),
					  "limit_email"					=> $this->input->post('edit_sending_limit')
					);	
			
			$this->UserModel->update_email_account($id,$data);
			echo "success";
		}
		
		public function change_password(){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}
			
			$this->load->view('user/change_password');
		}
		
		public function change_password_update(){
			if($this->session->userdata('login_status')!=="login"){
				redirect(base_url(),'location');
			}
			
			$id = $this->session->userdata('user_id');
			$data = array(
					  "password" 			=> $this->input->post('new_password')
					);	
			
			$this->UserModel->update($data,$id);
			echo "success";
		}
	}
?>