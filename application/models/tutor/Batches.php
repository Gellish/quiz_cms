<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Batches extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Batch count
	public function total_batch_count()
	{
		$tutor_id = $this->session->userdata('user_id');
		$this->db->select('a.*,b.student_ids');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_details b','b.batch_id = a.batch_id');
		$this->db->where('tutor_id',$tutor_id);
		$this->db->where('status',1);
		return $query = $this->db->get()->num_rows();
	}

	//Inset batch Name 
	function insert_batch($data)
	{ 	
		$this->db->insert('tutor_batch',$data);
        return true;
	}
	//Retrieve batch List From DB to view On the Tutor Panel
	public function retrieve_batch_list()
	{
		$tutor_id = $this->session->userdata('user_id');
		$this->db->select('a.*,b.student_ids');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_details b','b.batch_id = a.batch_id');
		$this->db->where('tutor_id',$tutor_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	public function retrieve_batch_editdata($batch_id)
	{
		$tutor_id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('tutor_batch');
		$this->db->where(array('batch_id'=>$batch_id,'tutor_id'=>$tutor_id,'status'=>1)); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Update Batch
	public function update_batch($batch_id,$data)
	{	
		$this->db->where('batch_id',$batch_id);
		$this->db->update('tutor_batch',$data); 
		return true;
	}
	//Change batch Name Status
	public function delete_batch_name($batch_id)
	{
		$this->db->where('batch_id',$batch_id);
		$this->db->delete('tutor_batch'); 
		return true ;
	}
	
}