<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cquestion extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'question';
    }
	/*
	//* Retrieve Question List to view on the admin end
	*/
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lquestion');
		$CI->load->model('admin/Questions');
	
		$config = array();
		#Paggination start#
        $config["base_url"] = base_url('admin/Cquestion/index');
        $config["total_rows"] = $this->Questions->count_question_list();
        $config["per_page"] = 20;
        $config["uri_segment"] = 4;
        $config["num_links"] = 5; 
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        #Paggination end#


		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links();
	
        $content = $CI->lquestion->question_list($limit,$page,$links);
        $sub_menu = array(
				array('label'=>display('manage_question'), 'url' => 'admin/Cquestion', 'class' =>'active'),
				array('label'=> display('add_question'), 'url' => 'admin/Cquestion/add_question_form')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	/*
	//* Form for add Class Name
	*/
	public function add_question_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lquestion');
		
        $content = $CI->lquestion->question_add_form();
       
        $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'admin/Cquestion'),
				array('label'=> display('add_question'), 'url' => 'admin/Cquestion/add_question_form','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	
	// Rtrieve Chapter By using Jquery Ajax 
	// This is need to add Questions
	
	public function retrieve_chapter()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Questions');
		
		$course_id =  $_POST['course_id'];	
		$chapter = $CI->Questions->retrieve_course($course_id);		
		echo"<option value=''>".display('select_chapter')."</option>";
		foreach($chapter as $row)
		{		
			echo "<option value='$row->chapter_id'set_select('chapter_id', '$row->chapter_id') >$row->chapter_name</option>";
		}
	}
	/*
	//* Insert Course Name To Data Base
	*/
	public function insert_question_and_option()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Questions');
		$CI->Questions->question_and_option_entry();
		
		$this->session->set_userdata(array('message'=>display('successfully_added_question')));
		redirect(base_url('admin/Cquestion/add_question_form'));
	}
	
	// Retrieve Option List to view on the Admin end
	public function view_question_option()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Questions');
		$question_id=$this->input->post('id');
		
		$option_data = $CI->Questions->retrieve_option_data($question_id);
		$answer_data = $CI->Questions->retrieve_answer_data($question_id);

		// Database data modified start
		if(!empty($option_data)){
			foreach($option_data as $index=>$value){
				$option_id = $value['question_option_id'];
				if(!empty($answer_data)){
					foreach($answer_data as $k=>$val){
					
						if($option_id == $val['answer_option_id']){
							$option_data[$index]['checked']='checked="checked"';
						}
					}
				}
			}
		}

		$data = array(
				'title' => 'Option List',
				'question_details' => $option_data[0]['question_detals'],
				'question_id' => $option_data[0]['question_id'],
				'option_list' => $option_data
			);
        	
		// Database data modified end

		// This page load to ajax page start
        $form  = '';

        $form .= "<div class='text-center'>";
		if(isset($data['question_details'])){echo htmlspecialchars_decode($data['question_details']);} 
		$form .= "</div>";

       	$form .=" <table class='table table-striped table-bordered'>
			<thead>
				<tr>
					<th><center>".display('answer')."</center></th>
					<th><center>".display('question_option')."</center></th>
				</tr>
			</thead>
			<tbody>";
			if(!empty($data['option_list'])){
				foreach($data['option_list'] as $value){ 

		$form .="<tr>
					<td width='2%'>
						<center>
							<input type='checkbox' value='".$value['question_option_id']."' ";
							if(isset($value['checked']))
								{$form .= $value['checked'];} 

		$form .="name='answer_id'>
						</center>
					</td>
					<td>
						<center>".htmlspecialchars_decode($value['option_details'])."</center>
					</td>
				</tr>";
				}
			}

		$form .="</tbody>
		</table>";
		echo $form;

		// This page load to ajax page end
	}
	//Course Edit Form 

	public function question_edit_form($question_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lquestion');
		if($question_id ==''){
			redirect(base_url('admin/Cquestion'));
		}
		
        $content = $CI->lquestion->question_option_edit_data($question_id);
		$sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'admin/Cquestion'),
				array('label'=> display('add_question'), 'url' => 'admin/Cquestion/add_question_form'),
				array('label'=> display('edit_question'), 'url' => 'admin/Cquestion/question_edit_form','class' =>'active')
			);
			
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	
	//Question Option Update
	
	public function question_and_option_update()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Questions');		
		$CI->Questions->question_and_option_update();
		$this->session->set_userdata(array('message'=>display('successfully_update')));
		redirect(base_url('admin/Cquestion'));
	}
	//Delate Questions
	public function delete_question()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Questions');
		
		$question_id =  $_POST['question_id'];			
		$status = $CI->Questions->question_delete($question_id);
		$this->session->set_userdata(array('message'=>display('successfully_delete')));
		echo $status;
	}
		/*
	//* Insert Options Form for right Now inserted Question
	*/
	public function add_single_option_form($question_id='')
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lquestion');
		
		if($question_id ==''){
			redirect(base_url('admin/Cquestion'));
		}
		
		$data = array( 
			'title' => 'Add question option',
			'question_id' => $question_id
			);
        $content = $this->parser->parse('admin_view/question_option/add_option_form',$data,true);
		
        $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'admin/Cquestion'),
				array('label'=> display('add_question'), 'url' => 'admin/Cquestion/add_question_form'),
				array('label'=> display('add_question_option'), 'url' => 'admin/Cquestion/add_option_form','class' =>'active')
			);
			
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	public function insert_question_single_option(){
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Questions');
		$CI->Questions->single_option_entry();
		
		if(isset($_POST['add-option'])){

			$this->session->set_userdata(array('message'=>display('successfully_option_add')));

			redirect(base_url('admin/Cquestion'));
			exit;
		}elseif(isset($_POST['add-option-another'])){

			$this->session->set_userdata(array('message'=>display('successfully_option_add_another')));

			$question_id = $this->input->post('question_id');
			$this->add_single_option_form($question_id);
		}
		
	}
	//Question search by class and course id
	public function question_search_by_class_id(){
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Questions');
		$CI->load->library('lquestion');

		$class_id=$this->input->post('class_id');
		$chapter_id=$this->input->post('chapter_id');

		$content = $CI->lquestion->question_search_by_chapter_id($class_id,$chapter_id);
		$sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'admin/Cquestion','class' => 'active'),
				array('label'=> display('add_question'), 'url' => 'admin/Cquestion/add_question_form'),
			);
			
		$this->template->full_admin_html_view($content,$sub_menu);
	}
}