<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lfacebook {
	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function fb_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Facebook_model');
		$fb_list = $CI->Facebook_model->retrieve_fb_list();
		
		$data = array(
				'title' => 'Facebook List',
				'fb_list' => $fb_list
			);
		
		$fbList = $CI->parser->parse('admin_view/facebook/facebook',$data,true);
		return $fbList;
	}
	//Facebook edit data
	public function fb_edit_data($fb_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Facebook_model');	

		$fb_list = $CI->Facebook_model->fb_list($fb_id);

		$data = array(
			'title' => 'Edit Facebook',
			'facebook_id' => $fb_list[0]['facebook_id'],
			'fb_app_id' => $fb_list[0]['fb_app_id'],
			'fb_app_secret' => $fb_list[0]['fb_app_secret'],
		);

		$fbList = $CI->parser->parse('admin_view/facebook/edit_fb_form',$data,true);
		return $fbList;
	}
}
?>