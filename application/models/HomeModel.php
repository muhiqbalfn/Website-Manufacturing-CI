<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class HomeModel extends CI_Model {

		/*public function get_hp($table){
			$query = $this->db->get($table);
			return $query->result();
		}

		public function add_hp($table,$dat){  
	        $result= $this->db->insert($table,$dat);
	        return $result;
	    }

		public function get_update_hp($id){
			$query=$this->db->query("SELECT*FROM tb_hp WHERE id_hp='$id'");
			if($query->num_rows()>0){
				foreach ($query->result() as $value) {
					$data=array(
						'id_hp'   => $value->id_hp,
						'merk'    => $value->merk,
						'tipe'    => $value->tipe,
						'warna'   => $value->warna,
						'harga'   => $value->harga,
						'gambar'  => $value->gambar
					);
				}
			}
			return $data;
		}

		public function update_hp($table,$dat,$id){
			$this->db->set($dat); //cek_coba
			$this->db->where($id);
			$this->db->update($table, $dat);
		}

		public function del_hp($id,$table){
			$this->db->where($id);
			$this->db->delete($table);
		}*/

	}


/* End of file HomeModel.php */
/* Location: ./application/models/HomeModel.php */