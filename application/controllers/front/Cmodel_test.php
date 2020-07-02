<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Cmodel_test extends CI_Controller {
	
	function __construct() {
      parent::__construct();
      $this->load->model('front/Model_tests');
    }
	
	public function index()
	{	
		$CI =& get_instance();
		$CI->load->library('front_lib/lmodel_test');	

		$config = array();
		#Paggination start#
        $config["base_url"] = base_url('front/Cmodel_test/index');
        $config["total_rows"] = $this->Model_tests->count_model_list();
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

		$content = $CI->lmodel_test->model_test_individual_view($page,$limit,$links);
		$this->template->full_html_view($content);
	}

	public function get_model_test( )
	{
		$CI =& get_instance();
		$CI->load->model('front/Model_tests');
		
	//	$all_course =  $_POST['all_course'];
		$model_test_list = $CI->Model_tests->retrieve_model_all_test();

		$count_1=floor(count($model_test_list)/3);
		$count_2=floor(count($model_test_list)/3);
		$count_3=count($model_test_list)-($count_1+$count_2);
		$i=0;
		$j=0;
		$k=0;

			for ($i=0;$i<$count_1;$i++){
				echo "<div class='courseColoumn1'>";
					echo"<a href='".base_url()."front/Cmodel_test/model_test_details/".$model_test_list[$i]['model_test_id']."'>".$model_test_list[$i]['model_test_name']."</a><br/>";
				echo"</div>";
			}
				
			$coloumn2 = $i+$count_2;
			for ($j=$i;$j<$coloumn2;$j++){
				echo "<div class='courseColoumn2'>";
					echo"<a href='".base_url()."front/Cmodel_test/model_test_details/".$model_test_list[$j]['model_test_id']."'>".$model_test_list[$j]['model_test_name']."</a><br/>";
				echo"</div>";
			}
			
			$coloumn3 = $j+$count_3;
			for ($k=$j;$k<$coloumn3;$k++){
				echo "<div class='courseColoumn3'>";
					echo"<a href='".base_url()."front/Cmodel_test/model_test_details/".$model_test_list[$k]['model_test_id']."'>".$model_test_list[$k]['model_test_name']."</a><br/>";
				echo"</div>";
			}		
	}
	public function model_test_details( $model_test_id )
	{
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lmodel_test');
		if( $model_test_id ==''){redirect(base_url());exit;}
        $content = $CI->lmodel_test->get_model_test_details( $model_test_id );		
		$this->template->full_html_view($content);
	}
	
	public function model_test_question_set()
	{	
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lmodel_test');
		$CI->load->model('front/Model_tests');
				
		$subject_id =  $this->input->post('course_id');
		$no_of_ques =  $this->input->post('no_of_ques');
		$qstn_limit =  $this->input->post('qstn_limit');
		$model_test_sett_id =  $this->input->post('model_test_id');

		$final_qstn_ids = array();
		for ($i=0, $n=count($subject_id); $i < $n; $i++) 
		{
			$subj_id = $subject_id[$i];
			$number_ques = $no_of_ques[$i];
				
			$question_ids = $CI->Model_tests->computer_generated_question_set($subj_id,$number_ques);	
			if(!empty($question_ids)){
				foreach ($question_ids as $index=>$value) {
					foreach ($value as $key=>$val) {
						$final_qstn_ids[] = $val;
					}
				}
			}	
		}
		
		$data = array(
			'model_test_id' 			=> null,
		 	'model_test_settings_id'	=> $model_test_sett_id, 
			'user_id' 					=> $CI->session->userdata('user_id'),
			'number_of_question' 		=> $qstn_limit,
		 	'subject_ids' 				=> json_encode($subject_id,JSON_FORCE_OBJECT),
			'status' 					=> 1
		);
		
		$rtn_model_test_id = $CI->Model_tests->insert_model_test_head_info( $data );

	
		// ENTRY TO EXAM DETAIL TABLE
		if(!empty($final_qstn_ids)){
			$data1 = array(
				'model_test_id' 		=> $rtn_model_test_id,
				'question_ids' 			=> json_encode( $final_qstn_ids,JSON_FORCE_OBJECT ),
				'status' 				=> 1
			);
			
			$CI->Model_tests->insert_model_test_details_data( $data1 );	
		}
		
		$model_test_data = $CI->Model_tests->get_model_test_data( $model_test_sett_id );	
		
		$model_test_name = $model_test_data[0]['model_test_name'];
		$model_test_duration = $model_test_data[0]['duration'];
		
		$another_exam_data = array('exam_related_data' => array('model_test_id'=> $model_test_sett_id,'model_test_name'=> $model_test_name,'no_of_question' => $qstn_limit ,'exam_id'=> $rtn_model_test_id,'model_test_duration'=> $model_test_duration));
		$CI->session->set_userdata($another_exam_data);
			
        $content = $CI->lmodel_test->get_common_exam_view( $final_qstn_ids );
						
		$CI->template->full_html_view( $content );
	}
	
		//Create Question Sequence
	public function submit_common_exam()
	{		
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lmodel_test');
		$option_id = $this->input->post('option_id');
        $content = $CI->lmodel_test->submit_common_exam_view( $option_id );		
		$CI->template->full_html_view( $content );
	}
	
	public function view_common_exam_result()
	{		
		$CI =& get_instance();
		$CI->auth->is_not_logged_in();
		$CI->load->library('front_lib/lmodel_test');
		$model_test_id = $CI->session->userdata('exam_id');		
        $content = $CI->lmodel_test->final_exam_result_view( $model_test_id );
		$CI->template->full_html_view( $content );
	}
	//RESULT DETAILS VIEW
	public function exam_result_detail_view()
	{		
		$CI =& get_instance();
		$CI->load->library('front_lib/lmodel_test');
		$CI->auth->is_not_logged_in();
		$exam_and_ques_id =  $_POST['modelTestAndQuesId'];
		list($exam_id,$ques_id,$sl_no) = explode("-",$exam_and_ques_id);
		$answered_result = $CI->lmodel_test->individual_question_view( $exam_id,$ques_id );
		
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
								echo "<div class='noOfQuesWrapper'><div class='yourAnsText'><p><b>You answered: </b></p></div><div class='questBottBar'></div></div>";
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