<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class BomModel extends CI_Model {

		public function get_data(){
			$this->db->select('*');
			$this->db->from('tb_bom');
			$this->db->join('tb_product','tb_bom.id_product=tb_product.id_product','inner');
			return $this->db->get()->result();
		}

		public function get_product_package(){
			$query = $this->db->query("SELECT*FROM tb_product WHERE id_product_category='2'");
			return $query->result();
		}

		public function add_data($table,$dat){  
	        $result = $this->db->insert($table,$dat);
	        return $result;
	    }

	    public function get_update_data($id){
			$query=$this->db->query("SELECT*FROM tb_bom WHERE id_bom='$id'");
			if($query->num_rows()>0){
				foreach ($query->result() as $value) {
					$data=array(
						'id_bom' 	 => $value->id_bom,
						'id_product' => $value->id_product,
						'qty_bom' 	 => $value->qty_bom,
						'reference'  => $value->reference,
						'bom_type' 	 => $value->bom_type
					);
				}
			}
			return $data;
		}

		public function update_data($table,$data,$id){
			$this->db->set($data);
			$this->db->where($id);
			$this->db->update($table,$data);
		}

	    public function del_data($id,$table){
			$this->db->where($id);
			$this->db->delete($table);
		}

		//=================================================================================
		//Detail BOM

		public function get_detail($id){
			$query = $this->db->query("SELECT*FROM tb_bom 
									   INNER JOIN tb_product ON tb_bom.id_product=tb_product.id_product
									   WHERE tb_bom.id_bom='$id'");
			return $query->result();
		}

		public function get_detail_product($id){
			$query = $this->db->query("SELECT*FROM id_detail_bom 
									   INNER JOIN tb_bom ON id_detail_bom.id_bom=tb_bom.id_bom
									   INNER JOIN tb_product ON id_detail_bom.id_product=tb_product.id_product
									   WHERE tb_bom.id_bom='$id'");
			return $query->result();
		}

		public function get_product_part(){
			$query = $this->db->query("SELECT*FROM tb_product WHERE id_product_category='1'");
			return $query->result();
		}

		public function add_detail_product($table,$dat){  
	        $result = $this->db->insert($table,$dat);
	        return $result;
	    }

	    public function del_detail_product($id,$table){
			$this->db->where($id);
			$this->db->delete($table);
		}

	}


/* End of file BomModel.php */
/* Location: ./application/models/BomModel.php */