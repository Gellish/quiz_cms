<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lcompany {
	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function company_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Company');
		$company_list = $CI->Company->retrieve_company_list();

		if(!empty($company_list)){
			foreach($company_list as $k=>$val){
				if($val['status']==1){
					$company_list[$k]['class']="fa fa-check";
				}
				else if($val['status']==0){
					$company_list[$k]['class']="fa fa-times-circle";
				}
				else{
					$company_list[$k]['class']='';
				}
			}
			$i = 0;
			foreach($company_list as $key=>$val){$i++;
				$company_list[$key]['sl'] = $i;
			}
		}
		
		$data = array(
				'title' => 'Company List',
				'company_list' => $company_list
			);
		
		$companyList = $CI->parser->parse('admin_view/company/company',$data,true);
		return $companyList;
	}
	//Company edit data
	public function company_edit_data($company_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/Company');	

		$company_list = $CI->Company->company_list($company_id);
	
		$data = array(
			'title' => 'Edit Company',
			'company_id' => $company_list[0]['company_id'],
			'company_name' => $company_list[0]['company_name'],
			'email' => $company_list[0]['email'],
			'address' => $company_list[0]['address'],
			'mobile' => $company_list[0]['mobile'],
			'website' => $company_list[0]['website']
		);

		$companyList = $CI->parser->parse('admin_view/company/edit_company_form',$data,true);
		return $companyList;
	}
}
?>