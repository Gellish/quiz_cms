<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Classes extends CI_Model {
	private $table;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->table = 'class_add';
	}
	// Count Class List For Create Paginiton
	public function count_class_list(){
	
		$this->db->select('*');
		$this->db->from('class_add');
		$this->db->where('status !=',2);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}
	/*
	** Retrieve Class List From DB to view On the Admin Panel
	*/
	public function retrieve_class_list(){
	
		$this->db->select('*');
		$this->db->from('class_add');
		$this->db->where('status !=',2); 
		$this->db->order_by('class_id','desc'); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	/*
	** Inset Class Name To DB
	*/
	
	function insert_class($data)
	{ 	
		$this->db->insert($this->table,$data);
        return true;
	}

	//Retrive class by id
	public function retrieve_class_editdata($class_id){
	
		$this->db->select('*');
		$this->db->from('class_add a');
		$this->db->where('class_id',$class_id); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	/*
	** Update Class
	*/
	public function update_class($class_id,$data){	
		$this->db->where('class_id',$class_id);
		$this->db->update('class_add',$data); 
		return true;
	}
	//Change Class Name Status
	public function change_className_status($class_id)
	{
		$this->db->select('status');
		$this->db->from('class_add');
		$this->db->where('class_id',$class_id); 
		
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
			'status' 		=>$status
		);
		$this->db->where('class_id',$class_id);
		$this->db->update('class_add',$data); 
		return $status ;
	}
	
	public function retrieve_requested_class(){
	
		$this->db->select('*');
		$this->db->from('class_add');
		$this->db->where('status',2);
		$this->db->order_by('class_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function approve_requested_class($class_id)
	{
		$data=array(
			'status' 		=>1
		);
		$this->db->where('class_id',$class_id);
		$this->db->update('class_add',$data); 
		return true ;
	}
	
	public function delete_requested_class($class_id)
	{
		$this->db->where('class_id',$class_id);
		$this->db->delete('class_add'); 
		return true ;
	}
}