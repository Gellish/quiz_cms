<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_exam_info extends CI_Controller {

	function __construct() {
      parent::__construct();
    }
	public function user_schedule_exam()
	{
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/luser_exam_info');
		
		$content = $CI->luser_exam_info->get_schedule_exam();		
		$this->template->full_html_view($content);
	}

	//Attend Tutor Provide Exam
	public function attend_tutor_provided_exam( $exam_id )
	{	
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lcommon_exam');
		$CI->load->model('front/Common_exams');
		
		if($exam_id !=''){
		
			$course_id = '';
			$qstn_limit = '';
		
			$exam_data = $CI->Common_exams->get_tutor_provided_exam_data( $exam_id );
			
			if($exam_data !=''){
				$course_id = $exam_data[0]['course_id'];
				$course_name = $exam_data[0]['course_name'];
				$qstn_limit = $exam_data[0]['number_of_question'];
				$question_ids = json_decode($exam_data[0]['question_ids'],true);

				$another_exam_data = array('exam_related_data' => array('course_id'=> $course_id,'no_of_question' => $qstn_limit ,'exam_id'=> $exam_id,'course_name'=> $course_name));
				$CI->session->set_userdata($another_exam_data);
				if($question_ids !=''){
					$content = $CI->lcommon_exam->get_common_exam_view( $question_ids );
					$CI->template->full_html_view( $content );
				}else{
					$CI->session->set_userdata(array('warning_message'=>"Your are not authorized user for this exam"));
					redirect(base_url());exit();
				}
			}
			
		}else{
			$CI->session->set_userdata(array('warning_message'=>"You did not select exam!"));
			redirect(base_url());exit();
		}
	}
	
	public function schedule_exam_statistics()
	{
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/luser_exam_info');
		
		$content = $CI->luser_exam_info->get_schedule_exam_statistics();		
		$this->template->full_html_view($content);
	}
	
	public function view_schedule_exam_result( $exam_id )
	{		
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lcommon_exam');
		$content = '';
		if($exam_id !=''){		
			$content = $CI->lcommon_exam->final_exam_result_view( $exam_id );
		}else{
			$CI->session->set_userdata(array('warning_message'=>"You did not select exam!"));
			redirect(base_url());exit();
		}
		$CI->template->full_html_view( $content );
	}
	
	public function personal_exam_statistics()
	{
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/luser_exam_info');
		$CI->load->model('front/user_exam_infos');
	
		$config = array();
		#Paggination start#
        $config["base_url"] = base_url('front/User_exam_info/personal_exam_statistics');
        $config["total_rows"] = $this->user_exam_infos->count_own_exam_list();
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;
        $config["num_links"] = 5; 
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination pager'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li class=\"next\">";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li class=\"previous\">";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        #Paggination end#

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links();
		
		$content = $CI->luser_exam_info->get_own_exam_statistics( $limit,$page,$links );		
		$this->template->full_html_view($content);
	}
	
	public function view_personal_exam_result( $exam_id )
	{		
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lcommon_exam');
		$content = '';
		if($exam_id !=''){		
			$content = $CI->lcommon_exam->final_exam_result_view( $exam_id );
		}else{
			$CI->session->set_userdata(array('warning_message'=>"You did not select exam!"));
			redirect(base_url());exit();
		}
		$CI->template->full_html_view( $content );
	}
	
	public function model_test_statistics()
	{
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/luser_exam_info');
		$CI->load->model('front/user_exam_infos');
		
		$config = array();
		$config["base_url"] = base_url()."front/User_exam_info/model_test_statistics";
		$config["total_rows"] = $this->user_exam_infos->count_model_test_list();  
		$config["per_page"] = 20;
		$config["uri_segment"] = 4;	
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links();
		
		$content = $CI->luser_exam_info->get_model_test_exam_statistics( $limit,$page,$links );		
		$this->template->full_html_view($content);
	}
	
	public function view_model_test_exam_result( $exam_id )
	{		
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lmodel_test');
		$content = '';
		if($exam_id !=''){		
			$content = $CI->lmodel_test->final_exam_result_view( $exam_id );
		}else{
			$CI->session->set_userdata(array('warning_message'=>"You did not select exam!"));
			redirect(base_url());exit();
		}
		$CI->template->full_html_view( $content );
	}
}