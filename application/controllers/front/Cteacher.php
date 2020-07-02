<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cteacher extends CI_Controller {

	function __construct() {
      parent::__construct();
    }
	public function index()
	{
		$CI =& get_instance();
	//	$CI->auth->check_tutor_auth();
		$html_page = "";
		if ($CI->auth->is_logged())
		{
			if($CI->auth->is_tutor()){
			 	$url = base_url().'tutor/Tutor_dashboard';
				redirect($url,'refresh'); exit; 	
			}else{
				$html_page = "front_view/signin_signup/signin";
			} 
		}else{
			$html_page = "front_view/signin_signup/signin";
		}
		$CI->parser->parse($html_page,$data = array());	
	}
}