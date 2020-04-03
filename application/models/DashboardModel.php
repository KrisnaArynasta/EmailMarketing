<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardModel extends CI_Model {
	
	public function get_email_sent($id){
		$this->db->select('count(*) as result');
		$this->db->from('tbl_outbox');
		$this->db->where('user_id', $id);
		$this->db->where('send_date', date("Y-m-d"));
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function get_event_waiting($id){
		$this->db->select('count(*) as result');
		$this->db->from('tbl_event');
		$this->db->where('user_id',$id);
		// dimana tgl event - tgl harus kirim lebih besar dari tgl sekarang
		$this->db->where('(event_date - message_send_before) > CURDATE()');
		$query = $this->db->get()->result();
		return $query;
	}
	
	public function get_questionnaire($id){
		$this->db->select('count(*) as result');
		$this->db->from('tbl_send_questionnaire sn');
		$this->db->join('tbl_questionnaire qn','sn.questionnaire_id=qn.questionnaire_id');
		$this->db->where('questionnaire_fill_status', 1);
		$this->db->where('user_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function get_guest($id){
		$this->db->select('count(*) as result');
		$this->db->from('tbl_guest');
		$this->db->where('user_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function get_inbox($id){
		$this->db->select('*');
		$this->db->from('tbl_inbox');
		$this->db->where('user_id', $id);
		$this->db->order_by('inbox_id', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get()->result();
		return $query; 
	}
	
}