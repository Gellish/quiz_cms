<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Questions extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	// Retrieve Counr Question List 
	public function count_question_list(){
	
		$this->db->select('a.*,c.chapter_name,d.course_name,e.class_name');
		$this->db->from('question_head a');
		$this->db->join('course_question_relation b', 'b.question_id = a.question_id');
		$this->db->join('course_chapter_add c', 'c.chapter_id = b.course_chapter_id');
		$this->db->join('course_add d', 'd.course_id = c.course_id');
		$this->db->join('class_add e', 'e.class_id = d.class_id');
		$this->db->where(array('c.status'=>1,'d.status'=>1,'e.status'=>1)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}
	// Retrieve Question List From DB
	public function retrieve_question_list($limit,$page){
	
		$this->db->select('a.*,c.chapter_name,d.course_name,e.class_name');
		$this->db->from('question_head a');
		$this->db->join('course_question_relation b', 'b.question_id = a.question_id');
		$this->db->join('course_chapter_add c', 'c.chapter_id = b.course_chapter_id');
		$this->db->join('course_add d', 'd.course_id = c.course_id');
		$this->db->join('class_add e', 'e.class_id = d.class_id');
		$this->db->where(array('c.status'=>1,'d.status'=>1,'e.status'=>1)); 
		$this->db->order_by('a.question_id','desc'); 
		$this->db->limit($limit,$page); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrive question by id
	public function retrieve_question_by_id($class_id,$chapter_id){

	 	$this->db->select('course_question_relation.*,question_head.*,course_chapter_add.*,course_add.*,class_add.*')
		    ->from('course_question_relation')
		    ->join('question_head', 'course_question_relation.question_id = question_head.question_id')
		    ->join('course_chapter_add', 'course_chapter_add.chapter_id = course_question_relation.course_chapter_id')
			->join('course_add', 'course_add.course_id = course_chapter_add.course_id')
			->join('class_add', 'class_add.class_id = course_add.class_id')
			->where('course_question_relation.course_chapter_id',$chapter_id);
	    $query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Retrieve Class List From DB
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

	// Retrieve Class List From DB
	public function retrieve_all_course_list(){
	
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('status',1); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	// Retrieve Course List From DB by id
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
	// Retrieve Chapter List From DB
	public function retrieve_chapter_list($course_id){
	
		$this->db->select('*');
		$this->db->from('course_chapter_add');
		$this->db->where(array('status'=>1,'course_id'=>$course_id)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Retrieve Course  By Class Wise Using Ajax
	public function retrieve_course($course_id)
	{
		$this->db->select('chapter_id,chapter_name');
		$this->db->from('course_chapter_add');
		$this->db->where(array('course_id'=>$course_id,'status'=>1)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	// Insert Class Name To DB
	function question_and_option_entry()
	{ 
		//Entry Question Details 
	 	$chapter_id = $this->input->post('chapter_id');
		
		$data=array(
			'question_id' 		=> null,
			'question_detals' 	=> strip_tags($this->input->post('questionName'),'<p><a>'),
			'language' 			=> $this->input->post('language'),
			'question_image' 	=> '',
			'answer_type' 		=> $this->input->post('answerType'),
			'status' 			=> 1
		);
				
		$this->db->insert('question_head',$data);
        $question_id =  $this->db->insert_id();
		
		//Course and Question relation table
		$items=array(
			'question_id' 			=> $question_id,
			'course_chapter_id' 	=> $chapter_id,
			'status' 				=> 1
		);
		$this->db->insert('course_question_relation',$items);
		
		//Insert to Question and creator relation table
		$relation_data = array(
			'relation_id' 		=> null,
			'creator_id' 		=> $this->session->userdata('user_id'),
			'question_id' 		=> $question_id,
			'entry_ip' 			=> '',
			'time_info' 		=> $this->input->post('answerType'),
			'status' 			=> 1
		);
		
		$this->db->insert('question_creator_relation',$relation_data);
		
		//Insert question option
		$true_answer = $this->input->post('is_answer');
		$ques_option = $this->input->post('ques_option'); 
		

		for ($i=0, $n=count($ques_option); $i < $n; $i++) {
			//$is_answer = $true_answer[$i];
			$option = $ques_option[$i];
			
			if($option !=''){	
				$data=array(
					'question_option_id'=> null,
					'question_id' 	 	=> $question_id,
					'option_details' 	=> htmlspecialchars($option),
					'language' 			=> $this->input->post('language'),
					'option_image' 		=> '',
					'status' 			=> 1
				);
			
				$this->db->insert('question_options',$data);
				$option_id = $this->db->insert_id();
			
				foreach($true_answer  as $value){
					if($i == $value){
					$data2 = array(
						'answer_id'			=> null,
						'question_id' 	 	=> $question_id,
						'answer_option_id' 	=> $option_id,
						'partial_answer' 	=> ''
					);
					
					$this->db->insert('answer_sheet',$data2); 
					}
				}
			}
		}
      return true;
	}
	
	// Retrieve Data for Update
	public function retrieve_question_editdata($question_id){
	
		$this->db->select('a.*,c.chapter_id,c.chapter_name,d.course_id,d.course_name,e.class_name,e.class_id');
		$this->db->from('question_head a');
		$this->db->join('course_question_relation b', 'b.question_id = a.question_id');
		$this->db->join('course_chapter_add c', 'c.chapter_id = b.course_chapter_id');
		$this->db->join('course_add d', 'd.course_id = c.course_id');
		$this->db->join('class_add e', 'e.class_id = d.class_id');
		$this->db->where('a.question_id',$question_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//All Option View Of Specific Questions
	public function retrieve_option_data($question_id){
		$CI =& get_instance();		
		$this->db->select('a.*,b.*');
		$this->db->from('question_options a');
		$this->db->join('question_head b','b.question_id = a.question_id');
		$this->db->where(array('a.question_id'=>$question_id,'a.status'=>1,'b.status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//All Option View Of Specific Questions
	public function retrieve_answer_data($question_id){
		$CI =& get_instance();		
		$this->db->select('*');
		$this->db->from('answer_sheet');
		$this->db->where(array('question_id'=>$question_id));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//Update Question
	public function question_and_option_update()
	{
		
		$question_id = $this->input->post('question_id');
		$chapter_id = $this->input->post('chapter_id');
		
		$data=array(
			'question_detals' 	=> strip_tags($this->input->post('questionName'),'<p><a>'),
			'language' 			=> $this->input->post('language'),
			'question_image' 	=> '',
			'answer_type' 		=> $this->input->post('answerType'),
			'status' 			=> 1
		);
			
		$this->db->where('question_id',$question_id);
		$this->db->update('question_head',$data); 
		
		$items=array(
			'course_chapter_id' => $chapter_id
		);
		$this->db->where('question_id',$question_id);
		$this->db->update('course_question_relation',$items); 
		
		//Update option and answer table
		
		$option_id = $this->input->post('option_id');
		$option_detail = $this->input->post('ques_option');
		
		for ($i=0, $n=count($option_id); $i < $n; $i++) {
		
			$ques_option_id = $option_id[$i];
			$ques_option_detail = $option_detail[$i];
			
			$data=array(
				'option_details' 	=>htmlspecialchars($ques_option_detail)
			);			
			if(!empty($option_id))
			{
				$this->db->where('question_option_id',$ques_option_id);
				$this->db->update('question_options',$data);
			}
		}
		
		$answer_id = $this->input->post('answer_id');
	
		//Delete
		$this->db->where('question_id',$question_id);
		$this->db->delete('answer_sheet');

		if(!empty($answer_id)){
			for ($i=0, $n=count($answer_id); $i < $n; $i++) {
			
				$answer_option_id = $answer_id[$i];
				
				//Insert
				$data2 =array(
					'answer_id'			=> null,
					'question_id' 	 	=> $question_id,
					'answer_option_id' 	=> $answer_option_id,
					'partial_answer' 	=> ''
				);	
				$this->db->insert('answer_sheet',$data2);
			}
		}
				
		return true;
	}
	//Delete Question
	public function question_delete($question_id)
	{
		//Delete Question
		$this->db->where('question_id', $question_id);
		$this->db->delete('question_head');
		//Delete Options
		$this->db->where('question_id', $question_id);
		$this->db->delete('question_options');
		return TRUE;
	}
	public function single_option_entry()
	{
		$true_answer = $this->input->post('is_answer');
		$question_id = $this->input->post('question_id');
		
		$data=array(
			'question_option_id'=> null,
			'question_id' 	 	=> $question_id,
			'option_details' 	=> htmlspecialchars($this->input->post('optionDetail')),
			'language' 			=> $this->input->post('language'),
			'option_image' 		=> '',
			'status' 			=> 1
		);
	
		$this->db->insert('question_options',$data);
		$option_id = $this->db->insert_id();
		
		if($true_answer !=''){
			$data2 = array(
				'answer_id'			=> null,
				'question_id' 	 	=> $question_id,
				'answer_option_id' 	=> $option_id,
				'partial_answer' 	=> ''
			);
			
			$this->db->insert('answer_sheet',$data2); 
		}
		return TRUE;
	}

}