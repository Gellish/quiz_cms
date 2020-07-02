<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_tests extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	// Count all model test to Create Paginiton
	public function count_all_model_test()
	{
	
		$this->db->select('a.*,b.class_name');
		$this->db->from('model_test_settings a');
		$this->db->join('class_add b', 'b.class_id = a.class_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}
	// Retrieve All Model Test

	public function retrieve_model_test_list()
	{
	
		$this->db->select('a.*,b.class_name');
		$this->db->from('model_test_settings a');
		$this->db->join('class_add b','b.class_id = a.class_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1)); 
		$this->db->order_by('a.model_test_id','desc'); 
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
	//Retrive course list
	public function retrieve_course($class_id)
	{
		$query=$this->db->select('
					course_add.course_name,
					course_add.course_id,
					count(course_question_relation.question_id) as total_question
					')
				->from('course_add')
				->join('course_chapter_add','course_add.course_id = course_chapter_add.course_id','left')
				->join('course_question_relation','course_question_relation.course_chapter_id = course_chapter_add.chapter_id','left')
				->where(array('course_add.class_id'=>$class_id,'course_add.status'=>1))
				->group_by('course_add.course_id')
				->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	//insert model test
	function insert_model_test($data)
	{ 
		$this->db->insert('model_test_settings',$data);
        return true;
	}
	
	public function retrieve_model_test_editdata($model_test_id)
	{
		$this->db->select('a.*,b.class_name');
		$this->db->from('model_test_settings a');
		$this->db->join('class_add b','b.class_id = a.class_id');
		$this->db->where(array('a.status'=>1,'a.model_test_id'=>$model_test_id,'b.status'=>1)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}	
	//Retrive class name
	public function retrieve_class_name($subject_id)
	{
		$this->db->select('course_name');
		$this->db->from('course_add');
		$this->db->where(array('status'=>1,'course_id'=>$subject_id)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Update Course
	public function update_model_test($model_test_id,$data)
	{	
		$this->db->where('model_test_id',$model_test_id);
		$this->db->update('model_test_settings',$data); 
		return true;
	}
	
	//Delete Model Test
	public function do_delete_model_test($model_test_id)
	{
		$this->db->where('model_test_id',$model_test_id); 
		$this->db->delete('model_test_settings'); 
		return true ;
	}
}