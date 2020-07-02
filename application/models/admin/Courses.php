<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Courses extends CI_Model {
	private $table;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->table = 'course_add';
	}
	/*
	** Count Course List For Create Paginiton
	*/
	public function count_course_list(){
	
		$this->db->select('a.course_id,a.course_name,a.status,b.class_name');
		$this->db->from('course_add a');
		$this->db->join('class_add b', 'b.class_id = a.class_id');
		$this->db->where('b.status',1); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->num_rows();	
		}
		return false;
	}
	/*
	** Retrieve Course List From DB
	*/
	public function retrieve_course_list(){
	
		$this->db->select('a.*,a.course_name,a.status,b.class_name');
		$this->db->from('course_add a');
		$this->db->join('class_add b', 'b.class_id = a.class_id');
		$this->db->where('b.status',1); 
		$this->db->where('a.status !=',2); 
		$this->db->order_by('a.course_id','desc'); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	/*
	** Retrieve Class List From DB
	*/
	public function retrieve_class_list(){
	
		$this->db->select('*');
		$this->db->from('class_add');
		$this->db->where('status',1); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	/*
	** Inset Class Name To DB
	*/
	function insert_course($data)
	{ 
		$this->db->insert('course_add',$data);
		//Write Into Json Page
		$this->db->select('course_id,course_name');
		$this->db->from('course_add');
		$this->db->where('status',1);
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$json_course[] = array('label'=>$row->course_name,'value'=>$row->course_id);
		}
		$cache_file = './my-assets/js/admin_js/json/course_name.json';
		$courseList = json_encode($json_course);
		file_put_contents($cache_file,$courseList);
        return true;
	}
	/*
	** Retrieve Data for Update
	*/
	public function retrieve_course_editdata($course_id){
	
		$this->db->select('*');
		$this->db->from('course_add');
		$this->db->where('course_id',$course_id); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	/*
	** Update Course
	*/
	public function update_course($course_id,$data){	
		$this->db->where('course_id',$course_id);
		$this->db->update('course_add',$data); 
		
		//Write Into Json Page
		$this->db->select('course_id,course_name');
		$this->db->from('course_add');
		$this->db->where('status',1);
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$json_course[] = array('label'=>$row->course_name,'value'=>$row->course_id);
		}
		$cache_file = './my-assets/js/admin_js/json/course_name.json';
		$courseList = json_encode($json_course);
		file_put_contents($cache_file,$courseList);
        return true;
	}
	//Change Course Name Status
	public function change_courseName_status($course_id)
	{
		$this->db->select('status');
		$this->db->from('course_add');
		$this->db->where('course_id',$course_id); 
		
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
		$this->db->where('course_id',$course_id);
		$this->db->update('course_add',$data); 
		return $status ;
	}
	
	public function retrieve_requested_course_list()
	{
		$this->db->select('a.course_id,a.course_name,a.status,b.class_name');
		$this->db->from('course_add a');
		$this->db->join('class_add b', 'b.class_id = a.class_id');
		$this->db->where(array('a.status'=>2,'b.status'=>1)); 
		$this->db->order_by('a.course_id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
		
	public function approve_requested_course( $course_id )
	{
		$data=array(
			'status' 		=>1
		);
		$this->db->where('course_id',$course_id);
		$this->db->update('course_add',$data); 
		return true ;
	}
	
	public function delete_requested_course( $course_id )
	{
		$this->db->where('course_id',$course_id);
		$this->db->delete('course_add'); 
		return true ;
	}
}