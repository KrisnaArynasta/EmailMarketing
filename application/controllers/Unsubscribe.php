<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unsubscribe extends CI_Controller {
	function __construct() {
		parent::__construct(); 
		$this->load->helper(array('form', 'url'));
		$this->load->Model('UnsubscribeModel');
		$this->load->library('session');
    }
	
	public function Unsubscribe($id){		
		$this->UnsubscribeModel->Unsubscribe($id);
		//echo "<center><h1>Unsubscribed!</h1></center>";
		$this->load->view('Unsubscribe/unsubscribe');
		
	}
}


?>