<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cgoogle extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  $this->template->current_menu = 'google';
    }
    //Manage google page
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lgoogle');
	
        $content = $CI->lgoogle->google_list();
        $sub_menu = array(
				array('label'=> display('manage_google'), 'url' => 'admin/Cgoogle', 'class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Google Edit Form
	public function google_edit_form($google_id)
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lgoogle');
		
        $content = $CI->lgoogle->google_edit_data($google_id);
		$sub_menu = array(
				array('label'=> display('manage_google'), 'url' => 'admin/Cgoogle'),
				array('label'=> display('edit_google'), 'url' => 'admin/Cgoogle','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Update Google
	public function update_google()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Google_model');
		
		$data=array(
			'google_id' => $this->input->post('google_id'),
			'google_client_id' => $this->input->post('google_client_id'), 
			'google_secret_id' => $this->input->post('google_secret_id'),  
			'google_api_key' => $this->input->post('google_api_key'),  
			);

		$CI->Google_model->update_google($data);
		$this->session->set_userdata(array('message'=> display('successfully_update')));

		redirect(base_url('admin/Cgoogle'));
	}
}