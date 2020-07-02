<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Model_tests extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//Count model test
	public function count_model_list()
	{
		$this->db->select('a.*,b.class_name');
		$this->db->from('model_test_settings a');
		$this->db->join('class_add b','b.class_id = a.class_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1)); 
		$this->db->order_by('a.model_test_id','desc'); 
		return $query = $this->db->get()->num_rows();
	}
	//Retrive all model test
	public function retrieve_model_all_test_limit($page,$limit)
	{
		$this->db->select('a.*,b.class_name');
		$this->db->from('model_test_settings a');
		$this->db->join('class_add b','b.class_id = a.class_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1)); 
		$this->db->limit($limit,$page);
		$this->db->order_by('a.model_test_id','desc'); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	public function retrieve_model_all_test()
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

	//Retrieve model list by randomly
	public function retrieve_model_list_by_random()
	{
		$this->db->select('*');
		$this->db->from('model_test_settings');
		$this->db->where('status',1);
		$this->db->order_by('model_test_id', 'RANDOM');
    	$this->db->limit(4);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function retrieve_model_test_details( $model_test_id )
	{
		$this->db->select('a.*,b.class_name');
		$this->db->from('model_test_settings a');
		$this->db->join('class_add b','b.class_id = a.class_id');
		$this->db->where(array('a.status'=>1,'a.model_test_id'=> $model_test_id,'b.status'=>1)); 
		$this->db->order_by('a.model_test_id','desc'); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
		
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
	
	//Retrieve computer Generated Question Bank
	public function computer_generated_question_set( $course_id,$noOfQuestion )
	{
		$this->db->select('a.question_id');
		$this->db->from('question_head a');
		$this->db->join('course_question_relation b','b.question_id = a.question_id');
		$this->db->join('course_chapter_add c','c.chapter_id = b.course_chapter_id');
		$this->db->join('course_add d','d.course_id = c.course_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1));
		$this->db->where('d.course_id',$course_id);
		$this->db->order_by('a.question_id','RANDOM');
		$this->db->limit($noOfQuestion);
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	//Insert model test Head Info
	function insert_model_test_head_info( $data )
	{ 	
		$this->db->insert( 'model_test_head',$data );
		$exam_id =  $this->db->insert_id();
        return $exam_id;
	}
	
	//Insert Model test details
	function insert_model_test_details_data( $data1 )
	{ 	
		$this->db->insert('model_test_details',$data1);
        return true;
	}
	
 	function get_model_test_data( $model_test_sett_id )
	{ 	
		$this->db->select('model_test_name,duration');
		$this->db->from('model_test_settings');
		$this->db->where('model_test_id',$model_test_sett_id);
		$query = $this->db->get();	
		return $query->result_array();	
	}
	
	 
	//Insert exam result Details
	function insert_model_test_result_details( $data )
	{ 	
		$this->db->insert('model_test_result_details',$data);
        return true;
	}
		//Retrieve Chapter Names
	function entry_model_test_result( $data )
	{ 	
		$this->db->insert('model_test_result',$data);
        return true;
	}
	
	public function get_exam_question_data( $exam_id )
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('*');
		$this->db->from('model_test_result_details');
		$this->db->where(array('model_test_id'=>$exam_id,'user_id'=>$user_id));
		$query = $this->db->get();			
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_exam_result_data( $exam_id )
	{
		$user_id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('model_test_result');
		$this->db->where(array('model_test_id'=>$exam_id,'user_id'=>$user_id));
		$query = $this->db->get();			
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrieve Course name
	function get_model_test_name( $model_test_id )
	{ 	
		$this->db->select('model_test_name');
		$this->db->from('model_test_settings');
		$this->db->where('model_test_id',$model_test_id );
		$query = $this->db->get();					
		if ($query->num_rows() > 0) {
			$model_test_name = $query->result_array();
			return $model_test_name[0]['model_test_name'];
		}
		return false;
	}	
	
	//Retrieve Chapter Ids
	function get_subjects_ids( $exam_id )
	{ 	
		$this->db->select('*');
		$this->db->from('model_test_head');
		$this->db->where('model_test_id',$exam_id );
		$query = $this->db->get();					
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Retrieve Chapter Names
	function get_subject_names( $subject_ids )
	{ 	
		$this->db->select('course_name');
		$this->db->from('course_add');
		$this->db->where_in('course_id',$subject_ids);
		$query = $this->db->get();					
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	
	public function get_question_single_answer_sheet( $question_id )
	{
		$this->db->select('question_id,answer_option_id');
		$this->db->from('answer_sheet');
		$this->db->where('question_id',$question_id );
		$query = $this->db->get();					
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}	
	
	//Retrieve User Answered
	function get_user_answered_result( $exam_id )
	{ 	
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('answers_ids');
		$this->db->from('model_test_result_details');
		$this->db->where(array('user_id'=>$user_id,'model_test_id'=>$exam_id));
		$query = $this->db->get();					
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	
	
	public function get_questions_and_options( $question_id )
	{
		$this->db->select('a.question_id,a.question_detals,a.answer_type,b.question_option_id,b.option_details');
		$this->db->from('question_head a');
		$this->db->join('question_options b','b.question_id = a.question_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1,'a.question_id'=>$question_id));
		$query = $this->db->get();			
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//RETRIEVE USER WRONG_ANSWER
	function get_user_selected_wrong_answer( $answered_option_ids )
	{ 	
		$this->db->select('option_details');
		$this->db->from('question_options');
		$this->db->where_in('question_option_id',$answered_option_ids);
		$query = $this->db->get();					
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	
}