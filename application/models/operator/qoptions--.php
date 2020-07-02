<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Qoptions extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function retrieve_options_editdata($option_id){
	
		$this->db->select('*');
		$this->db->from('question_options');
		$this->db->where('question_option_id',$option_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Option Course
	public function update_option($option_id,$data)
	{	
		$this->db->where('question_option_id',$option_id);
		$this->db->update('question_options',$data); 
		return true;
	}
	//Delete Question
	public function option_delete($option_id)
	{
		//Delete Question
		$this->db->where('question_option_id', $option_id);
		$this->db->delete('question_options');
		return TRUE;
	}
	public function retrieve_option_data($question_id)
	{
		$CI =& get_instance();	
		$operator_id = $CI->session->userdata('user_id');
		
		$this->db->select('a.*,b.question_id,b.question_detals');
		$this->db->from('question_options a');
		$this->db->join('question_head b','b.question_id = a.question_id');
		$this->db->join('question_creator_relation c','c.question_id = b.question_id');
		$this->db->where(array('b.status'=>1,'c.question_id'=>$question_id,'c.creator_id'=>$operator_id));
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
	//Update All Options Of specific Questions
	public function update_all_option()
	{
		$option_id = $this->input->post('option_id');
		$option_detail = $this->input->post('option_details');
		
		for ($i=0, $n=count($option_id); $i < $n; $i++) {
			$ques_option_id = $option_id[$i];
			$ques_option_detail = $option_detail[$i];
			
			$data=array(
				'option_details' 	=> $ques_option_detail
			);			
			if(!empty($option_id))
			{
				$this->db->where('question_option_id',$ques_option_id);
				$this->db->update('question_options',$data);
			}
		}
		$answer_id = $this->input->post('answer_id');
		$question_id = $this->input->post('question_id');
	
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
}