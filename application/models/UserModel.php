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
						'property_name' =>$query->property_name,
						'property_logo' =>$query->property_logo,
						'API_key' =>$query->API_key,
						'secret_key' =>$query->secret_key		
					);
			}	
			return $hasil;
		}else{	
			return 0;
		}
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
	
}