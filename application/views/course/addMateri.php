<div class="main-panel">
    <div class="content-wrapper">
    	<?= form_open('course/addMateri/'); ?>
            <div class="form-group row">
                <label class="col-md-2 offset-md-1 col-form-label">Judul Konten</label>
                <div class="col-md-8">  
                	<input type="hidden" name="idKursus" value="<?= $course['0']['id_kursus']; ?>">                  
                    <input type="text" autofocus="on" name="judul" id="juduldu" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 offset-md-1 ol-form-label">Konten</label>
                <div class="col-md-8">
                    <textarea name="konten" id="ckeditor"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 offset-md-1 col-form-label">Link Konten</label>
                <div class="col-md-8">
                    <input type="text" placeholder="misal 'link YouTube'" name="link" id="link" class="form-control">
                </div>
            </div>  
            <div class="form-group row">                
                <div class="col-md-8 offset-md-3">
                    <button class="btn btn-sm btn-success">Simpan</button>
                </div>
            </div>                    	                             
        </form>