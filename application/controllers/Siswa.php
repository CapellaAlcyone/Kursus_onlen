<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    //cek();
    $this->load->model('UserModel');
		$this->load->model('CourseModel');
		$this->load->model('GenreModel');
    $this->load->model('RbModel');

		$this->load->library('cart');
  }

  public function index($value='')
  {
    $id = $this->session->userdata('id');
    $data['userAktif'] = $this->UserModel->getOneUser($id);
    $data['rb'] = $this->RbModel->getRbByMaker($id);

    $genre=($this->uri->segment(3))?$this->uri->segment(3):0;
    $data['kursus'] = $this->RbModel->get_produk_kategori($genre);
    $data['genre'] = $this->RbModel->get_kategori_all();



    if ($this->session->userdata('role_id') == '3') {
    $this->load->view('templates/header1', $data);
    $this->load->view('siswa/index', $data);
    $this->load->view('templates/userFooter');
  }else{
    echo "tes";
  }
  }

  public function profile()
  {
    $id = $this->session->userdata('id');

    $data['userAktif'] = $this->UserModel->getOneUser($id);
    // var_dump($data['user']);
    // die;
    $data['judul']='Profile';
    $genre=($this->uri->segment(3))?$this->uri->segment(3):0;
    $data['kursus'] = $this->RbModel->get_produk_kategori($genre);
    $data['genre'] = $this->RbModel->get_kategori_all();


    $this->load->view('templates/header1', $data);
    $this->load->view('siswa/profil', $data);
    $this->load->view('templates/userFooter');

  }

  public function publish()
  {
    $data['judul'] = 'BeLon || Daftra Kursus';
    $data['course'] = $this->CourseModel->getAllCourse();

    $genre=($this->uri->segment(3))?$this->uri->segment(3):0;
    $data['kursus'] = $this->RbModel->get_produk_kategori($genre);
    $data['genre'] = $this->RbModel->get_kategori_all();


    $this->load->view('templates/header1', $data);
    $this->load->view('course/publish2', $data);
    $this->load->view('templates/footer1');

  }

  public function update()
  {
    $this->form_validation->set_rules('edit_nama', 'Nama', 'required|trim', [
      'required' => 'Nama wajib diisi!'
    ]);
    $this->form_validation->set_rules('edit_alamat', 'Alamat', 'required|trim', [
      'required' => 'Alamat wajib diisi!'
    ]);
    if ($this->form_validation->run() == false) {
      $id = $this->session->userdata('id');

      $data['userAktif'] = $this->UserModel->getOneUser($id);
      // var_dump($data['user']);
      // die;
      $this->load->view('templates/adminHeader');
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('profil/index', $data);
      $this->load->view('templates/adminFooter');
    }else{
      $upload_gambar = $_FILES['edit_foto']['name'];
      $data = $this->UserModel->getOneUser($this->input->post('id'));
      if ($upload_gambar) {
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']		 = '2048';
        $config['upload_path']   = './assets/img/profil/';
        $config['encrypt_name'] = FALSE;

        $this->load->library('upload', $config);

        if($this->upload->do_upload('edit_foto')){
          $gambar = $this->upload->data('file_name');
          $gambar_lama = $data['gambar'];

          if ($gambar_lama != 'default.jpg') {
            unlink(FCPATH . 'assets/img/profil/' . $gambar_lama);
          }
        }
      }
        $id = $this->input->post('id');
        $nama = $this->input->post('edit_nama');
        $alamat = trim($this->input->post('edit_alamat'));
        $this->UserModel->update($id, $nama, $alamat, $gambar);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Profil berhasil diupdate.</div>');
        redirect('siswa');

    }
  }

  public function detail_k($idKursus)
  {
    $id = $this->session->userdata('id');

    $data['userAktif'] = $this->UserModel->getOneUser($id);
    $data['course'] = $this->CourseModel->getCourseByID($idKursus);
    $data['materi'] = $this->CourseModel->getMateri($idKursus);
    // var_dump($data['user']);
    // die;
    $data['judul']='Detail Kursus';
    $genre=($this->uri->segment(3))?$this->uri->segment(3):0;
    $data['kursus'] = $this->RbModel->get_produk_kategori($genre);
    $data['genre'] = $this->RbModel->get_kategori_all();


    $this->load->view('templates/header1', $data);
    $this->load->view('siswa/detail_k', $data);
    $this->load->view('templates/userFooter');

  }

  public function tampil_m($idKursus)
  {
    $id = $this->session->userdata('id');

    $data['userAktif'] = $this->UserModel->getOneUser($id);
    $data['course'] = $this->CourseModel->getCourseByID($idKursus);
    $data['materi'] = $this->CourseModel->getMateri($idKursus);
    // var_dump($data['user']);
    // die;
    $data['judul']='Detail Materi';
    $this->load->view('templates/userHeader',$data);
    $this->load->view('templates/userTopbar2');
    $this->load->view('siswa/tampil_m', $data);
    $this->load->view('templates/userFooter');

  }

  public function keranjang()
  {
    $data['judul'] = 'BeLon || Daftra Kursus';
    $data['course'] = $this->CourseModel->getAllCourse();

    $data['genre'] = $this->RbModel->get_kategori_all();


    $this->load->view('templates/header1', $data);
    $this->load->view('siswa/keranjang', $data);
    $this->load->view('templates/footer1');

  }

  function tambah()
{
  $data_kursus= array('id' => $this->input->post('id'),
             'name' => $this->input->post('nama'),
             'price' => $this->input->post('harga'),
             'gambar' => $this->input->post('gambar'),
             'qty' =>'1'
            );
  $this->cart->insert($data_kursus);
 //var_dump($data_kursus);die;
   redirect('siswa/publish');
}

}
