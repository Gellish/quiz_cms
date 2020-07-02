<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chapters extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*
	** Count Course List For Create Paginiton
	*/
	public function count_chapter_list(){
	
		$this->db->select('a.*,b.course_name,c.class_name');
		$this->db->from('course_chapter_add a');
		$this->db->join('course_add b', 'b.course_id = a.course_id');
		$this->db->join('class_add c', 'c.class_id = b.class_id');
		$this->db->where(array('b.status'=>1,'c.status'=>1)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}
	/*
	** Retrieve Course List From DB
	*/
	public function retrieve_chapter_list(){
	
		$this->db->select('a.*,b.course_name,c.class_name');
		$this->db->from('course_chapter_add a');
		$this->db->join('course_add b', 'b.course_id = a.course_id');
		$this->db->join('class_add c', 'c.class_id = b.class_id');
		$this->db->where(array('b.status'=>1,'c.status'=>1)); 
		$this->db->where('a.status !=',2); 
		$this->db->order_by('a.chapter_id','desc'); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	/*
	** Retrieve Class List From DB
	*/
	public function retrieve_class_list(){
	
		$this->db->select('*');
		$this->db->from('class_add');
		$this->db->where('status',1); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	/*
	** Retrieve Course  By Class Wise Using Ajax retrieve_course_list
	*/
	public function retrieve_course($class_id){
	
		$this->db->select('course_id,course_name');
		$this->db->from('course_add');
		$this->db->where(array('class_id'=>$class_id,'status'=>1)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	/*
	** Inset Class Name To DB
	*/
	function insert_chapter($data)
	{ 
		$this->db->insert('course_chapter_add',$data);
        return true;
	}
	/*
	** Retrieve Course List From DB
	*/
	public function retrieve_course_list($class_id){
	
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where(array('status'=>1,'class_id'=>$class_id)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	/*
	** Retrieve Data for Update
	*/
	public function retrieve_chapter_editdata($chapter_id){

		$this->db->select('a.*,b.course_name,c.*');
		$this->db->from('course_chapter_add a');
		$this->db->join('course_add b', 'b.course_id = a.course_id');
		$this->db->join('class_add c', 'c.class_id = b.class_id');
		$this->db->where('a.chapter_id',$chapter_id); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	/*
	** Update Course
	*/
	public function update_chapter($chapter_id,$data){	
		$this->db->where('chapter_id',$chapter_id);
		$this->db->update('course_chapter_add',$data); 
		return true;
	}
	//Change Chapter Name status
	public function change_chapterName_status($chapter_id)
	{
		$this->db->select('status');
		$this->db->from('course_chapter_add');
		$this->db->where('chapter_id',$chapter_id); 
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$status = $row->status ;
			}
		}
		if($status==1){
			$status=0;
		}else if($status==0){
			$status=1;
		}
		$data=array(
			'status' 		=>$status
		);
		$this->db->where('chapter_id',$chapter_id);
		$this->db->update('course_chapter_add',$data); 
		return $status ;
	}
	
	public function retrieve_requested_chapter_list()
	{
		$this->db->select('a.*,b.course_name,c.class_name');
		$this->db->from('course_chapter_add a');
		$this->db->join('course_add b', 'b.course_id = a.course_id');
		$this->db->join('class_add c', 'c.class_id = b.class_id');
		$this->db->where(array('b.status'=>1,'c.status'=>1,'a.status'=>2)); 
		$this->db->order_by('a.chapter_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function approve_requested_chapter( $chapter_id )
	{
		$data=array(
			'status' 		=>1
		);
		$this->db->where('chapter_id',$chapter_id);
		$this->db->update('course_chapter_add',$data); 
		return true ;
	}
	
	public function delete_requested_chapter( $chapter_id )
	{
		$this->db->where('chapter_id',$chapter_id);
		$this->db->delete('course_chapter_add'); 
		return true ;
	}
}