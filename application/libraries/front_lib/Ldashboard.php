<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ldashboard {
	// Data For Main Home Page
	public function get_home_data()
	{
		$CI =& get_instance();
		$CI->load->model('front/Common_exams');
		$CI->load->model('front/Model_tests');
		$course_list = $CI->Common_exams->retrieve_course_list();
		$model_test_list = $CI->Model_tests->retrieve_model_all_test();
		$newly_course_list = $CI->Common_exams->retrieve_newly_added_course();
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$get_web_setting = $CI->Common_exams->get_web_setting();
		$get_favicon = $CI->Common_exams->get_favicon();
	
		$data = array(
			'title' => 'Home',
			'course_list' => $course_list,
			'model_test_list' => $model_test_list,
			'newly_course_list' => $newly_course_list,
			'popular_course_list' => $popular_course_list,
			'get_sidebar_add' => $get_sidebar_add,
			'logo' => $get_web_setting[0]['logo'],
			'link' => $get_web_setting[0]['link'],
			'back_image' => $get_web_setting[0]['back_image'],
			'copyright' => $get_web_setting[0]['copyright'],
			'second_image' => $get_web_setting[0]['second_image'],
			'first_image' => $get_web_setting[0]['first_image'],
			'third_image' => $get_web_setting[0]['third_image'],
			'first_url' => $get_web_setting[0]['first_url'],
			'second_url' => $get_web_setting[0]['second_url'],
			'third_url' => $get_web_setting[0]['third_url'],
			'favicon' => $get_favicon[0]['favicon'],
		);
		$chapterList = $CI->parser->parse('front_view/home/home',$data,true);
		return $chapterList;
	}
}
?>