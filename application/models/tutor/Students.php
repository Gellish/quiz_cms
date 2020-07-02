<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Students extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Count Student List
	public function count_student_list()
	{
		$tutor_id = $this->session->userdata('user_id');
		
		$final_ids = array();
		
		$this->db->select('a.*,b.*');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_details b','b.batch_id = a.batch_id');
		$this->db->where(array('tutor_id' =>$tutor_id,'a.status' =>1));
		$query = $this->db->get();
		foreach ($query->result() as $rows) {
			$student_ids = json_decode($rows->student_ids,true);
			foreach ($student_ids as $index=>$val) {
				$final_ids[] = $val;
			}
		}
		
		if(!empty($final_ids)){	
				
			//Retrieve Image Name From Image management Table 
			$this->db->select('a.user_name,b.email');
			$this->db->from('users a');
			$this->db->join('client_user_login b','b.user_id = a.user_id');
			$this->db->where(array('b.status' => 1));
			$this->db->where_in('a.user_id',$final_ids);
			$query = $this->db->get();						
			return $query->num_rows();
		
		}
		
		return 0;
		
	}
	//Retrieve student List From DB to view On the Tutor Panel
		
	public function retrieve_student_list()
	{
		$tutor_id = $this->session->userdata('user_id');
		
		$final_ids = array();
		
		$this->db->select('a.*,b.*');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_details b','b.batch_id = a.batch_id');
		$this->db->where(array('tutor_id' =>$tutor_id,'a.status' =>1));
		$query = $this->db->get();

		foreach ($query->result() as $rows) {
	 		$student_ids = json_decode($rows->student_ids,true);
			foreach ($student_ids as $index=>$val) {
				$final_ids[] = $val;
			} 
		}
		foreach ($query->result() as $rows) {
			$batch_id[] = $rows->batch_id;
		} 

		if(!empty($final_ids)){	
				
			//Retrieve Image Name From Image management Table 
			$this->db->select('a.user_name,a.mobile_no,b.email');
			$this->db->from('users a');
			$this->db->join('client_user_login b','b.user_id = a.user_id');
			$this->db->where(array('b.status' => 1));
			$this->db->where_in('a.user_id',$final_ids);
			$query = $this->db->get();						
			return $query->result_array();
		
		}
		
		return false;
		
	}
	public function retrieve_batch_list()
	{
		$tutor_id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('tutor_batch');
		$this->db->where('tutor_id',$tutor_id);
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Student Search By Batch id
	public function student_search_by_batch($batch_id)
	{
	
		$tutor_id = $this->session->userdata('user_id');
		
		$final_ids = array();
		
		$this->db->select('a.*,b.*');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_details b','b.batch_id = a.batch_id');
		$this->db->where(array('a.batch_id' =>$batch_id,'tutor_id' =>$tutor_id,'a.status' =>1));
		$query = $this->db->get();
		foreach ($query->result() as $rows) {
			$student_ids = json_decode($rows->student_ids,true);
			foreach ($student_ids as $index=>$val) {
				$final_ids[] = $val;
			}
		}
		
		if(!empty($final_ids)){	
				
			//Retrieve Image Name From Image management Table 
			$this->db->select('a.user_name,b.email');
			$this->db->from('users a');
			$this->db->join('client_user_login b','b.user_id = a.user_id');
			$this->db->where(array('b.status' => 1));
			$this->db->where_in('a.user_id',$final_ids);
			$query = $this->db->get();						
			return $query->result_array();
		
		}
		
		return false;		
	}

	// Check Valid Student Email
	function student_email_check($std_email)
	{ 	
        $this->db->where(array('email'=>$std_email,'user_type'=>"student",'status'=>1));
		$query = $this->db->get('client_user_login');
		return $query->result_array();
	}
	// The email id check for this Batch
	function studenid_check_forThis_batch($batch_id,$student_id)
	{ 	
        $this->db->select('student_ids');
		$this->db->from('tutor_batch_details');
		$this->db->where('batch_id',$batch_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $rows) {
				$student_ids = json_decode($rows->student_ids,true);
				foreach ($student_ids as $index=>$val) {
					$final_ids[] = $val;
				}
			}		
			if(in_array("$student_id",$final_ids)){
				return 0;
			}else{
				return 1;
			}
		}else{
			return 1;
		}
	}
	//Inset student Name 
	function insert_emailid_inbatch($batch_id,$student_id)
	{ 	
		$student_ids = array();
		$this->db->select('student_ids');
		$this->db->from('tutor_batch_details');
		$this->db->where('batch_id',$batch_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$student_ids = json_decode($row->student_ids,true);
			}
			array_push($student_ids,$student_id);
			
			$data=array(
				'student_ids'	=>	json_encode($student_ids,JSON_FORCE_OBJECT)
			);
			$this->db->where('batch_id',$batch_id);
			$this->db->update('tutor_batch_details',$data); 
		}else{
			$aray_push=array();
			array_push($aray_push,$student_id);
			$data=array(
				'batch_id'		=>	$batch_id,
				'student_ids'	=>	json_encode($aray_push,JSON_FORCE_OBJECT)
				);
			$this->db->insert('tutor_batch_details',$data);
		}
        return true;
	}
	//Change student Name Status
	public function delete_student_name($batch_id,$student_id)
	{
		$tutor_id = $this->session->userdata('user_id');
		
		$final_ids = array();
		$order_ids = array();
		
		$this->db->select('a.*,b.*');
		$this->db->from('tutor_batch a');
		$this->db->join('tutor_batch_details b','b.batch_id = a.batch_id');
		$this->db->where(array('a.batch_id' =>$batch_id,'tutor_id' =>$tutor_id));
		$query = $this->db->get();
		foreach ($query->result() as $rows) {
			$student_ids = json_decode($rows->student_ids,true);
			foreach ($student_ids as $index=>$val) {
				$final_ids[] = $val;
			}
		}
		
		if(!empty($final_ids)){	
			$random_order_ids = array_diff($final_ids,[$student_id]);
			$order_ids = array_values($random_order_ids);
		}
		if(!empty($order_ids)){	
			$data=array(
				'student_ids'	=>	json_encode($order_ids,JSON_FORCE_OBJECT)
			);
			$this->db->where('batch_id',$batch_id);
			$this->db->update('tutor_batch_details',$data); 
		}
		return true;
	}
	
}