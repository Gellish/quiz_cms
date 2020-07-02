<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	//Retrive company list
	public function retrieve_company_list(){
	
		$this->db->select('*');
		$this->db->from('company_information');
		$this->db->where('status','1');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	// Retrieve Company List
	function company_list($company_id)
	{ 	
		$this->db->select('*');
		$this->db->from('company_information');
		$this->db->where('company_id',$company_id);
		$this->db->where('status',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Update Company
	public function update_company($data){
		$this->db->where('company_id',$data['company_id']);
		$this->db->update('company_information',$data); 
		return true;
	}
	//Change Class Name Status
	public function change_company_status($company_id)
	{
		$this->db->select('status');
		$this->db->from('company_information');
		$this->db->where('company_id',$company_id); 
		
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
		$this->db->where('company_id',$company_id);
		$this->db->update('company_information',$data); 
		return $status ;
	}
}