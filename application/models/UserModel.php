<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {
	
	public function login($where){
		$cek=$this->db->get_where('tbl_user', $where);
		
		
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where($where);
		$query = $this->db->get()->result();
		
		if($query){
			foreach ($query as $query){
				$hasil= array(
						'nums_row' => $cek->num_rows(),
						'user_id' => $query->user_id,
						'user_email' => $query->email,
						'property_name' =>$query->property_name,
						'property_logo' =>$query->property_logo,
						'API_key' =>$query->API_key,
						'secret_key' =>$query->secret_key		
					);
			}	
			return $hasil;
		}else{	
			return 0;
		}
	}	
}