<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lprofile {
	
	public function get_user_all_info()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Profiles');
		$profile_data = $CI->Profiles->retrieve_profile_data();

		$data = array(
			'title' => 'Account Setting',
			'user_name' =>  $profile_data[0]['user_name'],
            'mobile_no' =>  $profile_data[0]['mobile_no'],
            'email' =>  $profile_data[0]['email']
		);
		$exam_view = $CI->parser->parse('admin_view/profile/profile',$data,true);
		return $exam_view;
	}
	
	public function get_edit_full_name_view()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Profiles');
		
		$profile_data = $CI->Profiles->retrieve_profile_data();

		$data = array(
			'title' => 'Edit Profile',
			'user_name' =>  $profile_data[0]['user_name'],
            'mobile_no' =>  $profile_data[0]['mobile_no'],
            'email' =>  $profile_data[0]['email']
		);
		$info_edit_view = $CI->parser->parse('admin_view/profile/full_name_view',$data,true);
		return $info_edit_view;
	}
	
	public function get_edit_user_cellno_view()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Profiles');
		
		$profile_data = $CI->Profiles->retrieve_profile_data();

		$data = array(
			'title' => 'Edit Profile',
			'user_name' =>  $profile_data[0]['user_name'],
            'mobile_no' =>  $profile_data[0]['mobile_no'],
            'email' =>  $profile_data[0]['email']
		);
		$info_edit_view = $CI->parser->parse('admin_view/profile/cell_number_view',$data,true);
		return $info_edit_view;
	}

	public function get_change_password_view()
	{
		$CI =& get_instance();		
		$CI->load->model('admin/Profiles');
		
		$profile_data = $CI->Profiles->retrieve_profile_data();

		$data = array(
			'title' => 'Edit Password',
			'user_name' =>  $profile_data[0]['user_name'],
            'mobile_no' =>  $profile_data[0]['mobile_no'],
            'email' =>  $profile_data[0]['email']
		);
		$change_pass_view = $CI->parser->parse('admin_view/profile/change_password',$data,true);
		return $change_pass_view;
	}


}
?>