<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model {
	
	public function login($where){
		$cek=$this->db->get_where('tbl_admin', $where);
		
		
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where($where);
		$query = $this->db->get()->result();
		
		if($query){
			foreach ($query as $query){
				$hasil= array(
						'nums_row' => $cek->num_rows(),
						'admin_id' => $query->admin_id,
						'admin_username' => $query->admin_username,
						'admin_password' => $query->admin_password,	
						'admin_name' => $query->admin_name
					);
			}	
			return $hasil;
		}else{	
			return 0;
		}
	}

	// public function register($data){
		// $this->db->insert('tbl_user', $data);
	// }
	
	//GET SEMUA DATA USER
	public function get_user_all(){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$query = $this->db->get()->result();
		return $query; 
	}
	
	//GETS DETAIL DATA USER
	public function get_user_detail($id){
		$this->db->select('*');
		$this->db->from('tbl_user u');
		$this->db->join('tbl_admin a','u.admin_id_approver=a.admin_id','left');
		$this->db->where('user_id',$id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	//HITUNG JUMLAH USER YG BLM D APPROVE
	public function check_proved_user(){
		$this->db->select('count(*) as result');
		$this->db->from('tbl_user');
		$this->db->where('user_status_active',0);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	//HITUNG USER
	public function get_user(){
		$this->db->select('count(*) as result');
		$this->db->from('tbl_user');
		$this->db->where('user_status_active',1);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	//HITUNG EVENT
	public function get_event(){
		$this->db->select('count(*) as result');
		$this->db->from('tbl_event');
		$query = $this->db->get()->result();
		return $query; 
	}
		
	//HITUNG QUESTIONNAIRE
	public function get_questionnaire(){
		$this->db->select('count(*) as result');
		$this->db->from('tbl_questionnaire');
		$query = $this->db->get()->result();
		return $query; 
	}
	
	//HITUNG TAMU
	public function get_guest(){
		$this->db->select('count(*) as result');
		$this->db->from('tbl_guest');
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function user_status($id,$data){
		$this->db->where('user_id', $id);
		$this->db->update('tbl_user', $data); 
	}

	
}