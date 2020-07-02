<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lmodel_test {

	// GET COURSE NAME 
	public function model_test_individual_view($page,$limit,$links)
	{
		$CI =& get_instance();
		$CI->load->model('front/Model_tests');
		$CI->load->model('front/Common_exams');
		
		$model_test_list = $CI->Model_tests->retrieve_model_all_test_limit($page,$limit,$links);	
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();	
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
			'title' => 'Model Test List',
			'model_test_list' => $model_test_list,
			'popular_course_list' => $popular_course_list,
			'links' => $links,
			'get_top_add' => $get_top_add,
			'get_sidebar_add' => $get_sidebar_add
		);
		$model_test_view = $CI->parser->parse('front_view/model_test/all_model_test',$data,true);
		return $model_test_view;
	}
	//Get model test details
	public function get_model_test_details( $model_test_id )
	{
		$CI =& get_instance();
		$CI->load->model('front/Model_tests');
		$CI->load->model('front/Common_exams');
		
		$model_test_detail = $CI->Model_tests->retrieve_model_test_details( $model_test_id );
	
		$related_model_list = $CI->Model_tests->retrieve_model_list_by_random();

		if(empty($model_test_detail)){
			$CI->session->set_userdata(array('warning_message'=>"Invalid Model Test ID"));
			redirect(base_url('front/Dashboard'));
		}else{			
			$detail_data = json_decode($model_test_detail[0]['model_test_details'],true);
			$total_ques = 0;
			foreach($detail_data as $key=>$value)
			{
				$subj_name = $CI->Model_tests->retrieve_class_name($value['subject_id']);
				$subject_data[] = array( 'course_id'=>$value['subject_id'],'course_name'=>$subj_name[0]['course_name'],'no_of_ques'=>$value['no_of_ques']);
				$total_ques = $total_ques + $value['no_of_ques'];
			}
			$popular_course_list = $CI->Common_exams->retrieve_popular_course();
			$get_top_add = $CI->Common_exams->get_top_add();
			$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
			$data = array(
				'title' => 'Model Test Details',
				'subject_data' => $subject_data,
				'total_ques' => $total_ques,
				'model_test_image' => $model_test_detail[0]['image'],
				'test_details' => $model_test_detail[0]['test_details'],
				'model_test_id' => $model_test_id,
				'model_test_name' => $model_test_detail[0]['model_test_name'],
				'related_model_list' => $related_model_list,
				'popular_course_list' => $popular_course_list,
				'get_top_add' => $get_top_add,
				'get_sidebar_add' => $get_sidebar_add,
			);
		}
		
		$test_detail_view = $CI->parser->parse('front_view/model_test/model_test_details',$data,true);
		return $test_detail_view;
	}
	
	//Get common exam view
	public function get_common_exam_view( $question_ids )
	{
		$CI =& get_instance();
		$CI->load->model('front/Model_tests');
		$CI->load->model('front/Common_exams');
		
		// GET EAXM STARTING TIME
		$current_time = date("H:i:s"); 
		
		$test_duration = $CI->session->userdata['exam_related_data']['model_test_duration'];
		list($hour,$minute,$second) = explode(":",$test_duration);
		$qstn_first_id ='';
		
		if(empty($question_ids)){
			$CI->session->set_userdata(array('warning_message'=>"No Questin Found for Your Selected Model test"));
		redirect(base_url());exit(); /* Need Change*/
		}else{
			sort($question_ids);
			$qstn_first_id = $question_ids[0];
			//Changed here
			$key = array_keys($question_ids);
			$last_index=end($key);
			//Changed here
			$exam_data = array('exam_data' => array('exam_question_ids'=>$question_ids,'current_index'=>0,'last_index'=>$last_index,'exam_start_time'=>$current_time));
			$result_data = array('result_data' =>Array());
			$CI->session->set_userdata($result_data);
			$CI->session->set_userdata($exam_data);
		}		
		$question_data = $CI->Model_tests->get_questions_and_options( $qstn_first_id );			
		
		$btn_previous ="";
		$btn_next ="show";
		 if(isset($CI->session->userdata['exam_related_data']['model_test_name'])){
			$model_test_name = $CI->session->userdata['exam_related_data']['model_test_name'];
		 }else{$course_name ="";}
		$related_model_list = $CI->Model_tests->retrieve_model_list_by_random();
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();

		$data = array(
			'course_name' =>  $model_test_name,
			'btn_previous' => $btn_previous,
			'btn_next' => $btn_next,
			'question_id' => $question_data[0]['question_id'],
			'main_question' => $question_data[0]['question_detals'],
			'question_data' => $question_data,
			'hour' => $hour,
			'minute' => $minute,
			'second' => $second,
			'related_model_list' => $related_model_list,
			'popular_course_list' => $popular_course_list,
			'get_top_add' => $get_top_add,
			'get_sidebar_add' => $get_sidebar_add
		);
		$questionList = $CI->parser->parse('front_view/model_test/exam_start_view',$data,true);
		return $questionList;
	}

	// VIEW QUESTION ONE BY ONE
	public function submit_common_exam_view( $option_id )
	{
		$CI =& get_instance();
		$CI->load->model('front/Model_tests');	
		$CI->load->model('front/Common_exams');
		
		$hour = $CI->input->post('hour');
		$minute = $CI->input->post('min');
		$second = $CI->input->post('sec');
				
		//IF USER ANSWERED OR DON'T CLICK ON THE OPTIONS
		if( $option_id !=''){
			$answerd_qstn_id =  $CI->input->post('hdn_qstn_id');
			$sess_result_array =  $CI->session->userdata('result_data');

			$new_result =  Array("question_id" =>$answerd_qstn_id,"option_ids" =>$option_id);
			
			//IF SESSION is EMPTY OR USER STAY ON THE EXAM START STAGE THEN NEW ANSWER WILL BE INSERT SESSION ARRAY
			if(empty($sess_result_array)){

				//Changed here
				$result_data = array('result_data');//=> array()
				//Changed here

				$CI->session->unset_userdata($result_data);
				$sess_result_array =array();
				array_push($sess_result_array,$new_result);	
				$result_data = array('result_data' => $sess_result_array);
				$CI->session->set_userdata($result_data);
			
			
			//IF ALREADY EXIST SOME ANSWER IS IN SESSION  NEW ANSWER WILL BE ADD WITH EXIST SESSION ARRAY
			}elseif(!empty($sess_result_array)){
							
				foreach ($sess_result_array as $index => $value){
					if($value['question_id'] == $answerd_qstn_id){	
						$sess_result_array =$this->array_index_remove( $sess_result_array,$answerd_qstn_id );
					}
				}
				//Changed here
				$result_data = array('result_data');//=> array()
				//Changed here
				$CI->session->unset_userdata($result_data);
				array_push($sess_result_array,$new_result);	
				$result_data = array('result_data' => $sess_result_array);
				$CI->session->set_userdata($result_data);				
			}
		}
		
		//GET CURRENT_INDEX LAST_INDEX FROM SESSION WHICH WAS INSERTED INTO SESSION
		$session_data =  $CI->session->userdata('exam_data');		
		$current_index = $session_data['current_index'];
		$last_index = $session_data['last_index'];
		
		//CHECK THAT USER WHICH BUTTON IS CLICKED
		if(isset($_POST['btn-submit-previous'])){
			$current_index = $current_index-1;
			$current_index = ($current_index < 0)?0:$current_index ;
		}elseif(isset($_POST['btn-submit-next'])){
			$current_index = $current_index + 1;
			if($current_index >= $last_index ){
				$current_index = $last_index ;
			}
		}else{
			//GO TO (Controller) EXAM RESULT METHOD 
			$this->common_exam_result_processing();
		}
		
		$start_time = $session_data['exam_start_time'];
		$total_time = $this->time_counter($start_time);
		//list($hour,$minute,$second) = explode(":",$total_time);
		
		
		//SETTINGS FOR "NEXT","PREVIOUS" AND FINISH BUTTON
		$btn_previous ="show";
		$btn_next ="show";
		if($current_index == 0){$btn_previous = "";}
		if($current_index == $last_index ){$btn_next = "";}
		
		//FIND REQUIRED QUESTION ID TO MAINTAIN SEQUENTIAL QUESTION VIEW
		$question_ids = $session_data['exam_question_ids'];
		$expected_qstn_id = $question_ids["$current_index"];
		
		//Changed here
		$exam_data = array('exam_question_ids'=>'','current_index'=>'','last_index'=>'','exam_start_time'=>'');//array('exam_data' =>
		//Changed here

		$CI->session->unset_userdata($exam_data);

		$exam_data = array('exam_data' => array('exam_question_ids'=>$question_ids,'current_index'=>$current_index,'last_index'=>$last_index,'exam_start_time'=>$start_time));
		$CI->session->set_userdata($exam_data);
		
		//GET QUESTION FROM TABLE BY REQURED QUESTION ID
		$question_data = $CI->Model_tests->get_questions_and_options( $expected_qstn_id );
		
		$result_array =  $CI->session->userdata('result_data');
		//CHECKED THAT USER IS RE ANSWERD OR NOT
		foreach ($result_array as $indx => $val){
			if($val['question_id'] == $expected_qstn_id){
				$result_option_ids = $val['option_ids'];
			}
		}	

		if(!empty($result_option_ids)){
		
			foreach ($result_option_ids as $keyy => $vall){
				foreach($question_data as $k=>$valu){
					if($vall== $valu['question_option_id']){
						$question_data[$k]['checked']='checked="checked"';
					}
				}
			}	
		}
		
		$model_test_name =  $CI->session->userdata['exam_related_data']['model_test_name'];
		$related_model_list = $CI->Model_tests->retrieve_model_list_by_random();
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();
		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();
		$data = array(
			'title' 	=> 'Question Set',
			'course_name' 	=> $model_test_name,
			'btn_previous' 	=> $btn_previous,
			'btn_next' 		=> $btn_next,
			'question_id'	=> $question_data[0]['question_id'],
			'main_question' => $question_data[0]['question_detals'],
			'question_data' => $question_data,
			'hour' 		=> $hour,
			'minute' 	=> $minute,
			'second' 	=> $second,
			'related_model_list' 	=> $related_model_list,
			'popular_course_list' 	=> $popular_course_list,
			'get_top_add' 	=> $get_top_add,
			'get_sidebar_add' 	=> $get_sidebar_add
		);
		$questionList = $CI->parser->parse('front_view/model_test/exam_start_view',$data,true);
		return $questionList;
	}
	// THIS FUNCTION RETURN ARRAY AFTER ONE DESIRED INDEX REMOVED
	private function array_index_remove( $target_array,$target_id )
	{
		foreach($target_array as $key => $val)
		{
			if ($val['question_id'] === $target_id ){
				$final_key = $key;
			}
		}
		//ARAAY INDEX REMOVED 
		unset($target_array[$final_key]);
		//REORDER ARRAY INDEX
		sort($target_array);
		return $target_array;
	}
	//EXAM RSULT METHOD
	public function common_exam_result_processing( )
	{
		$CI =& get_instance();
		$CI->load->model('front/Model_tests');	
		
		$sess_ques_data = $CI->session->userdata('exam_data');	
		$question_ids =  $sess_ques_data['exam_question_ids'];
		$start_time = $sess_ques_data['exam_start_time'];
		$total_time = $this->time_counter($start_time);
		
		$result_data =  $CI->session->userdata('result_data');
		
		
		//INSERT EXAM DETAILS TO DATABASE 
		$exam_related_data = $CI->session->userdata('exam_related_data');	
		
		$course_id = $exam_related_data['model_test_id'];
		$no_of_question = $exam_related_data['no_of_question'];
		$exam_id = $exam_related_data['exam_id'];

		$data = array(
			'model_test_id' 	=> $exam_id,
			'user_id' 			=> $CI->session->userdata('user_id'),
			'questions_ids' 	=> json_encode($question_ids,JSON_FORCE_OBJECT),
			'answers_ids' 		=> json_encode($result_data,JSON_FORCE_OBJECT)
		);
		
		$CI->Model_tests->insert_model_test_result_details( $data );
		
		
		$final_result = $this->exam_result_creator( $question_ids,$result_data );
		$total_correct_answer = $this->correct_answer_counter( $final_result );
		$total_answered = count($result_data);		
		$result_in_percent = 0;
		$result_in_percent = round(($total_correct_answer/$no_of_question)*100,2);
		
		//ENTRY TO DB
		
		date_default_timezone_set('Asia/Dhaka');
		$current_date = date("Y-m-d g:i:s");
		
		$data1 = array(
			'model_test_id' 		=> $exam_id,
			'user_id' 				=> $CI->session->userdata('user_id'),		
			'model_test_settings_id' => $course_id,
			'attend_date' 			=> $current_date,
			'number_of_question' 	=> $no_of_question,
			'duration' 				=> $total_time,
			'total_answered' 	=> $total_answered,
			'marks' 	=> $result_in_percent,
			'status' 	=> 1
		);
		$CI->Model_tests->entry_model_test_result( $data1 ); 

		// Unset Session Array;
			$exam_data = array('exam_question_ids'=>'','current_index'=>'','last_index'=>'');
			$CI->session->unset_userdata($exam_data);
			$another_exam_data = array('model_test_id'=> "",'model_test_name'=> "",'no_of_question' => "" ,'exam_id'=> "");
			$CI->session->unset_userdata($another_exam_data);
			
			$result_data = array('result_data' => '');
			$CI->session->unset_userdata($result_data);
		
		//	Insert exam id to session
			$exam_data = array('exam_id' => $exam_id);
			
           $CI->session->set_userdata($exam_data);
		
		redirect(base_url('front/Cmodel_test/view_common_exam_result'));exit();
		
	}
	
	public function final_exam_result_view( $model_test_id )
	{
		$CI =& get_instance();
		$CI->load->model('front/Model_tests');
		$CI->load->model('front/Common_exams');	
		
		$question_data = $CI->Model_tests->get_exam_question_data( $model_test_id );
		$question_ids = json_decode( $question_data[0]['questions_ids'],true);
		$result_data =  json_decode( $question_data[0]['answers_ids'],true);

		
		$exam_result_data = $CI->Model_tests->get_exam_result_data( $model_test_id );
		$course_id = $exam_result_data[0]['model_test_settings_id'];
		$no_of_question = $exam_result_data[0]['number_of_question'];
		$time_expense = $exam_result_data[0]['duration'];
		
		$final_result = $this->exam_result_creator( $question_ids,$result_data );
		
		$total_correct_answer = $this->correct_answer_counter( $final_result );
		$total_answered = count($result_data);
		$model_test_name = 	$CI->Model_tests->get_model_test_name( $course_id );
		$subject_ids = 	$CI->Model_tests->get_subjects_ids( $model_test_id );
		$all_subject_id = array();
		if(!empty($subject_ids)){$all_subject_id = (array) json_decode( $subject_ids[0]['subject_ids'] );}
		$subject_name = $CI->Model_tests->get_subject_names( $all_subject_id );

		$result_in_percent = 0;
		$result_in_percent = round(($total_correct_answer/$no_of_question)*100,2);
		$incorrect_answer = $total_answered - $total_correct_answer;
		$related_model_list = $CI->Model_tests->retrieve_model_list_by_random();
		$popular_course_list = $CI->Common_exams->retrieve_popular_course();

		$get_top_add = $CI->Common_exams->get_top_add();
		$get_sidebar_add = $CI->Common_exams->get_sidebar_add();

		// View Data
		$results_data = array(
			'title' => 'Result View',
			'model_test_name' => $model_test_name,
			'chapters_name' => $subject_name,
			'no_of_question' => $no_of_question,
			'total_answered' => $total_answered,
			'correct_answer' => $total_correct_answer,
			'incorrect_answer' => $incorrect_answer,
			'result' => $result_in_percent,
			'time_expense' => $time_expense,
			'related_model_list' => $related_model_list,
			'popular_course_list' => $popular_course_list,
			'get_top_add' => $get_top_add,
			'get_sidebar_add' => $get_sidebar_add,
		);
		$html_summary_result = $CI->parser->parse('front_view/model_test/summary_result',$results_data,true);

		$i = 0;
		foreach ($final_result as $key=>$value){$i++;
			$final_result[$key]['sl'] = $i;
			$final_result[$key]['exam_&_ques_id'] = $model_test_id."-".$value['question_id'];
		}
		$view_data = array(
				'summary_result' => $html_summary_result,
				'final_result_view' => $final_result,
				'related_model_list' => $related_model_list,
				'popular_course_list' => $popular_course_list,
				'get_top_add' => $get_top_add,
				'get_sidebar_add' => $get_sidebar_add,
		);
		$html_view = $CI->parser->parse('front_view/model_test/exam_result',$view_data,true);
		
		return $html_view ;
	}
	// EXAM RESULT CREATOR
	
	public function exam_result_creator( $question_ids,$result_data )
	{	
		$CI =& get_instance();	
		$CI->load->model('front/Model_tests');	
		if(!empty($question_ids)){
			for( $i=0; $i<count($question_ids); $i++ ){
				$question_id = $question_ids[$i];
				$original_answer_array =$CI->Model_tests->get_question_single_answer_sheet( $question_id );
				
				$original_ans_options = array();
				if(!empty($original_answer_array)){
					foreach ($original_answer_array as $ky=>$res_vale){
						$original_ans_options[] =$res_vale['answer_option_id'];
					}
				}
				
				$user_answerd_options = $this->array_index_searcher( $result_data,$question_id );
				if($original_ans_options == $user_answerd_options){
					$final_result[] = array("question_id"=>$question_id,"css_class"=>'answer_right');
				}else{
					$final_result[] = array("question_id"=>$question_id,"css_class"=>'answer_wrong');
				}
			}
			return $final_result;
		}else{
			$CI->session->set_userdata(array('warning_message'=>"You are not authorized user for this exam"));
			redirect(base_url());exit();
		}
	}
	// THIS FUNCTION RETURN ARRAY VALUE OF EXPECTED INDEX 
	private function array_index_searcher( $target_array,$target_id )
	{
		$option_ids = '';
		$final_key = Null ;
		foreach($target_array as $key => $val)
		{
			if ($val['question_id'] === $target_id ){
				$final_key = $key;
			}
		}		
		if($final_key === Null){
			return $option_ids;
		}else{
			$expected_array_val = $target_array[$final_key];
			$option_ids =$expected_array_val['option_ids'];
			return $option_ids;
		}
	}
	// THIS FUNCTION RETURN ARRAY VALUE OF EXPECTED INDEX 
	private function correct_answer_counter( $total_answers )
	{
		$total_correct_answer = 0 ;
		foreach($total_answers as $key => $val)
		{
			if($val['css_class'] == "answer_right"){
				$total_correct_answer++ ;
			}
		}
		return $total_correct_answer;
	}
	public function individual_question_view( $exam_id,$ques_id )
	{
		$CI =& get_instance();
		$CI->load->model('front/Model_tests');
		$answered_result = $CI->Model_tests->get_user_answered_result( $exam_id );
		$answered_array = (array) json_decode($answered_result[0]['answers_ids'],true);
		$answered_option_ids = $this->array_index_searcher( $answered_array,$ques_id );

		$question_and_option = $CI->Model_tests->get_questions_and_options( $ques_id );
		
		foreach($question_and_option as $key=>$val){
			$original_all_option[] = array('option_details'=>$val['option_details'],'question_option_id'=>$val['question_option_id']);
		}
	
		$original_answer = $CI->Model_tests->get_question_single_answer_sheet( $ques_id );
		
		$orgnl_ans_options = array();
		if(!empty($original_answer)){
			foreach($original_answer as $value){
				$orgnl_ans_options[] = $value['answer_option_id'];	
			}
		}
		
		$matching_result = $this->match_single_question_result( $answered_option_ids,$orgnl_ans_options);

		$user_selected_ans = array();
		if($matching_result){
			$user_selected_ans[] = "Right";
		}else{
			$wrong_answered_ids = $CI->Model_tests->get_user_selected_wrong_answer( $answered_option_ids );
			if(!empty($wrong_answered_ids)){
				foreach($wrong_answered_ids as $arr_val){
					$user_selected_ans[] = $arr_val['option_details'];
				}
			}
		}

		if(isset($answered_option_ids)){
		
			for($i=0;$i<count($orgnl_ans_options); $i++){
				for($j=0;$j<count($original_all_option); $j++){
					if($orgnl_ans_options[$i] == $original_all_option[$j]['question_option_id']){
						$original_all_option[$j]['right_answer']="origin_right_ans";
					}
				}
			}
		}
					
		$main_question = $question_and_option[0]['question_detals'];
		$final_array = array("main_question"=>$main_question,"main_options"=>$original_all_option,"user_answer"=>$user_selected_ans);
		return $final_array;

	}
	//
	private function match_single_question_result( $original_options,$user_answerd_options )
	{
		if($original_options == $user_answerd_options){
			return true;
		}else{
			return false;
		}
	}
	private function time_counter( $start_time )
	{
		$current_time = date("H:i:s"); 

		$time1 = strtotime($start_time);
		$time2 = strtotime($current_time);
		
		$difference = $time2 - $time1;
		$diff_format = date('H:i:s',$difference);
		list($hour,$minute,$second) = explode(":",$diff_format);
		$hour = ($hour == "01")? '00' :$hour ;
		$total_time = $hour.":".$minute.":".$second;
		return $total_time ;

	}
	
}
?>