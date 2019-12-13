<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class QuestionnaireModel extends CI_Model {
	
	// GET DATA EVENT
	public function view_event($id){
		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where('user_id',$id);
		// dimana tgl event - tgl harus kirim lebih besar dari tgl sekarang
		$this->db->where('(event_date - message_send_before) > CURDATE()');
		// order by status aktif event = aktif
		$this->db->order_by('event_status_active', "DESC");
		// order by tgl harus kirim dari yang paling dekat dekat tgl skrng
		$this->db->order_by("(event_date - message_send_before)", "ASC");
		$query = $this->db->get()->result();
		return $query;
	}
	
	public function view_questionnaire_by_id($id,$user){ 
		$this->db->select('*');
		$this->db->from('tbl_questionnaire');
		$this->db->where('questionnaire_id', $id);
		$this->db->where('user_id', $user);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function view_question_option($id,$user){ 
		$this->db->select('*');
		$this->db->from('tbl_questionnaire qn');
		$this->db->join('tbl_question q','q.questionnaire_id=qn.questionnaire_id');
		$this->db->join('tbl_question_option qo','qo.question_id=q.question_id');
		$this->db->where('qn.questionnaire_id', $id);
		$this->db->where('qn.user_id', $user);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function insert_questionnaire($data){
		//UNTUK INSERT KE TBL Questionnaire
		$this->db->insert('tbl_questionnaire', $data);
		
		// UNTUK DAPETIN ID YANG BARU DIINSERT TADI
		$this->db->select('questionnaire_id');
		$this->db->from('tbl_questionnaire');
		$this->db->order_by('questionnaire_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get()->result();
		
		if($query){
			foreach ($query as $query){
				$result= $query->questionnaire_id;
			}	
			return $result;
		}else{	
			return 0;
		}
	}
	
	public function insert_question($data){
		//UNTUK INSERT KE TBL Questionnaire
		$this->db->insert('tbl_question', $data);
		
		// UNTUK DAPETIN ID YANG BARU DIINSERT TADI
		$this->db->select('question_id');
		$this->db->from('tbl_question');
		$this->db->order_by('question_id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get()->result();
		
		if($query){
			foreach ($query as $query){
				$result= $query->question_id;
			}	
			return $result;
		}else{	
			return 0;
		}
	}
	
	public function insert_option($data){
		$this->db->insert('tbl_question_option', $data);
	}
	
	//UDPDATE DATA EVENT
	public function update($id,$data){
		$this->db->where('event_id', $id);
		if($this->db->update('tbl_event', $data)){ 
			return 1;
		}
	}
	
	
	//UPDATE DATA EVENT NON AKTIF ATAU AKTIF (1 / 0)
	public function aktif($id,$data){
		$this->db->where('event_id', $id);
		$this->db->update('tbl_event', $data); 
	}	
	
	
	//UPDATE DATA EVENT JADI DELETED (1)
	public function delete($id,$data){
		$this->db->where('event_id', $id);
		$this->db->update('tbl_event', $data); 
	}
	
	
	
	// SEARCH FUCTION
	public function get_total($user_id){
		
		$this->db->where('user_id',$user_id);
		//$this->db->where('event_status_delete',0);
		$query=$this->db->get("tbl_questionnaire");	
		return $query->num_rows();	
	}
	
	public function get_filter($user_id,$search){
		
		$this->db->where('user_id',$user_id);
		//$this->db->where('event_status_delete',0);
		$this->db->like('questionnaire_name', $search);
		$this->db->or_like('questionnaire_message', $search);
		$query=$this->db->get("tbl_questionnaire");
		return $query->num_rows();
	} 	

	public function get_current_page_records($user_id, $limit, $start){
		
		$this->db->where('user_id',$user_id);
		//$this->db->where('event_status_delete',0);
		$this->db->limit($limit, $start);
        $query = $this->db->get("tbl_questionnaire");
 
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
		
		$this->db->where('user_id',$user_id);
		//$this->db->where('event_status_delete',0);
		$this->db->limit($limit, $start);
		$this->db->like('questionnaire_name', $search);
		$this->db->or_like('questionnaire_message', $search);
        $query = $this->db->get("tbl_questionnaire");
 
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
	

}