<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
$ci =& get_instance(); 
$data = $ci->db->where('google_id','1')->get('google_config')->row();
if(!empty($data)) {
	$config['googleplus']['client_id']        = $data->google_client_id;
	$config['googleplus']['client_secret']    = $data->google_secret_id;
	$config['googleplus']['api_key']          = $data->google_api_key; 
	$config['googleplus']['application_name'] = 'web';
	$config['googleplus']['redirect_uri'] = base_url().'front/Signup/gmail_login';
	$config['googleplus']['scopes']           = array('profile','email');
}else{
	echo "Please set google app info";
}

