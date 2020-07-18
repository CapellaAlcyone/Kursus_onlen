<div class="main-panel">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-5 offset-md-5">
        <?= $this->session->flashdata('message'); ?>
        <?php  if ($rb == null) : ?>
          
          <div class="alert alert-warning">
            Anda Belum Mengikuti Kursus Apapun! Silahkan Klik <a href="<?= base_url('siswa/publish') ?>">Di Sini</a>.
          </div>
        <?php  endif;  ?>

      </div>
