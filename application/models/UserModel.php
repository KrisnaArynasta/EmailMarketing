<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {
	
	public function login($where){
		$cek=$this->db->get_where('tbl_user', $where);
		
		
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where($where);
		$query = $this->db->get()->result();
		
		if($query){
			foreach ($query as $query){
				$hasil= array(
						'nums_row' => $cek->num_rows(),
						'user_id' => $query->user_id,
						'user_email' => $query->email,
						'user_password' => $query->password,
						'property_name' =>$query->property_name,
						'property_logo' =>$query->property_logo,
						'property_address' =>$query->property_address,
						'property_website' =>$query->property_website,
						'API_key' =>$query->API_key,
						'secret_key' =>$query->secret_key		
					);
			}	
			return $hasil;
		}else{	
			return 0;
		}
	}

	//CEK EMAIL UDAH TERDAFTAR APA BELUM
	public function check_email_register($email){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function login_with_google($email){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('email', $email);
		$query = $this->db->get();
		$check = $query->num_rows();
		
		// CEK KLO EMAILNYA UDH ADA BLM, KLO UDH:
		if($check>0){
			//BUAT SELECT DATA YANG LOGIN
			$this->db->select('*');
			$this->db->from('tbl_user');
			$this->db->where('email', $email);
			$query = $this->db->get()->result();
			foreach ($query as $query){
				$hasil= array(
						'user_id' => $query->user_id,
						'user_email' => $query->email,
						'user_password' => $query->password,
						'property_name' =>$query->property_name,
						'property_logo' =>$query->property_logo,
						'property_address' =>$query->property_address,
						'property_website' =>$query->property_website,
						'API_key' =>$query->API_key,
						'secret_key' =>$query->secret_key,	
						//KALO PENGGUNA LAMA AKAN DI ARAHKAN LANGSUNG KE HALAMAN DASHBOARD					
						'redirect_url' =>'Dashboard'		
					);
			}
		// CEK KLO EMAILNYA UDH ADA BLM, KLO BLM:			
		}else{	
			
			//Build API dan Secret Key
			$API = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU1234567890"),0,15);
			$API = date('hisYmd').$API;
			$secret = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU1234567890!@#$%^&*)("),0,50);
		
			$data = array(
							'email' => $email,
							'API_key' => $API,
							'secret_key' => $secret
					);
			
			if($this->db->insert('tbl_user', $data)){
				//BUAT SELECT YG TADI DI INSERT
				$this->db->select('*');
				$this->db->from('tbl_user');
				$this->db->where('email', $email);
				$query = $this->db->get()->result();
				foreach ($query as $query){
					$hasil= array(
							'user_id' => $query->user_id,
							'user_email' => $query->email,
							'user_password' => $query->password,
							'property_name' =>$query->property_name,
							'property_logo' =>$query->property_logo,
							'property_address' =>$query->property_address,
							'property_website' =>$query->property_website,
							'API_key' =>$query->API_key,
							'secret_key' =>$query->secret_key,
							//KALO PENGGUNA BARU AKAN DI ARAHKAN KE HALAMAN EDIT PROFILE USER
							'redirect_url' =>'Account/edit_profile'	
						);
				}
			}
		}
		return $hasil;
	}

	public function register($data){
		$this->db->insert('tbl_user', $data);
	}
	
	//GET USER BY ID
	public function get_by_id($id){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	//UPDATE DATA PROPERTY PROFILE
	public function update($data,$id){
		$this->db->where('user_id', $id);
		$this->db->update('tbl_user', $data);
	}
	
	public function save_email_account($data){
		$this->db->insert('tbl_email_sender', $data);
	}
	
	//UPDATE DATA EMAIL SENDER NON AKTIF ATAU AKTIF (1 / 0)
	public function email_account_status($id,$data){
		$this->db->where('email_sender_id', $id);
		$this->db->update('tbl_email_sender', $data); 
	}	
	
	public function email_account($id){
		$this->db->select('*');
		$this->db->from('tbl_email_sender');
		$this->db->where('user_id', $id);
		$this->db->order_by('email_status_active', 'DESC');
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function get_email_account_by_id($id){
		$this->db->select('*');
		$this->db->from('tbl_email_sender');
		$this->db->where('email_sender_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function update_email_account($id,$data){
		$this->db->where('email_sender_id', $id);
		$this->db->update('tbl_email_sender', $data);
	}
	
	//DAPETIN API KEY DAN SECRET KEY USER
	public function get_key($id){
		$this->db->select('API_key, secret_key');
		$this->db->from('tbl_user');
		$this->db->where('user_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
}