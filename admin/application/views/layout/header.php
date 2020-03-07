<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1"> -->
    <meta name="viewport" content="width=1024; initial-scale=0.6; user-scalable=0;">
    <!-- <link rel="shortcut icon" href="assets/images/icone_simbolo.png" type="image/x-icon"> -->
    <meta name="description" content="">
    <title>Clinica Reintegrar</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/logo_reintegrar.png">   
    <!-- Styles -->
    <!-- link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css' -->
    <!-- <link href="<?php echo base_url(); ?>assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/> -->
    <!-- <link href="<?php echo base_url(); ?>assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/> -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
    <link href="<?php echo base_url(); ?>assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
    <link href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
    <link href="<?php echo base_url(); ?>assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/css/datatable.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/raty/jquery.raty.css" rel="stylesheet" type="text/css"/>
    <!-- <link href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.css" rel="stylesheet" type="text/css"/> -->
    <link href="<?php echo base_url(); ?>assets/plugins/select-picker/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/jquery-calendar/css/jquery-calendar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/tipped/css/tipped.css" rel="stylesheet" type="text/css"/>
    <!-- O alerta mais estilizado -->
    <link href="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>

    <!-- Theme Styles -->
    <link href="<?php echo base_url(); ?>assets/css/modern.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/sidebar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/toastr.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css rel="stylesheet" type="text/css"/>
   
    <!-- <link href="<?php echo base_url(); ?>assets/plugins/tablesaw/css/tablesaw.css" rel="stylesheet" type="text/css"/> -->

    <!-- Font Styles -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet"> 

    <script src="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/js/modernizr.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
    </script>
        
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/validate/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/validate/jquery.validate.rules.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/plugins/input-moeda/moeda.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/tipped/js/tipped.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/chartsjs/Chart.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/tablesaw/js/tablesaw.jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/tablesaw/js/tablesaw-init.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert/sweetalert.min.js"></script> -->

    <style type="text/css">
    .td-actions{text-align: right;}
    .navbar-green {
        background-color: #26a69a;
        border-color: #26a69a;
        color: #fafafa;
    }
    </style>
</head>
<script type='text/javascript'>//<![CDATA[
var curl = window.location.href;if (curl.indexOf('m=1') != -1) {curl = curl.replace('m=1', 'm=0');window.location.href = curl;}
//]]></script>
<body class="">
    <!-- Navigation -->
<section class="menu cid-r1uW0hkCRd" once="menu" id="menu2-0">
    <nav class="navbar navbar-green navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url().'dashboard';?>">
                    <img src="<?php echo base_url() ?>assets/images/logo_reintegrar.png" style="width:40px; height:40px">
                    <!-- <p style="margin: 10px 0 10px;">Sistema Clinico</p> -->
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php echo recursiveMenuNav($menuOrdenado,'id="sidebar-menu"');$menuOrdenado=FALSE; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">     
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-users"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a href="<?php echo site_url("javascript;;");?>"><i class="fa fa-user"></i><?php echo $userdata['nome']; ?></a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a href="<?php echo site_url("dashboard/alterarSenha");?>"><i class="fa fa-calendar"></i>Alterar Senha</a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a href="javascript:;"><i class="fa fa-lock"></i>Lock screen</a></li>
                            <li role="presentation"><a href="<?php echo site_url("auth/logout"); ?>"><i class="fa fa-sign-out m-r-xs"></i>Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
<section>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page-inner">
          