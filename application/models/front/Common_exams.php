<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Common_exams extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Get Favicon
	public function get_favicon(){
		return $query = $this->db->select('favicon')
						->from('setting')
						->get()
						->result_array();
	}
	//Retrieve course list For front view home page
	public function count_course_list()
	{
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('status',1);
		return $query = $this->db->get()->num_rows();
	}
	//Retrieve course list For front view home page
	public function retrieve_course_list_for_limit($limit,$page,$links)
	{
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('status',1);
		$this->db->order_by('course_id','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrieve course list For front view home page
	public function retrieve_course_list()
	{
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('status',1);
		$this->db->order_by('course_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrieve course list by randomly
	public function retrieve_course_list_by_random()
	{
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('status',1);
		$this->db->order_by('course_id', 'RANDOM');
    	$this->db->limit(4);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrieve course by id
	public function retrieve_course_list_by_id($course_id)
	{
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('status',1);
		$this->db->where('course_id',$course_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrieve course list For front view home page
	public function search_course_list( $limit,$page,$search_key )
	{
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('status',1);
		$this->db->like('course_name',$search_key,'both'); 
		$this->db->order_by('course_id','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrieve course list For front view home page
	public function count_course_search_list( $search_key )
	{
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('status',1);
		$this->db->like('course_name',$search_key,'both');
		return $query = $this->db->get()->num_rows();
	}
	//Retrieve Popular course list For front view home page
	public function retrieve_popular_course()
	{
		$this->db->select('a.*');
		$this->db->from('course_add a');
		$this->db->join('find_popular_course b','b.course_id = a.course_id');
		$this->db->where(array('a.status'=>1));
		$this->db->order_by('b.total_exam','desc');
		$this->db->limit(5);
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//Retrieve Newly Added course list For front view home page
	public function retrieve_newly_added_course()
	{
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where(array('is_new'=>1,'status'=>1));
		$this->db->order_by('course_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Get Question count
	public function get_chapters_question_count( $course_id )
	{
		$this->db->select('a.*,a.chapter_name,b.*,c.*');
		$this->db->from('course_chapter_add a');
		$this->db->join('course_add b','b.course_id=a.course_id');
		$this->db->join('course_question_relation c','c.course_chapter_id=a.course_id');
		$this->db->where(array('a.status'=>1,'a.course_id'=>$course_id,'a.course_id'=>$course_id));
		return $query = $this->db->get()->num_rows();
	}

	//Retrieve Chapter list For front view home page
	public function get_chapters( $course_id )
	{
		$query = $this->db->select("
				course_chapter_add.*,
				course_add.course_name,
				course_question_relation.*,
				count(course_question_relation.question_id) as total_question
			")
			->from("course_chapter_add")
			->join('course_add','course_add.course_id=course_chapter_add.course_id')
			->join('course_question_relation', 'course_question_relation.course_chapter_id = course_chapter_add.chapter_id', 'left')
			->where('course_chapter_add.course_id', $course_id )
			->group_by('course_chapter_add.chapter_id')
			->order_by('course_chapter_add.chapter_id', 'asc')
			->get();

			if ($query->num_rows() > 0) {
				return $query->result_array();	
			}
			return false;
	}

	public function total_exam_unique_subject( $course_id )
	{
		$this->db->select('*');
		$this->db->from('find_popular_course');
		$this->db->where(array('status'=>1,'course_id'=>$course_id));
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
		
			$this->db->where(array('status'=>1,'course_id'=>$course_id));
			$this->db->set('total_exam', 'total_exam+1', FALSE);
			$this->db->update('find_popular_course');
			
		}else{
		
			$this->db->insert( 'find_popular_course',array('course_id'=>$course_id,'total_exam'=>1,'status'=>1) );
			$exam_id =  $this->db->insert_id();
		}
		return True;
	}
	
	//Insert Exam Head Info
	function insert_exam_head_info( $data )
	{ 	
		$this->db->insert( 'exam_head',$data );
		$exam_id =  $this->db->insert_id();
        return $exam_id;
	}
	
	//Retrieve computer Generated Question Bank
	public function computer_generated_question_set( $chapter_ids,$qstn_limit )
	{
		$this->db->select('a.question_id');
		$this->db->from('question_head a');
		$this->db->join('course_question_relation b','b.question_id = a.question_id');
		$this->db->join('course_chapter_add c','c.chapter_id = b.course_chapter_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1));
		$this->db->where_in('c.chapter_id',$chapter_ids);
		$this->db->order_by('a.question_id','RANDOM');
		$this->db->limit($qstn_limit);
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	//Insert exam Name 
	function insert_exam_details_data( $data1 )
	{ 	
		$this->db->insert('exam_details',$data1);
        return true;
	}
	function get_single_course_name( $course_id )
	{ 	
		$this->db->select('course_name');
		$this->db->from('course_add');
		$this->db->where('course_id',$course_id);
		$query = $this->db->get();	
		return $query->result_array();	
	}
	
	public function get_exam_question_data( $exam_id )
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('*');
		$this->db->from('user_exam_result_details');
		$this->db->where(array('exam_id'=>$exam_id,'user_id'=>$user_id));
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
		$this->db->from('user_exam_result');
		$this->db->where(array('exam_id'=>$exam_id,'user_id'=>$user_id));
		$query = $this->db->get();			
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_questions_and_options( $question_id )
	{
		$this->db->select('a.question_id,a.question_detals,,a.answer_type,b.question_option_id,b.option_details');
		$this->db->from('question_head a');
		$this->db->join('question_options b','b.question_id = a.question_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1,'a.question_id'=>$question_id));
		$query = $this->db->get();			
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//THID FUNCTION RETURN ANSER SHEET.THIS ANSWER SHEET RETIEVE BY QUESION IDS
	public function get_questions_answer_sheet( $question_ids )
	{
		$this->db->select('question_id,answer_option_id');
		$this->db->from('answer_sheet');
		$this->db->where_in('question_id',$question_ids);
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
	//Insert exam result 
	function insert_exam_result_data( $data )
	{ 	
		$this->db->insert('user_exam_result',$data);
        return true;
	}
	//Insert exam result Details
	function insert_exam_result_details( $data )
	{ 	
		$this->db->insert('user_exam_result_details',$data);
        return true;
	}
	//UPDATE SCHEDULE EXAM TABLE
	function update_schedule_exam_table( $exam_id,$data )
	{ 	
		$student_id = $this->session->userdata('user_id');
		
		$this->db->where(array('student_id'=>$student_id,'exam_id'=>$exam_id,'status'=>1));
		$this->db->update('exam_notifications',$data);
        return true;
	}
	//Retrieve Course name
	function get_course_name( $course_id )
	{ 	
		$this->db->select('course_name');
		$this->db->from('course_add');
		$this->db->where('course_id',$course_id );
		$query = $this->db->get();					
		if ($query->num_rows() > 0) {
			$course_name = $query->result_array();
			return $course_name[0]['course_name'];
		}
		return false;
	}	
	//Retrieve Chapter Ids
	function get_chapter_ids( $exam_id )
	{ 	
		$this->db->select('*');
		$this->db->from('exam_head');
		$this->db->where('exam_id',$exam_id );
		$query = $this->db->get();					
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Retrieve Chapter Names
	function get_chapter_names( $chapter_ids )
	{ 	
		$this->db->select('chapter_name');
		$this->db->from('course_chapter_add');
		$this->db->where_in('chapter_id',$chapter_ids);
		$query = $this->db->get();					
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Retrieve Chapter Names
	function entry_exam_result( $data )
	{ 	
		$this->db->insert('user_exam_result',$data);
        return true;
	}
	//Retrieve User Answered
	function get_user_answered_result( $exam_id )
	{ 	
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('answers_id');
		$this->db->from('user_exam_result_details');
		$this->db->where(array('user_id'=>$user_id,'exam_id'=>$exam_id));
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
	//RETRIEVE SCHEDULE EXAM DATA
	function get_tutor_provided_exam_data( $exam_id )
	{ 	
		$this->db->select('a.course_id,a.number_of_question,b.question_ids,c.course_name');
		$this->db->from('exam_head a');
		$this->db->join('exam_details b','b.exam_id = a.exam_id');
		$this->db->join('course_add c','c.course_id = a.course_id');
		$this->db->where(array('a.exam_id'=>$exam_id,'a.status'=>1,'b.status'=>1));
		$query = $this->db->get();	
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//RETRIEVE TOP ADD
	function get_top_add()
	{
		$this->db->select('*');
		$this->db->from('advertisement');
		$this->db->where('add_status','1');
		$this->db->where('add_position','Top Ads');
		$this->db->order_by('add_id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//RETRIEVE SIDEBAR ADD
	function get_sidebar_add()
	{
		$this->db->select('*');
		$this->db->from('advertisement');
		$this->db->where('add_status','1');
		$this->db->where('add_position','Left Ads');
		$this->db->order_by('add_id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
	//Get Web Setting
	function get_web_setting()
	{
		$this->db->select('*');
		$this->db->from('setting');
		$this->db->where('id','1');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}
}