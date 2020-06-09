<div class="page-title">
	<div class="container">
		<h3>Especialidades</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("especialidades")?>">Especialidades</a></li>
		<li>Adicionar Especialidade </li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent has-shadow">
				<div class="panel-body">
				<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Especialidades / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("especialidades/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">

									<form id="form_especialidades" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
									<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="nome_espec">Nome</label>
											<div class="col-sm-10">
												<input name="nome_espec" type="text" id="nome_espec" class="form-control" value="<?php echo set_value("nome_espec", @$item->nome_espec) ?>" />
												<?php echo form_error('nome_espec'); ?>
											</div>
										</div>
										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("especialidades"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/especialidades/js.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/especialidades/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>