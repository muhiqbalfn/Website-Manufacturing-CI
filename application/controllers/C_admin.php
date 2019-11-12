<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends CI_Controller {

	function __construct(){ 
		parent::__construct(); 
		$this->load->model('M_grafik');

		
	} 

	public function index()
	{
		$data = array(
			'user' => $this->M_grafik->listUser(),
			'manufacturing_confirmed'=> $this->M_grafik->getManufacturingWhereStatus('confirmed'),
			'manufacturing_progress'=> $this->M_grafik->getManufacturingWhereStatus('progress'),
			'manufacturing_done'=> $this->M_grafik->getManufacturingWhereStatus('done'),
			'manuf_confirmed'=> $this->M_grafik->manufacturing_status('confirmed'),
			'manuf_progress'=> $this->M_grafik->manufacturing_status('progress'),
			'manuf_done'=> $this->M_grafik->manufacturing_status('done'),
			'manufacturing_count'=> $this->M_grafik->manufacturing_count(),
			'product_count'=> $this->M_grafik->product_count(),
			'bom_count'=> $this->M_grafik->bom_count(),
			'user_count'=> $this->M_grafik->user_count(),
			'manufacturing_jan' => $this->M_grafik->manufacturing_bln(1),
			'manufacturing_feb' => $this->M_grafik->manufacturing_bln(2),
			'manufacturing_mar' => $this->M_grafik->manufacturing_bln(3),
			'manufacturing_apr' => $this->M_grafik->manufacturing_bln(4),
			'manufacturing_mei' => $this->M_grafik->manufacturing_bln(5),
			'manufacturing_jun' => $this->M_grafik->manufacturing_bln(6),
			'manufacturing_jul' => $this->M_grafik->manufacturing_bln(7),
			'manufacturing_agu' => $this->M_grafik->manufacturing_bln(8),
			'manufacturing_sep' => $this->M_grafik->manufacturing_bln(9),
			'manufacturing_okt' => $this->M_grafik->manufacturing_bln(10),
			'manufacturing_nov' => $this->M_grafik->manufacturing_bln(11),
			'manufacturing_des' => $this->M_grafik->manufacturing_bln(12)
		);
		$this->load->view('grafik', $data);
	}


}
