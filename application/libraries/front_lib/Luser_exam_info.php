<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Luser_exam_info {

	public function get_schedule_exam()
	{
		$CI =& get_instance();
		$CI->load->model('front/User_exam_infos');
		$CI->load->model('front/Common_exams');
		
		$schedule_exam = $CI->User_exam_infos->get_schedule_exam_data();
		$i=0;
		if(!empty($schedule_exam)){
			foreach($schedule_exam as $key=>$val){$i++;
				$schedule_exam[$key]['sl'] = $i;
			}
		}
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$related_course_list = $CI->Common_exams->retrieve_course_list_by_random();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
			'title' => 'Home',
			'schedule_exam' => $schedule_exam,
			'popular_course_list' => $popular_course_list,
			'related_course_list' => $related_course_list,
			'get_top_add' => $get_top_add,
			'get_sidebar_add' => $get_sidebar_add,
			'start_exam_link' => base_url()."front/User_exam_info/attend_tutor_provided_exam/",
		);
		$exam_view = $CI->parser->parse('front_view/home/schedule_exam',$data,true);
		return $exam_view;
	}

	public function get_schedule_exam_statistics()
	{
		$CI =& get_instance();
		$CI->load->model('front/User_exam_infos');
		$CI->load->model('front/Common_exams');
		$exam_statistics = $CI->User_exam_infos->get_schedule_exam_stats_data();		
		$i=0;
		if(!empty($exam_statistics)){
			foreach($exam_statistics as $key=>$val){$i++;
				$exam_statistics[$key]['sl'] = $i;
			}
		}
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$related_course_list = $CI->Common_exams->retrieve_course_list_by_random();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
			'title' => 'Home',
			'active_exam' => 'teacher',
			'exam_statistics' => $exam_statistics,
			'popular_course_list' => $popular_course_list,
			'related_course_list' => $related_course_list,
			'get_top_add' => $get_top_add,
			'get_sidebar_add' => $get_sidebar_add,
			'exam_stats_link' => base_url()."front/User_exam_info/view_schedule_exam_result/",
		);
		$statistics_view = $CI->parser->parse('front_view/home/schedule_exam_stats',$data,true);
		return $statistics_view;
	}
	
	public function get_own_exam_statistics( $limit,$page,$links )
	{
		$CI =& get_instance();
		$CI->load->model('front/User_exam_infos');
		$CI->load->model('front/Common_exams');
		
		$exam_statistics = $CI->User_exam_infos->get_own_exam_stats_data( $limit,$page );		
		$i = $page;
		if(!empty($exam_statistics)){
			foreach($exam_statistics as $key=>$val){$i++;
				$exam_statistics[$key]['sl'] = $i;
			}
		}
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$related_course_list = $CI->Common_exams->retrieve_course_list_by_random();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
			'title' => 'Won Exam Statistics',
			'active_exam' => 'personal',
			'exam_statistics' => $exam_statistics,
			'exam_stats_link' => base_url()."front/User_exam_info/view_personal_exam_result/",
			'links' => $links,
			'popular_course_list' => $popular_course_list,
			'related_course_list' => $related_course_list,
			'get_top_add' => $get_top_add,
			'get_sidebar_add' => $get_sidebar_add
		);
	
		$statistics_view = $CI->parser->parse('front_view/home/own_exam_stats',$data,true);
		return $statistics_view;
	}	
	
	public function get_model_test_exam_statistics( $limit,$page,$links )
	{
		$CI =& get_instance();
		$CI->load->model('front/User_exam_infos');
		$CI->load->model('front/Common_exams');
		
		$exam_statistics = $CI->User_exam_infos->get_model_test_stats_data( $limit,$page );			
		$i = $page;
		if(!empty($exam_statistics)){
			foreach($exam_statistics as $key=>$val){$i++;
				$exam_statistics[$key]['sl'] = $i;
			}
		}
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$related_course_list = $CI->Common_exams->retrieve_course_list_by_random();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		
		$data = array(
			'title' => 'Model Test Statistics',
			'active_exam' => 'model_test',
			'exam_statistics' => $exam_statistics,
			'popular_course_list' => $popular_course_list,
			'related_course_list' => $related_course_list,
			'get_top_add' => $get_top_add,
			'get_sidebar_add' => $get_sidebar_add,
			
			'links' => $links
		);
		$statistics_view = $CI->parser->parse('front_view/home/model_test_stats',$data,true);
		return $statistics_view;
	}
}
?>