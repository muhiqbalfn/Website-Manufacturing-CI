<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ContactController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//--------------------------------------
		if (!$this->session->userdata('id_user')) 
		{
    	  redirect(base_url('LoginController'));
    	}
		//--------------------------------------
		$this->load->model('ContactModel');
	}

	public function index()
	{
		$this->load->view('contact');
	}


}