<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Profiles extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//Retrieve course list For front view home page
	public function retrieve_profile_data()
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('a.user_name,a.mobile_no,b.email');
		$this->db->from('users a');
		$this->db->join('client_user_login b','b.user_id = a.user_id');
		$this->db->where(array('a.user_id'=>$user_id,'b.status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	public function check_old_password( $old_pass )
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('*');
		$this->db->from('client_user_login');
		$this->db->where(array('user_id'=>$user_id,'status'=>1,'password'=>$old_pass ));
		$query = $this->db->get();
		
		if ($query->num_rows() > 0){
			return true	;
		}
		return false;
	}
	public function change_password( $old_pass,$data )
	{
		$user_id = $this->session->userdata('user_id');

		$this->db->where(array('user_id'=>$user_id,'password'=>$old_pass ));
		$this->db->update('client_user_login',$data);
		
		return true	;
	}
	public function user_info_update( $data )
	{
		$user_id = $this->session->userdata('user_id');

		$this->db->where(array('user_id'=>$user_id));
		$this->db->update('users',$data);
		return true	;
	}
	
}