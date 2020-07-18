<div class="main-panel">
    <div class="content-wrapper">
    	<div class="row">
    		<div class="col-md-8 offset-2">
          <?php foreach($course as $u){ ?>
    			<form action="<?= base_url('course/update'); ?>" method="post">

            <p>  <label> ID Materi </label> <br>
              <input type="text" readonly name="id" id="id" value="<?php echo $u->id ?>"> </p>

          <p>  <label> Judul Materi</label> <br>
            <input type="text" name="judul" id="judul" value="<?php echo $u->judul ?>"> </p>

            <p>  <label> Judul Link Video </label> <br>
              <input type="text" name="link_konten" id="link_konten" value="<?php echo $u->link_konten ?>" </p>

          <p>  <label> Ketik Materi </label>
    				<textarea name="konten" id="ckeditor" required><?php echo $u->konten ?></textarea>
          </p>

          <input type="submit" class="btn btn-success" value="Simpan">
    			</form>
          <?php } ?>
    		</div>
    	</div>
