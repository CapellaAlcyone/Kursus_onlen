<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenreModel extends CI_Model {

	public function create()
	{
		$pengguna_id = $this->session->userdata('id');		
		$genre = $this->input->post('nama_genre');

		$query = "INSERT INTO `genre` VALUES('','$pengguna_id','$genre')";

		$this->db->query($query);
	}

	public function get()
	{		

		$query = "SELECT * FROM `genre`";

		return $this->db->query($query)->result_array();
	}

}
