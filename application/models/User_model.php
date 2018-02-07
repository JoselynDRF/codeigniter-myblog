<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

  // Get current user
	public function getUser($dataUser) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $dataUser['username']);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
      $row = $query->row();

      // Check hash (password)
      if (password_verify($dataUser['password'], $row->password)) {
	    	return $row;
			} else {
			  return false;
			} 

    } else {
    	return false;
    }
	}
}

