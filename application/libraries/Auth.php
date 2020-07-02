<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {
	//Login....
	public function login($username,$password)
	{
		$CI =& get_instance();
		$CI->load->model('front/Sign_up');
		$present_url = '';
		$result = $CI->Sign_up->check_valid_user($username,$password);
		
        if ($result)
		{
			// codeigniter session stored data			
			$user_data = array(
				'user_id' 		=> $result[0]['user_id'],
				'user_name' 	=> $result[0]['email'],
				'usertype' 		=> $result[0]['user_type'],
				'full_name' 	=> $result[0]['user_name'],
				'image' 		=> (!empty($result[0]['image'])?$result[0]['image']:base_url('my-assets/images/user.png')),
				'logged_in' 	=> TRUE
			);
           $CI->session->set_userdata($user_data);
          //  return TRUE;
		  $present_url = $CI->session->userdata('present_url');
		  $CI->session->unset_userdata(array('present_url'=>""));
		  if($present_url ==''){
			$url = base_url().$result[0]['redirect_url'];
		  }else{
			$url = $present_url;
		  }
		  redirect($url,'refresh'); exit;
		}else{
			return FALSE;
        }
	}
	// Admin Login....
	public function admin_login( $username,$password )
	{
		$CI =& get_instance();
		$CI->load->model('front/Sign_up');
		$result = $CI->Sign_up->valid_admin_user_check($username,$password);
		
        if ($result)
		{
			// codeigniter session stored data			
			$user_data = array(
				'user_id' 		=> $result[0]['user_id'],
				'user_name' 	=> $result[0]['email'],
				'usertype' 		=> $result[0]['user_type'],
				'full_name' 	=> $result[0]['user_name'],
				'image' 		=> (!empty($result[0]['image'])?$result[0]['image']:base_url('my-assets/images/user.png')),
				'logged_in' 	=> TRUE
			);
           $CI->session->set_userdata($user_data);
          //  return TRUE;
		  $url = base_url()."admin/Admin_dashboard";
		  redirect($url,'refresh'); exit;
		}else{
			return FALSE;
        }
	}
	//Check if is logged....
	public function is_logged()
	{
		$CI =& get_instance();
        if($CI->session->userdata('user_id'))
		{
			return true;
		}
		return false;
	}
	//Logout....
	public function logout()
	{
		$CI =& get_instance();
		$newdata = array(
			'user_id'  		 => '',
			'user_name'   	 => '',
			'usertype'   	 => '',
			'logged_in' 	 => FALSE
			);
        $CI->session->sess_destroy($newdata);
		return true;
	}
	/*
	* Check for logged in user is Admin or not.
	*/
	public function is_admin()
	{
		$CI =& get_instance();
        if ($CI->session->userdata('usertype')=='super_admin')
		{
			return true;
		}
		return false;
	}
	
	///
	function check_admin_auth($url='')
	{   
        if($url==''){$url = base_url().'admin/Admin_dashboard/login';}
		$CI =& get_instance();
        if ((!$this->is_logged()) || (!$this->is_admin()))
		{ 
			$this->logout();
			$error = "You are not authorized for this part";
			$CI->session->set_userdata(array('error_message'=>$error));
            redirect($url,'refresh'); exit;
        }
	}
	public function is_operator()
	{
		$CI =& get_instance();
        if ($CI->session->userdata('usertype')=='operator')
		{
			return true;
		}
		return false;
	}
	///
	function check_operator_auth($url='')
	{   
        if($url==''){$url = base_url().'operator/Operator_dashboard/login';}
		$CI =& get_instance();
        if ((!$this->is_logged()) || (!$this->is_operator()))
		{ 
			$this->logout();
			$error = "You are not authorized for this part";
			$CI->session->set_userdata(array('error_message'=>$error));
            redirect($url,'refresh'); exit;
        }
	}
	public function is_tutor()
	{
		$CI =& get_instance();
        if ($CI->session->userdata('usertype')=='teacher')
		{
			return true;
		}
		return false;
	}
	///
	function check_tutor_auth($url='')
	{   
        if($url==''){$url = base_url().'tutor/Tutor_dashboard/login';}
		$CI =& get_instance();
        if ((!$this->is_logged()) || (!$this->is_tutor()))
		{ 
			$this->logout();
			$error = "You are not authorized for this part";
			$CI->session->set_userdata(array('error_message'=>$error));
            redirect($url,'refresh'); exit;
        }
	}
		//Check if is logged....
	public function is_not_logged_in()
	{
		$CI =& get_instance();
        if($CI->session->userdata('user_id'))
		{
			return true;
		}else{
			$present_url = current_url();
			$CI->session->set_userdata(array('present_url'=>$present_url));
			$CI->session->set_userdata(array('error_message'=>"Please login to access"));
			redirect(base_url('login'));exit();
		}
	}
}
?>