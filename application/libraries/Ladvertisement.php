<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ladvertisement {
	/*
	** Retrieve  Class List From DB to View Class Menu
	*/
	public function advertisement_list()
	{
		$CI =& get_instance();
		$CI->load->model('admin/Advertisement');
		$advertisement_list = $CI->Advertisement->retrieve_advertisement_list();

		if(!empty($advertisement_list)){
			$id=1;
			foreach($advertisement_list as $k=>$val){
				$advertisement_list[$k]['id']=$id;
				if($val['add_status']==1){
					$advertisement_list[$k]['btn_class']="btn btn-info btn-sm";
					$advertisement_list[$k]['class']="glyphicon glyphicon-ok";
					$advertisement_list[$k]['add_status']=display('active');
				}
				else if($val['add_status']==0){
					$advertisement_list[$k]['btn_class']="btn btn-danger btn-sm";
					$advertisement_list[$k]['class']="glyphicon glyphicon-remove";
					$advertisement_list[$k]['add_status']=display('inactive');
				}
				else{
					$advertisement_list[$k]['class']='';
				}
			}
		
			$i = 0;
			foreach($advertisement_list as $key=>$val){$i++;
				$advertisement_list[$key]['sl'] = $i;
			}
		}

		$data = array(
				'title' => 'Advertisement List',
				'advertisement_list' => $advertisement_list
			);
		
		$companyList = $CI->parser->parse('admin_view/advertisement/advertisement',$data,true);
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
		$CI->load->model('admin/Advertisement');	

		$advertisement_list = $CI->Advertisement->advertise_list($add_id);

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