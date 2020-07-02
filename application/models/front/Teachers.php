<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Teachers extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


}