<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Ltexam {
	// Retrieve  exam List 
	public function exam_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/exams');
		$tutor_id = $CI->session->userdata('user_id');
		$exam_data = $CI->exams->retrieve_exam_list($tutor_id,$limit,$page);
		$i=$page;
		foreach($exam_data as $k=>$v){$i++;
           $exam_data[$k]['sl']=$i;
		}
		$data = array(
				'title' => 'Exam List',
				'exam_list' => $exam_data,
				'links' => $links
			);
		$examList = $CI->parser->parse('tutor_view/exam/exam',$data,true);
		return $examList;
	}
	public function insert_exam($data)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/exams');
        $CI->exams->insert_exam($data);
		return true;
	}
	// exam_edit_data
	public function exam_edit_data($exam_id)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/exams');		
		$exam_list = $CI->exams->retrieve_exam_editdata($exam_id);
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
		$CI->load->model('tutor/exams');
		$datas = array();
		$sess_data =  $CI->session->userdata('required_exam_data');
		$chapter_ids = $sess_data['chapter_ids'];	
		$qstn_limit = $sess_data['ques_limit'];	
		$selected_ques = $sess_data['select_ques'];
		$exam_name = $sess_data['exam_name'];
		
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
			
			$exam_data = array('required_exam_data' => array('exam_name'=>$exam_name,'gen_proc'=>4,'chapter_ids'=>$chapter_ids,'select_ques'=>$selected_ques,'ques_limit'=>$qstn_limit));
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
				$CI->session->set_userdata(array('warning_message'=>"Question Set Create is Successfully Done Want To Save this Question Set !"));
				redirect(base_url('tutor/texam/finish_exam'));
				exit;
			}	
		}
		
		$startLevel = $CI->input->post('startLevel');
		if($startLevel =='' ){
			$startLevel = 0;
		}
		$items = 3;
		
		$questions = $CI->exams->chooseQuestion_fromQuestion_bank($chapter_ids,$startLevel,$items);
		if(empty($questions)){
			$CI->session->set_userdata(array('warning_message'=>"You have finished all questions ! Do you want to create Exam by your selected Questions ?"));
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
		$CI->load->model('tutor/exams');
		$tutor_id = $CI->session->userdata('user_id');
		$exam_data = $CI->exams->deleted_exam_list($tutor_id);
		$data = array(
				'title' => 'Deleted Exam List',
				'exam_list' => $exam_data
			);
		$examList = $CI->parser->parse('tutor_view/exam/deleted_exam',$data,true);
		return $examList;
	}
	//
	public function assign_exam_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/exams');
		$tutor_id = $CI->session->userdata('user_id');
		$assign_exam_list = $CI->exams->retrieve_assign_exam_list($tutor_id,$limit,$page);
		if(!empty($assign_exam_list)){
			$i=$page;
			foreach($assign_exam_list as $k=>$v){$i++;
			   $assign_exam_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'assign_exam_list' => $assign_exam_list,
				'links' => $links
			);
		$examList = $CI->parser->parse('tutor_view/exam/assign_batch',$data,true);
		return $examList;
	}
	// Retrieve Batch list
	public function batch_assign_form()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/exams');
		$tutor_id = $CI->session->userdata('user_id');
		$batch_list = $CI->exams->retrieve_batch_list($tutor_id);
		$exam_list = $CI->exams->retrieve_exam_items($tutor_id);
        $data = array(
				'title' => 'student List',
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
		$CI->load->model('tutor/exams');
		$tutor_id = $CI->session->userdata('user_id');
		$batch_list = $CI->exams->retrieve_batch_list($tutor_id);
		
		$exam_list = $CI->exams->retrieve_exam_items($tutor_id);
		$batch_assign_data = $CI->exams->retrieve_batch_assign_data($batch_assign_id);
		
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
}
?>