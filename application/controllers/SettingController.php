<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SettingController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//--------------------------------------
		if (!$this->session->userdata('id_user')) 
		{
    	  redirect(base_url('LoginController'));
    	}
		//--------------------------------------
		$this->load->model('SettingModel');
	}

	public function index()
	{
		$data['data'] = $this->SettingModel->get_data('tb_user');
		$this->load->view('setting',$data);
	}

	public function get_data(){
		$data['data'] = $this->SettingModel->get_data('tb_user');
		echo json_encode($data);
	}

	public function add_data(){
        $dat = array(
			'username' => $this->input->post('data1'),
			'email'	   => $this->input->post('data2'),
			'password' => $this->input->post('data3'),
			'phone'	   => $this->input->post('data4'),
			'address'  => $this->input->post('data5'),
			'level'	   => $this->input->post('data6')
		);
		$data = $this->SettingModel->add_data('tb_user',$dat);
		echo json_encode($data);
    }

    public function get_update_data(){
        $id   = $this->input->get('data1');
        $data = $this->SettingModel->get_update_data($id);
        echo json_encode($data);
    }

    public function update_data(){
		$dat = array(
			'username'   => $this->input->post('data2'),
			'email'		 => $this->input->post('data3'),
			'password'	 => $this->input->post('data4'),
			'phone'	     => $this->input->post('data5'),
			'address'	 => $this->input->post('data6'),
			'level'	     => $this->input->post('data7')
		);
		$id    = array('id_user' => $this->input->post('data1'));
		$data  = $this->SettingModel->update_data('tb_user',$dat,$id);
		echo json_encode($data);
	}

    public function del_data(){
		$id   = array('id_user' => $this->input->post('data1'));
		$data = $this->SettingModel->del_data($id,'tb_user');
		echo json_encode($data);
	}

}