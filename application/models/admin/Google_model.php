<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Google_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Retrive google list
	public function retrieve_google_list(){
	
		$this->db->select('*');
		$this->db->from('google_config');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Retrieve google List
	function google_list($google_id)
	{ 	
		$this->db->select('*');
		$this->db->from('google_config');
		$this->db->where('google_id',$google_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Update google
	public function update_google($data){
		$this->db->where('google_id',$data['google_id']);
		$this->db->update('google_config',$data); 
		return true;
	}
}