<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '1093228467265-jg2r4159vsoqqt8h1cj77p82qivocpui.apps.googleusercontent.com';
$config['google']['client_secret']    = 'TK79ZEx7FtL065254msa1OEJ';
$config['google']['redirect_uri']     = 'base_url()Login/login_with_google';
$config['google']['application_name'] = 'PEMS';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();

?>