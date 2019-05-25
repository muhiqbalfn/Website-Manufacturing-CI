<?php defined('BASEPATH') OR exit('No direct script access allowed');

class BomController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//--------------------------------------
		if (!$this->session->userdata('id_user')) 
		{
    	  redirect(base_url('LoginController'));
    	}
		//--------------------------------------
		$this->load->model('BomModel');
	}

	public function index(){
		$data['data'] = $this->BomModel->get_data();
		//cb---------------------------------
		$data['product'] = $this->BomModel->get_product_package();
		//-----------------------------------
		$this->load->view('bom',$data);
	}

	public function get_data(){
		$data['data'] = $this->BomModel->get_data();
		echo json_encode($data);
	}

	public function add_data(){
        $dat = array(
			'id_product' => $this->input->post('data1'),
			'qty_bom'		 => $this->input->post('data2'),
			'reference'	 => $this->input->post('data3'),
			'bom_type'	 => $this->input->post('data4')
		);
		$data = $this->BomModel->add_data('tb_bom',$dat);
		echo json_encode($data);
    }

    public function get_update_data(){
        $id   = $this->input->get('data1');
        $data = $this->BomModel->get_update_data($id);
        echo json_encode($data);
    }

    public function update_data(){
		$dat = array(
			'id_product' => $this->input->post('data2'),
			'qty_bom'		 => $this->input->post('data3'),
			'reference'	 => $this->input->post('data4'),
			'bom_type'	 => $this->input->post('data5')
		);
		$id   = array('id_bom' => $this->input->post('data1'));
		$data  = $this->BomModel->update_data('tb_bom',$dat,$id);
		echo json_encode($data);
	}

    public function del_data(){
		$id   = array('id_bom' => $this->input->post('data1'));
		$data = $this->BomModel->del_data($id,'tb_bom');
		echo json_encode($data);
	}

	//=========================================================================
	//Detail BOM

	public function get_detail($id){
		$data['datas'] = $this->BomModel->get_detail($id);
		$data['kode'] = $id;
		//cb---------------------------------
		$data['product'] = $this->BomModel->get_product_part();
		//-----------------------------------
		$this->load->view('bomDetail',$data);
	}

	public function get_detail_product($id){
		$data['data'] = $this->BomModel->get_detail_product($id);
		echo json_encode($data);
	}

	public function add_detail_product(){
        $dat = array(
			'id_bom' 	  => $this->input->post('data1'),
			'id_product'  => $this->input->post('data2'),
			'qty_detail'	 	  => $this->input->post('data3')
		);
		$data = $this->BomModel->add_detail_product('id_detail_bom',$dat);
		echo json_encode($data);
    }

    public function del_detail_product(){
		$id   = array('id_detail_bom' => $this->input->post('data1'));
		$data = $this->BomModel->del_detail_product($id,'id_detail_bom');
		echo json_encode($data);
	}

}