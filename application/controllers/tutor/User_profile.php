<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_profile extends CI_Controller {

	function __construct() {
      parent::__construct();
    }
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('tutor_lib/lprofile');
		
		$content = $CI->lprofile->get_user_all_info();	
		$this->template->full_tutor_html_view($content);
	}
	//Edit full name
	public function edit_full_name()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('tutor_lib/lprofile');
		$content = $CI->lprofile->get_edit_full_name_view();	
		$this->template->full_tutor_html_view($content);
	}
	//Ueser full name edit
 	public function do_user_full_name_edit()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Profiles');

		$password = md5("gef_quize".$CI->input->post('password'));
		
		$is_exist = $CI->Profiles->check_old_password( $password );
		

		if($is_exist)
		{
			$data =array(
				"user_name"	=> $this->input->post('full_name')
				);
			$CI->Profiles->user_info_update( $data );
			
			$CI->session->set_userdata(array('message'=>display("successfully_changed")));
			redirect(base_url('tutor/User_profile'));exit();
			
		}else{
		
			$CI->session->set_userdata(array('warning_message'=>display("sorry_password_dosent_match")));

			redirect(base_url('tutor/User_profile/edit_user_info'));exit();
		}
		
	}
	//User cell no edit
	public function edit_user_cellno()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('tutor_lib/lprofile');
		$content = $CI->lprofile->get_edit_user_cellno_view();	
		$this->template->full_tutor_html_view($content);
	}
	//User cell no edit
	public function do_user_cellno_edit()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Profiles');
		
		
		$password = md5("gef_quize".$CI->input->post('password'));
		
		$is_exist = $CI->Profiles->check_old_password( $password );
		

		if($is_exist)
		{
			$data =array(
				"mobile_no"	=> $this->input->post('mobile_no')
				);
			$CI->Profiles->user_info_update( $data );
			
			$CI->session->set_userdata(array('message'=>display("successfully_changed")));
			redirect(base_url('tutor/User_profile'));exit();
			
		}else{
		
			$CI->session->set_userdata(array('warning_message'=>display("sorry_password_dosent_match")));

			redirect(base_url('tutor/User_profile/edit_user_info'));exit();
		}
	}
	//Change user password
	public function change_user_password()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('tutor_lib/lprofile');
		$content = $CI->lprofile->get_change_password_view();	
		$this->template->full_tutor_html_view($content);
	}
	//Change user password
	public function do_password_change()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Profiles');
		
		
		$old_pass = md5("gef_quize".$CI->input->post('old_pass'));
		$new_pass = md5("gef_quize".$CI->input->post('new_pass'));
		
		$is_exist = $CI->Profiles->check_old_password( $old_pass );
		

		if($is_exist)
		{
			$data =array("password"=>$new_pass);
			$CI->Profiles->change_password( $old_pass,$data );
			
			$CI->session->set_userdata(array('message'=>display("successfully_changed")));

			redirect(base_url('tutor/User_profile'));exit();
			
		}else{
		
			$CI->session->set_userdata(array('warning_message'=>display("sorry_password_dosent_match")));
			redirect(base_url('tutor/User_profile/change_user_password'));exit();
		}
		
	}

}