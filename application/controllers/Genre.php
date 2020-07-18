<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genre extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		cek();		
		$this->load->model('UserModel');
		$this->load->model('GenreModel');
	}

	public function index()
	{
		$id = $this->session->userdata('id');
		$data['userAktif'] = $this->UserModel->getOneUser($id);	
		$data['genre'] = $this->GenreModel->get();
		if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') {
			$this->load->view('templates/adminHeader');			
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('genre/list');						
			$this->load->view('templates/adminFooter');	
		}else{
			$this->load->view('templates/adminHeader');			
			$this->load->view('errors/404');			
			$this->load->view('templates/adminFooter');	
		}	
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_genre', 'Genre', 'trim|required', [
				'required' => 'Genre wajib diisi!'
		]);

		if ($this->form_validation->run() == false) {			
			$id = $this->session->userdata('id');
			$data['userAktif'] = $this->UserModel->getOneUser($id);

			$this->load->view('templates/adminHeader');			
			$this->load->view('templates/topbar', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('genre/list');						
			$this->load->view('templates/adminFooter');
		}else{
			$this->GenreModel->create();
			$this->session->set_flashdata('message', '<div class="alert alert-success">Genre berhasil ditambah.</div>');
				redirect('genre');
		}
	}

}