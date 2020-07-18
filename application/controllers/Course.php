<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// cek();
		$this->load->model('UserModel');
		$this->load->model('CourseModel');
		$this->load->model('GenreModel');

	}

	public function index()
	{
		$id = $this->session->userdata('id');

		$data['userAktif'] = $this->UserModel->getOneUser($id);
		$data['course'] = $this->CourseModel->getCourseByMaker($id);

		$this->load->view('templates/adminHeader');
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('course/index',$data);
		$this->load->view('templates/adminFooter');
	}

	public function create()
	{
		$id = $this->session->userdata('id');

		$data['userAktif'] = $this->UserModel->getOneUser($id);
		$data['genre'] = $this->GenreModel->get();
		$this->load->view('templates/adminHeader');
		$this->load->view('templates/topbar', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('course/create');
		$this->load->view('templates/adminFooter');
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required', [
				'required' => 'Nama wajib diisi!'
		]);
		$this->form_validation->set_rules('genre', 'Genre', 'trim|required', [
				'required' => 'Genre wajib diisi!'
		]);
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required', [
				'required' => 'Kolom Deskripsi wajib diisi!'
		]);
		$this->form_validation->set_rules('keuntungan', 'Keuntungan', 'trim|required', [
				'required' => 'Kolom Keuntungan wajib diisi!'
		]);

		if ($this->form_validation->run() == false) {

			$id = $this->session->userdata('id');

			$data['userAktif'] = $this->UserModel->getOneUser($id);
			$data['genre'] = $this->GenreModel->get();
			$this->load->view('templates/adminHeader');
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('course/create');
			$this->load->view('templates/adminFooter');
		}else{

			$upload_gambar = $_FILES['gambar']['name'];
			if ($upload_gambar) {
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']		 = '2048';
				$config['upload_path']   = './assets/img/course/';
				$config['encrypt_name'] = FALSE;

				$this->load->library('upload', $config);

				if($this->upload->do_upload('gambar')){

					$gambar = $this->upload->data('file_name');
					$nama = $this->input->post('nama');
					$genre = $this->input->post('genre');
					$deskripsi = $this->input->post('deskripsi');
					$keuntungan = $this->input->post('keuntungan');

				$this->CourseModel->insert($nama, $genre, $deskripsi, $gambar, $keuntungan);

				}
			}

				$this->session->set_flashdata('message', '<div class="alert alert-success">Kursus Berhasil dibuat.</div>');
				redirect('course');


		}
	}

	public function publish()
	{
		$data['judul'] = 'BeLon || Daftra Kursus';
		$data['course'] = $this->CourseModel->getAllCourse();

		$this->load->view('templates/userHeader', $data);
		$this->load->view('templates/userTopbar');
		$this->load->view('course/publish', $data);
		$this->load->view('templates/userFooter');

	}


	//detail kursus untuk instruktur
	public function detail($idKursus)
	{
		$id = $this->session->userdata('id');

		$data['userAktif'] = $this->UserModel->getOneUser($id);
		$data['course'] = $this->CourseModel->getCourseByID($idKursus);
		$data['materi'] = $this->CourseModel->getMateri($idKursus);
		// var_dump($data['course']['0']['id_pengguna']);die;
		if ($this->session->userdata('id') == $data['course']['0']['id_pengguna']) {
			$this->load->view('templates/adminHeader');
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('course/detail');
			$this->load->view('templates/adminFooter');
		}else{
			$this->load->view('templates/adminHeader');
			$this->load->view('errors/404');
			$this->load->view('templates/adminFooter');
		}

	}

	public function detailMateri($idMateri)
	{
		// var_dump($id);die;
		$id = $this->session->userdata('id');

		$data['userAktif'] = $this->UserModel->getOneUser($id);

		$data['materi'] = $this->CourseModel->getMateriByID($idMateri);
		var_dump($this->session->userdata('idKursus'));die;

		 if ($this->session->userdata('idKursus') == $data['materi']['id_kursus']) {
			$this->load->view('templates/adminHeader');
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('course/detailMateri');
			$this->load->view('templates/adminFooter');
		 }else{
			$this->load->view('templates/adminHeader');
			$this->load->view('errors/404');
			$this->load->view('templates/adminFooter');
		}

	}

	public function addMateri()
	{
		$idKursus = [
			'idKursus' => $this->uri->segment(3)
		];
		// var_dump($idKursus);die;
		$this->session->set_userdata($idKursus);
			// var_dump($this->session->userdata('idKursus'));die;
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required', [
				'required' => 'Judul wajib diisi!'
		]);
		$this->form_validation->set_rules('konten', 'Konten', 'trim|required', [
				'required' => 'Konten wajib diisi!'
		]);


		if ($this->form_validation->run() == false) {

			$id = $this->session->userdata('id');

			$data['userAktif'] = $this->UserModel->getOneUser($id);
			$data['course'] = $this->CourseModel->getCourseByID($this->session->userdata('idKursus'));
			$this->load->view('templates/adminHeader');
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('course/addMateri');
			$this->load->view('templates/adminFooter');
			// echo "false";
		}else{

		// echo "true";
			$data = [
				'id_kursus' => $this->input->post('idKursus'),
				'judul' => $this->input->post('judul'),
				'konten' => trim($this->input->post('konten')),
				'link_konten' => $this->input->post('link'),
				'created_at' => date('d M Y H:i:s')
			];

			$this->CourseModel->insertMateri($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Materi Berhasil dibuat.</div>');
				redirect('course');


		 }
	}

	public function editMateri()
	{
		$idKursus = [
			'idKursus' => $this->uri->segment(3)
		];
		// var_dump($idKursus);di
		$this->session->set_userdata($idKursus);
		// var_dump($this->session->userdata('idKursus'));die;
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required', [
				'required' => 'Judul wajib diisi!'
		]);
		$this->form_validation->set_rules('konten', 'Konten', 'trim|required', [
				'required' => 'Konten wajib diisi!'
		]);


		if ($this->form_validation->run() == false) {

			$id = $this->session->userdata('id');

			$data['userAktif'] = $this->UserModel->getOneUser($id);
			$data['course'] = $this->CourseModel->getCourseByID($this->session->userdata('idKursus'));
			$this->load->view('templates/adminHeader');
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar');
			$this->load->view('course/addMateri');
			$this->load->view('templates/adminFooter');
			// echo "false";
		}else{

		// echo "true";
			$data = [
				'id_kursus' => $this->input->post('idKursus'),
				'judul' => $this->input->post('judul'),
				'konten' => trim($this->input->post('konten')),
				'link_konten' => $this->input->post('link'),
				'created_at' => date('d M Y H:i:s')
			];

			$this->CourseModel->insertMateri($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success">Materi Berhasil dibuat.</div>');
				redirect('course');


		 }
	}

}
