<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ccompany extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  $this->template->current_menu = 'company';
    }
    //Manage company page load
	public function index()
	{
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lcompany');
	
        $content = $CI->lcompany->company_list();
        $sub_menu = array(
				array('label'=> display('manage_company'), 'url' => 'admin/Ccompany', 'class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Operator Edit Form
	public function company_edit_form($company_id)
	{		
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->library('lcompany');
		
        $content = $CI->lcompany->company_edit_data($company_id);
		$sub_menu = array(
				array('label'=> display('manage_company'), 'url' => 'admin/Ccompany'),
				array('label'=> display('edit_company'), 'url' => 'admin/Ccompany','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
	//Update Operator
	public function update_company()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Company');
		
		$data=array(
			'company_id' => $this->input->post('company_id'),
			'company_name' => $this->input->post('company_name'), 
			'email' => $this->input->post('email'),  
			'address' => $this->input->post('address'),  
			'mobile' => $this->input->post('mobile'),  
			'website' => $this->input->post('website'),  
			);

		$CI->Company->update_company($data);

		$this->session->set_userdata(array('message'=> display('successfully_update')));

		redirect(base_url('admin/Ccompany'));
	}
	//Operator Staus Cahnge
	public function company_status_change()
	{	
		$CI =& get_instance();
		$CI->auth->check_admin_auth();
		$CI->load->model('admin/Company');
		$company_id =  $_POST['company_id'];
		$status = $CI->Company->change_company_status($company_id);
		$this->session->set_userdata(array('message'=> display('successfully_status_changed')));
		echo $status;
	}
}