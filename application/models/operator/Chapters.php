<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chapters extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	// Count Chapter List For paginition
	public function count_chapter_list()
	{
		$CI =& get_instance();
		$operator_id =  $CI->session->userdata('user_id');

		$this->db->select('a.*,b.course_name,c.class_name');
		$this->db->from('course_chapter_add a');

		$this->db->join('course_add b', 'b.course_id = a.course_id');

		$this->db->join('class_add c', 'c.class_id = b.class_id');

		$this->db->join('operator_permission d', 'd.course_id = b.course_id');

		$this->db->join('client_user_login e', 'e.user_id = d.operator_id');

		$this->db->where(array('b.status'=>1,'c.status'=>1,'e.status'=>1,'e.user_id'=>$operator_id,'e.user_type'=>'operator')); 

		$query = $this->db->get();
	
		return $query->num_rows();
	}
	//Retrieve Course List From DB 

	public function retrieve_chapter_list()
	{
		$CI =& get_instance();
		$operator_id =  $CI->session->userdata('user_id');
		
		$this->db->select('a.*,b.course_name,c.class_name');
		$this->db->from('course_chapter_add a');
		$this->db->join('course_add b', 'b.course_id = a.course_id');
		$this->db->join('class_add c', 'c.class_id = b.class_id');
		$this->db->join('operator_permission d', 'd.course_id = b.course_id');
		$this->db->join('client_user_login e', 'e.user_id = d.operator_id');
		$this->db->where(array('b.status'=>1,'c.status'=>1,'e.status'=>1,'e.user_id'=>$operator_id,'e.user_type'=>'operator')); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrieve Class List From DB
	
	public function retrieve_class_list()
	{
		$this->db->select('*');
		$this->db->from('class_add');
		$this->db->where('status',1); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Retrieve Assign Course

	public function retrieve_assign_course()
	{
		$CI =& get_instance();
		$operator_id =  $CI->session->userdata('user_id');

		$this->db->select('a.course_id,a.course_name');
		$this->db->from('course_add a');
		$this->db->join('operator_permission b', 'b.course_id = a.course_id');
		$this->db->where('a.status',1); 
		$this->db->where('b.operator_id',$operator_id ); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Inset chapter Name To DB
	function insert_chapter($data)
	{ 
		$this->db->insert('course_chapter_add',$data);
        return true;
	}
	// Retrieve Data for Update
	
	public function retrieve_chapter_editdata($chapter_id)
	{
	
		$this->db->select('a.*,b.course_id,b.course_name,c.class_id,c.class_name');
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
	//Update Course
	public function update_chapter($chapter_id,$data)
	{	
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

}