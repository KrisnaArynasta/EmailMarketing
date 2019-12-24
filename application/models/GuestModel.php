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
	
}