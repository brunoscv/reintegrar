<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("usuarios")?>">Usuário</a></li>
        <li>Alterar Senha</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Usuários</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Alterar Senha</h4>
				                    <a href="<?php echo site_url("usuarios/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Listagem de Usuários</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_alterarsenha" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="senha">Senha Antiga</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="senha_antiga" id="senha_antiga">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="senha">Senha</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="nova_senha" id="nova_senha">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="senha2">Confirmação</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="senha2" id="senha2">
											</div>
										</div>

										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("dashboard")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuarios/js.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuarios/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>