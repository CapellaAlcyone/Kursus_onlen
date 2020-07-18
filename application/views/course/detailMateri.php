<div class="main-panel">
    <div class="content-wrapper">
    	<div class="row">
    		<div class="col">
    			<h4 class="card-title"><?= $materi['judul']; ?></h4>
    			<div class="card">
    				<div class="card-body">    					   			
    					<?= $materi['konten']; ?>
    					<hr>
    					<a class="btn btn-sm btn-warning" href="<?= base_url('course/editMateri/') . $materi['id'];?>">Edit</a>
    				</div> 
    				 				    					    			
    			</div>
    		</div>
    	</div>