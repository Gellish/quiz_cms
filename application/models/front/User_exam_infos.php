<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class User_exam_infos extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_total_exam_notification()
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('status');
		$this->db->from('exam_notifications');
		$this->db->where(array('student_id'=>$user_id,'status'=>1));
		$query = $this->db->get();
		return $query->num_rows();

	}
	
	public function get_schedule_exam_data()
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('a.*,b.exam_name,c.user_name,d.course_name');
		$this->db->from('exam_notifications a');
		$this->db->join('exam_head b','b.exam_id = a.exam_id');
		$this->db->join('users c','c.user_id = b.tutor_id');
		$this->db->join('course_add d','d.course_id = b.course_id');
		$this->db->where(array('a.student_id'=>$user_id,'a.status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	public function get_schedule_exam_stats_data()
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('a.*,b.exam_name,c.user_name,d.course_name');
		$this->db->from('exam_notifications a');
		$this->db->join('exam_head b','b.exam_id = a.exam_id');
		$this->db->join('users c','c.user_id = b.tutor_id');
		$this->db->join('course_add d','d.course_id = b.course_id');
		$this->db->where(array('a.student_id'=>$user_id,'a.status'=>2));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}	
		
	public function count_own_exam_list( )
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('a.*,b.user_name,c.course_name');
		$this->db->from('exam_head a');
		$this->db->join('users b','b.user_id = a.tutor_id');
		$this->db->join('course_add c','c.course_id = a.course_id');
		$this->db->join('user_exam_result d','d.exam_id = a.exam_id');
		$this->db->where(array('a.tutor_id'=>$user_id,'a.status'=>1));
		$query = $this->db->get();
		
		return $query->num_rows();	
	}
	
	public function get_own_exam_stats_data( $limit,$page )
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('a.*,b.user_name,c.course_name,d.attend_date');
		$this->db->from('exam_head a');
		$this->db->join('users b','b.user_id = a.tutor_id');
		$this->db->join('course_add c','c.course_id = a.course_id');
		$this->db->join('user_exam_result d','d.exam_id = a.exam_id');
		$this->db->where(array('a.tutor_id'=>$user_id,'a.status'=>1));
		$this->db->limit($limit,$page);
		$this->db->order_by('a.exam_id','desc');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}	
	
	public function count_model_test_list( )
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('a.*,b.user_name,c.model_test_name,d.attend_date');
		$this->db->from('model_test_head a');
		$this->db->join('users b','b.user_id = a.user_id');
		$this->db->join('model_test_settings c','c.model_test_id = a.model_test_settings_id');
		$this->db->join('model_test_result d','d.model_test_id = a.model_test_id');
		$this->db->where(array('a.user_id'=>$user_id,'a.status'=>1));
		$query = $this->db->get();
		
		return $query->num_rows();	
	}
	public function get_model_test_stats_data( $limit,$page )
	{
		$user_id = $this->session->userdata('user_id');
		
		$this->db->select('a.*,b.user_name,c.model_test_name,d.attend_date');
		$this->db->from('model_test_head a');
		$this->db->join('users b','b.user_id = a.user_id');
		$this->db->join('model_test_settings c','c.model_test_id = a.model_test_settings_id');
		$this->db->join('model_test_result d','d.model_test_id = a.model_test_id');
		$this->db->where(array('a.user_id'=>$user_id,'a.status'=>1));
		$this->db->limit($limit,$page);
		$this->db->order_by('a.model_test_id','desc');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

}