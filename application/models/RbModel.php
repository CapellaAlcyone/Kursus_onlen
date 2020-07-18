<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RbModel extends CI_Model {

  public function getRbByMaker($id)
  {
    $query = "SELECT * FROM rb WHERE id_pengguna = '$id'";

    return $this->db->query($query)->result_array();
  }

  public function get_produk_kategori($kategori)
	{
		if($kategori>0)
			{
				$this->db->where('id_genre',$kategori);
			}
		$query = $this->db->get('kursus');
		return $query->result_array();
	}

	public function get_kategori_all()
	{
		$query = $this->db->get('genre');
		return $query->result_array();
	}

  public function insert_cart($data_cart)
	{
		$this->db->insert('keranjang', $data_cart);
	}

}
