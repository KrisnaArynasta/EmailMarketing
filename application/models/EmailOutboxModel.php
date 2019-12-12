<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailOutboxModel extends CI_Model {
	
	// SEARCH FUCTION
	public function get_total($user_id){
		
		$this->db->join('tbl_event','tbl_outbox.event_id=tbl_event.event_id', 'left');
		$this->db->where('tbl_outbox.user_id',$user_id);
		$this->db->order_by('send_date, send_time','DESC');
		$query=$this->db->get("tbl_outbox");	
		return $query->num_rows();	
	}
	
	public function get_filter($user_id,$search){
		
		$this->db->join('tbl_event','tbl_outbox.event_id=tbl_event.event_id', 'left');
		$this->db->where('tbl_outbox.user_id',$user_id);
		$this->db->like('message_send', $search);
		$this->db->or_like('outbox_subject', $search);
		$this->db->or_like('email_send_to', $search);
		$this->db->order_by('send_date, send_time','DESC');
		$query=$this->db->get("tbl_outbox");
		return $query->num_rows();
	} 	

	public function get_current_page_records($user_id, $limit, $start){
		
		$this->db->join('tbl_event','tbl_outbox.event_id=tbl_event.event_id', 'left');
		$this->db->where('tbl_outbox.user_id',$user_id);
		$this->db->limit($limit, $start);
		$this->db->order_by('send_date, send_time','DESC');
        $query = $this->db->get("tbl_outbox");
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
	
	public function get_current_page_records_filter($user_id, $limit, $start, $search){
		
		$this->db->join('tbl_event','tbl_outbox.event_id=tbl_event.event_id', 'left');		
		$this->db->where('tbl_outbox.user_id',$user_id);
		$this->db->limit($limit, $start);
		$this->db->like('message_send', $search);
		$this->db->or_like('outbox_subject', $search);
		$this->db->or_like('email_send_to', $search);
		$this->db->order_by('send_date, send_time','DESC');
        $query = $this->db->get("tbl_outbox");
 
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
	
	public function email_body($outbox_id){
		$this->db->select('*');
		$this->db->from('tbl_outbox');
		$this->db->where('outbox_id',$outbox_id);
		$query = $this->db->get()->row_array(); //row array biar datanya gk dalam index array
		return $query;
	}

}