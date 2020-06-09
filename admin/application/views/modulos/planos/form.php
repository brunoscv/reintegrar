<div class="page-title">
	<div class="container">
		<h3>Planos</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("planos")?>">Planos</a></li>
		<li>Adicionar Plano </li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
				<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Planos / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("planos/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<form id="form_planos" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
									<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="nome_plano">Nome</label>
											<div class="col-sm-10">
												<input name="nome_plano" type="text" id="nome_plano" class="form-control" value="<?php echo set_value("nome_plano", @$item->nome_plano) ?>" />
												<?php echo form_error('nome_plano'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="telefone_plano">Telefone</label>
											<div class="col-sm-10">
												<input name="telefone_plano" type="text" id="telefone_plano" class="form-control" value="<?php echo set_value("telefone_plano", @$item->telefone_plano) ?>" />
												<?php echo form_error('telefone_plano'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="email_plano">Email</label>
											<div class="col-sm-10">
												<input name="email_plano" type="text" id="email_plano" class="form-control" value="<?php echo set_value("email_plano", @$item->email_plano) ?>" />
												<?php echo form_error('email_plano'); ?>
											</div>
										</div>
										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("planos"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/planos/js.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/planos/validate.js"></script>
							<script type="text/javascript">
								jQuery(document).ready(function($) {
									$("#telefone_plano").mask("(99)99999-9999");
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>