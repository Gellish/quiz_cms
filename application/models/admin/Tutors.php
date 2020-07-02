<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tutors extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	// Count Tutor List for Create Paginition

	public function count_active_tutor(){
	
		$this->db->select('a.*,b.*,d.course_name');
		$this->db->from('users a');
		$this->db->join('client_user_login b', 'b.user_id = a.user_id');
		$this->db->join('operator_permission c', 'c.operator_id = b.user_id');
		$this->db->join('course_add d', 'd.course_id = c.course_id');
		$this->db->where(array('b.status'=>1,'b.user_type'=>"teacher"));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return 0;
	}
	// Retrieve Class List From DB to view On the Admin Panel
	public function retrieve_active_tutor_list(){
	
		$this->db->select('a.*,b.*');
		$this->db->from('users a');
		$this->db->join('client_user_login b', 'b.user_id = a.user_id');
		$this->db->where(array('b.status'=>1,'b.user_type'=>"teacher"));
		$this->db->order_by('b.user_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function count_new_register_tutor(){
	
		$this->db->select('a.*,b.*,d.course_name');
		$this->db->from('users a');
		$this->db->join('client_user_login b', 'b.user_id = a.user_id');
		$this->db->join('operator_permission c', 'c.operator_id = b.user_id');
		$this->db->join('course_add d', 'd.course_id = c.course_id');
		$this->db->where(array('b.status'=>2,'b.user_type'=>"teacher"));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return 0;
	}
	
	public function retrieve_newRegister_tutor_list($limit,$page){
	
		$this->db->select('a.*,b.*');
		$this->db->from('users a');
		$this->db->join('client_user_login b', 'b.user_id = a.user_id');
		$this->db->where(array('b.status'=>2,'b.user_type'=>"teacher"));
		$this->db->order_by('b.user_id','desc');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function count_inactive_tutor(){
	
		$this->db->select('a.*,b.*,d.course_name');
		$this->db->from('users a');
		$this->db->join('client_user_login b', 'b.user_id = a.user_id');
		$this->db->join('operator_permission c', 'c.operator_id = b.user_id');
		$this->db->join('course_add d', 'd.course_id = c.course_id');
		$this->db->where(array('b.status'=>0,'b.user_type'=>"teacher"));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return 0;
	}
	
	public function retrieve_inactive_tutor_list($limit,$page){
	
		$this->db->select('a.*,b.*');
		$this->db->from('users a');
		$this->db->join('client_user_login b', 'b.user_id = a.user_id');
		$this->db->where(array('b.status'=>0,'b.user_type'=>"teacher"));
		$this->db->limit($limit,$page);
		$this->db->order_by('b.user_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Inset Class Name To DB
	function insert_tutor($data1,$data2)
	{ 	
		$this->db->insert('users',$data1);
		$this->db->insert('client_user_login',$data2);
        return true;
	}
	//Tutor Edit Data
	public function retrieve_tutor_editdata($tutor_id){

		$this->db->select('a.*,b.*');
		$this->db->from('users a');
		$this->db->join('client_user_login b', 'b.user_id = a.user_id');
		$this->db->where('b.user_type','teacher');
		$this->db->where('a.user_id',$tutor_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Tutor course list
	public function retrieve_course_list(){
	
		$this->db->select('a.course_id,a.course_name,a.status,b.class_name');
		$this->db->from('course_add a');
		$this->db->join('class_add b', 'b.class_id = a.class_id');
		$this->db->where('b.status',1); 
		$this->db->where('a.status !=',2); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	//Update Operators
	public function update_tutor($tutor_id,$data1,$data2,$data3){	
		$this->db->where('user_id',$tutor_id);
		$this->db->update('users',$data1); 
		//
		if(!empty($data2)){
			$this->db->where('user_id',$tutor_id);
			$this->db->update('client_user_login',$data2);
		}
		//
		$this->db->where('operator_id',$tutor_id);
		$this->db->update('operator_permission',$data3); 
		return true;
	}
	//Change tutor Name Status
	public function change_tutor_status($tutor_id)
	{

		$this->db->select('status');
		$this->db->from('client_user_login');
		$this->db->where('user_id',$tutor_id);
		$this->db->where('user_type','teacher');
		
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
		$this->db->where('user_id',$tutor_id);
		$this->db->update('client_user_login',$data); 
		return $status ;
	}
	//Delete Operator
	public function go_approved_teacher( $tutor_id )
	{
		$data=array(
			'status' 	=>1,
			'activation_code' =>""
		);
		$this->db->where('user_id',$tutor_id);
		$this->db->update('client_user_login',$data); 
		return TRUE;
	}	
	//Delete Operator
	public function go_notApproved_teacher( $tutor_id )
	{
		$data=array(
			'status' 	=>3
		);
		$this->db->where('user_id',$tutor_id);
		$this->db->update('client_user_login',$data); 
		return TRUE;
	}
	//Delete Operator
	public function delete_tutor($tutor_id)
	{
		//Delete User Table
		$this->db->where('user_id',$tutor_id);
		$this->db->delete('users');
		//Delete Login Table
		$this->db->where('user_id',$tutor_id);
		$this->db->delete('client_user_login');
		return TRUE;
	}
	
}