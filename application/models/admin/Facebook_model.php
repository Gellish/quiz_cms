<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Facebook_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Retrive facebook list
	public function retrieve_fb_list(){
	
		$this->db->select('*');
		$this->db->from('facebook_config');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Retrieve facebook List by id
	function fb_list($fb_id)
	{ 	
		$this->db->select('*');
		$this->db->from('facebook_config');
		$this->db->where('facebook_id',$fb_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Update facebook
	public function update_fb($data){
		$this->db->where('facebook_id',$data['facebook_id']);
		$this->db->update('facebook_config',$data); 
		return true;
	}
}