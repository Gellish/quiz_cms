<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Texam extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'exam';
    }
	// Retrieve texam List to view on the tutor end
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');
		$CI->load->model('tutor/Exams');
		$tutor_id = $CI->session->userdata('user_id');

        $content = $CI->ltexam->exam_list();	
		
        $sub_menu = array(
				array('label'=> display('manage_exam'), 'url' => 'tutor/Texam','class' =>'active'),
				array('label'=> display('add_exam'), 'url' => 'tutor/Texam/add_exam_form'),
				array('label'=> display('delete_exam'), 'url' => 'tutor/Texam/deleted_exam_list'),
				array('label'=> display('exam_assign'), 'url' => 'tutor/Texam/exam_assignTo_batch'),
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	//Form for add texam Name
	public function add_exam_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');
		
		$data = array( 
			'title' => 'Add Exam',
			'info' => '',
			);
        $content = $this->parser->parse('tutor_view/exam/add_exam_form',$data,true);
        $sub_menu = array(
				array('label'=> display('manage_exam'), 'url' => 'tutor/Texam'),
				array('label'=> display('add_exam'), 'url' => 'tutor/Texam/add_exam_form','class' =>'active'),
				array('label'=> display('delete_exam'), 'url' => 'tutor/Texam/deleted_exam_list'),
				array('label'=> display('exam_assign'), 'url' => 'tutor/Texam/exam_assignTo_batch'),
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	public function retrieve_chapter_name()
	{	
		$CI =& get_instance();
		//$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Exams');
		$course_id =  $_POST['course_id'];	
		$chapter_name = $CI->Exams->retrieve_chapter_name($course_id);			
		foreach($chapter_name as $row)
		{
		echo "<option value='$row->chapter_id' >$row->chapter_name</option>";
		} 
	}
	//Create Question 
	public function create_questions()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Exams');
		$CI->load->library('ltexam');
		
		$qstn_src_type = $this->input->post('qstn_src_type');
		$chapter_ids = $this->input->post('chapter_id');
		$qstn_limit = $this->input->post('no_of_question');
		$exam_name = $this->input->post('exam_name');
		$course_id = $this->input->post('course_id');

		switch ($qstn_src_type){
			case 1:
				$question_ids = $CI->Exams->computer_generated_question_bank($chapter_ids,$qstn_limit);
				$exam_data = array('required_exam_data' => array('exam_name'=>$exam_name,'gen_proc'=>$qstn_src_type,'course_id'=>$course_id,'chapter_ids'=>$chapter_ids,'select_ques'=>$question_ids,'ques_limit'=>$qstn_limit));
				$CI->session->set_userdata($exam_data);

				$CI->session->set_userdata(array('warning_message'=>display('question_set_is_create_successfully')));

				$this->finish_exam();
			 break;
			case 2:
				$question_ids = $CI->Exams->my_question_bank_randomly($chapter_ids,$qstn_limit);
				$exam_data = array('required_exam_data' => array('exam_name'=>$exam_name,'gen_proc'=>$qstn_src_type,'course_id'=>$course_id,'chapter_ids'=>$chapter_ids,'select_ques'=>$question_ids,'ques_limit'=>$qstn_limit));
				$CI->session->set_userdata($exam_data);	

				$CI->session->set_userdata(array('warning_message'=>display('question_set_is_create_successfully')));

				$this->finish_exam();
			  break;
			case 3:
			  	$question_ids = $CI->Exams->my_question_bank_sequentially($chapter_ids,$qstn_limit);
				$exam_data = array('required_exam_data' => array('exam_name'=>$exam_name,'gen_proc'=>$qstn_src_type,'course_id'=>$course_id,'chapter_ids'=>$chapter_ids,'select_ques'=>$question_ids,'ques_limit'=>$qstn_limit));
				$CI->session->set_userdata($exam_data);	

				$CI->session->set_userdata(array('warning_message'=>display('question_set_is_create_successfully')));

				$this->finish_exam();				
			  break;
			case 4:

				$exam_data = array('required_exam_data' => array('exam_name'=>$exam_name,'gen_proc'=>4,'course_id'=>$course_id,'chapter_ids'=>$chapter_ids,'select_ques'=>array(),'ques_limit'=>$qstn_limit));

				$CI->session->set_userdata($exam_data);
				$this->questionIn_sequence();
			  break;
		}
	}
	// texam Edit Form
	public function finish_exam()
	{		
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$data = array('title'=>"");
		$content =  $CI->parser->parse('tutor_view/exam/finish_question',$data,true);
		$this->template->full_tutor_html_view($content);
	}
	//Create Question Sequence
	public function questionIn_sequence()
	{		
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');
		$select_ids = $this->input->post('question_id');		
		$CI->ltexam->chooseQuestion_fromQuestion_bank($select_ids);
	}
	
	// Insert texam Name To Data Base
	public function insert_selected_question()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Exams');
		if(isset($_POST['save-exam'])){		
			$session_data =  $CI->session->userdata('required_exam_data');

			$sess_selected_ques = $session_data['select_ques'];	
			foreach ($sess_selected_ques as $index=>$value) {
				foreach ($value as $key=>$val) {
					$new_datas[] = $val;
				}
			}				
			$no_of_ques = count($new_datas);
			if($session_data['ques_limit'] > $no_of_ques){
				$no_of_ques_limit =  $no_of_ques;
			}else{
				$no_of_ques_limit = $session_data['ques_limit'];
			}
			$data = array(
				'exam_id' 				=> null,
				'exam_name' 			=> $session_data['exam_name'],
				'tutor_id' 				=> $CI->session->userdata('user_id'),
				'course_id' 			=> $session_data['course_id'],
				'number_of_question' 	=> $no_of_ques_limit,
				'generated_procedure' 	=> $session_data['gen_proc'],
				'chapter_ids' 			=> json_encode($session_data['chapter_ids'],JSON_FORCE_OBJECT),
				'status' 				=> 1
			);
			$exam_id = $CI->Exams->insert_exam_head_data($data);
			$data1 = array(
				'exam_id' 				=> $exam_id,
				'question_ids' 			=> json_encode($new_datas,JSON_FORCE_OBJECT),
				'status' 				=> 1
			);
			$CI->Exams->insert_exam_details_data($data1);
			
			$exam_data = array('required_exam_data' => '');
			$CI->session->unset_userdata($exam_data);

			$CI->session->set_userdata(array('message'=>"Exam Added Successfuly !"));

			redirect(base_url('tutor/Texam'));
			exit;
		}elseif(isset($_POST['cancell-exam'])){
		
			$exam_data = array('required_exam_data' => '');
			$CI->session->unset_userdata($exam_data);

			$CI->session->set_userdata(array('message'=>display('selected_question_cancelled')));

			redirect(base_url('tutor/Texam'));
		}
	}
	//Exam Edit Form
	public function texam_edit_form($texam_id)
	{		
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');
		
        $content = $CI->ltexam->texam_edit_data($texam_id);
		$sub_menu = array(
				array('label'=> display('manage_exam'), 'url' => 'tutor/Texam'),
				array('label'=> display('add_exam'), 'url' => 'tutor/Texam/add_texam_form'),
				array('label'=> display('edit_exam'), 'url' => 'tutor/Texam','class' =>'active'),
				array('label'=> display('exam_assign'), 'url' => 'tutor/Texam/exam_assignTo_batch'),
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	// texam Update
	public function update_texam()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/texams');
		
		$texam_id = $this->input->post('texamId');
		$data=array(
			'texam_name' => $this->input->post('texamName')
		);
		$CI->texams->update_texam($texam_id,$data);

		$this->session->set_userdata(array('message'=>display('successfully_update')));

		redirect(base_url('tutor/Texam'));
	}
	//Delate texam
	public function delete_examName()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Exams');
		$exam_id =  $_POST['exam_id'];	
		$status = $CI->Exams->delete_exam_name($exam_id);
		$CI->session->set_userdata(array('message'=>display('successfully_delete')));
		return true;
	}
	//Delate texam
	public function exam_deleteToactive_mode()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Exams');
		$exam_id =  $_POST['exam_id'];	
		$status = $CI->Exams->return_to_active_mode($exam_id);
		$CI->session->set_userdata(array('message'=>display('successfully_status_changed')));
		return true;
	}
	// Retrieve Deleted Exam List
	public function deleted_exam_list()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');

        $content = $CI->ltexam->deleted_exam_list();	
        $sub_menu = array(
				array('label'=> display('manage_exam'), 'url' => 'tutor/Texam'),
				array('label'=> display('add_exam'), 'url' => 'tutor/Texam/add_exam_form'),
				array('label'=> display('delete_exam'), 'url' => 'tutor/Texam/deleted_exam_list','class' =>'active'),
				array('label'=> display('exam_assign'), 'url' => 'tutor/Texam/exam_assignTo_batch'),
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	// Assign Exam to Batch List
	public function assign_exam_list()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');
		$CI->load->model('tutor/Exams');
		

        $content = $CI->ltexam->assign_exam_list();	
        $sub_menu = array(
				array('label'=> display('manage_exam'), 'url' => 'tutor/Texam'),
				array('label'=> display('add_exam'), 'url' => 'tutor/Texam/add_exam_form'),
				array('label'=> display('delete_exam'), 'url' => 'tutor/Texam/deleted_exam_list'),
				array('label'=> display('exam_assign'), 'url' => 'tutor/Texam/exam_assignTo_batch'),
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list','class' =>'active'),
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	// Assign Exam to Batch
	public function exam_assignTo_batch()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');

        $content = $CI->ltexam->batch_assign_form();	
        $sub_menu = array(
				array('label'=> display('manage_exam'), 'url' => 'tutor/Texam'),
				array('label'=> display('add_exam'), 'url' => 'tutor/Texam/add_exam_form'),
				array('label'=> display('delete_exam'), 'url' => 'tutor/Texam/deleted_exam_list'),
				array('label'=> display('exam_assign'), 'url' => 'tutor/Texam/exam_assignTo_batch','class' =>'active'),
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	// Assign Submit
	public function assign_submit()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Exams');
		$tutor_id = $CI->session->userdata('user_id');
		$user_name = $CI->session->userdata('user_name');

		$exam_id = $this->input->post('exam_id');	
		$batch_id = $this->input->post('batch_id');	
		$data = array(
			'batch_assign_id' 		=> null,
			'exam_id' 				=> $exam_id,
			'tutor_id' 				=> $tutor_id,
			'batch_id' 				=> $batch_id,
			'status' 				=> 1
		);
		$CI->Exams->assign_submit($data);
		//Notify to All Students
		//Get All Student Ids from Batch
		$all_student_data = $CI->Exams->get_all_batch_student($batch_id);
		$all_student_ids = json_decode($all_student_data[0]['student_ids'],true);
		if(!empty($all_student_ids)){
			foreach($all_student_ids as $value){
				$data2[] =  array(
					'notification_id' 		=> null,
					'student_id' 			=> $value,
					'exam_id' 				=> $exam_id,
					'assign_date' 			=> date('Y-m-d'),
					'status' 				=> 1
				);
			}
			
			$CI->Exams->entry_notify_student_data($data2);
		}
		//Notify by Mail
		if(!empty($all_student_ids)){
		
			$all_student_email_ids = $CI->Exams->get_student_email_id($all_student_ids);
			
			if(!empty($all_student_email_ids)){
				foreach($all_student_email_ids as $val){
					$student_email_ids[] =  $val['email'];
				}
			}	
			if(!empty($student_email_ids)){
			
		/* 		$all_student_emails = '';
				$this->email->from($user_name, 'Tutor');
				$this->email->to('info@gefedu.com');
				$this->email->cc($student_email_ids);
				$this->email->subject('Exam Notification');
				$this->email->message('You have an Exam');
				$this->email->send(); */
			}

		}

		$CI->session->set_userdata(array('message'=>display('assigned_exam_successfully')));

		redirect(base_url('tutor/Texam/assign_exam_list'));
		exit;
       
	}
	// Assign Exam to Batch Edit
	public function exam_assignToBatch_edit($batch_assign_id)
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');

        $content = $CI->ltexam->retrieve_batch_assign_data($batch_assign_id);	
        $sub_menu = array(
				array('label'=> display('manage_exam'), 'url' => 'tutor/Texam'),
				array('label'=> display('add_exam'), 'url' => 'tutor/Texam/add_exam_form'),
				array('label'=> display('delete_exam'), 'url' => 'tutor/Texam/deleted_exam_list'),
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list'),
				array('label'=> display('exam_assign'), 'url' => 'tutor/Texam/exam_assignTo_batch','class' =>'active'),
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	// Assign Update
	public function assign_update()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Exams');
		$batch_assign_id = $this->input->post('batch_assign_id');

		$exam_id = $this->input->post('exam_id');	
		$batch_id = $this->input->post('batch_id');	
		$data = array(
			'exam_id' 				=> $exam_id,
			'tutor_id' 				=> $tutor_id,
			'batch_id' 				=> $batch_id,
			'status' 				=> 1
		);
		$CI->Exams->assign_submit_update($batch_assign_id,$data);

		$CI->session->set_userdata(array('message'=>display('assign_exam_update_successfully')));

		redirect(base_url('tutor/Texam/assign_exam_list'));
		exit;
	}
	//Delate texam
	public function exam_assign_batch_delete()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Exams');
		$batch_assign_id =  $_POST['batch_assign_id'];
		$status = $CI->Exams->exam_assign_batch_delete($batch_assign_id);
		$CI->session->set_userdata(array('message'=>display('successfully_delete')));
		return true;
	}
	
	// Assign Exam to Batch List
	public function assign_exam_result( $batch_id,$exam_id )
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');
		$CI->load->model('tutor/Exams');
		
		if( $batch_id==''|| $exam_id ==''){

			$CI->session->set_userdata(array('warning_message'=>display('error_in_your_url')));

			redirect(base_url('tutor/Texam/assign_exam_list'));
		}
		
		/* $config = array();
		$config["base_url"] = base_url()."tutor/texam/assign_exam_list";
		$config["total_rows"] = $this->exams->count_assign_exam_list();  
		$config["per_page"] = 15;
		$config["uri_segment"] = 4;	
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links(); 

        $content = $CI->ltexam->assign_exam_list($limit,$page,$links);	*/
		
        $content = $CI->ltexam->get_assign_exam_result( $batch_id,$exam_id );	
		
        $sub_menu = array(
				array('label'=> display('manage_exam'), 'url' => 'tutor/Texam'),
				array('label'=> display('add_exam'), 'url' => 'tutor/Texam/add_exam_form'),
				array('label'=> display('delete_exam'), 'url' => 'tutor/Texam/deleted_exam_list'),
				array('label'=> display('exam_assign'), 'url' => 'tutor/Texam/exam_assignTo_batch'),				
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list'),
				array('label'=> display('student_result'), 'url' => 'tutor/Texam/assign_exam_list','class' =>'active')
			);
			
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	
		// Assign Exam to Batch List
	public function student_detail_result( $student_id,$exam_id )
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltexam');
		$CI->load->model('tutor/Exams');
		
		if( $student_id==''|| $exam_id ==''){
			$CI->session->set_userdata(array('warning_message'=>"Error in your URL !"));
			redirect(base_url('tutor/Texam/assign_exam_list'));
		}
		
        $content = $CI->ltexam->get_student_detail_result( $student_id,$exam_id );	
		
        $sub_menu = array(
				array('label'=> display('manage_exam'), 'url' => 'tutor/Texam'),
				array('label'=> display('add_exam'), 'url' => 'tutor/Texam/add_exam_form'),
				array('label'=> display('delete_exam'), 'url' => 'tutor/Texam/deleted_exam_list'),
				array('label'=> display('exam_assign'), 'url' => 'tutor/Texam/exam_assignTo_batch'),
				array('label'=> display('assign_exam_list'), 'url' => 'tutor/Texam/assign_exam_list'),
				array('label'=> display('student_detail_result'), 'url' => 'tutor/Texam/assign_exam_list','class' =>'active')
			);
			
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	
	
	
}