<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lprofile {
	
	public function get_user_all_info()
	{
		$CI =& get_instance();
		$CI->load->model('front/Profiles');
		$CI->load->model('front/Common_exams');

		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$profile_data = $CI->Profiles->retrieve_profile_data();
		$related_course_list = $CI->Common_exams->retrieve_course_list_by_random();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
			'title' => 'Account Setting',
			'user_name' =>  $profile_data[0]['user_name'],
            'mobile_no' =>  $profile_data[0]['mobile_no'],
            'email' =>  $profile_data[0]['email'],
            'related_course_list' =>  $related_course_list,
            'popular_course_list' =>  $popular_course_list,
            'get_top_add' =>  $get_top_add,
            'get_sidebar_add' =>  $get_sidebar_add
		);
		$exam_view = $CI->parser->parse('front_view/profile/profile',$data,true);
		return $exam_view;
	}
	
	public function get_edit_full_name_view()
	{
		$CI =& get_instance();
		$CI->load->model('front/Profiles');
		$CI->load->model('front/Common_exams');
		
		$profile_data = $CI->Profiles->retrieve_profile_data();
		$related_course_list = $CI->Common_exams->retrieve_course_list_by_random();
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
			'title' => 'Edit Profile',
			'user_name' =>  $profile_data[0]['user_name'],
            'mobile_no' =>  $profile_data[0]['mobile_no'],
            'email' =>  $profile_data[0]['email'],
            'related_course_list' =>  $related_course_list,
            'popular_course_list' =>  $popular_course_list,
            'get_top_add' =>  $get_top_add,
            'get_sidebar_add' =>  $get_sidebar_add
		);
		$info_edit_view = $CI->parser->parse('front_view/profile/full_name_view',$data,true);
		return $info_edit_view;
	}
	
	public function get_edit_user_cellno_view()
	{
		$CI =& get_instance();
		$CI->load->model('front/Profiles');
		$CI->load->model('front/Common_exams');
		
		$profile_data = $CI->Profiles->retrieve_profile_data();
		$related_course_list = $CI->Common_exams->retrieve_course_list_by_random();
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
			'title' => 'Edit Profile',
			'user_name' =>  $profile_data[0]['user_name'],
            'mobile_no' =>  $profile_data[0]['mobile_no'],
            'email' =>  $profile_data[0]['email'],
            'related_course_list' =>  $related_course_list,
            'popular_course_list' =>  $popular_course_list,
            'get_top_add' =>  $get_top_add,
            'get_sidebar_add' =>  $get_sidebar_add
		);
		$info_edit_view = $CI->parser->parse('front_view/profile/cell_number_view',$data,true);
		return $info_edit_view;
	}

	public function get_change_password_view()
	{
		$CI =& get_instance();		
		$CI->load->model('front/Profiles');
		$CI->load->model('front/Common_exams');
		
		$profile_data = $CI->Profiles->retrieve_profile_data();

		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$related_course_list = $CI->Common_exams->retrieve_course_list_by_random();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
			'title' => 'Edit Password',
			'user_name' =>  $profile_data[0]['user_name'],
            'mobile_no' =>  $profile_data[0]['mobile_no'],
            'popular_course_list' =>  $popular_course_list,
            'related_course_list' =>  $related_course_list,
            'email' =>  $profile_data[0]['email'],
            'get_top_add' =>  $get_top_add,
            'get_sidebar_add' =>  $get_sidebar_add
		);
		$change_pass_view = $CI->parser->parse('front_view/profile/change_password',$data,true);
		return $change_pass_view;
	}


}
?>