<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lchapter {
	/*
	** Retrieve  Course List From DB to View Course Menu
	*/
	public function chapter_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Chapters');
		$chapter_list = $CI->Chapters->retrieve_chapter_list();
		if(!empty($chapter_list)){
			foreach($chapter_list as $k=>$val){
				if($val['status']==1){
					$chapter_list[$k]['btn_class']="btn btn-sm btn-info";
					$chapter_list[$k]['class']="glyphicon glyphicon-ok";
					$chapter_list[$k]['status']=display('active');
				}
				else if($val['status']==0){
					$chapter_list[$k]['btn_class']="btn btn-sm btn-danger";
					$chapter_list[$k]['class']="glyphicon glyphicon-remove";
					$chapter_list[$k]['status']=display('inactive');
				}
				else{
					$chapter_list[$k]['class']='';
				}
			}
		
			$i =0;
			foreach($chapter_list as $key=>$val){$i++;
				$chapter_list[$key]['sl'] = $i;
			}
		}
		$data = array(
				'title' => 'Chapter List',
				'chapter_list' => $chapter_list,
			);
		$chapterList = $CI->parser->parse('admin_view/chapter/chapter',$data,true);
		return $chapterList;
	}

	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function chapter_add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Chapters');
		
		$class_list = $CI->Chapters->retrieve_class_list();
		$datas = array(
				'title' => 'Add Chapter',
				'class_list' => $class_list
			);			
		$chapterForm = $CI->parser->parse('admin_view/chapter/add_chapter_form',$datas,true);
		return $chapterForm;
	}
	/*
	** Insert Class Name To the Database
	*/
	public function insert_chapter($data)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Chapters');
        $CI->Chapters->insert_chapter($data);
		return true;
	}
	/*
	** class_edit_data
	*/
	public function chapter_edit_data($chapter_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Chapters');	
		$class_list = $CI->Chapters->retrieve_class_list();
		$chapter_detail = $CI->Chapters->retrieve_chapter_editdata($chapter_id);
		$class_id 	= $chapter_detail[0]['class_id'];
		$course_list = $CI->Chapters->retrieve_course_list($class_id);
		
		foreach($class_list as $k=>$val){
			if($chapter_detail[0]['class_id'] == $val['class_id']){
				$class_list[$k]['selected']='selected="selected"';
			}
			else{
                $class_list[$k]['selected']='';
            }
		}

		foreach($course_list as $key=>$value){
			if($chapter_detail[0]['course_id'] == $value['course_id']){
				$course_list[$key]['selected']='selected="selected"';
			}
			else{
                $course_list[$key]['selected']='';
            }
		}

		$data = array(
			'title' => 'Edit Chapter',
			'class_list' => $class_list,
			'course_list' => $course_list,
			'class_id' 	=> $chapter_detail[0]['class_id'],
			'course_id' => $chapter_detail[0]['course_id'],
			'course_name' => $chapter_detail[0]['course_name'],
			'chapter_id' => $chapter_detail[0]['chapter_id'],
			'chapter_name' => $chapter_detail[0]['chapter_name'],
			'image' => $chapter_detail[0]['image'],
			'chapter_file' => $chapter_detail[0]['chapter_file'],
			'youtube_url' => $chapter_detail[0]['youtube_url'],
			'status' => $chapter_detail[0]['status']
		);
		$chapterList = $CI->parser->parse('admin_view/chapter/edit_chapter_form',$data,true);
		return $chapterList;
	}

	public function get_requested_chapter_view()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Chapters');
		$chapter_list = $CI->Chapters->retrieve_requested_chapter_list();
		if(!empty($chapter_list)){
			$i = 0;
			foreach($chapter_list as $key=>$val){$i++;
				$chapter_list[$key]['sl'] = $i;
			}
		}
		$data = array(
				'title' => 'Requested Chapter List',
				'chapter_list' => $chapter_list
			);
		$chapterList = $CI->parser->parse('admin_view/chapter/requested_chapter',$data,true);
		return $chapterList;
	}
}
?>