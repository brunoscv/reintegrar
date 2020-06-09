<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("permissoes")?>">Permissoes</a></li>
		<li>Adicionar Permissoe </li>
	</ol>
</div>
<div class="page-title">
	<div class="container">
		<h3>Controle de Permissoes</h3>
	</div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
					<?php $this->load->view('layout/messages.php'); ?>
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Permissoes / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("permissoes/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<form id="form_perfil" class="form-horizontal" method="post">
										<input type="hidden" id="id" name="id" value="<?php echo set_value("id", @$item->id); ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="descricao">Usuário</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('usuarios_id', $listaUsuarios, set_value('usuarios_id', @$item->usuarios_id), 'class="form-control"'); ?>
												<?php echo form_error('usuarios_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="descricao">Controllers</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('metodos_id', $listaClasses, set_value('metodos_id', @$item->metodos_id), 'class="form-control"'); ?>
												<?php echo form_error('metodos_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("perfis")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/permissoes/js.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/permissoes/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>