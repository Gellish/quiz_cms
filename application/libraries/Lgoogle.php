<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lgoogle {
	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function google_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Google_model');
		$google_list = $CI->Google_model->retrieve_google_list();
		
		$data = array(
				'title' => 'Google List',
				'google_list' => $google_list
			);
		
		$googleList = $CI->parser->parse('admin_view/google/google',$data,true);
		return $googleList;
	}
	//Google edit data
	public function google_edit_data($google_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Google_model');	

		$company_list = $CI->Google_model->google_list($google_id);
	
		$data = array(
			'title' => 'Edit Google',
			'google_id' => $company_list[0]['google_id'],
			'google_client_id' => $company_list[0]['google_client_id'],
			'google_secret_id' => $company_list[0]['google_secret_id'],
			'google_api_key' => $company_list[0]['google_api_key'],
		);

		$googleList = $CI->parser->parse('admin_view/google/edit_google_form',$data,true);
		return $googleList;
	}
}
?>