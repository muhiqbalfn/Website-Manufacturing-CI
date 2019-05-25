<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class ProductModel extends CI_Model {

		public function get_data(){
			$this->db->select('*');
			$this->db->from('tb_product');
			$this->db->join('tb_product_category','tb_product.id_product_category=tb_product_category.id_product_category','inner');
			$this->db->join('tb_tax','tb_product.id_tax=tb_tax.id_tax','inner');
			return $this->db->get()->result();
		}

		public function add_data($table,$dat){  
	        $result = $this->db->insert($table,$dat);
	        return $result;
	    }

	    public function get_update_data($id){
			$query=$this->db->query("SELECT*FROM tb_product WHERE id_product='$id'");
			if($query->num_rows()>0){
				foreach ($query->result() as $value) {
					$data=array(
						'id_product'          => $value->id_product,
						'id_product_category' => $value->id_product_category,
						'product_name'    	  => $value->product_name,
						'type'   			  => $value->type,
						'internal_reference'  => $value->internal_reference,
						'barcode'  			  => $value->barcode,
						'sales_price'  		  => $value->sales_price,
						'id_tax'  			  => $value->id_tax,
						'cost'  			  => $value->cost,
						'stok'  			  => $value->stok,
						'internal_notes'  	  => $value->internal_notes,
						'foto_product'  	  => $value->foto_product
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

		public function get_ctg(){
			return $this->db->get('tb_product_category')->result();
		}

	}


/* End of file ProductModel.php */
/* Location: ./application/models/ProductModel.php */