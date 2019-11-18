<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailInboxModel extends CI_Model {
	
	// mendapatkan data akun email sumber inbox
	public function email_account($user_id){
		$this->db->select('*');
		$this->db->from('tbl_email_sender');
		$this->db->where('user_id',$user_id);
		$this->db->where('email_status_active',1);
		$query = $this->db->get()->result();
		return $query;
	}
	
	// mendapatkan data tamu
	public function guest_email($user_id){
		$this->db->select('*');
		$this->db->from('tbl_guest');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get()->result();
		return $query;
	}
    
	// dapatkan tanggal log terakhir user untuk di jadikan sebagai parameter load email apabila sudah pernah load sebelumnya
	public function last_log_inbox($user_id){
		$this->db->select('*');
		$this->db->from('tbl_log_load_inbox');
		$this->db->where('user_id',$user_id);
		$this->db->order_by('last_load_date', 'ASC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query;

	}
	// mendapatkan data inbox
	public function inbox_email($user_id){
		$this->db->select('*');
		$this->db->from('tbl_inbox');
		$where = array(
				'user_id' => $user_id,
				'duplicate_status' => 0
				); 
		$this->db->where($where);
		$this->db->order_by('inbox_id', 'DESC');
		$query = $this->db->get()->result();
		return $query;
	}
	
	public function update_duplicate_status($message_id,$data){
		$this->db->where('message_id', $message_id);
		$this->db->update('tbl_inbox', $data);
	}
	
	public function delete_duplicate_email(){
		$this->db->where('duplicate_status', 1);
		$this->db->delete('tbl_inbox');
	}
	
	public function insert_inbox($data){
		$this->db->insert('tbl_inbox', $data);
	}
	
	public function insert_new_log_inbox($data){
		$this->db->insert('tbl_log_load_inbox', $data);
	}
	
	public function email_body($inbox_id){
		$this->db->select('*');
		$this->db->from('tbl_inbox');
		$this->db->where('inbox_id',$inbox_id);
		$query = $this->db->get()->row_array(); //row array biar datanya gk dalam index array
		return $query;
	}
	
	public function email_sender($user_id){
		//get email yang sudah limit hari ini
		$this->db->select('o.email_sender_id');  
		$this->db->from('tbl_outbox o');
		$this->db->join('tbl_email_sender es','o.email_sender_id=es.email_sender_id');
		$this->db->where('send_date',date("Y-m-d"));
		$this->db->having('COUNT(outbox_id) >','limit_email');
		$this->db->group_by('o.email_sender_id');
		$ignore_sender = $this->db->get()->result();
		
		//get email yg tidak limit hari ini berdasarkan query di atas
		$this->db->select('*');
		$this->db->from('tbl_email_sender');
		foreach ($ignore_sender as $ignore_sender){$this->db->where_not_in('email_sender_id', $ignore_sender->email_sender_id);}
		$this->db->where('user_id',$user_id);		
		$this->db->where('email_status_active',1);		
		$query = $this->db->get()->result();
		return $query;
	}
		
}