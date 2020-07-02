<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lmodel_test {
	/*
	** Retrieve  Course List From DB to View Course Menu
	*/
	public function model_test_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Model_tests');
		$model_test_list = $CI->Model_tests->retrieve_model_test_list();

		if(!empty($model_test_list)){
			foreach($model_test_list as $k=>$val){
				if($val['status']==1){
					$model_test_list[$k]['class']="icon-ok";
				}
				else if($val['status']==0){
					$model_test_list[$k]['class']="icon-remove-sign";
				}
				else{
					$model_test_list[$k]['class']='';
				}
			}
		
			$i = 0;
			foreach($model_test_list as $key=>$val){$i++;
				$model_test_list[$key]['sl'] = $i;
				$model_test_list[$key]['test_details'] =character_limiter($val['test_details'],'80');
			}
		}
	
		$data = array(
				'title' => 'Model Test List',
				'model_test_list' => $model_test_list,
			);
		$model_testList = $CI->parser->parse('admin_view/model_test/model_test',$data,true);
		return $model_testList;
	}

	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function model_test_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Model_tests');
		
		$class_list = $CI->Model_tests->retrieve_class_list();
		$datas = array(
				'title' => 'Add Model Test',
				'class_list' => $class_list
			);			
		$model_testForm = $CI->parser->parse('admin_view/model_test/add_test_form',$datas,true);
		return $model_testForm;
	}
	/*
	** Insert Class Name To the Database
	*/
	public function insert_model_test($data)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Model_tests');
        $CI->Model_tests->insert_model_test($data);
		return true;
	}
	/*
	** class_edit_data
	*/
	public function model_test_edit_data($model_test_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Model_tests');	
		$class_list = $CI->Model_tests->retrieve_class_list();
		$model_test_detail = $CI->Model_tests->retrieve_model_test_editdata($model_test_id);
		if(empty($model_test_detail)){
			$CI->session->set_userdata(array('warning_message'=>"Invalid Model Test ID"));
			redirect(base_url('admin/cmodel_test'));
		}else{
			foreach($class_list as $k=>$val){
				if($model_test_detail[0]['class_id'] == $val['class_id']){
					$class_list[$k]['selected']='selected="selected"';
				}
				else{
					$class_list[$k]['selected']='';
				}
			}
			
			$detail_data = json_decode($model_test_detail[0]['model_test_details'],true);
			
			foreach($detail_data as $key=>$value)
			{
				$subj_name = $CI->Model_tests->retrieve_class_name($value['subject_id']);
				$subject_data[] = array( 'course_id'=>$value['subject_id'],'course_name'=>$subj_name[0]['course_name'],'no_of_ques'=>$value['no_of_ques']);
			}

			$data = array(
				'title' 	=> 'Edit Model Test',
				'class_list' => $class_list,
				'class_id' 	=> $model_test_detail[0]['class_id'],
				'model_test_name' => $model_test_detail[0]['model_test_name'],
				'duration' => $model_test_detail[0]['duration'],
				'subject_data' => $subject_data,
				'test_details' => $model_test_detail[0]['test_details'],
				'image' => $model_test_detail[0]['image'],
				'model_test_id' => $model_test_id
			);
		}
		
		$model_testList = $CI->parser->parse('admin_view/model_test/edit_test_form',$data,true);
		return $model_testList;
	}

	public function get_requested_model_test_view()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Model_tests');
		$model_test_list = $CI->Model_tests->retrieve_requested_model_test_list();
		if(!empty($model_test_list)){
			$i = 0;
			foreach($model_test_list as $key=>$val){$i++;
				$model_test_list[$key]['sl'] = $i;
			}
		}
		$data = array(
				'title' => 'Requested model_test List',
				'model_test_list' => $model_test_list
			);
		$model_testList = $CI->parser->parse('admin_view/model_test/requested_model_test',$data,true);
		return $model_testList;
	}
}
?>