<div class="main-panel">
          <div class="content-wrapper"> 
          	<div class="row">
          		<div class="col-md-6 offset-md-3">
                <?= $this->session->flashdata('message'); ?>
          			<?php if ($course == null) :?>
          				<div class="alert alert-warning">
          					Anda Belum membuat kursus apapun! Silahkan buat.
          				</div>
          			<?php endif; ?>          		
          		</div>
          		<div class="col-md-4">
          			<a href="<?= base_url('course/create'); ?>" class="btn btn-success btn-sm mb-3">Buat Sekarang?</a>         		
          		</div>
          	</div>
          	<div class="row">
          		<?php foreach ($course as $row) : ?>
                <div class="col-md-4">
                  <div class="card" style="width: 18rem;">
                    <img src="<?= base_url('assets/img/course/') . $row['gambar'];?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?= $row['nama_krs'] ?></h5>
                      <span class="badge badge-pill badge-primary text-white mb-2"><?= $row['nama_genre']; ?></span><br>
                      <a href="<?= base_url('course/detail/') . $row['id_kursus'];?>" class="btn btn-sm btn-info">Detail</a>                     
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>        
          	</div>
