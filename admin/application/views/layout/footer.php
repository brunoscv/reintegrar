    </div><!-- Page Inner -->
</section><!-- Page Content -->
    <div class="page-footer">
        <div class="container">
            <p class="no-s text-center"><?php echo date("Y"); ?> &copy; Todos os Direitos Reservados</p>
        </div>
    </div>
        
        <!-- Javascripts -->
        <script src="<?php echo base_url(); ?>assets/js/mustache/mustache.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dialogs.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/js/custom.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.app.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/wow.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/fastclick.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/modern.min.js"></script>
        
        <!-- <script src="<?php echo base_url(); ?>assets/js/pages/form-select2.js"></script> -->

        <!-- <script src="<?php echo base_url(); ?>assets/plugins/pace-master/pace.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/plugins/classie/classie.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/waves/waves.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/raty/jquery.raty.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/plugins/select-picker/js/bootstrap-select.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/multiselect/multiselect.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/maskedinput/jquery.maskedinput-1.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/tinymce/tinymce.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/lib/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.js"></script>
        <script src='<?php echo base_url(); ?>assets/plugins/fullcalendar/lang-all.js'></script>
        <script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/gcal.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-calendar/js/jquery-calendar.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

        <!-- Init tinymce
        <script>tinymce.init(
            { 
                selector:'textarea',
                toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify',
                menubar: false, 
                setup : function(ed){
                     ed.on('blur', function(e){
                        tinyMCE.triggerSave();
                        $("#"+ed.id).valid();
                     });
                }
            });</script> -->
        
        <script type="text/javascript">
            $('body').tooltip({
                selector: '[rel=tooltip]',
                placement:"top"
            });
        </script>
        <script type="text/javascript">
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-bottom-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "1500",
              "hideDuration": "500",
              "timeOut": "2000",
              "extendedTimeOut": "100",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
        </script>
    </body>
</html>