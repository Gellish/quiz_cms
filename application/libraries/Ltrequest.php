<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ltrequest {
	//Retrieve  Course List From DB to View Course Menu
	public function chapter_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Request');
		$chapter_list = $CI->Request->retrieve_chapter_list($limit,$page);
		if(!empty($chapter_list)){
			foreach($chapter_list as $k=>$val){
				if($val['status']==1){
					$chapter_list[$k]['class']="icon-ok";
				}
				else if($val['status']==0){
					$chapter_list[$k]['class']="icon-remove-sign";
				}
				else{
					$chapter_list[$k]['class']='';
				}
			}
		}
		
		$data = array(
				'title' => 'Chapter List',
				'chapter_list' => $chapter_list,
				'links' => $links
			);
		$chapterList = $CI->parser->parse('tutor_view/request/request',$data,true);
		return $chapterList;
	}
	// COURSE REQUEST VIEW
	public function course_request_form()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Request');
		
		$class_list = $CI->Request->retrieve_all_class();
		$datas = array('title' => 'Request for course','class_list' => $class_list);			
		$courseForm = $CI->parser->parse('tutor_view/request/request_course_form',$datas,true);
		return $courseForm;
	}
	// CHAPTER REQUEST VIEW
	public function chapter_request_form()
	{
		$CI =& get_instance();
		$CI->load->model('tutor/Request');
		
		$class_list = $CI->Request->retrieve_all_class();
		$datas = array('title' => 'Request for course','class_list' => $class_list);			
		$courseForm = $CI->parser->parse('tutor_view/request/request_chapter_form',$datas,true);
		return $courseForm;
	}


}
?>