<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Retrive student list
	public function retrieve_student_list(){
		$this->db->select('client_user_login.*,users.*');
		$this->db->from('users');
		$this->db->join('client_user_login', 'client_user_login.user_id = users.user_id');
		$this->db->where('client_user_login.user_type','student');
		$this->db->order_by('client_user_login.user_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Retrieve student list by id
	function student_list($student_id)
	{ 	
		$this->db->select('client_user_login.*,users.*');
		$this->db->from('users');
		$this->db->join('client_user_login', 'client_user_login.user_id = users.user_id');
		$this->db->where('client_user_login.user_id',$student_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	// Inset Student To DB
	function insert_student($data1,$data2)
	{ 	
		$this->db->insert('users',$data1);
		$this->db->insert('client_user_login',$data2);
        return true;
	}
	//Update Student
	public function update_student($student_id,$users,$client){	

		$this->db->where('user_id',$student_id);
		$this->db->update('users',$users); 

		//Client table update
		if(!empty($client)){
			$this->db->where('user_id',$student_id);
			$this->db->update('client_user_login',$client);
		}
		return true;
	}
	//Delete student
	public function delete_student($user_id)
	{
		//Delete User Table
		$this->db->where('user_id',$user_id);
		$this->db->delete('users');
		//Delete Login Table
		$this->db->where('user_id',$user_id);
		$this->db->delete('client_user_login');
		return TRUE;
	}
	//Change User Status
	public function change_user_status($user_id)
	{
		$this->db->select('status');
		$this->db->from('client_user_login');
		$this->db->where('user_id',$user_id); 
		
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
			'status' 	=>$status
		);
		$this->db->where('user_id',$user_id);
		$this->db->update('client_user_login',$data); 
		return $status ;
	}
}