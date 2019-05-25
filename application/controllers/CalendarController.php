<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CalendarController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//--------------------------------------
		if (!$this->session->userdata('id_user')) 
		{
    	  redirect(base_url('LoginController'));
    	}
		//--------------------------------------
	}

	public function index()
	{
		$this->load->view('calendar');
	}

}