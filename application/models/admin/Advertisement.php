<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Advertisement extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Retrive Advertisement list
	public function retrieve_advertisement_list(){
	
		$this->db->select('*');
		$this->db->from('advertisement');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Insert Advertisement
	public function insert_add($data){
		$this->db->insert('advertisement',$data);
		return true;
	}
	//Retrieve Advertisement List
	function advertise_list($add_id)
	{ 	
		$this->db->select('*');
		$this->db->from('advertisement');
		$this->db->where('add_id',$add_id);
		$this->db->where('add_status',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Update Advertisement
	public function update_advertisement($data){
		$add_id=$this->input->post('add_id');
		$this->db->where('add_id',$add_id);
		$this->db->update('advertisement',$data); 
		return true;
	}
	//Change add status
	public function change_ads_status($add_id)
	{
		$this->db->select('add_status');
		$this->db->from('advertisement');
		$this->db->where('add_id',$add_id); 
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$add_status = $row->add_status ;
			}
		}
		if($add_status==1){
			$add_status=0;
		}else if($add_status==0){
			$add_status=1;
		}
		$data=array(
			'add_status' 	=>$add_status
		);
		$this->db->where('add_id',$add_id);
		$this->db->update('advertisement',$data); 
		return $add_status ;
	}

	//Delete Advertisement
	public function do_delete_advertise($add_id)
	{
		$this->db->where('add_id',$add_id); 
		$this->db->delete('advertisement'); 
		return true ;
	}
}