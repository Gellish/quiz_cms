<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lclass {
	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function class_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Classes');
		$class_list = $CI->Classes->retrieve_class_list();
		if(!empty($class_list)){
			foreach($class_list as $k=>$val){
				if($val['status']==1){
					$class_list[$k]['btn_class']="btn btn-sm btn-info";
					$class_list[$k]['class']="glyphicon glyphicon-ok";
					$class_list[$k]['status']=display('active');
				}
				else if($val['status']==0){
					$class_list[$k]['btn_class']="btn btn-sm btn-danger";
					$class_list[$k]['class']="glyphicon glyphicon-remove";
					$class_list[$k]['status']=display('inactive');
				}
				else{
					$class_list[$k]['class']='';
				}
			}
		
			$i = 0;
			foreach($class_list as $key=>$val){$i++;
				$class_list[$key]['sl'] = $i;
			}
		}
		
		$data = array(
				'title' => 'Class List',
				'class_list' => $class_list,
			);
		$classList = $CI->parser->parse('admin_view/class/class',$data,true);
		return $classList;
	}
	public function insert_class($data)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Classes');
        $CI->Classes->insert_class($data);
		return true;
	}
	/*
	** class_edit_data
	*/
	public function class_edit_data($class_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Classes');		
		$class_list = $CI->Classes->retrieve_class_editdata($class_id);
		$data = array(
				'modal_header' =>'Class Name Edit',
				'class_id' => $class_list[0]['class_id'],
				'class_name' => $class_list[0]['class_name'],
				'status' => $class_list[0]['status']
			);
		$quizeList = $CI->parser->parse('admin_view/class/edit_class_form',$data,true);
		return $quizeList;
	}
	public function requested_class_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Classes');
		$class_list = $CI->Classes->retrieve_requested_class();
		
		if(!empty($class_list)){		
			$i = 0;
			foreach($class_list as $key=>$val){$i++;
				$class_list[$key]['sl'] = $i;
			}
		}
		$data = array(
				'title' => 'Requested Class List',
				'class_list' => $class_list
			);
		$classList = $CI->parser->parse('admin_view/class/requested_class',$data,true);
		return $classList;
	}
}
?>