<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
	}

	public function index()
	{
		$this->load->view('login');
	}
	
	public function login(){
		if(isset($_POST['login'])){
			$email     = $this->input->post('email',true);
			$password  = $this->input->post('password',true);
			$cek   	   = $this->LoginModel->login($email, $password);
			$hasil     = count($cek);
			if($hasil > 0)
			{
				$in   = $this->db->get_where('tb_user', array('email'=>$email, 'password' => $password))->row();
				$data = array('udhmasuk'  => true,
							  'id_user'   => $in->id_user,
							  'username'  => $in->username);
				
				$this->session->set_userdata($data);
				redirect(base_url('ProductController'));
			}
			else
			{
				redirect(base_url('LoginController'));
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('LoginController'));
	}

}