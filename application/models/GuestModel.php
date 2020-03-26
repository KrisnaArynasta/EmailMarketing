<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GuestModel extends CI_Model {
	
	//GET USER BY ID
	public function get_guest($id){
		$this->db->select('*');
		$this->db->from('tbl_guest');
		$this->db->where('user_id', $id);
		$this->db->order_by('guest_active_status', 'DESC');
		$this->db->order_by('guest_last_update', 'DESC');
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function save_guest($data){
		$this->db->insert('tbl_guest', $data);
	}
	
	public function get_guest_by_id($id){
		$this->db->select('*');
		$this->db->from('tbl_guest');
		$this->db->where('guest_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function update_guest($id,$data){
		$this->db->where('guest_id', $id);
		$this->db->update('tbl_guest', $data);
	}
	
	// GANTI STATUS AKTIF GUEST
	public function guest_active_status($id,$data){
		$this->db->where('guest_id', $id);
		$this->db->update('tbl_guest', $data); 
	}	
	
}