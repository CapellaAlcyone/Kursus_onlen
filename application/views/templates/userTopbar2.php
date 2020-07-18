<nav class="navbar navbar-expand-sm navbar-dark bg-info">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url('siswa') ?>"><img src="<?= base_url('assets/img/ikbal1.png'); ?>" style="width: 138px; height: 45px;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url('siswa/profile') ?>">Profil</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url('') ?>">Keranjang</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?= base_url('siswa/publish') ?>">Daftar Kursus</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?=  base_url('auth/logout');  ?>">Logout</a>
        </li>
      </ul>
    </div>
    </div>
</nav>
