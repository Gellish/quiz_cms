<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lstudent {
	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function student_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Student');
		$student_list = $CI->Student->retrieve_student_list();

		if(!empty($student_list)){
			foreach($student_list as $k=>$val){
				if($val['status']==1){
					$student_list[$k]['btn_class']="btn btn-sm btn-info";
					$student_list[$k]['class']="fa fa-check";
					$student_list[$k]['status']=display('active');
				}
				else if($val['status']==0){
					$student_list[$k]['btn_class']="btn btn-sm btn-danger";
					$student_list[$k]['class']="fa fa-times-circle";
					$student_list[$k]['status']=display('inactive');
				}
				else{
					$student_list[$k]['class']='';
				}
			}
			$i = 0;
			foreach($student_list as $key=>$val){$i++;
				$student_list[$key]['sl'] = $i;
			}
		}
		
		$data = array(
				'title' => 'Student List',
				'student_list' => $student_list
			);
		$studentList = $CI->parser->parse('admin_view/student/student',$data,true);
		return $studentList;
	}
	// ADD STUDENT FORM
	public function add_student_form()
	{	
		$CI =& get_instance();
		$CI->load->model('admin/Student');
		$data=array(
			'title' => 'Add Student',
		);
        $htmlForm = $CI->parser->parse('admin_view/student/add_student_form',$data,true);
		return $htmlForm;
	}
	//INSERT STUDENT
	public function insert_student($data1,$data2)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Student');
        $CI->Student->insert_student($data1,$data2);
		return true;
	}
	//Student edit data
	public function student_edit_data($student_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/student');	
		$student_list = $CI->student->student_list($student_id);
		$data = array(
			'title' => 'Edit student',
			'user_id' => $student_list[0]['user_id'],
			'user_name' => $student_list[0]['user_name'],
			'email' => $student_list[0]['email'],
			'mobile_no' => $student_list[0]['mobile_no'],
			'image' => $student_list[0]['image'],
			'status' => $student_list[0]['status'],
		);
	
		$companyList = $CI->parser->parse('admin_view/student/edit_user_form',$data,true);
		return $companyList;
	}
}
?>