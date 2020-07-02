<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lochapter {
	//Retrieve  Course List From DB to View Course Menu
	public function chapter_list()
	{
		$CI =& get_instance();
		$CI->load->model('operator/Chapters');
		$chapter_list = $CI->Chapters->retrieve_chapter_list();
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
			);
		$chapterList = $CI->parser->parse('operator_view/chapter/chapter',$data,true);
		return $chapterList;
	}
	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function chapter_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('operator/Chapters');
		
		$course_list = $CI->Chapters->retrieve_assign_course();
		$datas = array(
				'title' => 'Add Chapter',
				'course_list' => $course_list
			);			
		$chapterForm = $CI->parser->parse('operator_view/chapter/add_chapter_form',$datas,true);
		return $chapterForm;
	}
	/*
	** Insert Class Name To the Database
	*/
	public function insert_chapter($data)
	{
		$CI =& get_instance();
		$CI->load->model('operator/Chapters');
        $CI->Chapters->insert_chapter($data);
		return true;
	}
	/*
	** class_edit_data
	*/
	public function chapter_edit_data($chapter_id)
	{
		$CI =& get_instance();
		$CI->load->model('operator/Chapters');	
		$chapter_detail = $CI->Chapters->retrieve_chapter_editdata($chapter_id);
		$course_list = $CI->Chapters->retrieve_assign_course();

		$data = array(
			'title' => 'Chapters List',
			'course_list' => $course_list,
			'chapter_id' 	=> $chapter_detail[0]['chapter_id'],
			'course_id' => $chapter_detail[0]['course_id'],
			'course_name' => $chapter_detail[0]['course_name'],
			'chapter_name' => $chapter_detail[0]['chapter_name'],
			'status' => $chapter_detail[0]['status']
		);
		$chapterList = $CI->parser->parse('operator_view/chapter/edit_chapter_form',$data,true);
		return $chapterList;
	}
}
?>