<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lcourse {
	/*
	** Retrieve  Course List From DB to View Course Menu
	*/
	public function course_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Courses');
		$course_list = $CI->Courses->retrieve_course_list();
		if(!empty($course_list)){
			foreach($course_list as $k=>$val){
				if($val['status']==1){
					$course_list[$k]['btn_class']="btn btn-sm btn-info";
					$course_list[$k]['class']="glyphicon glyphicon-ok";
					$course_list[$k]['course_status']=display('active');
				}
				else if($val['status']==0){
					$course_list[$k]['btn_class']="btn btn-sm btn-danger";
					$course_list[$k]['class']="glyphicon glyphicon-remove";
					$course_list[$k]['course_status']=display('inactive');
				}
				else{
					$course_list[$k]['class']='';
				}
			}
			$i = 0;
			foreach($course_list as $key=>$val){$i++;
				$course_list[$key]['sl'] = $i;
			}
		}
		$data = array(
				'title' => 'Course List',
				'course_list' => $course_list,
			);
		$courseList = $CI->parser->parse('admin_view/course/course',$data,true);
		return $courseList;
	}

	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function course_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Courses');
		
		$class_list = $CI->Courses->retrieve_class_list();
		$data = array(
				'title' => 'Add Coure',
				'class_list' => $class_list
			);
		$courseForm = $CI->parser->parse('admin_view/course/add_course_form',$data,true);
		return $courseForm;
	}
	/*
	** Insert Class Name To the Database
	*/
	public function insert_course($data)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Courses');
        $CI->Courses->insert_course($data);
		return true;
	}
	//class_edit_data
	public function course_edit_data($course_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Courses');	
		$class_list = $CI->Courses->retrieve_class_list();
		$course_detail = $CI->Courses->retrieve_course_editdata($course_id);
		
		$class_id = $course_detail[0]['class_id'];

		foreach($class_list as $k=>$val){
			if($class_id == $val['class_id']){
				$class_list[$k]['selected']='selected="selected"';
			}
			else{
                $class_list[$k]['selected']='';
            }
		}
		
		$data = array(
				'class_list' => $class_list,
				'class_id' => $course_detail[0]['class_id'],
				'course_id' => $course_detail[0]['course_id'],
				'course_name' => $course_detail[0]['course_name'],
				'is_new' => $course_detail[0]['is_new'],
				'status' => $course_detail[0]['status']
			);
		$courseList = $CI->parser->parse('admin_view/course/edit_course_form',$data,true);
		return $courseList;
	}
	public function get_requested_course_view()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Courses');
		$course_list = $CI->Courses->retrieve_requested_course_list();

		if(!empty($course_list)){
			$i = 0;
			foreach($course_list as $key=>$val){$i++;
				$course_list[$key]['sl'] = $i;
			}
		}
		$data = array(
				'title' => 'Requested Course List',
				'course_list' => $course_list
			);
		$courseList = $CI->parser->parse('admin_view/course/requested_course',$data,true);
		return $courseList;
	}
}
?>