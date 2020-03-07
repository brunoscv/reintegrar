<div class="page-title">
	<div class="container">
		<h3>Profissionais</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("profissionais")?>">Profissionais</a></li>
		<li>Adicionar Profissionai </li>
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
									<h4 class="panel-title">Profissionais / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("profissionais/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<?php $this->load->view('layout/messages.php'); ?>
									<form id="form_profissionais" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
									<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="nome_prof">Nome</label>
											<div class="col-sm-10">
												<input name="nome_prof" type="text" id="nome_prof" class="form-control" value="<?php echo set_value("nome_prof", @$item->nome_prof) ?>" />
												<?php echo form_error('nome_prof'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="telefone_prof">Telefone</label>
											<div class="col-sm-10">
												<input name="telefone_prof" type="text" id="telefone_prof" class="form-control" value="<?php echo set_value("telefone_prof", @$item->telefone_prof) ?>" />
												<?php echo form_error('telefone_prof'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="email_prof">Email</label>
											<div class="col-sm-10">
												<input name="email_prof" type="text" id="email_prof" class="form-control" value="<?php echo set_value("email_prof", @$item->email_prof) ?>" />
												<?php echo form_error('email_prof'); ?>
											</div>
										</div>
										<div class="form-group">
										<label class="col-sm-2 control-label" for="especialidades_id">Especialidade</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('especialidades_id', $listaEspecialidades, set_value('especialidades_id', @$item->especialidades_id), 
												'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="especialidades"'); ?>
												<?php echo form_error('especialidades_id'); ?>
											</div>
										</div>
										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("profissionais"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/profissionais/js.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/profissionais/validate.js"></script>
							<script type="text/javascript">
								jQuery(document).ready(function() {
									$("#telefone_prof").mask("(99)99999-9999");
									// $("#especialidades").select2();
									$("#especialidades").selectpicker();
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>