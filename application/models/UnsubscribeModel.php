<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UnsubscribeModel extends CI_Model {
	
	//GET USER BY ID
	public function Unsubscribe($id){
		$data = array(
			'guest_subscribe_status' => 0	
		);
		$this->db->where('md5(guest_id)', $id);
		$this->db->update('tbl_guest', $data);
		//return $query; 
	}
	
}