<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class MoModel extends CI_Model {

		public function get_data(){
			$this->db->select('*');
			$this->db->from('tb_manufacturing');
			$this->db->join('tb_product','tb_manufacturing.id_product=tb_product.id_product','inner');
			$this->db->join('tb_user','tb_manufacturing.id_user=tb_user.id_user','inner');
			return $this->db->get()->result();
		}

		public function get_product_package(){
	        $this->db->from('tb_product');
	        $this->db->where('id_product_category','2');
	        return $this->db->get()->result();
		}

		public function get_bom(){
			$this->db->select('*');
			$this->db->from('tb_bom');
			$this->db->join('tb_product','tb_bom.id_product=tb_product.id_product','inner');
			return $this->db->get()->result();
		}

		public function get_user(){
			return $this->db->get('tb_user')->result();
		}

		public function add_data($table,$dat){  
	        return $this->db->insert($table,$dat);
	    }

		//CONFIRMED----------------------------------------------------------------------------
		public function get_data_confirmed($id){
			$this->db->select('*');
	        $this->db->from('tb_manufacturing');
	        $this->db->join('tb_product','tb_product.id_product=tb_manufacturing.id_product');
	        $this->db->join('tb_user','tb_user.id_user=tb_manufacturing.id_user');
	        $where = array('status' => 'Confirmed', 'id_manufacturing' => $id);
	        $this->db->where($where);
	        $this->db->order_by('id_manufacturing','desc');
	        return $this->db->get()->result();
		}

		public function get_data_confirmed_component($id){
			$query = $this->db->query("SELECT*FROM id_detail_bom 
									   INNER JOIN tb_bom ON id_detail_bom.id_bom=tb_bom.id_bom
									   INNER JOIN tb_product ON id_detail_bom.id_product=tb_product.id_product
									   INNER JOIN tb_manufacturing ON tb_bom.id_bom=tb_manufacturing.id_bom
									   WHERE tb_manufacturing.id_manufacturing='$id'");
			return $query->result();
		}

		public function get_data_id($id){
			$this->db->select('*');
	        $this->db->from('tb_manufacturing');
	        $this->db->join('tb_product','tb_product.id_product=tb_manufacturing.id_product');
	        $this->db->join('tb_user','tb_user.id_user=tb_manufacturing.id_user');
	        $this->db->where('id_manufacturing', $id);
	        return $this->db->get()->result();
		}

		public function get_detail_bom_id($id_bom) {
			$this->db->select('*');
	        $this->db->from('id_detail_bom');
	        $this->db->join('tb_product','tb_product.id_product=id_detail_bom.id_product');
	        $this->db->where('id_bom',$id_bom);
	        return $this->db->get()->result();
		}

		public function del_data_confirmed($id,$table){
			$this->db->where($id);
			$this->db->delete($table);
		}


		//PRODUCE -------------------------------------------------------------------------------
		public function updatestok($data, $id){
			$query = $this->db->query("UPDATE tb_product SET stok='$data' WHERE id_product='$id'");
		}

		public function get_product_where_id($id){
			$this->db->select('*');
	        $this->db->from('tb_product');
	        $this->db->where('id_product', $id);
	        return $this->db->get()->result();
		}

		public function updatestatus($data, $id){
			$query = $this->db->query("UPDATE tb_manufacturing SET status='$data' WHERE id_manufacturing='$id'");
		}

		public function get_data_produce($id){
			$this->db->select('*');
	        $this->db->from('tb_manufacturing');
	        $this->db->join('tb_product','tb_product.id_product=tb_manufacturing.id_product');
	        $this->db->join('tb_user','tb_user.id_user=tb_manufacturing.id_user');
	        $where = array('status' => 'In Progress', 'id_manufacturing' => $id);
	        $this->db->where($where);
	        $this->db->order_by('id_manufacturing','desc');
	        return $this->db->get()->result();
		}

		public function update_status($data,$id){
			$query = $this->db->query("UPDATE tb_manufacturing SET status='$data' WHERE id_manufacturing='$id'");
		}

		//DONE---------------------------------------------------------------------------------
		public function get_data_done($id){
			$this->db->select('*');
	        $this->db->from('tb_manufacturing');
	        $this->db->join('tb_product','tb_product.id_product=tb_manufacturing.id_product');
	        $this->db->join('tb_user','tb_user.id_user=tb_manufacturing.id_user');
	        $where = array('status' => 'Done', 'id_manufacturing' => $id);
	        $this->db->where($where);
	        $this->db->order_by('id_manufacturing','desc');
	        return $this->db->get()->result();
		}

	}


/* End of file MoModel.php */
/* Location: ./application/models/MoModel.php */