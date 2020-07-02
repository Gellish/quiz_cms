<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Exams extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Retrieve Chapter Name
	public function count_total_exams_items($tutor_id)
	{
		$this->db->select('exam_id,exam_name,number_of_question,generated_procedure');
		$this->db->from('exam_head');
		$this->db->where('tutor_id',$tutor_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->num_rows();
	}//Retrieve Chapter Name
	public function retrieve_exam_list($tutor_id)
	{
		$this->db->select('exam_id,exam_name,number_of_question,generated_procedure');
		$this->db->from('exam_head');
		$this->db->where('tutor_id',$tutor_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result_array();
	}
	//Retrieve Chapter List
	public function retrieve_chapter_name($course_id)
	{
		$this->db->select('chapter_id,chapter_name');
		$this->db->from('course_chapter_add');
		$this->db->where('course_id',$course_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	//Retrieve computer Generated Question Bank
	public function computer_generated_question_bank($chapter_ids,$qstn_limit)
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
	//Retrieve My Question Bank Randomly
	public function my_question_bank_randomly($chapter_ids,$question_limit)
	{
		$tutor_id =  $this->session->userdata('user_id');
		
		$this->db->select('a.question_id');
		$this->db->from('question_head a');
		$this->db->join('course_question_relation b','b.question_id = a.question_id');
		$this->db->join('course_chapter_add c','c.chapter_id = b.course_chapter_id');
		$this->db->join('question_creator_relation d', 'd.question_id = a.question_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1,'d.creator_id'=>$tutor_id));
		$this->db->where_in('c.chapter_id',$chapter_ids);
		$this->db->order_by('a.question_id','RANDOM');
		$query = $this->db->get();		
		if ($query->num_rows() <= $question_limit) {
			return $query->result_array();	
		}else{
			$question_ids = array_slice($query->result_array(),0,$question_limit);
			return $question_ids;
		}
	}
	//Retrieve My Question Bank Sequencially
	public function my_question_bank_sequentially($chapter_ids,$question_limit)
	{
		$tutor_id =  $this->session->userdata('user_id');
		
		$this->db->select('a.question_id');
		$this->db->from('question_head a');
		$this->db->join('course_question_relation b','b.question_id = a.question_id');
		$this->db->join('course_chapter_add c','c.chapter_id = b.course_chapter_id');
		$this->db->join('question_creator_relation d', 'd.question_id = a.question_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1,'d.creator_id'=>$tutor_id));
		$this->db->where_in('c.chapter_id',$chapter_ids);
		$this->db->order_by('a.question_id','ASC');
		$query = $this->db->get();
		if ($query->num_rows() <= $question_limit) {
			return $query->result_array();
		}else{
			$question_ids = array_slice($query->result_array(),0,$question_limit);
			return $question_ids;
		}

	}
	//Retrieve My Question Bank Randomly
	public function chooseQuestion_fromQuestion_bank($chapter_ids,$starts,$items)
	{
		$tutor_id =  $this->session->userdata('user_id');
		
		$this->db->select('a.question_id,a.question_detals');
		$this->db->from('question_head a');
		$this->db->join('course_question_relation b','b.question_id = a.question_id');
		$this->db->join('course_chapter_add c','c.chapter_id = b.course_chapter_id');
		$this->db->where(array('a.status'=>1,'b.status'=>1));
		$this->db->where_in('c.chapter_id',$chapter_ids);
		$this->db->order_by('a.question_id','asc');
		$this->db->limit($items,$starts);
		$query = $this->db->get();		
		return $query->result_array();
		
	}
	//Insert exam Name 
	function insert_exam_head_data($data)
	{ 	
		$this->db->insert('exam_head',$data);
		$exam_id =  $this->db->insert_id();
        return $exam_id;
	}
	//Insert exam Name 
	function insert_exam_details_data($data1)
	{ 	
		$this->db->insert('exam_details',$data1);
        return true;
	}
	//Change exam Name Status
	public function delete_exam_name($exam_id)
	{
		//Delete Head Table
		$data = array(
				'status' => 0
			);
		$this->db->where('exam_id',$exam_id);
		$this->db->update('exam_head',$data); 
		//Delete Details Table
		$this->db->where('exam_id',$exam_id);
		$this->db->update('exam_details',$data); 
		return true ;
	}
	//Change exam Name Status
	public function return_to_active_mode($exam_id)
	{
		//Delete Head Table
		$data = array(
				'status' => 1
			);
		$this->db->where('exam_id',$exam_id);
		$this->db->update('exam_head',$data); 
		//Delete Details Table
		$this->db->where('exam_id',$exam_id);
		$this->db->update('exam_details',$data); 
		return true ;
	}
	// Retrieve  Deleted Exam List
	public function deleted_exam_list($tutor_id)
	{
		$this->db->select('exam_id,exam_name,number_of_question,generated_procedure');
		$this->db->from('exam_head');
		$this->db->where('tutor_id',$tutor_id);
		$this->db->where('status',0);
		$query = $this->db->get();
		return $query->result_array();
	}
	// Count Assign Exam List for Create Paginition
	public function count_assign_exam_list()
	{	
		$tutor_id = $this->session->userdata('user_id');
		$this->db->select('a.batch_name,b.batch_assign_id,c.exam_name');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_exam b','b.batch_id = a.batch_id');
		$this->db->join('exam_head c','c.exam_id = b.exam_id');
		$this->db->where('a.tutor_id',$tutor_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		return $query->num_rows();
	}
	// retrieve Assign Exam List
	public function retrieve_assign_exam_list($tutor_id)
	{
		$this->db->select('a.batch_id,a.batch_name,b.batch_assign_id,c.exam_name,c.exam_id');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_exam b','b.batch_id = a.batch_id');
		$this->db->join('exam_head c','c.exam_id = b.exam_id');
		$this->db->where('a.tutor_id',$tutor_id);
		$this->db->where('a.status',1);
		$query = $this->db->get();
		return $query->result_array();
	}

	// Retrieve Batch List
	public function retrieve_batch_list($tutor_id)
	{
		$this->db->select('batch_id,batch_name');
		$this->db->from('tutor_batch');
		$this->db->where('tutor_id',$tutor_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result_array();
	}
	// Retrieve Exam List
	public function retrieve_exam_items($tutor_id)
	{
		$this->db->select('exam_id,exam_name');
		$this->db->from('exam_head');
		$this->db->where('tutor_id',$tutor_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result_array();
	}
	//assign_submit
	public function assign_submit($data)
	{
		$this->db->insert('tutor_batch_exam',$data);
        return true;
	}
	// Retrieve All Student IDs
	public function get_all_batch_student( $batch_id )
	{
		$this->db->select('student_ids');
		$this->db->from('tutor_batch_details');
		$this->db->where('batch_id',$batch_id);
		$query = $this->db->get();
		return $query->result_array();
	}
		//Notify to student
	public function entry_notify_student_data($data)
	{
		$this->db->insert_batch('exam_notifications',$data);
        return true;
	}
	// Get all student Email Ids
	public function get_student_email_id($student_ids)
	{
		$this->db->select('email');
		$this->db->from('client_user_login');
		$this->db->where_in('user_id',$student_ids);
		$this->db->where('status',1);
        $query = $this->db->get();
		return $query->result_array();
	}
	
	// retrieve_batch_assign_data
	public function retrieve_batch_assign_data($batch_assign_id)
	{
		$this->db->select('a.batch_id,a.batch_name,b.batch_assign_id,c.exam_id,c.exam_name');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_exam b','b.batch_id = a.batch_id');
		$this->db->join('exam_head c','c.exam_id = b.exam_id');
		$this->db->where(array('b.batch_assign_id'=>$batch_assign_id,'a.status'=>1));
		$query = $this->db->get();
		return $query->result_array();
	}
	// Assign_exam Update
	public function assign_submit_update($batch_assign_id,$data)
	{
		$this->db->where('batch_assign_id',$batch_assign_id);
		$this->db->update('tutor_batch_exam',$data); 
		return true ;
	}
	// Assign_exam Update
	public function exam_assign_batch_delete($batch_assign_id)
	{
		$this->db->where('batch_assign_id',$batch_assign_id);
		$this->db->delete('tutor_batch_exam'); 
		return true ;
	}
	
	// Retrieve all student from a batch
	public function retrieve_batch_student( $batch_id )
	{
		$tutor_id =  $this->session->userdata('user_id');
	
		$this->db->select('b.*');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_details b','b.batch_id = a.batch_id');
		$this->db->where(array('a.tutor_id'=>$tutor_id,'a.batch_id'=>$batch_id));
		$query = $this->db->get();
		return $query->result_array();
	}
	// Retrieve Assign Exam Student Result
	public function retrieve_assign_exam_result( $all_student,$exam_id )
	{
		$tutor_id =  $this->session->userdata('user_id');
	
		$this->db->select('a.*,b.user_name,b.mobile_no,c.course_name,d.exam_name');
		$this->db->from('user_exam_result a');
		$this->db->join('users b','b.user_id = a.user_id');
		$this->db->join('course_add c','c.course_id = a.course_id');
		$this->db->join('exam_head d','d.exam_id = a.exam_id');
		$this->db->where(array('a.exam_id'=>$exam_id,'a.status'=>1));
		$this->db->where_in('a.user_id',$all_student);
		$query = $this->db->get();
		return $query->result_array();		
	}

	public function retrieve_exam_data( $student_id,$exam_id )
	{
		$tutor_id =  $this->session->userdata('user_id');
	
		$this->db->select('*');
		$this->db->from('user_exam_result_details');
		$this->db->where(array('exam_id'=>$exam_id,'user_id'=>$student_id));
		$query = $this->db->get();
		return $query->result_array();		
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
	
	public function retrieve_original_question_answer( $question_id )
	{
		$this->db->select('b.question_id,b.question_detals,c.option_details');
		$this->db->from('answer_sheet a');
		$this->db->join('question_head b','b.question_id = a.question_id');
		$this->db->join('question_options c','c.question_option_id = a.answer_option_id');
		$this->db->where(array('a.question_id'=>$question_id,'b.status'=>1));
		$query = $this->db->get();

		return $query->result_array();		
	}	
	
	public function retrieve_student_question_answer( $option_ids )
	{
		$this->db->select('option_details');
		$this->db->from('question_options');
		$this->db->where('status',1);
		$this->db->where_in('question_option_id',$option_ids);
		$query = $this->db->get();
		return $query->result_array();		
	}	
	public function retrieve_student_info( $student_id )
	{
		$this->db->select('a.*');
		$this->db->from('users a');
		$this->db->join('client_user_login b','b.user_id = a.user_id');
		$this->db->where(array('a.user_id'=>$student_id,'b.status'=>1));
		$query = $this->db->get();
		return $query->result_array();		
	}
}