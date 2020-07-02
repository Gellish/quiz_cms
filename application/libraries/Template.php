<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template {
	var $current_menu = 'home';
	function message_html()
	{
		$CI =& get_instance();
		$CI->load->library('parser');
		
		$message = '';
		$message_class = '';
		$html = '';
		
		if ( $CI->session->userdata('message') != '' )
		{
			$message = $CI->session->userdata('message');
			$message_class = 'alert-success';
		}
		
		if ( $CI->session->userdata('error_message') != '' )
		{
			$message = $CI->session->userdata('error_message');
			$message_class = 'alert-danger';
		}else if ( $CI->session->userdata('warning_message') != '' )
		{
			$message = $CI->session->userdata('warning_message');
			$message_class = 'alert-warning';
		}

		$data = array(
					'message' => $message,
					'message_class' => $message_class
				);

		if ( $message != '' )
			$html = $CI->parser->parse('admin_view/message',$data,true);

		$CI->session->unset_userdata('message');
		$CI->session->unset_userdata('error_message');
		$CI->session->unset_userdata('warning_message');

		return $html;
	}
	
	// Admin html View template
	public function full_admin_html_view($content,$sub_menu='')
	{
	
		$CI =& get_instance(); 
		$message = $this->message_html();
		$logged_info='';
		$top_menu='';
		
		if ($CI->auth->is_logged())
		{
			$menu_template = 'admin_view/include/top_menu';
			$logged_data = 'admin_view/include/admin_loggedin_info';
			//$full_name = $CI->auth->get_full_name();
		
			// parse menu
			$menu_data = array(
					'active' => $this->current_menu
				);
			$log_info = array(
					'email' => $CI->session->userdata('user_name'),
					'logout' => base_url().'admin/Admin_dashboard/logout'
				); 
			$top_menu = $CI->parser->parse($menu_template,$menu_data,true);
			$logged_info = $CI->parser->parse($logged_data,$log_info,true);
		}
		//Sub Menu
		if ( $sub_menu != '' )
		{
			// insert empty text to non assigned elments
			foreach($sub_menu as $k=>$sub){
				if(!isset($sub['title']))$sub_menu[$k]['title']='';
				if(!isset($sub['class']))$sub_menu[$k]['class']='';
			}
			$sub_menu = $CI->parser->parse('admin_view/include/sub_menu', array('sub_menu'=>$sub_menu), true);
		}

		$CI->load->model('admin/Company');
		$company_info=$CI->Company->retrieve_company_list();
		$data = array (
				'logindata' => $logged_info,
				'mainmenu' 	=> $top_menu,
				'sub_menu' 	=> $sub_menu,
				'content' 	=> $content,
				'msg_content' => $message,
				'company_info' => $company_info
			);
		$CI->parser->parse('admin_view/admin_html_template',$data);
	}
	
	//Operator Template
	public function full_operator_html_view($content,$sub_menu='')
	{
	
		$CI =& get_instance();
		$message = $this->message_html();
		$logged_info='';
		$top_menu='';
		
		if ($CI->auth->is_logged())
		{
			$menu_template = 'operator_view/include/top_menu';
			$logged_data = 'operator_view/include/operator_loggedin_info';
			//$full_name = $CI->auth->get_full_name();
		
			// parse menu
			$menu_data = array(
					'active' => $this->current_menu
				);
			$log_info = array(
					'email' => $CI->session->userdata('user_name'),
					'logout' => base_url().'operator/Operator_dashboard/logout'
				); 
			$top_menu = $CI->parser->parse($menu_template,$menu_data,true);
			$logged_info = $CI->parser->parse($logged_data,$log_info,true);
		}
		//Sub Menu
		if ( $sub_menu != '' )
		{
			// insert empty text to non assigned elments
			foreach($sub_menu as $k=>$sub){
				if(!isset($sub['title']))$sub_menu[$k]['title']='';
				if(!isset($sub['class']))$sub_menu[$k]['class']='';
			}
			$sub_menu = $CI->parser->parse('admin_view/include/sub_menu', array('sub_menu'=>$sub_menu), true);
		}
		$CI->load->model('admin/Company');
		$company_info=$CI->Company->retrieve_company_list();
		$data = array (
				'logindata' => $logged_info,
				'mainmenu' 	=> $top_menu,
				'sub_menu' 	=> $sub_menu,
				'content' 	=> $content,
				'msg_content' => $message,
				'company_info' => $company_info
			);
		$CI->parser->parse('operator_view/operator_html_template',$data);
	}
	//Tutor Template
	public function full_tutor_html_view($content,$sub_menu=''){
	
		$CI =& get_instance();
		$message = $this->message_html();
		$logged_info='';
		$top_menu='';
		
		if ($CI->auth->is_logged())
		{
			$menu_template = 'tutor_view/include/top_menu';
			$logged_data = 'tutor_view/include/tutor_loggedin_info';
			//$full_name = $CI->auth->get_full_name();
		
			// parse menu
			$menu_data = array(
					'active' => $this->current_menu
				);
			$log_info = array(
					'email' => $CI->session->userdata('user_name'),
					'logout' => base_url().'tutor/Tutor_dashboard/logout'
				); 
			$top_menu = $CI->parser->parse($menu_template,$menu_data,true);
			$logged_info = $CI->parser->parse($logged_data,$log_info,true);
		}
		//Sub Menu
		if ( $sub_menu != '' )
		{
			// insert empty text to non assigned elments
			foreach($sub_menu as $k=>$sub){
				if(!isset($sub['title']))$sub_menu[$k]['title']='';
				if(!isset($sub['class']))$sub_menu[$k]['class']='';
			}
			$sub_menu = $CI->parser->parse('admin_view/include/sub_menu', array('sub_menu'=>$sub_menu), true);
		}
		$CI->load->model('admin/Company');
		$company_info=$CI->Company->retrieve_company_list();
		$data = array (
				'logindata' => $logged_info,
				'mainmenu' 	=> $top_menu,
				'sub_menu' 	=> $sub_menu,
				'content' 	=> $content,
				'msg_content' => $message,
				'company_info' => $company_info
			);
		$CI->parser->parse('tutor_view/tutor_html_template',$data);
	}
	
	//Front Html View Template
	
	public function full_html_view($content){
		$CI =& get_instance();
		$CI->load->model('front/User_exam_infos');

		$logged_info = '';
 		if ($CI->auth->is_logged())
		{
			$view_page = 'front_view/include/user_loggedin_info';
			$total_exam_notify = $CI->User_exam_infos->get_total_exam_notification();			
			$log_info = array(
					'full_name' => $CI->session->userdata('full_name'),
					'logout_link' =>base_url()."front/Dashboard/logout",
					'schedule_exam_link' => base_url().'exam_schedule',
					'total_exam_notify' =>$total_exam_notify,
					'exam_stats_link' => base_url().'exam_statistics'
				); 
			$logged_info = $CI->parser->parse($view_page,$log_info,true);
		} 
		
		$CI->load->model('admin/Company');
		$company_info=$CI->Company->retrieve_company_list();
		$data = array (
				'content' => $content,
				'message' => $this->front_message_html(),
				'logged_info' => $logged_info,
				'company_info' => $company_info
			);
		$content = $CI->parser->parse('front_view/html_template',$data);
	}
	function front_message_html()
	{
		$CI =& get_instance();
		$CI->load->library('parser');
		
		$message = '';
		$message_class = '';
		$html = '';
		
		if ( $CI->session->userdata('message') != '' )
		{
			$message = $CI->session->userdata('message');
			$message_class = 'alert-success';
		}
		
		if ( $CI->session->userdata('error_message') != '' )
		{
			$message = $CI->session->userdata('error_message');
			$message_class = 'alert-danger';
		}else if ( $CI->session->userdata('warning_message') != '' )
		{
			$message = $CI->session->userdata('warning_message');
			$message_class = 'alert-warning';
		}

		$data = array(
					'message' => $message,
					'message_class' => $message_class
				);

		if ( $message != '' )
			$html = $CI->parser->parse('front_view/include/message',$data,true);

		$CI->session->unset_userdata('message');
		$CI->session->unset_userdata('error_message');
		$CI->session->unset_userdata('warning_message');

		return $html;
	}
}