<!DOCTYPE html>
<html lang="en">
<head>
	<title>Clínica Reintegrar</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/logo_reintegrar.png">
	<link href="<?php echo base_url(); ?>assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
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
<body>
	<style type="text/css">
	</style>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="<?php echo current_url(); ?>" method="post">
					<input type="hidden" name="r" value="<?php echo $this->input->get_post("r"); ?>" />
					<span class="login100-form-title p-b-34">
						Bem vindo à Clinica Reintegrar
					</span>
					<div class="row"></div>
					<div class="col-sm-12">
						<?php $this->load->view('layout/messages.php'); ?>
					</div>
					<div class="wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input class="input100" type="text" name="usuario" placeholder="usuário" required>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="senha" placeholder="senha" required>
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" name="enviar" class="login100-form-btn">
							Entrar no Sistema
						</button>
					</div>

					<div class="w-full text-center p-t-27">
						<span class="txt1">
							Esqueceu
						</span>

						<a href="#" class="txt2">
							Usuário / Senha ?
						</a>
					</div>

					<div class="w-full text-center">
						<a href="#" class="txt3">
							ENTRAR
						</a>
					</div>
				</form>
				<div class="login100-more"></div>
			</div>
		</div>
	</div>

	<!-- Javascripts -->
	<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.3.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-backstretch/jquery.backstretch.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/pace-master/pace.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-blockui/jquery.blockui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/uniform/jquery.uniform.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/classie/classie.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugins/waves/waves.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/modern.min.js"></script>
</body>
</html>