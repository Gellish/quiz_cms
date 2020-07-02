<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tquestion extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'question';
    }

	// Retrieve Question List to view on the tutor end
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltquestion');
		$CI->load->model('tutor/Questions');
		
		$config = array();

		#Paggination start#
        $config["base_url"] = base_url('tutor/Tquestion/index');
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

        $content = $CI->ltquestion->question_list($limit,$page,$links);
        $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'tutor/Tquestion', 'class' =>'active'),
				array('label'=> display('add_question'), 'url' => 'tutor/Tquestion/add_question_form')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}

	//Form for add Class 
	public function add_question_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltquestion');
		
        $content = $CI->ltquestion->question_add_form();
  
        $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'tutor/Tquestion'),
				array('label'=> display('add_question'), 'url' => 'tutor/Tquestion/add_question_form','class' =>'active')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	//Question search by class id
	public function question_search_by_chapter_id()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltquestion');
		$chapter_id=$this->input->post('chapter_id');
        $content = $CI->ltquestion->question_search_by_chapter_id($chapter_id);
  
        $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'tutor/Tquestion'),
				array('label'=> display('add_question'), 'url' => 'tutor/Tquestion/add_question_form','class' =>'active')
			);
		$this->template->full_tutor_html_view($content,$sub_menu);
	}

	
	// Rtrieve course
	public function retrieve_course()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Questions');
		
		$class_id =  $_POST['class_id'];
		$course = $CI->Questions->retrieve_course_list($class_id);	
		
		echo"<option value=''>".display('select_course')."</option>";
		foreach($course as $row)
		{		
			echo "<option value='".$row['course_id']."' >".$row['course_name']."</option>";
		}
	}

	//Retrive chapter list
	public function retrieve_chapter()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Questions');
		
		$course_id =  $_POST['course_id'];	
		$chapter = $CI->Questions->retrieve_chapter_list($course_id);		
		echo"<option value=''>".display('select_chapter')."</option>";
		foreach($chapter as $row)
		{		
			echo "<option value='".$row['chapter_id']."' >".$row['chapter_name']."</option>";
		}
	}
	
	// Submit Question and option form
	public function insert_question_and_option()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Questions');		
		$CI->Questions->question_and_option_entry();

		$this->session->set_userdata(array('message'=>display('successfully_added_question')));
		redirect(base_url('tutor/Tquestion/add_question_form'));
	}
		
	// Retrieve Option List to view on the Admin end
	public function view_question_option()
	{
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Questions');

		$question_id = $this->input->post('id');
		$option_data = $CI->Questions->retrieve_option_data($question_id);
		$answer_data = $CI->Questions->retrieve_answer_data($question_id);

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
	
	//Teacher Question Edit
	public function question_edit_form($question_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		
		$CI->load->library('ltquestion');
		$CI->load->model('tutor/Questions');
		
		if($question_id ==''){
			redirect(base_url('tutor/Tquestion'));
		}
        $content = $CI->ltquestion->question_option_edit_data($question_id);
		$sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'tutor/Tquestion'),
				array('label'=> display('add_question'), 'url' => 'tutor/Tquestion/add_question_form'),
				array('label'=> display('edit_question'), 'url' => 'tutor/Tquestion/question_edit_form','class' =>'active')
			);
			
		$this->template->full_tutor_html_view($content,$sub_menu);
	}
	
	//Question Option Update
	public function question_and_option_update()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Questions');		
		$CI->Questions->question_and_option_update();
		$this->session->set_userdata(array('message'=>display('successfully_update')));
		redirect(base_url('tutor/Tquestion'));
	}
	
	//Delate Questions
	public function delete_question()
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Questions');
		
		$question_id =  $_POST['question_id'];			
		$status = $CI->Questions->question_delete($question_id);
		$this->session->set_userdata(array('message'=>display('successfully_delete')));
		echo $status;
	}

	// Insert Options Form for right Now inserted Question
	public function add_single_option_form($question_id='')
	{	
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->library('ltquestion');
		
		if($question_id ==''){
			redirect(base_url('tutor/Tquestion'));
		}
		$data = array(
			'title' => 'Add Question Option', 
			'question_id' => $question_id,

			);
        $content = $this->parser->parse('tutor_view/question_option/add_option_form',$data,true);
		
        $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'tutor/Tquestion'),
				array('label'=> display('add_question'), 'url' => 'tutor/Tquestion/add_question_form'),
				array('label'=> display('add_question_option'), 'url' => 'tutor/Tquestion/add_option_form','class' =>'active')
			);
			
		$this->template->full_tutor_html_view($content,$sub_menu);
	}

	//Insert question single option
	public function insert_question_single_option(){
		$CI =& get_instance();
		$CI->auth->check_tutor_auth();
		$CI->load->model('tutor/Questions');
		$CI->Questions->single_option_entry();
		
		if(isset($_POST['add-option'])){
		 	$this->session->set_userdata(array('message'=>display('successfully_option_add')));
			redirect(base_url('tutor/Tquestion'));
			exit(); 
		}elseif(isset($_POST['add-option-another'])){
			$this->session->set_userdata(array('message'=>display('successfully_option_add_another')));
			$question_id = $this->input->post('question_id');
			$this->add_single_option_form($question_id); 
		}
	}
}