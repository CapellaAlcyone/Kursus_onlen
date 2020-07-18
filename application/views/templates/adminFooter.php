
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="icon-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url('assets/js/vendor.bundle.base.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/DataTables/datatables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/off-canvas.js'); ?>"></script>
    <script src="<?= base_url('assets/js/misc.js'); ?>"></script>
    <script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
    <script>
      $(document).ready(function () {
        $('#example1').DataTable();

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
            });
        }, 4000);

        $('.carousel').carousel();

        CKEDITOR.replace('ckeditor', {
          filebrowserImageBrowseUrl : '<?= base_url('assets/kcfinder/browse.php'); ?>',
          height : '400px'
        });
      });          
    </script>
  </body>
</html>