<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Request extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	// Count ChapterList 
	public function count_chapter_list(){
		$CI =& get_instance();
		$tutor_id =  $CI->session->userdata('user_id');
		
		$this->db->select('a.*,b.course_name,c.class_name');
		$this->db->from('course_chapter_add a');
		$this->db->join('course_add b', 'b.course_id = a.course_id');
		$this->db->join('class_add c', 'c.class_id = b.class_id');
		$this->db->join('operator_permission d', 'd.course_id = b.course_id');
		$this->db->join('client_user_login e', 'e.user_id = d.operator_id');
		$this->db->where(array('b.status'=>1,'c.status'=>1,'e.status'=>1,'e.user_id'=>$tutor_id,'e.user_type'=>'tutor')); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}
	// Retrieve Course List From DB
	public function retrieve_chapter_list($limit,$page)
	{
		$CI =& get_instance();
		$tutor_id =  $CI->session->userdata('user_id');
		
		$this->db->select('a.*,b.course_name,c.class_name');
		$this->db->from('course_chapter_add a');
		$this->db->join('course_add b', 'b.course_id = a.course_id');
		$this->db->join('class_add c', 'c.class_id = b.class_id');
		$this->db->join('operator_permission d', 'd.course_id = b.course_id');
		$this->db->join('client_user_login e', 'e.user_id = d.operator_id');
		$this->db->where(array('b.status'=>1,'c.status'=>1,'e.status'=>1,'e.user_id'=>$tutor_id,'e.user_type'=>'tutor')); 
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Retrieve Assign Course
	public function retrieve_all_class(){
		$CI =& get_instance();
		
		$this->db->select('*');
		$this->db->from('class_add');
		$this->db->where('status',1); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Inset chapter Name To DB
	function insert_class_request($data)
	{ 
		$this->db->insert('class_add',$data);
        return true;
	}
	//Inset Course Request Name To DB
	function insert_course_request($data)
	{ 
		$this->db->insert('course_add',$data);
        return true;
	}

	function insert_chapter_request($data)
	{ 
		$this->db->insert('course_chapter_add',$data);
        return true;
	}
	// Retrieve Data for Update



}