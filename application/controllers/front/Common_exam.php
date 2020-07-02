<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Common_exam extends CI_Controller {
	
	function __construct() {
      parent::__construct();
      $this->load->model('front/Common_exams');
    }
	
	public function index()
	{
		$CI =& get_instance();
		$CI->load->library('front_lib/lcommon_exam');

		$config = array();
		#Paggination start#
        $config["base_url"] = base_url('front/Common_exam/index');
        $config["total_rows"] = $this->Common_exams->count_course_list();
        $config["per_page"] = 6;
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

		$content = $CI->lcommon_exam->course_list_individual_view($limit,$page,$links);		
		$this->template->full_html_view($content);
	}
	//Get All Course List for Home Page
	public function get_all_course( )
	{
		$CI =& get_instance();
		$CI->load->model('front/Common_exams');
		//$CI->auth->check_tutor_auth();
		
	//	$all_course =  $_POST['all_course'];
		$course_list = $CI->Common_exams->retrieve_course_list();	
		
		$count_1=floor(count($course_list)/3);
		$count_2=floor(count($course_list)/3);
		$count_3=count($course_list)-($count_1+$count_2);
		$i=0;
		$j=0;
		$k=0;

			for ($i=0;$i<$count_1;$i++){
				echo "<div class='courseColoumn1'>";
					echo"<a href='".base_url()."front/Common_exam/chapter_list/".$course_list[$i]['course_id']."'>".$course_list[$i]['course_name']."</a><br/>";
				echo"</div>";
			}
				
			$coloumn2 = $i+$count_2;
			for ($j=$i;$j<$coloumn2;$j++){
				echo "<div class='courseColoumn2'>";
					echo"<a href='".base_url()."front/Common_exam/chapter_list/".$course_list[$j]['course_id']."'>".$course_list[$j]['course_name']."</a><br/>";
				echo"</div>";
			}
			
			$coloumn3 = $j+$count_3;
			for ($k=$j;$k<$coloumn3;$k++){
				echo "<div class='courseColoumn3'>";
					echo"<a href='".base_url()."front/Common_exam/chapter_list/".$course_list[$k]['course_id']."'>".$course_list[$k]['course_name']."</a><br/>";
				echo"</div>";
			}		
	}
	//Get All Course List for Home Page
	public function search_course( )
	{
		$CI =& get_instance();
		$CI->load->model('front/Common_exams');
		$search_key =  $this->input->post('search_value');

		$config = array();
		#Paggination start#
        $config["base_url"] = base_url('front/Common_exam/search_course');
        $config["total_rows"] = $this->Common_exams->count_course_search_list($search_key);
        $config["per_page"] = 6;
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

		$course_list = $CI->Common_exams->search_course_list($limit,$page,$search_key);

		//$course_list = $CI->Common_exams->search_course_list( $search_key );
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
				'title' => 'Course List',
				'popular_course_list' => $popular_course_list,
				'course_list' => $course_list,
				'get_top_add' => $get_top_add,
				'get_sidebar_add' => $get_sidebar_add,
				'links' => $links,
			);
		$content = $CI->parser->parse('front_view/home/search_result',$data,true);
		$this->template->full_html_view($content);
	}
	
	//Get All Newly added Course List for Home Page
	public function get_popular_course( )
	{
		$CI =& get_instance();
		$CI->load->model('front/Common_exams');

		$course_list = $CI->Common_exams->retrieve_popular_course();

		$count_1=floor(count($course_list)/3);
		$count_2=floor(count($course_list)/3);
		$count_3=count($course_list)-($count_1+$count_2);
		$i=0;
		$j=0;
		$k=0;

			for ($i=0;$i<$count_1;$i++){
				echo "<div class='courseColoumn1'>";
					echo"<a href='".base_url()."front/Common_exam/chapter_list/".$course_list[$i]['course_id']."'>".$course_list[$i]['course_name']."</a><br/>";
				echo"</div>";
			}
				
			$coloumn2 = $i+$count_2;
			for ($j=$i;$j<$coloumn2;$j++){
				echo "<div class='courseColoumn2'>";
					echo"<a href='".base_url()."front/Common_exam/chapter_list/".$course_list[$j]['course_id']."'>".$course_list[$j]['course_name']."</a><br/>";
				echo"</div>";
			}
			
			$coloumn3 = $j+$count_3;
			for ($k=$j;$k<$coloumn3;$k++){
				echo "<div class='courseColoumn3'>";
					echo"<a href='".base_url()."front/Common_exam/chapter_list/".$course_list[$k]['course_id']."'>".$course_list[$k]['course_name']."</a><br/>";
				echo"</div>";
			}		
	}
	
		//Get All Newly added Course List for Home Page
	public function get_newly_added_course( )
	{
		$CI =& get_instance();
		$CI->load->model('front/Common_exams');
	
		$course_list = $CI->Common_exams->retrieve_newly_added_course();	
		
		$count_1=floor(count($course_list)/3);
		$count_2=floor(count($course_list)/3);
		$count_3=count($course_list)-($count_1+$count_2);
		$i=0;
		$j=0;
		$k=0;

			for ($i=0;$i<$count_1;$i++){
				echo "<div class='courseColoumn1'>";
					echo"<a href='".base_url()."front/Common_exam/chapter_list/".$course_list[$i]['course_id']."'>".$course_list[$i]['course_name']."</a><br/>";
				echo"</div>";
			}
				
			$coloumn2 = $i+$count_2;
			for ($j=$i;$j<$coloumn2;$j++){
				echo "<div class='courseColoumn2'>";
					echo"<a href='".base_url()."front/Common_exam/chapter_list/".$course_list[$j]['course_id']."'>".$course_list[$j]['course_name']."</a><br/>";
				echo"</div>";
			}
			
			$coloumn3 = $j+$count_3;
			for ($k=$j;$k<$coloumn3;$k++){
				echo "<div class='courseColoumn3'>";
					echo"<a href='".base_url()."front/Common_exam/chapter_list/".$course_list[$k]['course_id']."'>".$course_list[$k]['course_name']."</a><br/>";
				echo"</div>";
			}		
	}
	
	//Retrieve chapter list by course id
	public function chapter_list( $course_id )
	{		
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lcommon_exam');
		if( $course_id ==''){redirect(base_url());exit;}
        $content = $CI->lcommon_exam->retrieve_chapter_list( $course_id );		
		$this->template->full_html_view($content);
	}

	//Retrieve Chapter Name From After Select Course Name
	public function create_question_set()
	{	
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lcommon_exam');
		$CI->load->model('front/Common_exams');
		
		$chapter_ids = $this->input->post('chapter_id');
		$qstn_limit = $this->input->post('no_of_question');
		$course_id = $this->input->post('course_id');
		$current_url = $this->input->post('current_url');
		$total_question = $this->input->post('total_ques');

		if ($chapter_ids == null) {
			$this->session->set_userdata('message',display('please_select_a_chapter'));
			redirect($current_url);
		}elseif ($qstn_limit == 0) {
			$this->session->set_userdata('message',display('no_question_availabe'));
			redirect($current_url);
		}elseif ($total_question < $qstn_limit) {
			$this->session->set_userdata('message',display('out_of_question'));
			redirect($current_url);
		}
		
		// Insert data to database for findout the total exams of unique course
		$CI->Common_exams->total_exam_unique_subject( $course_id );
		
		$data = array(
			'exam_id' 				=> null,
			'exam_name' 			=> '',
			'course_id' 			=> $course_id,
			'tutor_id' 				=> $CI->session->userdata('user_id'),
			'number_of_question' 	=> $qstn_limit,
			'generated_procedure' 	=> 5,
			'chapter_ids' 			=> json_encode($chapter_ids,JSON_FORCE_OBJECT),
			'status' 				=> 1
		);

		$rtn_exam_id = $CI->Common_exams->insert_exam_head_info( $data );
		
		$question_ids = $CI->Common_exams->computer_generated_question_set($chapter_ids,$qstn_limit);

		$final_qstn_ids = array();
		
		if(!empty($question_ids)){
			foreach ($question_ids as $index=>$value) {
				foreach ($value as $key=>$val) {
					$final_qstn_ids[] = $val;
				}
			}
		}
		
		// ENTRY TO EXAM DETAIL TABLE
		if(!empty($final_qstn_ids)){
			$data1 = array(
				'exam_id' 				=> $rtn_exam_id,
				'question_ids' 			=> json_encode( $final_qstn_ids,JSON_FORCE_OBJECT ),
				'status' 				=> 1
			);
			$CI->Common_exams->insert_exam_details_data( $data1 );	
		}
		$course_name_array = $CI->Common_exams->get_single_course_name( $course_id );

		$course_name = $course_name_array[0]['course_name'];
		$another_exam_data = array('exam_related_data' => array('course_id'=> $course_id,'course_name'=> $course_name,'no_of_question' => $qstn_limit ,'exam_id'=> $rtn_exam_id));

		$CI->session->set_userdata($another_exam_data);
			
        $content = $CI->lcommon_exam->get_common_exam_view( $final_qstn_ids );
						
		$CI->template->full_html_view( $content );
	}
	
	//Create Question Sequence
	public function submit_common_exam()
	{		
		$CI =& get_instance();
		//$CI->auth->check_tutor_auth();
		$CI->load->library('front_lib/lcommon_exam');
		$option_id = $this->input->post('option_id');

        $content = $CI->lcommon_exam->submit_common_exam_view( $option_id );		
		$CI->template->full_html_view( $content );
	}
	public function view_common_exam_result()
	{		
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lcommon_exam');
		$exam_id = $CI->session->userdata('exam_id');		
        $content = $CI->lcommon_exam->final_exam_result_view( $exam_id );
		$CI->template->full_html_view( $content );
	}
	//RESULT DETAILS VIEW
	public function exam_result_detail_view()
	{		
		$CI =& get_instance();
		$CI->load->library('front_lib/lcommon_exam');
		$CI->auth->is_not_logged_in();
		$exam_and_ques_id =  $_POST['examAndQuesId'];
		list($exam_id,$ques_id,$sl_no) = explode("-",$exam_and_ques_id);
		$answered_result = $CI->lcommon_exam->individual_question_view( $exam_id,$ques_id );

		
		echo "<div class=\"panel-body\">";
		    echo "<div class=\"tab-content\">";
		        echo "<div class=\"tab-pane fade in active\" id=\"tab".$sl_no."default\">";
		        	echo "<div class=\"quiztest well\">";
		                echo "<h3>$sl_no".". ".strip_tags(htmlspecialchars_decode($answered_result['main_question']))."</h3>";

		                	echo"<div class='options'>";
								foreach($answered_result['main_options'] as $val){
									if(isset($val['right_answer'])){
										echo "<div class='right_ans_tick'></div><div class='singleOption'><div class='".strip_tags(htmlspecialchars_decode($val['right_answer']))."'>".strip_tags(htmlspecialchars_decode($val['option_details']))."</div> </div>";
									}else{
										echo "<div class='spacer'></div><div class='singleOption'><div class='ggg'>".strip_tags(htmlspecialchars_decode($val['option_details']))."</div> </div>";
									}
								}
						echo"</div>";
						echo "<br>";
						echo"<div class='yourAnsWrapper'>";
							echo"<div class='user_answer'>";
								echo "<div class='noOfQuesWrapper'><div class='yourAnsText'><p><b>".display('your_answered').": </b></p></div><div class='questBottBar'></div></div>";
							echo"</div>";
							echo"<div class='yourAnsContainer'>";
								foreach($answered_result['user_answer'] as $value){
									if($value == "Right"){
										echo "<div style='color:green !important;' class='user_answered_option'> ".strip_tags(htmlspecialchars_decode($value))." </div>";
									}else{
										echo "<div class='user_answered_option wrong'> ".strip_tags(htmlspecialchars_decode($value))." </div>";
									}
								}
							echo"</div>"; 
						echo"</div>"; 
		            echo "</div>";
		 		echo "</div>";
		    echo "</div>";
		echo "</div>";
	}
}