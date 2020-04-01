<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class QuestionnaireModel extends CI_Model {
	
	public function view_questionnaire_by_id($id,$user){ 
		$this->db->select('*');
		$this->db->from('tbl_questionnaire');
		$this->db->where('questionnaire_id', $id);
		$this->db->where('user_id', $user);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function view_questionnaire_email($id,$user){ 
		$this->db->select('*');
		$this->db->from('tbl_questionnaire qn');
		$this->db->join('tbl_user u','qn.user_id=u.user_id');
		$this->db->where('questionnaire_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function view_questionnaire_to_fill($id){ 
		$this->db->select('*, qn.questionnaire_id as "id_qnr", q.question_id as "question_id", qn.questionnaire_name as "questionnaire_name"');
		$this->db->from('tbl_send_questionnaire sq');
		$this->db->join('tbl_questionnaire qn','sq.questionnaire_id=qn.questionnaire_id','left');
		$this->db->join('tbl_user u','qn.user_id=u.user_id','left');
		$this->db->join('tbl_question q','qn.questionnaire_id=q.questionnaire_id','left');
		$this->db->join('tbl_question_option qo','qo.question_id=q.question_id','left');
		$this->db->where('md5(sq.send_questionnaire_id)', $id);
		$query = $this->db->get()->result();
		return $query; 
	}	

	public function view_question_option($id,$user){ 
		$this->db->select('*, qn.questionnaire_id as "id_qnr", q.question_id as "question_id"');
		$this->db->from('tbl_questionnaire qn');
		$this->db->join('tbl_question q','qn.questionnaire_id=q.questionnaire_id','left');
		$this->db->join('tbl_question_option qo','qo.question_id=q.question_id','left');
		$this->db->where('q.question_status_delete', 0);
		$this->db->where('qn.questionnaire_id', $id);
		$this->db->where('qn.user_id', $user);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function view_question_by_id($id){ 
		$this->db->select('*');
		$this->db->from('tbl_question q');
		$this->db->join('tbl_question_option qo','qo.question_id=q.question_id','left');
		$this->db->where('q.question_id', $id);
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
	
	public function update_question($data,$id){
		$this->db->where('question_id', $id);
		$this->db->update('tbl_question', $data);
	}
	
	public function insert_option($data){
		$this->db->insert('tbl_question_option', $data);
	}
	
	public function delete_option($id_question){
		$this->db->where('question_id', $id_question);
		$this->db->delete('tbl_question_option');
	}
	
	//UPDATE DATA QUESTIONNAIRE
	public function update_questionnaire($data,$id){
		$this->db->where('questionnaire_id', $id);
		$this->db->update('tbl_questionnaire', $data);
	}
	
	//DELETE QUESTION
	public function delete_question($data,$id){
		$this->db->where('question_id', $id);
		$this->db->update('tbl_question', $data);
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
		//$this->db->or_like('questionnaire_message', $search.')');
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
	
	public function insert_questionnaire_result($data,$send_questionnaire_id,$fill_status){
		//insert ke tabel tbl_option_result
		$this->db->insert('tbl_option_result', $data);
		
		//update tbl_send_questionnaire jadi statusnya udh di isi
		$this->db->where('send_questionnaire_id', $send_questionnaire_id);
		$this->db->update('tbl_send_questionnaire', $fill_status); 
		
	}
	
}