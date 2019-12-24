<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EventModel extends CI_Model {
	
	// GET DATA EVENT => SEKARANG DI SET DI BAWAH (BAGIAN SEARCH)
	// public function view_event($id){
		// $this->db->select('*');
		// $this->db->from('tbl_event');
		// $this->db->where('user_id',$id);
		// // dimana tgl event - tgl harus kirim lebih besar dari tgl sekarang
		// $this->db->where('(event_date - message_send_before) > CURDATE()');
		// // order by status aktif event = aktif
		// $this->db->order_by('event_status_active', "DESC");
		// // order by tgl harus kirim dari yang paling dekat dekat tgl skrng
		// $this->db->order_by("(event_date - message_send_before) > CURDATE()", "DESC");
		// $query = $this->db->get()->result();
		// return $query;
	// }
	
	// GET DATA EVENT BERDASARKAN ID EVENT
	public function view_event_by_id($id){ 
		$this->db->select('*');
		$this->db->from('tbl_event');
		$this->db->where('event_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	// GET DATA FOTO-FOTO EVENT BERDASARKAN ID EVENT
	public function view_event_photos_by_id($id){ 
		$this->db->select('*');
		$this->db->from('tbl_event_photos');
		$this->db->where('event_id', $id);
		$query = $this->db->get()->result();
		return $query; 
	}
	
	// GET DATA FOTO-FOTO EVENT BERDASARKAN NAMA FOTO DAN ID EVENT
	public function view_event_photos_by_name($id,$photo){ 
		$this->db->select('event_photo');
		$this->db->from('tbl_event_photos');
		$this->db->where('event_id', $id);
		$this->db->where_not_in('event_photo', $photo);
		$query = $this->db->get()->result();
		
		return $query;
	}
	
	//INPUT DATA KE TABEL EVENT
	public function insert($data){
		if($this->db->insert('tbl_event', $data)){
		
			$this->db->select('event_id');
			$this->db->from('tbl_event');
			$this->db->where($data);
			$query = $this->db->get()->result();
			
			foreach ($query as $query){
				$hasil= $query->event_id;
				return $hasil;
			}	
			
		}
	}
	
	//INPUT DATA FOTO KE TABEL FOTO EVENT
	public function insert_to_event_photos($data){
		$this->db->insert('tbl_event_photos', $data);
	}
	
	//UDPDATE DATA EVENT
	public function update($id,$data){
		$this->db->where('event_id', $id);
		if($this->db->update('tbl_event', $data)){ 
			return 1;
		}
	}
	
	//HAPUS FOTO EVENT YANG GK DIPAKE LAGI (PAS UPDATE DATA EVENT)
	public function delete_old_event_photos($id,$photo){
	    $this->db->where('event_id', $id);
		$this->db->where_not_in('event_photo', $photo);
		$this->db->delete('tbl_event_photos');
	}
	
	
	//GET DATA EVENT, USER, FOTO-FOTO EVENT UNTUK BUAT TAMPLATE EVENT
	public function view_event_email($id){ 
		$this->db->select('*');
		$this->db->from('tbl_event e');
		$this->db->join('tbl_user u','e.user_id=u.user_id');
		$this->db->join('tbl_event_photos ep', 'e.event_id=ep.event_id', 'left');
		$this->db->where('e.event_id', $id);
		$query = $this->db->get()->result();
		return $query; 
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
		$this->db->where('event_status_delete',0);
		$query=$this->db->get("tbl_event");	
		return $query->num_rows();	
	}
	
	public function get_filter($user_id,$search){
		
		$this->db->where('user_id',$user_id);
		$this->db->where('event_status_delete',0);
		$this->db->like('event_name', $search);
		$this->db->or_like('event_description', $search);
		$this->db->or_like('event_message', $search);
		$this->db->order_by('event_status_active', "DESC");
		// order by tgl harus kirim dari yang paling dekat dekat tgl skrng
		$this->db->order_by("(event_date - message_send_before) > CURDATE()", "DESC");
		$query=$this->db->get("tbl_event");
		return $query->num_rows();
	} 	

	public function get_current_page_records($user_id, $limit, $start){
		
		$this->db->where('user_id',$user_id);
		$this->db->where('event_status_delete',0);
		$this->db->limit($limit, $start);
		$this->db->order_by('event_status_active', "DESC");
		// order by tgl harus kirim dari yang paling dekat dekat tgl skrng
		$this->db->order_by("(event_date - message_send_before) > CURDATE()", "DESC");
        $query = $this->db->get("tbl_event");
 
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
		$this->db->where('event_status_delete',0);
		$this->db->limit($limit, $start);
		$this->db->like('event_name', $search);
		$this->db->or_like('event_description', $search);
		$this->db->or_like('event_message', $search);
		$this->db->order_by('event_status_active', "DESC");
		// order by tgl harus kirim dari yang paling dekat dekat tgl skrng
		$this->db->order_by("(event_date - message_send_before) > CURDATE()", "DESC");
        $query = $this->db->get("tbl_event");
 
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