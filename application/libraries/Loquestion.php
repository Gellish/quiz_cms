<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Loquestion {
	//Retrieve  Course List From DB to View Course Menu
	public function question_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('operator/Questions');

		$course_list = $CI->Questions->retrieve_assign_course();
		$course_id = $course_list [0]['course_id'];
		$chapter_list = $CI->Questions->retrieve_chapter_list($course_id);

		$question_data = $CI->Questions->retrieve_question_list($limit,$page);
		if(!empty($question_data)){
			$i = $page;
			foreach($question_data as $key=>$val){$i++;
				$question_data[$key]['sl'] = $i;
			}
		}
			$data = array(
					'title' => 'Question List',
					'question_list' => $question_data,
					'course_list' => $course_list,
					'chapter_list' => $chapter_list,
					'links' => $links
				);
		
		$questionList = $CI->parser->parse('operator_view/question_option/question',$data,true);
		return $questionList;
	}
	//Question seacrh by question id
	public function question_search_by_chapter_id($chapter_id)
	{
		$CI =& get_instance();
		$CI->load->model('operator/Questions');
		$question_data = $CI->Questions->retrieve_all_question_list($chapter_id);
		if(!empty($question_data)){
			$i = 0;
			foreach($question_data as $key=>$val){$i++;
				$question_data[$key]['sl'] = $i;
			}
		}
			$data = array(
					'title' => 'Question List',
					'question_list' => $question_data,
				);
		
		$questionList = $CI->parser->parse('operator_view/question_option/question',$data,true);
		return $questionList;
	}





	//Form for question Add
	public function question_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('operator/Questions');
		
		$course_list = $CI->Questions->retrieve_assign_course();
		$course_id = $course_list [0]['course_id'];
		$chapter_list = $CI->Questions->retrieve_chapter_list($course_id);
		$datas = array(
				'title' => 'Add Question',
				'course_list' => $course_list,
				'chapter_list' => $chapter_list
			);			
		$questionForm = $CI->parser->parse('operator_view/question_option/add_question_form',$datas,true);
		return $questionForm;
	}
	// Insert Question
	public function insert_question($data,$chapter_id)
	{
		$CI =& get_instance();
		$CI->load->model('operator/Questions');
        return $CI->Questions->question_entry($data,$chapter_id);
	}
	
	public function option_modal_view($question_id)
	{
		$CI =& get_instance();
		$CI->load->model('operator/Questions');
		$option_data = $CI->Questions->retrieve_option_data($question_id);
		$answer_data = $CI->Questions->retrieve_answer_data($question_id);

		if(!empty($option_data)){
			foreach($option_data as $index=>$value){
				$option_id = $value['question_option_id'];
				if(!empty($answer_data)){
					foreach($answer_data as $k=>$val){
					
						if($option_id == $val['answer_option_id']){
							$option_data[$index]['checked']='checked="checked"';
						}
					}
				}
			}
		}
		$data = array(
				'title' => 'Option List',
				'question_details' => $option_data[0]['question_detals'],
				'question_id' => $option_data[0]['question_id'],
				'option_list' => $option_data
			);
		$optionList = $CI->parser->parse('operator_view/question_option/question_option',$data,true);
		return $optionList;
	}
	
	// Retrieve Question Edit Data
	public function question_option_edit_data($question_id)
	{
		$CI =& get_instance();
		$CI->load->model('operator/Questions');
		
		//$class_list = $CI->Questions->retrieve_class_list();
		$question_detail = $CI->Questions->retrieve_question_editdata($question_id);
		
		$class_id 		 = $question_detail[0]['class_id'];
		$course_list	 = $CI->Questions->retrieve_course_list($class_id);	
		
		$course_id 		 =$question_detail[0]['course_id'];
		$chapter_list	 = $CI->Questions->retrieve_chapter_list($course_id);
/* 		foreach($class_list as $k=>$val){
			if($question_detail[0]['class_id'] == $val['class_id']){
				$class_list[$k]['selected']='selected="selected"';
			}
			else{
                $class_list[$k]['selected']='';
            }
		} */
		foreach($course_list as $key=>$value){
			if($question_detail[0]['course_id'] == $value['course_id']){
				$course_list[$key]['selected']='selected="selected"';
			}
			else{
                $course_list[$key]['selected']='';
            }
		}
		foreach($chapter_list as $indx=>$v){
			if($question_detail[0]['chapter_id'] == $v['chapter_id']){
				$chapter_list[$indx]['selected']='selected="selected"';
			}
			else{
                $chapter_list[$key]['selected']='';
            }
		}
		
		//Option Details 
		$option_data = $CI->Questions->retrieve_option_data($question_id);
		$answer_data = $CI->Questions->retrieve_answer_data($question_id);

		if(!empty($option_data)){
			foreach($option_data as $index=>$value){
				$option_id = $value['question_option_id'];
				if(!empty($answer_data)){
					foreach($answer_data as $k=>$val){
					
						if($option_id == $val['answer_option_id']){
							$option_data[$index]['checked']='checked="checked"';
						}
					}
				}
			}
		}
		
		$data = array(
				'title' => 'Edit Question',
				'course_list' => $course_list,
				'chapter_list' => $chapter_list,
				'question_id' => $question_detail[0]['question_id'],
				'question_detals' => $question_detail[0]['question_detals'],
				'language' => $question_detail[0]['language'],
				'answer_type' => $question_detail[0]['answer_type'],
				'option_list' => $option_data,
				'status' => $question_detail[0]['status']
			);
		$courseList = $CI->parser->parse('operator_view/question_option/edit_question_form',$data,true);
		return $courseList;
	}
	//Update Question
	
	public function update_question($data,$chapter_id,$question_id)
	{
		$CI =& get_instance();
		$CI->load->model('operator/Questions');
        $CI->Questions->question_update($data,$chapter_id,$question_id);
	}

}
?>