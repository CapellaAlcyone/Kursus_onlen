<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CourseModel extends CI_Model {

	public function getCourseByMaker($id)
	{
		$query = "SELECT `kursus`.*, `genre`.`nama_genre`
					FROM `kursus` JOIN `genre`
						ON `genre`.`id` = `kursus`.`id_genre`
							WHERE `kursus`.`id_pengguna` = '$id'";

		return $this->db->query($query)->result_array();
	}

	public function getCourseByID($idKursus)
	{
		$query = "SELECT * FROM `kursus` WHERE id_kursus = '$idKursus'";

		return $this->db->query($query)->result_array();
	}

	public function getMateriByID($id)
	{
		// var_dump($id);die;
		$query = "SELECT * FROM `materi` WHERE id = '$id'";

		return $this->db->query($query)->row_array();
	}

	public function getAllCourse()
	{
		$query = "SELECT `kursus`.*, `genre`.`nama_genre`
					FROM `kursus` JOIN `genre`
						ON `genre`.`id` = `kursus`.`id_genre`";

		return $this->db->query($query)->result_array();
	}

	public function insert($nama, $genre, $deskripsi, $gambar, $keuntungan)
	{
		$data = [
			'id_genre' => $genre,
			'id_pengguna' => $this->session->userdata('id'),
			'nama_krs' => $nama,
			'gambar' => $gambar,
			'deskripsi' => $deskripsi,
			'keuntungan' => $keuntungan,
			'created_at' => date('d M Y H:i:s')
		];

		$this->db->insert('kursus', $data);
	}

	public function insertMateri($data)
	{


		$this->db->insert('materi', $data);
	}

	public function getMateri($idKursus)
	{
		$query = "SELECT * FROM `materi` WHERE id_kursus = '$idKursus'";

		return $this->db->query($query)->result_array();
	}

}
