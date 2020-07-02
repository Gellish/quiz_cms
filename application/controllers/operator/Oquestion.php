<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Oquestion extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'question';
    }
	/*
	//* Retrieve Question List to view on the operator end
	*/
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->library('loquestion');
		$CI->load->model('operator/Questions');
		
		$config = array();
		$config["base_url"] = base_url()."operator/Oquestion/index";
		$config["total_rows"] = $this->Questions->count_question_list();  
		$config["per_page"] = 50;
		$config["uri_segment"] = 4;	
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links();
		
        $content = $CI->loquestion->question_list($limit,$page,$links);
        $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'operator/Oquestion', 'class' =>'active'),
				array('label'=> display('add_question'), 'url' => 'operator/Oquestion/add_question_form')
			);
		$this->template->full_operator_html_view($content,$sub_menu);
	}
	/*
	//* Form for add Class Name
	*/
	public function add_question_form()
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->library('loquestion');
		
        $content = $CI->loquestion->question_add_form();
       
        $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'operator/Oquestion'),
				array('label'=> display('add_question'), 'url' => 'operator/Oquestion/add_question_form','class' =>'active')
			);
		$this->template->full_operator_html_view($content,$sub_menu);
	}
	//Question search by chapter id
	public function question_search_by_chapter_id()
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->library('loquestion');
		$chapter_id=$this->input->post('chapter_id');
		
        $content = $CI->loquestion->question_search_by_chapter_id($chapter_id);
        $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'operator/Oquestion'),
				array('label'=> display('add_question'), 'url' => 'operator/Oquestion/add_question_form','class' =>'active')
			);
		$this->template->full_operator_html_view($content,$sub_menu);
	}
	// Submit Question and option form
	public function insert_question_and_option()
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->model('operator/Questions');		
		$CI->Questions->question_and_option_entry();
		
		$this->session->set_userdata(array('message'=>display('successfully_added_question')));

		redirect(base_url('operator/Oquestion/add_question_form'));
	}
	
	// Retrieve Option List to view on the Admin end
	public function view_question_option()
	{
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->model('operator/Questions');
		$question_id=$this->input->post('id');
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
					<th><center>".display('question')."</center></th>
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
	// Course Edit Form 
	public function question_edit_form($question_id)
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->library('loquestion');
		if($question_id ==''){
			redirect(base_url('operator/Oquestion'));
		}
		
        if($question_id ==''){
			redirect(base_url('tutor/tquestion'));
		}
        $content = $CI->loquestion->question_option_edit_data($question_id);
		$sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'operator/Oquestion'),
				array('label'=> display('add_question'), 'url' => 'operator/Oquestion/add_question_form'),
				array('label'=> display('edit_question'), 'url' => 'operator/Oquestion/question_edit_form','class' =>'active')
			);
			
		$this->template->full_operator_html_view($content,$sub_menu);
	}
	
	//Update Question and oprion
	public function question_and_option_update()
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->model('operator/Questions');		
		$CI->Questions->question_and_option_update();
		$this->session->set_userdata(array('message'=>display('successfully_update')));
		redirect(base_url('operator/Oquestion'));
	}
	// Insert single Options  form
	public function add_single_option_form($question_id='')
	{	
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		
		if($question_id ==''){
			redirect(base_url('operator/Oquestion'));
		}
		$data = array( 
			'title' => 'Add Single Option',
			'question_id' => $question_id,
			);
        $content = $this->parser->parse('operator_view/question_option/add_option_form',$data,true);
		
       $sub_menu = array(
				array('label'=> display('manage_question'), 'url' => 'operator/Oquestion'),
				array('label'=> display('add_question'), 'url' => 'operator/Oquestion/add_question_form'),
				array('label'=> display('add_question_option'), 'url' => 'operator/Oquestion/add_single_option_form','class' =>'active')
			);
			
		$this->template->full_operator_html_view($content,$sub_menu);
	}
	//
	public function insert_question_single_option(){
		$CI =& get_instance();
		$CI->auth->check_operator_auth();
		$CI->load->model('operator/Questions');		
		$CI->Questions->single_option_entry();
		
		if(isset($_POST['add-option'])){

		 	$this->session->set_userdata(array('message'=>display('successfully_option_add')));

			redirect(base_url('operator/Oquestion'));
			exit(); 
		}elseif(isset($_POST['add-option-another'])){	

			$this->session->set_userdata(array('message'=>display('successfully_option_add_another')));

			$question_id = $this->input->post('question_id');
			$this->add_single_option_form($question_id);			
		} 
	}
}