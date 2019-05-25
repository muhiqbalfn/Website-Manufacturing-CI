<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class ProductCategoryModel extends CI_Model {

		public function get_data($table){
			$query = $this->db->get($table);
			return $query->result();
		}

		public function add_data($table,$dat){  
	        $result = $this->db->insert($table,$dat);
	        return $result;
	    }

	    public function get_update_data($id){
			$query=$this->db->query("SELECT*FROM tb_product_category WHERE id_product_category='$id'");
			if($query->num_rows()>0){
				foreach ($query->result() as $value) {
					$data=array(
						'id_product_category' => $value->id_product_category,
						'category_name' 	  => $value->category_name
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

	}


/* End of file ProductModel.php */
/* Location: ./application/models/ProductModel.php */