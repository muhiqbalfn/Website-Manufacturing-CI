<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class LoginModel extends CI_Model {

		public function login($email, $password){
			$this->db->where('email',$email);
			$this->db->where('password',$password);
			return $this->db->get('tb_user')->row();
		}		

	}


/* End of file BomModel.php */
/* Location: ./application/models/BomModel.php */