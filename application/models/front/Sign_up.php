<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sign_up extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	// VALID USER MATCH WITH DATABASE
	function check_valid_user($username,$password)
	{ 	
		$password = md5("gef_quize".$password);
		$this->db->select('a.*,b.*');
		$this->db->from('client_user_login a');
		$this->db->join('users b','b.user_id = a.user_id');
		$this->db->where(array('email'=>$username,'password'=>$password,'status'=>1));
		$query = $this->db->get();
		return $query->result_array();
	}
	//View data by id user
	function view_data_by_id_user($table,$email)
	{ 	
		$this->db->select('a.*,b.*');
		$this->db->from('client_user_login a');
		$this->db->join('users b','b.user_id = a.user_id');
		$this->db->where(array('email'=>$email,'status'=>1));
		$query = $this->db->get()->row();	
		return $query;
	}
	//Email check
	function email_check($table,$email)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('client_user_login a');
		$this->db->join('users b','b.user_id = a.user_id');
		$this->db->where(array('email'=>$email,'status'=>1));
		$result=$this->db->get()->row();
		return $result;
	}
	// VALID ADMIN MATCH WITH DATABASE
	function valid_admin_user_check($username,$password)
	{ 	
		$password = md5("gef_quize".$password);
		$this->db->select('a.*,b.*');
		$this->db->from('client_user_login a');
		$this->db->join('users b','b.user_id = a.user_id');
		$this->db->where(array('email'=>$username,'password'=>$password,'user_type'=>"super_admin",'status'=>1));
		$query = $this->db->get();		
		return $query->result_array();
	}
	// Save user registration
	public function save_registration_data( $login_data,$user_data )
	{	
		$this->db->insert('client_user_login',$login_data);
		$this->db->insert('users',$user_data);
		return true;
	}
	//Email Existancy check
	public function email_existancy_check($email)
	{
	  $this->db->where('email', $email);
	  $query = $this->db->get('client_user_login');
	  if( $query->num_rows() > 0 ){ return TRUE; } else { return FALSE; }
	}
	//Confirm Registration
	public function confirm_registration( $register_code )
	{
		$this->db->where('activation_code', $register_code);
		$query = $this->db->get('client_user_login');
		
		if( $query->num_rows() > 0 )
		{
			$data = array('activation_code'=>"",'status'=>1);
		
			$this->db->where('activation_code',$register_code);
			$this->db->update('client_user_login',$data); 
			return true ;
		}else{
			return FALSE; 
		}
	}

}