<!DOCTYPE html>
<html>
    <head>
        
        <!-- Title -->
        <title>Sistema de Projetos Padrão</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <!-- link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css' -->
        <!-- <link href="<?php echo base_url(); ?>assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/> -->
        <link href="<?php echo base_url(); ?>assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        
        <!-- Theme Styles -->
        <!--  <link href="<?php echo base_url(); ?>assets/css/modern.css" rel="stylesheet" type="text/css"/> -->
        <!--  <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/> -->
        <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet" type="text/css"/>
        
        <script src="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body class="page-login">
        <main class="page-content">
            <div class="page-inner login">
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12 center">
                            <div class="login-box">
                                <div class="logo-box">
                                    <h1><!-- <a href="<?php echo base_url(); ?>" class="logo-text text-center"><span>Sistema Clínico</span></a> -->
                                        <!-- <img class="logo-img" src="<?php echo base_url();?>assets/images/logomarca_login.png"> -->
                                        <a href="<?php echo base_url(); ?>" class="logo-img text-center"></a>
                                    </h1>
                                </div>
                                <!-- Logo Box -->
                                <div class="form-box">
                                    <p class="text-center m-t-md">Entre com suas credenciais de acesso.</p> 
                                    <?php if(@$msg_error): ?>
                                        <p class="text-center m-t-md"><?php echo $msg_error; ?></p>
                                    <?php endif; ?>
                                    <form class="m-t-md" action="<?php echo current_url(); ?>" method="post">
                                        <input type="hidden" name="r" value="<?php echo $this->input->get_post("r"); ?>">
                                        <div class="form-group mb-2 mr-sm-2 mb-sm-0">
                                            <input type="text" class="form-control" name="usuario" placeholder="Usuário" required>         
                                        </div>
                                        <div class="form-group  mb-2 mr-sm-2 mb-sm-0">
                                            <input type="password" class="form-control" name="senha" placeholder="Senha" required>       
                                        </div>
                                        <button type="submit" name="enviar" class="btn btn-success btn-block">ACESSAR SISTEMA</button>
                                    <!--   
                                        <a href="javascript:;" class="display-block text-center m-t-md text-sm">Esqueceu sua senha?</a>
                                        <p class="text-center m-t-xs text-sm">Do not have an account?</p>
                                        <a href="register.html" class="btn btn-default btn-block m-t-md">Create an account</a>
                                        -->
                                    </form>
                                    <p class="text-center m-t-md btn-margin-top"><?php echo date("Y")?> &copy; Todos os Direitos Reservados.</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row -->
                </div><!-- Main Wrapper -->
            </div><!-- Page Inner -->
        </main><!-- Page Content -->
        <style type="text/css">
            .logo-box h1 a {
                background-image: none, url("<?php echo base_url();?>assets/images/logo.jpg");
                background-size: 84px;
                background-position: center top;
                background-repeat: no-repeat;
                color: #444;
                height: 84px;
                font-size: 20px;
                line-height: 1.3em;
                margin: 0 auto 25px;
                padding: 0;
                width: 84px;
                text-indent: -9999px;
                outline: 0;
                display: block;
            }
        </style>

        <!-- Javascripts -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-backstretch/jquery.backstretch.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/plugins/pace-master/pace.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/classie/classie.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/waves/waves.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/modern.min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                /* Fullscreen background */
                $.backstretch("<?php echo base_url(); ?>assets/images/inicial.jpg");
                
                $('#top-navbar-1').on('shown.bs.collapse', function(){
                    $.backstretch("resize");
                });
                $('#top-navbar-1').on('hidden.bs.collapse', function(){
                    $.backstretch("resize");
                });
                 /*  Fim do Fullscreen background */
            });
        </script>
    </body>
</html>