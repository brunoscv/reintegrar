<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("usuarios")?>">Users</a></li>
        <li>Remover User </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Users</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-4">
							<?php echo $this->load->view('layout/search.php'); ?>
						</div>
						<div class="col-md-8" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Controle de Users / Remover</h4>
				                    <a href="<?php echo site_url("users/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view("layout/messages"); ?>
									<form id="form_usuario" class="form-horizontal" method="post">
										<div class="alert alert-danger" role="alert">
					                    	<strong>Atenção!</strong> 
					                    	Esta ação não poderá ser desfeita.
					                	</div>
					                											<div class="form-group">
											<label class="col-sm-2 control-label" for="id">Id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("id", $item->id); ?>" name="id" id="id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="usuario">Usu�rio</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("usuario", $item->usuario); ?>" name="usuario" id="usuario">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="senha">Senha</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("senha", $item->senha); ?>" name="senha" id="senha">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="email">Email</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("email", $item->email); ?>" name="email" id="email">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="cidades_id">cidades_id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("cidades_id", $item->cidades_id); ?>" name="cidades_id" id="cidades_id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="estados_id">estados_id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("estados_id", $item->estados_id); ?>" name="estados_id" id="estados_id">
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
												<a href="<?php echo site_url("users")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/users/js.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/users/validate.js"></script>
	</div>
</div>