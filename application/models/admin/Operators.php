<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operators extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*
	** Retrieve Class List From DB to view On the Admin Panel
	*/
	public function retrieve_operator_list(){
	
		$this->db->select('a.*,b.*,d.course_name');
		$this->db->from('users a');
		$this->db->join('client_user_login b', 'b.user_id = a.user_id');
		$this->db->join('operator_permission c', 'c.operator_id = b.user_id');
		$this->db->join('course_add d', 'd.course_id = c.course_id');
		$this->db->where('b.user_type','operator');
		$this->db->order_by('b.user_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Retrieve Course List
	function course_list()
	{ 	
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('status',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Inset Operator Name To DB
	function insert_operator($data1,$data2,$data3)
	{ 	
		$this->db->insert('users',$data1);
		$this->db->insert('client_user_login',$data2);
		$this->db->insert('operator_permission',$data3);
        return true;
	}
	//Update Operators
	public function update_operator($operator_id,$data1,$data2,$data3){	
		$this->db->where('user_id',$operator_id);
		$this->db->update('users',$data1); 
		//
		if(!empty($data2)){
			$this->db->where('user_id',$operator_id);
			$this->db->update('client_user_login',$data2);
		}
		//
		$this->db->where('operator_id',$operator_id);
		$this->db->update('operator_permission',$data3); 
		return true;
	}
	//Change Class Name Status
	public function change_operator_status($operator_id)
	{
		$this->db->select('status');
		$this->db->from('client_user_login');
		$this->db->where('user_id',$operator_id); 
		
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
		$this->db->where('user_id',$operator_id);
		$this->db->update('client_user_login',$data); 
		return $status ;
	}
	//Operator Edit Data
	public function retrieve_operator_editdata($operator_id){
	
		$this->db->select('a.*,b.*,d.course_id,d.course_name');
		$this->db->from('users a');
		$this->db->join('client_user_login b', 'b.user_id = a.user_id');
		$this->db->join('operator_permission c', 'c.operator_id = b.user_id');
		$this->db->join('course_add d', 'd.course_id = c.course_id');
		$this->db->where('b.user_type','operator');
		$this->db->where('a.user_id',$operator_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Delete Operator
	public function delete_operator($operator_id)
	{
		//Delete User Table
		$this->db->where('user_id',$operator_id);
		$this->db->delete('users');
		//Delete Login Table
		$this->db->where('user_id',$operator_id);
		$this->db->delete('client_user_login');
		return TRUE;
	}
	
}