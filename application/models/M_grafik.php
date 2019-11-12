<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_grafik extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	public function listUser()
	{
		$query=$this->db->query("SELECT * FROM tb_user LIMIT 5");
		return $query->result();
	}

	public function getUser()
	{
		$this->db->select('*');
        $this->db->from('tb_user');
        $query = $this->db->get();
        return $query->result();
	}

	//nampilin di tabel
	public function getManufacturingWhereStatus($where)
	{
		$this->db->SELECT('tb_product.*, tb_manufacturing.*');
		$this->db->FROM('tb_manufacturing');
		$this->db->join('tb_product','tb_product.id_product=tb_manufacturing.id_product');
		$this->db->WHERE('tb_manufacturing.status', $where);
		$query = $this->db->get();
		return $query->result();
	}

	//nampilin di pie
	public function manufacturing_status($where)
	{
		$this->db->SELECT('count(id_manufacturing) AS semua');
		$this->db->FROM('tb_manufacturing');
		$this->db->WHERE('status', $where);
		$query = $this->db->get();
		return $query->row();
	}
	
	//per bulan
	public function manufacturing_bln($month){
		$this->db->SELECT('SUM(qty) AS semua');
		$this->db->FROM('tb_manufacturing');
		$this->db->WHERE('MONTH(deadline_start)', $month);
		$query = $this->db->get();
		return $query->row();
	}

	//nampilin jml
	public function manufacturing_count()
	{
		$this->db->SELECT('count(id_manufacturing) AS semua');
		$this->db->FROM('tb_manufacturing');
		$query = $this->db->get();
		return $query->row();
	}

	//nampilin jml
	public function user_count()
	{
		$this->db->SELECT('count(id_user) AS semua');
		$this->db->FROM('tb_user');
		$query = $this->db->get();
		return $query->row();
	}

	//nampilin jml
	public function bom_count()
	{
		$this->db->SELECT('count(id_bom) AS semua');
		$this->db->FROM('tb_bom');
		$query = $this->db->get();
		return $query->row();
	}

	//nampilin jml
	public function product_count()
	{
		$this->db->SELECT('count(id_product) AS semua');
		$this->db->FROM('tb_product');
		$query = $this->db->get();
		return $query->row();
	}
}
?>