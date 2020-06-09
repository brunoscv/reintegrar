    <!-- Footer -->
    <footer class="footer pt-0">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
          <div class="copyright text-center text-lg-left text-warning">
            &copy; <?= date("Y") ?> <a href="#" class="font-weight-bold ml-1 text-warning" target="_blank">Clinica Reintegrar</a>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="#" class="nav-link" target="_blank">Site Clinica Reintegrar</a>
            </li>
            <li class="nav-item">
              <a href="#/presentation" class="nav-link" target="_blank">Quem Somos</a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link" target="_blank">Parceiros</a>
            </li>

          </ul>
        </div>
      </div>
    </footer>
  </div>

  <!-- Argon Scripts -->
  <!-- Optional JS -->
  <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Optional JS -->
  <script src="<?php echo base_url(); ?>assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
<!--   <script src="<?php echo base_url(); ?>assets/vendor/quill/dist/quill.min.js"></script> -->
  <!-- Argon JS -->
  <script src="<?php echo base_url(); ?>assets/js/argon.js?v=1.1.0"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="<?php echo base_url(); ?>assets/js/demo.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/mustache/mustache.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/select-picker/js/bootstrap-select.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/maskedinput/jquery.maskedinput-1.3.min.js"></script>
  <script type="text/javascript">
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-center",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>
</body>

</html>