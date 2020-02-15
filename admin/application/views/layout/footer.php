        <div class="page-footer">
                    <div class="container">
                        <p class="no-s text-center"><?php echo date("Y"); ?> &copy; Todos os Direitos Reservados</p>
                    </div>
                </div>
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        <nav class="cd-nav-container" id="cd-nav">
            <header>
                <h3>Navigation</h3>
                <a href="#0" class="cd-close-nav">Close</a>
            </header>
            <ul class="cd-nav list-unstyled">
                <li class="cd-selected" data-menu="index">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-home"></i>
                        </span>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li data-menu="profile">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                        <p>Profile</p>
                    </a>
                </li>
                <li data-menu="inbox">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                        <p>Mailbox</p>
                    </a>
                </li>
                <li data-menu="#">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-tasks"></i>
                        </span>
                        <p>Tasks</p>
                    </a>
                </li>
                <li data-menu="#">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-cog"></i>
                        </span>
                        <p>Settings</p>
                    </a>
                </li>
                <li data-menu="calendar">
                    <a href="javsacript:void(0);">
                        <span>
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
                        <p>Calendar</p>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="cd-overlay"></div>
    
        <style type="text/css">
            table.dataTable {
                color: #50649c;
            }
            table.dataTable.no-footer {
                border-bottom: none;
            }
            .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
                color: #50649c;
            }
            .form-control {
                color: #50649c;
            }
            .pagination > .disabled > span, .pagination > .disabled > span:hover, .pagination > .disabled > span:focus, .pagination > .disabled > a, .pagination > .disabled > a:hover, .pagination > .disabled > a:focus {
                color: #50649c;
                cursor: not-allowed;
                background-color: #fff;
                border-color: #50649c;
            }
        </style>
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
        <script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/classie/classie.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/waves/waves.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        
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
        <script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.js"></script>

        <!-- Init tinymce -->
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
            });</script>
        
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