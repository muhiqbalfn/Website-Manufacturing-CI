<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//--------------------------------------
		if (!$this->session->userdata('id_user')){
    	  redirect(base_url('LoginController'));
    	}
		//--------------------------------------
		$this->load->model('ProductModel');
	}

	public function index(){
		$data['data'] = $this->ProductModel->get_data();
		//cb---------------------------------
		$data['ctg'] = $this->ProductModel->get_ctg();
		//-----------------------------------
		$this->load->view('product',$data);
	}

	public function get_data(){
		$data['data'] = $this->ProductModel->get_data();
		echo json_encode($data);
	}

	public function add_data(){
        $config['upload_path']="./assets/img/product";
        $config['allowed_types']='gif|jpg|png';
        //$config['encrypt_name'] = TRUE;
        
        $this->load->library('upload',$config);
        if($this->upload->do_upload('foto_productku')){
            $data = array('upload_data' => $this->upload->data());
            $dat  = array(
				'id_product_category' => $this->input->post('id_product_category'),
				'product_name' 	  	  => $this->input->post('product_name'),
				'type'	  			  => $this->input->post('type'),
				'internal_reference'  => $this->input->post('internal_reference'),
				'barcode'	  		  => $this->input->post('barcode'),
				'sales_price'	  	  => $this->input->post('sales_price'),
				'id_tax'	  		  => $this->input->post('id_tax'),
				'cost'	  			  => $this->input->post('cost'),
				'stok'	  			  => $this->input->post('stok'),
				'internal_notes'	  => $this->input->post('internal_notes'),
				'foto_product'  	  => $data['upload_data']['file_name']
			);
            $result = $this->ProductModel->add_data('tb_product',$dat);
            echo json_decode($result);
        }
    }

    public function get_update_data(){
        $id   = $this->input->get('data1');
        $data = $this->ProductModel->get_update_data($id);
        echo json_encode($data);
    }

    public function update_data(){
		$dat = array(
			'id_product_category' 	=> $this->input->post('data2'),
			'product_name'	  		=> $this->input->post('data3'),
			'type' 					=> $this->input->post('data4'),
			'internal_reference'	=> $this->input->post('data5'),
			'barcode'	  			=> $this->input->post('data6'),
			'sales_price' 	  		=> $this->input->post('data7'),
			'id_tax'	  			=> $this->input->post('data8'),
			'cost' 					=> $this->input->post('data9'),
			'stok'	  				=> $this->input->post('data10'),
			'internal_notes'	  	=> $this->input->post('data11'),
			'foto_product'  		=> $this->input->post('data12')
		);
		$id   = array('id_product' => $this->input->post('data1'));
		$data  = $this->ProductModel->update_data('tb_product',$dat,$id);
		echo json_encode($data);
	}

    /*public function update_data(){
    	$config['upload_path']="./assets/img/product";
        $config['allowed_types']='gif|jpg|png';
        //$config['encrypt_name'] = TRUE;
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload('data12')){
            $data = array('upload_data' => $this->upload->data());
            $dat  = array(
				'id_product_category' 	=> $this->input->post('data2'),
				'product_name'	  		=> $this->input->post('data3'),
				'type' 					=> $this->input->post('data4'),
				'internal_reference'	=> $this->input->post('data5'),
				'barcode'	  			=> $this->input->post('data6'),
				'sales_price' 	  		=> $this->input->post('data7'),
				'id_tax'	  			=> $this->input->post('data8'),
				'cost' 					=> $this->input->post('data9'),
				'stok'	  				=> $this->input->post('data10'),
				'internal_notes'	  	=> $this->input->post('data11'),
				'foto_product'  		=> $data['upload_data']['file_name']
			);
            $id   = array('id_product' => $this->input->post('data1'));
			$result = $this->ProductModel->update_data('tb_product',$dat,$id);
            echo json_decode($result);
        }
	}*/

	public function del_data(){
		$id   = array('id_product' => $this->input->post('id'));
		$data = $this->ProductModel->del_data($id,'tb_product');
		echo json_encode($data);
	}

}