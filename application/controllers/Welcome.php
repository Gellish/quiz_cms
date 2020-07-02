<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	//This method redirect to front 
	public function index()
	{
		redirect(base_url('home'));
	}
	
}