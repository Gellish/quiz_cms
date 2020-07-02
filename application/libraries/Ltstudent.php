<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Ltstudent {
	// Retrieve  student List 
	public function student_list()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Students');

		$batch_list = $CI->Students->retrieve_batch_list();
		$student_data = $CI->Students->retrieve_student_list();
		// echo "<pre>";
		// print_r($student_data);
		// exit();
		if(!empty($student_data)){
			$i=0;
			foreach($student_data as $k=>$v){$i++;
			   $student_data[$k]['sl']=$i;
			}
		}

		$data = array(
				'title' => 'Student List',
				'batch_name' => $batch_list,
				'student_list' => $student_data,
			);			
		$studentList = $CI->parser->parse('tutor_view/student/student',$data,true);
		return $studentList;
	}
	//Student Search By Batch id
	public function student_search_by_batch($batch_id)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Students');
		$batch_list = $CI->Students->retrieve_batch_list();
		$student_data = $CI->Students->student_search_by_batch($batch_id);
		if(!empty($student_data)){
			$i=0;
			foreach($student_data as $k=>$v){$i++;
			   $student_data[$k]['sl']=$i;
			}
			foreach($student_data as $k=>$v){;
			   $student_data[$k]['batch_id']=$batch_id;
			}
		}
		$data = array(
				'title' => 'student List',
				'batch_list' => $batch_list,
				'student_list' => $student_data
			);
		
		$studentList = $CI->parser->parse('tutor_view/student/student_search_result',$data,true);
		return $studentList;
	}
	// Retrieve Batch list
	public function retrieve_batch_list()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Students');
		$batch_list = $CI->Students->retrieve_batch_list();
        $data = array(
				'title' => 'student List',
				'batch_list' => $batch_list
			);
		$studentList = $CI->parser->parse('tutor_view/student/add_student_form',$data,true);
		return $studentList;
	}
	public function insert_student($data)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Students');
        $CI->Students->insert_student($data);
		return true;
	}
}
?>