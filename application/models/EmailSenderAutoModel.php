<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailSenderAutoModel extends CI_Model {
	
	public function input_email($data){
		$this->db->insert('tbl_outbox', $data); 
	}
	
	public function get_outbox(){
		$this->db->select('*');
		$this->db->from('tbl_outbox o');
		$this->db->join('tbl_email_sender es','o.email_sender_id=es.email_sender_id');
		$this->db->where('sent_status',0);
		$query = $this->db->get()->result();
		return $query; 
	}
		
	public function update_outbox($outbox_id,$data){
		$this->db->where('outbox_id', $outbox_id); 
		$this->db->update('tbl_outbox', $data); 
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
  
  
}