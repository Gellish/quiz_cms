<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lsetting {
	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function setting_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Settings');	

		$setting_list = $CI->Settings->setting_list();

		$data = array(
			'title' => 'Edit Setting',
			'id' => $setting_list[0]['id'],
			'language' => $setting_list[0]['language'],
			'logo' => $setting_list[0]['logo'],
			'favicon' => $setting_list[0]['favicon'],
			'copyright' => $setting_list[0]['copyright'],
			'back_image' => $setting_list[0]['back_image'],
			'link' => $setting_list[0]['link']
		);

		$companyList = $CI->parser->parse('admin_view/setting/edit_setting',$data,true);
		return $companyList;
	}
	//Footer image list
	public function footer_image_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Settings');	

		$setting_list = $CI->Settings->setting_list();

		$data = array(
			'title' => 'Edit Setting',
			'id' => $setting_list[0]['id'],
			'first_image' => $setting_list[0]['first_image'],
			'second_image' => $setting_list[0]['second_image'],
			'third_image' => $setting_list[0]['third_image'],
			'first_url' => $setting_list[0]['first_url'],
			'second_url' => $setting_list[0]['second_url'],
			'third_url' => $setting_list[0]['third_url'],
		);

		$companyList = $CI->parser->parse('admin_view/setting/edit_footer_image',$data,true);
		return $companyList;
	}


	//Add Advertisement
	public function add_advertisement()
	{
		$CI =& get_instance();	

	
		$data = array(
			'title' => 'Add Advertisement',
		);

		$advertisementList = $CI->parser->parse('admin_view/advertisement/add_advertisement',$data,true);
		return $advertisementList;
	}
	//Company edit data
	public function advertise_edit_data($add_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Settings');	

		$advertisement_list = $CI->Settings->advertise_list($add_id);

		foreach($advertisement_list as $k=>$val){
			if($add_id == $val['add_id']){
				$advertisement_list[$k]['selected']='selected="selected"';
			}
			else{
                $advertisement_list[$k]['selected']='';
            }
		}

		$data = array(
			'title' => 'Edit Advertisement',
			'add_id' => $advertisement_list[0]['add_id'],
			'add_position' => $advertisement_list[0]['add_position'],
			'add_code' => $advertisement_list[0]['add_code'],
			'add_status' => $advertisement_list[0]['add_status'],
			'selected' => $advertisement_list[$k]['selected']
		);

		$companyList = $CI->parser->parse('admin_view/advertisement/edit_advertisement_form',$data,true);
		return $companyList;
	}
}
?>