<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//turunan class dari object Google_Client yang telah disediakan oleh google, 
//yang telah di autoload pada file config.php yaitu : $config[‘composer_autoload’] = ‘vendor/autoload.php’;
//pada controller nanti bisa memanggil library tersebut dengan kode $this→load→library(‘Google’);
class Google extends Google_Client {
	function __construct() {
		parent::__construct(); 
		$this->setAuthConfigFile(APPPATH . '/client_secret.json');
		$this->setRedirectUri(base_url().'Login/oauth2callback');
		$this->setApplicationName('PEMS');
		$this->setScopes(array(
		"https://www.googleapis.com/auth/plus.login",
		"https://www.googleapis.com/auth/userinfo.email",
		"https://www.googleapis.com/auth/userinfo.profile",
		"https://www.googleapis.com/auth/plus.me",
		)); 
	}
}