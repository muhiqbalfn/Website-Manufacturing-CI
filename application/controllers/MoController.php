<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MoController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//--------------------------------------
		if (!$this->session->userdata('id_user')){
    	  redirect(base_url('LoginController'));
    	}
		//--------------------------------------
		$this->load->model('MoModel');
	}

	public function index(){
		$data['data'] = $this->MoModel->get_data();
		//CB---------------------------------------
		$data['product'] = $this->MoModel->get_product_package();
		$data['bom']     = $this->MoModel->get_bom();
		$data['user']    = $this->MoModel->get_user();
		//-----------------------------------------
		$this->load->view('mo',$data);
	}

	public function add_data(){
        $dat = array(
			'id_product' 	 => $this->input->post('data1'),
			'id_bom'	 	 => $this->input->post('data2'),
			'id_user'	 	 => $this->input->post('data3'),
			'qty'	 	 	 => $this->input->post('data4'),
			'deadline_start' => $this->input->post('data5'),
			'source'		 => $this->input->post('data6'),
			'status'	 	 => 'Confirmed'
		);
		$data = $this->MoModel->add_data('tb_manufacturing',$dat);
		echo json_encode($data);
	}

	public function get_update_data(){
        $id   = $this->input->get('data1');
        $data = $this->MoModel->get_update_data($id);
        echo json_encode($data);
    }

    public function update_data(){
		$dat = array(
			'qty'	 => $this->input->post('data2'),
			'deadline_start'	 => $this->input->post('data3')
		);
		$id   = array('id_manufacturing' => $this->input->post('data1'));
		$data  = $this->MoModel->update_data('tb_manufacturing',$dat,$id);
		echo json_encode($data);
	}

	//CONFIRMED-----------------------------------------------------
	public function get_data_confirmed($id){
		$data['data'] = $this->MoModel->get_data_confirmed($id);
		echo json_encode($data);
	}

	public function get_data_confirmed_component($id){
		$data['data'] = $this->MoModel->get_data_confirmed_component($id);
		echo json_encode($data);
	}

	public function go_confirmed($id){
		$data['id_mo'] = $id;
		$data['manufacturing'] = $this->MoModel->get_data_id($id);
		$mo_array = $this->MoModel->get_data_id($id);
		foreach($mo_array as $manufacturing){
		    $id_bom 	= $manufacturing->id_bom;
		    $id_product = $manufacturing->id_product;
		}
		$data['detail_bom'] = $this->MoModel->get_detail_bom_id($id_bom);
		$this->load->view('mo_confirmed',$data);
	}


	public function del_data_confirmed(){
		$id   = array('id_manufacturing' => $this->input->post('data1'));
		$data = $this->MoModel->del_data_confirmed($id,'tb_manufacturing');
		echo json_encode($data);
	}

	//PRODUCE--------------------------------------------------------
	public function produce(){
		$id_manufacturing = $this->input->post('id_manufacturing');
		$id_product 	  = $this->input->post('id_product');
		$id_bom 		  = $this->input->post('id_bom');
		$qty 			  = $this->input->post('qty');

		//Update Stok Produk Part
		$detail_bom = $this->MoModel->get_detail_bom_id($id_bom);
		foreach ($detail_bom as $key => $value) {
			$consumed   = $qty * $value->qty_detail;
			$newstok    = $value->stok - $consumed;
			$updatestok = $this->MoModel->updatestok($newstok, $value->id_product);
		}

		//Update Stok Produk Package
		$product_array = $this->MoModel->get_product_where_id($id_product);
		foreach($product_array as $product){
		    $stok = $product->stok;
		}
		$stokman = $stok + $qty;
		$updatestok = $this->MoModel->updatestok($stokman, $id_product);

		//Update Status
		$status = "In Progress";
		$updatestatus = $this->MoModel->updatestatus($status, $id_manufacturing);
		redirect('MoController');
	}

	public function get_data_produce($id){
		$data['data'] = $this->MoModel->get_data_produce($id);
		echo json_encode($data);
	}

	public function get_data_produce_component($id){
		$data['data'] = $this->MoModel->get_data_confirmed_component($id);
		echo json_encode($data);
	}

	public function go_produce($id){
		$data['id_mo'] = $id;
		$this->load->view('mo_produce',$data);
	}

	//DONE--------------------------------------------------------------------
	public function done($id) {
		$status = "Done";
		$updatestatus = $this->MoModel->update_status($status, $id);
		redirect('MoController');
	}

	public function get_data_done($id){
		$data['data'] = $this->MoModel->get_data_done($id);
		echo json_encode($data);
	}

	public function go_done($id){
		$data['id_mo'] = $id;
		$this->load->view('mo_done',$data);
	}

}