<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProductCategoryController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//--------------------------------------
		if (!$this->session->userdata('id_user')) {
    	  redirect(base_url('LoginController'));
    	}
		//--------------------------------------
		$this->load->model('ProductCategoryModel');
	}

	public function index(){
		$this->load->view('productCategory');
	}

	public function get_data(){
		$data['data'] = $this->ProductCategoryModel->get_data('tb_product_category');
		echo json_encode($data);
	}

	public function add_data(){
        $dat = array(
			'category_name'	=> $this->input->post('data1')
		);
		$data = $this->ProductCategoryModel->add_data('tb_product_category',$dat);
		echo json_encode($data);
    }

    public function get_update_data(){
        $id   = $this->input->get('data1');
        $data = $this->ProductCategoryModel->get_update_data($id);
        echo json_encode($data);
    }

    public function update_data(){
		$dat = array(
			'category_name'	=> $this->input->post('data2')
		);
		$id   = array('id_product_category' => $this->input->post('data1'));
		$data  = $this->ProductCategoryModel->update_data('tb_product_category',$dat, $id);
		echo json_encode($data);
	}

	public function del_data(){
		$id   = array('id_product_category' => $this->input->post('data1'));
		$data = $this->ProductCategoryModel->del_data($id,'tb_product_category');
		echo json_encode($data);
	}

}