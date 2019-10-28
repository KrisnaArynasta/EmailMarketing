<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailSenderEventModel extends CI_Model {
	
	public function get_user_email($user_id){
		$this->db->select('*');
		$this->db->from('tbl_email_sender');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get()->result();
		return $query;
	}
  
	public function get_user_guest($user_id,$event_id){
		$this->db->select('guest_id');  
		$this->db->from('tbl_outbox');
		$where = array(
				'event_id' => $event_id,
				'send_date' => date("Y-m-d")
				);
		$this->db->where($where);
		$ignore = $this->db->get()->result();
		
		$this->db->select('*');
		$this->db->from('tbl_guest');
		foreach ($ignore as $ignore){$this->db->where_not_in('guest_id', $ignore->guest_id);}
		$this->db->where('user_id',$user_id);		
		$query = $this->db->get()->result();
		return $query;
	}
  
	public function get_inbox_count($sender_id){ // hitung jumlah pesan yang sudah dikirim oleh suatu email sender
		
		$where = array(
				'email_sender_id' => $sender_id,
				'sent_status' => 1,
				'send_date' => date("Y-m-d")
				);
		
		$this->db->select('*');
		$this->db->from('tbl_outbox');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->num_rows();
	}
  
 	public function get_event_current_date($user_id){
		
		$where = array(
						'user_id' => $user_id,
						'event_status_active' => 1,
						'(event_date - INTERVAL message_send_before DAY) =' => date("Y-m-d")
						);
		
		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where($where);
		$query = $this->db->get()->result();
		return $query;
	} 
	
	public function insert_to_outbox($data){
		$this->db->insert('tbl_outbox', $data); 
	}
  
  
}