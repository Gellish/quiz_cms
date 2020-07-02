<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ltutor {
	// Retrieve  Class List From DB to View Class Menu

	public function get_active_tutor_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Tutors');
		$tutor_list = $CI->Tutors->retrieve_active_tutor_list();
		if(!empty($tutor_list)){
			foreach($tutor_list as $k=>$val){
				if($val['status']==1){
					$tutor_list[$k]['btn_class']="btn btn-sm btn-info";
					$tutor_list[$k]['class']="fa fa-check";
					$tutor_list[$k]['status']=display('inactive');
				}
				else if($val['status']==0){
					$tutor_list[$k]['btn_class']="btn btn-sm btn-danger";
					$tutor_list[$k]['class']="fa fa-times-circle";
					$tutor_list[$k]['status']=display('active');
				}
				else{
					$tutor_list[$k]['class']='';
				}
			}
			$i = 0;
			foreach($tutor_list as $key=>$val){$i++;
				$tutor_list[$key]['sl'] = $i;
			}
		}
		$data = array(
				'title' => 'All Active Teacher List',
				'tutor_list' => $tutor_list,
			);
		$tutorList = $CI->parser->parse('admin_view/tutor/tutor',$data,true);
		return $tutorList;
	}
	
	public function get_newRegister_tutor_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Tutors');
		$tutor_list = $CI->Tutors->retrieve_newRegister_tutor_list($limit,$page);
		if(!empty($tutor_list)){
			$i = $page;
			foreach($tutor_list as $key=>$val){$i++;
				$tutor_list[$key]['sl'] = $i;
			}
		}
		$data = array(
				'title' => 'Recent Register Teacher List',
				'tutor_list' => $tutor_list,
				'links' => $links
			);
		$tutorList = $CI->parser->parse('admin_view/tutor/new_registar',$data,true);
		return $tutorList;
	}
	
	public function get_inactive_tutor_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Tutors');
		$tutor_list = $CI->Tutors->retrieve_inactive_tutor_list($limit,$page);
		if(!empty($tutor_list)){
			foreach($tutor_list as $k=>$val){
				if($val['status']==1){
					$tutor_list[$k]['btn_class']="btn btn-sm btn-info";
					$tutor_list[$k]['class']="fa fa-check";
					$tutor_list[$k]['status']=display('inactive');
				}
				else if($val['status']==0){
					$tutor_list[$k]['btn_class']="btn btn-sm btn-danger";
					$tutor_list[$k]['class']="fa fa-times-circle";
					$tutor_list[$k]['status']=display('active');
				}
				else{
					$tutor_list[$k]['class']='';
				}
			}
			$i = $page;
			foreach($tutor_list as $key=>$val){$i++;
				$tutor_list[$key]['sl'] = $i;
			}
		}
		$data = array(
				'title' => 'All Inactive Teacher List',
				'tutor_list' => $tutor_list,
				'links' => $links
			);
		$tutorList = $CI->parser->parse('admin_view/tutor/tutor',$data,true);
		return $tutorList;
	}
	//Add Tutor Form
	public function add_tutor_form()
	{	
		$CI =& get_instance();
		$CI->load->model('admin/Tutors');
		$data=array(
			'title' => 'Add New Teacher',
			);
        $htmlForm = $CI->parser->parse('admin_view/tutor/add_tutor_form',$data,true);
		return $htmlForm;
	}
	public function insert_tutor($data1,$data2)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Tutors');
        $CI->Tutors->insert_tutor($data1,$data2);
		return true;
	}
	//
	public function tutor_edit_data($tutor_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Tutors');	
		$course_list = $CI->Tutors->retrieve_course_list();
		$tutor_data = $CI->Tutors->retrieve_tutor_editdata($tutor_id);
		// foreach($course_list as $k=>$val){
		// 	if($tutor_data[0]['course_id'] == $val['course_id']){
		// 		$course_list[$k]['selected']='selected="selected"';
		// 	}
		// 	else{
  //               $course_list[$k]['selected']='';
  //           }
		// }		
		$data = array(
			'title' => 'Edit Teacher',
			'course_list' => $course_list,
			'tutor_id' => $tutor_data[0]['user_id'],
			'tutor_name' => $tutor_data[0]['user_name'],
			'tutor_email' => $tutor_data[0]['email'],
			'image' => $tutor_data[0]['image'],
			'mobile' => $tutor_data[0]['mobile_no']
		);
		$quizeList = $CI->parser->parse('admin_view/tutor/edit_tutor_form',$data,true);
		return $quizeList;
	}
}
?>