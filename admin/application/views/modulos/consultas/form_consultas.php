<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
			<div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Consultas / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
					<a href="<?php echo site_url("consultas/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Todos </a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view('layout/messages.php'); ?>
					<form id="form_consultas" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
						<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
							
							<div class="form-group">
								<label class="col-sm-2 control-label" for="pacientes_id">Paciente</label>
								<div class="col-sm-10">
									<?php echo form_dropdown('pacientes_id', $listaPacientes, set_value('pacientes_id', @$item->pacientes_id), 
									'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="pacientes" required=""'); ?>
									<?php echo form_error('pacientes_id'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="profissionais_id">Profissional</label>
								<div class="col-sm-10">
									<?php echo form_dropdown('profissionais_id', $listaProfissionais, set_value('profissionais_id', @$item->profissionais_id), 
									'data-size="7" data-live-search="true" class="form-control" id="profissionais"required=""'); ?>
									<?php echo form_error('profissionais_id'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="qtd_atendimentos">Qtd. Atendimentos</label>
								<div class="col-sm-10">
									<input name="qtd_atendimentos" type="number" min="1" id="qtd_atendimentos" required="" class="form-control" value="<?php echo set_value("qtd_atendimentos", @$item->qtd_atendimentos) ?>" />
								<?php echo form_error('qtd_atendimentos'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="freq_atendimentos">Freq. Semanal</label>
								<div class="col-sm-10">
									<input name="freq_atendimentos" type="number" min="1" id="freq_atendimentos" required="" class="form-control" value="<?php echo set_value("freq_atendimentos", @$item->freq_atendimentos) ?>" />
								<?php echo form_error('freq_atendimentos'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="data_inicio">Inicio</label>
								<div class="col-sm-10">
									<input name="data_inicio" type="text" id="data_inicio" required="" class="form-control" value="<?php echo set_value("data_inicio", @$item->data_inicio) ?>" />
								<?php echo form_error('data_inicio'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="data_fim">Fim</label>
								<div class="col-sm-10">
									<input name="data_fim" type="text" id="data_fim" required="" class="form-control" value="<?php echo set_value("data_fim", @$item->data_fim) ?>" />
								<?php echo form_error('data_fim'); ?>
								</div>
							</div>
							
						<div class="form-actions">
							<div class="col-sm-10 col-offset-2">
								<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
								<a href="<?php echo site_url("consultas"); ?>" class="btn">
									Cancelar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/js.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/validate.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#pacientes").selectpicker();
		$("#profissionais").selectpicker();
		$("#data_inicio").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			language: "pt",
			todayHighlight: true
		});
		$("#data_inicio").mask("99/99/9999");
		$("#data_fim").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			language: "pt",
			todayHighlight: true
		});
		$("#data_fim").mask("99/99/9999");
	});
</script>