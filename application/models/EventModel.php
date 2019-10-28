<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EventModel extends CI_Model {
	
	// mendapatkan data akun email sumber inbox
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

	public function view_event_by_id($id){ 
		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where('event_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function view_event_photos_by_id($id){ 
		$this->db->select('*');
		$this->db->from('tbl_event_photos');
		$this->db->where('event_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	public function insert($data){
		if($this->db->insert('tbl_event', $data)){
		
			$this->db->select('event_id');
			$this->db->from('tbl_event');
			$this->db->where($data);
			$query = $this->db->get()->result();
			
			foreach ($query as $query){
				$hasil= $query->event_id;
			}	
			return $hasil;
		}
	}

	public function insert_to_event_photos($data){
		$this->db->insert('tbl_event_photos', $data);
	}

}