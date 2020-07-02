<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Loperator {
	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function operator_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Operators');
		$operator_list = $CI->Operators->retrieve_operator_list();
		if(!empty($operator_list)){
			foreach($operator_list as $k=>$val){
				if($val['status']==1){
					$operator_list[$k]['btn_class']="btn btn-sm btn-info";
					$operator_list[$k]['class']="fa fa-check";
					$operator_list[$k]['status']=display("active");
				}
				else if($val['status']==0){
					$operator_list[$k]['btn_class']="btn btn-sm btn-danger";
					$operator_list[$k]['class']="fa fa-times-circle";
					$operator_list[$k]['status']=display('inactive');
				}
				else{
					$operator_list[$k]['class']='';
				}
			}
			$i = 0;
			foreach($operator_list as $key=>$val){$i++;
				$operator_list[$key]['sl'] = $i;
			}
		}
		
		$data = array(
				'title' => 'Operator List',
				'operator_list' => $operator_list
			);
		$operatorList = $CI->parser->parse('admin_view/operator/operator',$data,true);
		return $operatorList;
	}
	// ADD OPERATOR FORM
	public function add_operator_form()
	{	
		$CI =& get_instance();
		$CI->load->model('admin/Operators');
		$course_list = $CI->Operators->course_list();
		$data=array(
			'title' => 'Add Operator',
			'course_list' 		=>$course_list
		);
        $htmlForm = $CI->parser->parse('admin_view/operator/add_operator_form',$data,true);
		return $htmlForm;
	}
	//INSERT OPERATOR
	public function insert_operator($data1,$data2,$data3)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Operators');
        $CI->Operators->insert_operator($data1,$data2,$data3);
		return true;
	}
	/*
	** class_edit_data
	*/
	public function operator_edit_data($operator_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Operators');	
		$course_list = $CI->Operators->course_list();
		$operator_data = $CI->Operators->retrieve_operator_editdata($operator_id);
		
		foreach($course_list as $k=>$val){
			if($operator_data[0]['course_id'] == $val['course_id']){
				$course_list[$k]['selected']='selected="selected"';
			}
			else{
                $course_list[$k]['selected']='';
            }
		}		
		$data = array(
			'title' => 'Edit Operator',
			'course_list' => $course_list,
			'operator_id' => $operator_data[0]['user_id'],
			'operator_name' => $operator_data[0]['user_name'],
			'operator_email' => $operator_data[0]['email'],
			'image' => $operator_data[0]['image'],
			'mobile' => $operator_data[0]['mobile_no']
		);
		$quizeList = $CI->parser->parse('admin_view/operator/edit_operator_form',$data,true);
		return $quizeList;
	}
}
?>