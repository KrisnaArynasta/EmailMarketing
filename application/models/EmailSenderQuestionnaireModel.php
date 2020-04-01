<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailSenderQuestionnaireModel extends CI_Model {
	
	public function get_all_user(){
		
		$this->db->select('*');
		$this->db->from('tbl_user');
		$query = $this->db->get()->result();
		return $query;
	} 
	
	public function get_questionnaire_current_date($user_id){
		
		$where = array(
						'user_id' => $user_id,
						'questionnaire_status_delete' => 0,
						'questionnaire_send_on' => date("Y-m-d")
						);
		
		$this->db->select('*');
		$this->db->from('tbl_questionnaire');
		$this->db->where($where);
		$query = $this->db->get()->result();
		return $query;
	} 
	
	public function get_user_email($user_id){
		$this->db->select('*');
		$this->db->from('tbl_email_sender');
		$this->db->where('user_id',$user_id);
		$this->db->where('email_status_active',1);
		$query = $this->db->get()->result();
		return $query;
	}
  
	public function get_user_guest($user_id,$questionnaire_id){
		$this->db->select('guest_id');  
		$this->db->from('tbl_outbox');
		$where = array(
				'questionnaire_id' => $questionnaire_id,
				'send_date' => date("Y-m-d")
				);
		$this->db->where($where);
		$ignore = $this->db->get()->result();
		
		$this->db->select('*');
		$this->db->from('tbl_guest');
		foreach ($ignore as $ignore){$this->db->where_not_in('guest_id', $ignore->guest_id);}
		$where_user = array(
				'user_id' => $user_id,
				'guest_active_status' => 1,
				'guest_subscribe_status' => 1
				);
		$this->db->where($where_user);		
		$query = $this->db->get()->result();
		return $query;
	}
  
  	public function insert_to_send_questionnaire($data){
		//INSERT KE TABEL tbl_send_questionnaire
		$this->db->insert('tbl_send_questionnaire', $data); 
		
		// UNTUK DAPETIN ID YANG BARU DIINSERT TADI
		$this->db->select('send_questionnaire_id');
		$this->db->from('tbl_send_questionnaire');
		$this->db->order_by('send_questionnaire_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get()->result();
		
		if($query){
			foreach ($query as $query){
				$result= $query->send_questionnaire_id;
			}	
			return $result;
		}else{	
			return 0;
		}
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
	
	public function insert_to_outbox($data){
		$this->db->insert('tbl_outbox', $data); 
	}
  
  
}