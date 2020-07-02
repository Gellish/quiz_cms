<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {
	public $message;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('front/Sign_up');
	}
	public function index()
	{
		$CI =& get_instance();		
		if ($CI->auth->is_logged() )
		{
			$CI->session->set_userdata(array('warning_message'=>display('you_already_logged_in')));
			redirect(base_url());exit();
		}
		  
		$html_page = "front_view/signin_signup/signup";
		$content = $CI->parser->parse($html_page,$data = array('title'=>"Sign Up",'signup'=>"signup"),true);	
		$CI->template->full_html_view( $content );
		
	}
	//Email-Exists Check
	function register_email_exists()
	{
	 	$CI =& get_instance();
		$CI->load->model('front/Sign_up');
		$enter_email =  $_POST['username'];
		if( $CI->Sign_up->email_existancy_check( $enter_email )== TRUE ){
		  echo json_encode(false);
		}else{
		  echo json_encode(true);
		}
	}
	//Submit user registration
	public function submit_user_registration()
	{
		$CI =& get_instance();
		$CI->load->model('front/Sign_up');
		
		$email  	=   $CI->input->post('username');
		$password  	=   md5("gef_quize".$CI->input->post('password'));
		$user_type  =   $this->input->post('user_type');
		
		$activation_code = md5(mt_rand(10000,99999).time()."$email");
		$user_id =$this->generator($length=20);
		$access_url = null;
		$status = 0;

		if($user_type == 'teacher'){
			$access_url = 'tutor/Tutor_dashboard';
			$status = 2;
		}

		if ($_FILES['image']['name']) {
			//Student add start
			$config['upload_path']          = './my-assets/images/student_image/';
	        $config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
	        $config['encrypt_name'] 		= TRUE;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('image'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_userdata(array('message'=> display('image_not_upload')));
	            redirect(base_url('signup'));
	        }
	        else
	        {
	            if ($image =$this->upload->data()) {
					$imagepath = base_url().'my-assets/images/student_image/'.$image['file_name'];
				}
			}
		}
			
		$login_data = array(
			'user_id' 			=> $user_id,
			'email' 			=> $CI->input->post('username'),
			'password' 			=> md5("gef_quize".$CI->input->post('password')),
			'redirect_url'		=> $access_url,
			'user_type' 		=> $user_type,
			'activation_code' 	=> $activation_code,
			'status' 			=> $status
			);
			
		$user_data = array(
			'user_id' 		=> $user_id,
			'user_name' 	=> $CI->input->post('full_name'),
			'mobile_no' 	=> $CI->input->post('mobile'),
			'image'			=> (!empty($imagepath)?$imagepath:base_url('my-assets/images/user.png')),
			'others'		=> ''
			);
			
		$CI->Sign_up->save_registration_data( $login_data,$user_data );
		
		if($user_type == 'teacher'){
			$CI->session->set_userdata(array('message'=>display('sign_up_registration_message')));
			redirect(base_url('signup'));exit();
		}elseif($user_type == 'student' || $user_type == 'others'){

			$this->send_activation_code($email,$password,$activation_code);

			$CI->session->set_userdata(array('message'=>display('sign_up_registration_message')));
			redirect(base_url('signup'));exit();
		}
	}
	//Send Activation Code
	public function send_activation_code($email,$password,$activation_code)
	{	
		$CI =& get_instance();
		$CI->load->library('email');
		
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
	
		$this->email->initialize($config);
		$this->email->from('admin@admin.com', 'Demo Test');
		$this->email->to($email);
		$this->email->cc('another@another-example.com');
		$this->email->bcc('them@their-example.com');

		$this->email->subject('Email Activation');

		$message = "<p>This email has been sent as a activate your account</p>";
       	$message .= "<p>Dear User please click here <a href='".base_url()."front/Signup/account_activation/$activation_code'>Click here </a>to activate your account. Thanks, Team.
                            if not, then ignore</p>";
		
		// send e-mail verification
		$this->email->message($message);
		$this->email->send();
		$CI->session->set_userdata(array('message'=>display('sign_up_registration_message')));
		redirect(base_url('signup'));exit();
	}

	public function account_activation()
	{	
		$CI =& get_instance();
		$CI->load->model('front/Sign_up');
	    $register_code = $this->uri->segment(4);
		if ($register_code == ''){
			
			$CI->session->set_userdata(array('warning_message'=>display('no_registration_code')));
			redirect(base_url());exit();
		}
		$reg_confirm = $CI->Sign_up->confirm_registration($register_code);
		//$this->output->enable_profiler(1);
		if($reg_confirm){
			$CI->session->set_userdata(array('message'=>display('your_account_successfully_activated')));
			redirect(base_url());exit();
		}
		else {
			$CI->session->set_userdata(array('warning_message'=>display('you_fail_to_registerd')));
			redirect(base_url());exit();
		}  
	}
	
	public function signin()
	{
		$CI =& get_instance();
		if ($CI->auth->is_logged() )
		{
			$CI->session->set_userdata(array('warning_message'=>"You have already logged in"));
			redirect(base_url());exit();
		}
		$html_page = "front_view/signin_signup/signin";
		$content = $CI->parser->parse($html_page,$data = array('title'=>"Sign In",'signin'=>"signin"),true);	
		$CI->template->full_html_view( $content );
		
	}

	//Facebook Login 
	public function fb_login() {
		$CI =& get_instance();
		$CI->load->model('front/Sign_up');
		$data['user'] = array();

		// Check if user is logged in
		if ($this->facebook->is_authenticated()) {

			// User logged in, get user details
			$user = $this->facebook->request('get', '/me?fields=id, name, email, about, age_range, birthday, cover, education, gender, hometown, languages, relationship_status, religion, photos, picture');

			$data['user'] = $user;
			$name = $data['user']['name'];
			$email = $data['user']['email'];
			$image = $data['user']['picture']['data']['url'];
			$password  	=   md5("gef_quize"."123");
			$user_type  =   "student";
			$activation_code = md5(mt_rand(10000,99999).time().$email);
			$user_id =$this->generator($length=20);
			$access_url = null;
			$status = 1;

			$login_data = array(
				'user_id' 			=> $user_id,
				'email' 			=> $email,
				'password' 			=> $password,
				'redirect_url'		=> $access_url,
				'user_type' 		=> $user_type,
				'activation_code' 	=> $activation_code,
				'status' 			=> $status
			);

			$user_data = array(
				'user_id' 		=> $user_id,
				'user_name' 	=> $name,
				'mobile_no' 	=> null,
				'image'			=> $image,
				'others'		=> ''
			);

			$email_check = $this->Sign_up->email_check('client_user_login', $email);

			if ($email_check == TRUE) {
				$session_user_data = array(
					'user_id' 		=> $email_check->user_id,
					'user_name' 	=> $email_check->email,
					'usertype' 		=> $email_check->user_type,
					'full_name' 	=> $email_check->user_name,
					'image' 		=> $email_check->image,
					'redirect' 		=> $email_check->redirect_url,
					'logged_in' 	=> TRUE,
				);
				$CI->session->set_userdata($session_user_data);
				redirect($session_user_data['redirect']);
			}else{
				$result=$CI->Sign_up->save_registration_data( $login_data,$user_data );

				if ($result) {
					$resultnew=$this->Sign_up->view_data_by_id_user('client_user_login',$email);
					
					$session_user_data = array(
						'user_id' 		=> $resultnew->user_id,
						'user_name' 	=> $resultnew->email,
						'usertype' 		=> $resultnew->user_type,
						'full_name' 	=> $resultnew->user_name,
						'image' 		=> $image,
						'redirect' 		=> $resultnew->redirect_url,
						'logged_in' 	=> TRUE,
					);

					$this->session->set_userdata($session_user_data);
				} else {
					$sdata['message'] = "You are not log in.";
					$this->session->set_userdata($sdata);
				}
				redirect(base_url());
			}
		}
	}
	#===============Login by gmail================#
	public function gmail_login() {
		//Google plus login
		if (isset($_GET['code'])) {
			$this->googleplus->getAuthenticate();
			$this->session->set_userdata('login', true);
			$this->session->set_userdata('user_profile', $this->googleplus->getUserInfo());

			$name  = $_SESSION['user_profile']['name'];
			$email = $_SESSION['user_profile']['email'];
			$image = $_SESSION['user_profile']['picture'];
			$password  	=   md5("gef_quize"."123");
			$user_type  =   "student";
			$activation_code = md5(mt_rand(10000,99999).time().$email);
			$user_id =$this->generator($length=20);
			$access_url = null;
			$status = 1;

			$login_data = array(
				'user_id' 			=> $user_id,
				'email' 			=> $email,
				'password' 			=> $password,
				'redirect_url'		=> $access_url,
				'user_type' 		=> $user_type,
				'activation_code' 	=> $activation_code,
				'status' 			=> $status
			);

			$user_data = array(
				'user_id' 		=> $user_id,
				'user_name' 	=> $name,
				'mobile_no' 	=> null,
				'image'			=> $image,
				'others'		=> ''
			);

			$email_check = $this->Sign_up->email_check('client_user_login', $email);

			if ($email_check == TRUE) {
				$session_user_data = array(
					'user_id' 		=> $email_check->user_id,
					'user_name' 	=> $email_check->email,
					'usertype' 		=> $email_check->user_type,
					'full_name' 	=> $email_check->user_name,
					'image' 	=> $email_check->image,
					'redirect' 		=> $email_check->redirect_url,
					'logged_in' 	=> TRUE,
				);
				$this->session->set_userdata($session_user_data);
				redirect($session_user_data['redirect']);
			}else{
				$result=$this->Sign_up->save_registration_data( $login_data,$user_data );

				if ($result) {
					$resultnew=$this->Sign_up->view_data_by_id_user('client_user_login',$email);
					$session_user_data = array(
						'user_id' 		=> $resultnew->user_id,
						'user_name' 	=> $resultnew->email,
						'usertype' 		=> $resultnew->user_type,
						'full_name' 	=> $resultnew->user_name,
						'image' 	=> $resultnew->image,
						'redirect' 		=> $resultnew->redirect_url,
						'logged_in' 	=> TRUE,
					);
					$this->session->set_userdata($session_user_data);
				} else {
					$sdata['message'] = "You are not log in.";
					$this->session->set_userdata($sdata);
				}
				redirect(base_url());
			}
		}
	}

	//Do login
	public function do_login()
	{	
		//$this->load->model('Users');
		$error = '';
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ( $username == '' || $password == '' || $this->auth->login($username, $password) === FALSE )
		{
			$error = 'Wrong user name or password !';
		}
		if ( $error != '' )
		{
			$this->session->set_userdata(array('error_message'=>$error));
			$this->output->set_header("Location: ".base_url('login'), TRUE, 302);
		}else{
			$this->output->set_header("Location: ".base_url(), TRUE, 302);
        }
	}
	// Forgot Password
	public function forgot_password()
	{
		$data['title']= 'Forgot Password';
		$data['msg']= $this->message;
		$this->load->view('front_view/forgot_password',$data);
	}
	//Check New Email For Forgot Pass
	public function checkNew_emailFor_forgotPass()
	{
		$email =  $_POST['email'];
		$result= $this->login_model->forgot_pass($email);
		if($result){
			foreach($result as $row)
			{
				echo json_encode($row);
		
			}
		}	
	}
	// Check valid New Password
	public function check_valid_NewPass()
	{
		$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|alpha_numeric|min_length[6]|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->forgot_password();
		}else{
			$email = $this->input->post('hideEmail',TRUE);
			$password=md5('gefera'.$this->input->post('new_pass',TRUE));
			
			$encrypt_pass = $email.'-'.$password;
			$encrypt_pass = base64_encode($encrypt_pass);
			
			$this->sendNewto_userEmail($email,$encrypt_pass);
		}
	
	}
	//Send new Pass To User Email
	public function sendNewto_userEmail($email,$encrypt_pass)
    {
		$email_link = '<a href="http://www.quize.gefedu.com/frontview_control/login/replace_pasword/'.$encrypt_pass.'">Reset Password</a>';
		$this->load->library('email');
		$this->email->from('maamun7@gmail.com', 'Mamun');
		$this->email->to($email);
		$this->email->subject('Registration Confirmation');
		$this->email->message("$email_link");
		$this->email->send();
		//echo 'Click the below link to reset your password <br/>'.anchor('http://localhost/gefera/mamun/frontview_control/login/replace_pasword/'.$encrypt_pass,'Reset Password');
    }
	//Replace Pasword
	public function replace_pasword()
    {  
		$register_code = $this->uri->segment(4);
		$register_code = base64_decode($register_code);
		list($email,$password) = explode("-",$register_code);
		$this->login_model->replace_pasword($email,$password);
		redirect('home');
    } 
	//ID Generator
	public function generator($lenth)
	{
		$number=array("A","B","C","D","E","F","G","H","I","J","K","L","N","M","O","P","Q","R","S","U","V","T","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0");
		
		for($i=0; $i<$lenth; $i++)
		{
			$rand_value=rand(0,61);
			$rand_number=$number["$rand_value"];
		
			if(empty($con))
			{ 
			$con=$rand_number;
			}
			else
			{
			$con="$con"."$rand_number";}
			}
		return $con;
	}
}
