<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Retrive Setting list
	public function retrieve_advertisement_list(){
	
		$this->db->select('*');
		$this->db->from('advertisement');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Insert Setting
	public function insert_add($data){
		$this->db->insert('advertisement',$data);
		return true;
	}
	//Retrieve Setting List
	function setting_list()
	{ 	
		$this->db->select('*');
		$this->db->from('setting');
		$this->db->where('id',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Update Setting
	public function update_setting($data){
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->update('setting',$data); 
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

	//Delete Setting
	public function do_delete_advertise($add_id)
	{
		$this->db->where('add_id',$add_id); 
		$this->db->delete('advertisement'); 
		return true ;
	}
}