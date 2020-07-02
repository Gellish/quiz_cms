<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Ltexam {
	// Retrieve  exam List 
	public function exam_list()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');
		$tutor_id = $CI->session->userdata('user_id');
		$exam_data = $CI->Exams->retrieve_exam_list($tutor_id);
		$i=0;
		foreach($exam_data as $k=>$v){$i++;
           $exam_data[$k]['sl']=$i;
		}
		$data = array(
				'title' => 'Exam List',
				'exam_list' => $exam_data,
			);
		$examList = $CI->parser->parse('tutor_view/exam/exam',$data,true);
		return $examList;
	}
	public function insert_exam($data)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');
        $CI->Exams->insert_exam($data);
		return true;
	}
	// exam_edit_data
	public function exam_edit_data($exam_id)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');		
		$exam_list = $CI->Exams->retrieve_exam_editdata($exam_id);
		$data = array(
				'exam_id' => $exam_list[0]['exam_id'],
				'exam_name' => $exam_list[0]['exam_name']
			);
		$quizeList = $CI->parser->parse('tutor_view/exam/edit_exam_form',$data,true);
		return $quizeList;
	}
	public function chooseQuestion_fromQuestion_bank($select_ids)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');
		$datas = array();
		$sess_data =  $CI->session->userdata('required_exam_data');
		$chapter_ids = $sess_data['chapter_ids'];	
		$qstn_limit = $sess_data['ques_limit'];	
		$selected_ques = $sess_data['select_ques'];
		$exam_name = $sess_data['exam_name'];
		$course_id = $sess_data['course_id'];
		
		if(!empty($selected_ques)){
			foreach ($selected_ques as $index=>$value) {
				foreach ($value as $key=>$val) {
					$datas[] = $val;
				}
			}
		}
		$choose_ids = count($datas);
		$left_ids = ($qstn_limit - $choose_ids);
		
		if(!empty($select_ids)){
			if($left_ids >= $choose_ids){
				$new_ids = $select_ids;	
			}else{
				$sliced_ids = array_slice($select_ids,0,$left_ids);
				$new_ids = $sliced_ids;	
			}
			array_push($selected_ques,$new_ids);
			$exam_data = array(
				'required_exam_data' => ''
				);
			$CI->session->unset_userdata($exam_data);
			
			$exam_data = array('required_exam_data' => array('exam_name'=>$exam_name,'gen_proc'=>4,'course_id'=>$course_id,'chapter_ids'=>$chapter_ids,'select_ques'=>$selected_ques,'ques_limit'=>$qstn_limit));
			$CI->session->set_userdata($exam_data);
			
			$sess_data =  $CI->session->userdata('required_exam_data');

			$sess_chapter_ids = $sess_data['chapter_ids'];	
			$sess_qstn_limit = $sess_data['ques_limit'];	
			$sess_selected_ques = $sess_data['select_ques'];	
			if(!empty($sess_selected_ques)){
				foreach ($sess_selected_ques as $index=>$value) {
					foreach ($value as $key=>$val) {
						$new_datas[] = $val;
					}
				}
			}
			$new_choose_ids = count($new_datas);
			if($sess_qstn_limit == $new_choose_ids){
				$CI->session->set_userdata(array('warning_message'=>"Question Set Create is Successfully Done, Want To Save this Question Set !"));
				redirect(base_url('tutor/texam/finish_exam'));
				exit;
			}	
		}
		
		$startLevel = $CI->input->post('startLevel');
		if($startLevel =='' ){
			$startLevel = 0;
		}
		$items = 3;
		
		$questions = $CI->Exams->chooseQuestion_fromQuestion_bank($chapter_ids,$startLevel,$items);
		if(empty($questions)){
			$CI->session->set_userdata(array('warning_message'=>"You have successfully selected all questions ! Do you want to create Exam now ?"));
			redirect(base_url('tutor/texam/finish_exam'));
		}
		$startLevel = $startLevel+ 3;
		$data = array(
				'startLevel' => $startLevel,
				'questions_name' => $questions
			);
		$quizeList = $CI->parser->parse('tutor_view/exam/choose_qstn_cont',$data,true);
		$CI->template->full_tutor_html_view($quizeList);
	}
	// Retrieve  Deleted Exam List
	public function deleted_exam_list()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');
		$tutor_id = $CI->session->userdata('user_id');
		$exam_data = $CI->Exams->deleted_exam_list($tutor_id);
		$data = array(
				'title' => 'Deleted Exam List',
				'exam_list' => $exam_data
			);
		$examList = $CI->parser->parse('tutor_view/exam/deleted_exam',$data,true);
		return $examList;
	}
	//
	public function assign_exam_list()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');
		$tutor_id = $CI->session->userdata('user_id');
		$assign_exam_list = $CI->Exams->retrieve_assign_exam_list($tutor_id);
		if(!empty($assign_exam_list)){
			$i=0;
			foreach($assign_exam_list as $k=>$v){$i++;
			   $assign_exam_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'title' => 'Assigned Exam List',
				'assign_exam_list' => $assign_exam_list,
			);
		$examList = $CI->parser->parse('tutor_view/exam/assign_batch',$data,true);
		return $examList;
	}
	// Retrieve Batch list
	public function batch_assign_form()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');
		$tutor_id = $CI->session->userdata('user_id');
		$batch_list = $CI->Exams->retrieve_batch_list($tutor_id);
		$exam_list = $CI->Exams->retrieve_exam_items($tutor_id);
        $data = array(
				'title' => 'Assigned Exam',
				'batch_list' => $batch_list,
				'exam_list' => $exam_list
			);
		$studentList = $CI->parser->parse('tutor_view/exam/batch_assign_add',$data,true);
		return $studentList;
	}
	// Retrieve Batch Data To Update 
	public function retrieve_batch_assign_data($batch_assign_id)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');
		$tutor_id = $CI->session->userdata('user_id');
		$batch_list = $CI->Exams->retrieve_batch_list($tutor_id);
		
		$exam_list = $CI->Exams->retrieve_exam_items($tutor_id);
		$batch_assign_data = $CI->Exams->retrieve_batch_assign_data($batch_assign_id);
		
		foreach($batch_list as $indx=>$v){
			if($batch_assign_data[0]['batch_id'] == $v['batch_id']){
				$batch_list[$indx]['selected']='selected="selected"';
			}
			else{
                $batch_list[$indx]['selected']='';
            }
		}
		foreach($exam_list as $indx=>$v){
			if($batch_assign_data[0]['exam_id'] == $v['exam_id']){
				$exam_list[$indx]['selected']='selected="selected"';
			}
			else{
                $exam_list[$indx]['selected']='';
            }
		}
	
        $data = array(
				'batch_assign_id' => $batch_assign_id,
				'batch_list' => $batch_list,
				'exam_list' => $exam_list
			);
		$studentList = $CI->parser->parse('tutor_view/exam/batch_assign_edit',$data,true);
		return $studentList;
	}
	
	// Cretae assign exam result view
	
	public function get_assign_exam_result( $batch_id,$exam_id )
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');
		
		$students = $CI->Exams->retrieve_batch_student( $batch_id );
		
		$all_student = array();
		if(!empty($students)){
			foreach($students as $indx=>$val){
			   $all_student =  json_decode($val['student_ids'],true);
			}
		}
		
		$assign_exam_result = array();
		if(!empty($all_student)){
			$assign_exam_result = $CI->Exams->retrieve_assign_exam_result( $all_student,$exam_id );
		}
	
	 	if(!empty($assign_exam_result)){
			$i=0;
			foreach($assign_exam_result as $k=>$v){$i++;
			   $assign_exam_result[$k]['sl']=$i;
			}
		} 
		$data = array(
				'assign_exam_result' => $assign_exam_result
			);
		$exam_result = $CI->parser->parse('tutor_view/exam/assign_exam_result',$data,true);
		return $exam_result;
	}
	// Cretae Student Detail Result View
	
	public function get_student_detail_result( $student_id,$exam_id )
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Exams');
		
		$exam_data = $CI->Exams->retrieve_exam_data( $student_id,$exam_id );
		$question_ids = array();
		$answer_ids = array();
		if(!empty($exam_data)){
			foreach($exam_data as $indx=>$val){
			   $question_ids =  json_decode($val['questions_id'],true);
			   $answer_ids =  json_decode($val['answers_id'],true);
			}
		}
		$matching_val = $this->exam_result_matcher( $question_ids,$answer_ids );
		
		if(!empty($matching_val)){
			foreach($matching_val as $index=>$value){
			   $final_result[] =  $value;
			}
		}
		$student_data = $CI->Exams->retrieve_student_info( $student_id );
		
		$data = array(
				'title'		=> "Student Detail Result",
				'student_name' => $student_data[0]['user_name'],
				'student_mobile' => $student_data[0]['mobile_no'],
				'detail_exam_result' => $final_result
			);
		$exam_result = $CI->parser->parse('tutor_view/exam/detaild_exam_result',$data,true);
		return $exam_result;
	}
	// EXAM RESULT CREATOR
	
	private function exam_result_matcher( $question_ids,$answer_ids )
	{	
		$CI =& get_instance();	
		$CI->load->model('tutor/Exams');

		$final_result = array();
		for( $i=0; $i<count($question_ids); $i++ ){
			$question_id = $question_ids[$i];
			$option_ids = $this->array_index_searcher( $answer_ids ,$question_id );
			
			$question_detals = '';
			$user_option_details = array();
			$system_option_details = array();
							
			if($option_ids){
				$user_options = $CI->Exams->retrieve_student_question_answer( $option_ids );
				if(!empty($user_options)){
					foreach($user_options as $pre_val){
						$user_option_details[] = $pre_val['option_details'];	
					}
				}
			}else{
				$user_option_details[] = "Did Not Attend";
			}
			
			$system_data = $CI->Exams->retrieve_original_question_answer( $question_id );
			
			if($system_data){
				foreach($system_data as $exponent_val){
					$question_detals = $exponent_val['question_detals'];	
					$system_option_details[] = $exponent_val['option_details'];	
				}
			}

			$final_result[] = array(
					'question_detals' => $question_detals,
					'system_option_details' => $system_option_details,
					'user_option_details' => $user_option_details
			);
		}
		return $final_result;
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
	
}
?>