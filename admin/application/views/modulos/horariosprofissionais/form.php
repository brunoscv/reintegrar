<div class="page-title">
	<div class="container">
		<h3>Controle de Horarios dos Profissionais</h3>
	</div>
</div>
<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("horarios_profissionais")?>">Horarios dos Profissionais</a></li>
		<li>Adicionar Horario Profissionai </li>
	</ol>
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
									<h4 class="panel-title">Horarios dos Profissionais / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("horariosprofissionais/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_horarios_profissionais" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
									<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="profissionais_id">Profissional</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('profissionais_id', $listaProfissionais, set_value('profissionais_id', @$item->profissionais_id), 'class="form-control"'); ?>
												<?php echo form_error('profissionais_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="dias_semana_id">Dia Semana</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('dias_semana_id', $listaDias, set_value('dias_semana_id', @$item->dias_semana_id), 'class="form-control"'); ?>
												<?php echo form_error('dias_semana_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="horarios_id">Horario</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('horarios_id[]', $listaHorarios, set_value('horarios_id', @$item->horarios_id), 'class="form-control select2" multiple=""'); ?>
												<?php echo form_error('horarios_id'); ?>
											</div>
										</div>

										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("horariosprofissionais"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/horariosprofissionais/js.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/horariosprofissionais/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>