<div class="page-title">
	<div class="container">
		<h3>Controle de Reposicao de Consultas</h3>
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
									<h4 class="panel-title">Reposicoes / <?php echo (@$item->frequencia_id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("consultas/reposicao/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body">
									<form id="form_consultas" action="<?php echo current_url();?>" class="form-horizontal" method="post">
										<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
										<div class="form-group">
											<label class="col-sm-12" for="paciente_id">PACIENTE: </label>
											<div class="col-sm-12">
												<div class="input-group">
												<?php echo form_dropdown('pacientes_id', $listaPacientes, set_value('pacientes_id', @$item->pacientes_id), 
												'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox" 
												id="pacientes" title="Novo"'); ?>
													<span class="input-group-addon" style="border-radius: 0">
															<a href="<?php echo site_url("consultas/pacientes");?>"
															data-widget="buscaPaciente"
															data-dialog="one"
															data-width="90%"
															data-label="#menupai"
															data-value="#pacientes_id"
															data-title="Novo Paciente"
															data-toggle="tooltip">
															<i class="fa fa-user-plus"></i>
														</a>
													</span>
									    		</div>
												<?php echo form_error('pacientes_id'); ?>
											</div>
										</div>
										<div class="form-group" style="margin-top:2em;">
											<label class="col-sm-12" for="especialidades_id">ESPECIALIDADE: </label>
											<div class="col-sm-12">
												<?php echo form_dropdown('especialidades_id', $listaEspecialidades, set_value('especialidades_id', @$item->especialidades_id), 
												'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox" id="especialidades_id"'); ?>
												<?php echo form_error('especialidades_id'); ?>
											</div>
										</div>
										<div class="form-group" id="selectProfissionais">
											<label class="col-sm-12" for="profissionais_id">PROFISSIONAL: </label>
											<div class="col-sm-12">
												<select class="form-control fill_select btn_in own_select boxdropdown-toggle" id="profissionais_id" name="profissionais_id"
												data-size="7" data-live-search="true">
													<option value='0'>Escolha um Profissional</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-12" for="planos_id">PLANOS: </label>
											<div class="col-sm-12">
												<select class="form-control fill_select btn_in own_select boxdropdown-toggle" id="planos_id" name="planos_id"
												data-size="7" data-live-search="true">
													<option value='0'>Escolha um Convênio</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-12" for="data">DATA INÍCIO: </label>
											<div class="col-sm-12">
												<div class="input-group">
													<?php if (@$item->data_inicio) { ?>
														<input name="data_inicio" type="text" id="data_inicio" class="form-control" value="<?php echo set_value("data_inicio", date("d/m/Y", strtotime(@$item->data_inicio))) ?>" />
													<?php } else { ?>
														<input name="data_inicio" type="text" id="data_inicio" class="form-control" value="<?php echo set_value("data_inicio", @$item->data_inicio) ?>" />
													<?php } ?>
													<span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar"></i></span>
												</div>
											</div>
										</div>
										<div class="col-sm-12" style="background-color: #eee; padding:1.5em; margin-bottom:1em">
											<!-- <div class="form-group">
												<div class="col-sm-12">
													<a href="javascript:void(0)" class="btn btn-primary adicionar_horario pull-right"><i class="fa fa-plus"></i> Adicionar Horário</a>	
												</div>
											</div> -->
											<div class="form-group fieldGroup">
												<div class="col-sm-4">
													<label class="col-sm-12" for="dias_semana_id">DIA SEMANA: </label>
													<div class="col-sm-12">
														<div class="input-group">
															<?php echo form_dropdown('dias_semana_id[]', $listaDiaSemana, set_value('dias_semana_id', @$item->dias_semana_id), 
															'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox dias_semana"'); ?>
															<span class="input-group-addon" style="border-radius: 0"><i class="fa fa-calendar"></i></span>
														</div>
													</div>
													<?php echo form_error('dias_semana_id'); ?>
												</div>
												<div class="col-sm-4">
													<label class="col-sm-12" for="horarios_id">HORÁRIO: </label>
													<div class="col-sm-12">
														<div class="input-group">
															<?php echo form_dropdown('horarios_id[]', $listaHorarios, set_value('horarios_id', @$item->horarios_id), 
															'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox horarios"'); ?>
															<span class="input-group-addon" style="border-radius: 0"><i class="fa fa-clock-o"></i></span>	
														</div>
													</div>	
													<?php echo form_error('horarios_id'); ?>
												</div>
												<div class="col-sm-4">
													<div class="col-sm-12" style="padding: 1.75em 0 0 0;">
														<a href="javascript:void(0)" class="btn btn-danger remover_horario"><i class="fa fa-trash"></i></a>
													</div>
												</div>
											</div>
											
										</div>
										<div class="form-group">
											<label class="col-sm-12" for="observacoes">OBSERVAÇÕES: </label>
											<div class="col-sm-12">
												<textarea id="observacoes" class="form-control" type="text" name="observacoes"></textarea>
												<?php echo form_error('planos_id'); ?>
											</div>
										</div>
										
										<div class="form-actions">
											<div class="col-sm-12">
												<input type="submit" name="enviar" class="btn btn-primary pull-right" value="Salvar" />
												<a href="<?php echo site_url("consultas/reposicao"); ?>" class="btn pull-right">
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
			</div>
		</div>
	</div>
</div>
		
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/criar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/validate.js"></script>
<script type="text/javascript">
	$(document).ready(function(event){
		$("#data_inicio").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			language: "pt",
			todayHighlight: true
		});
		$("#pacientes").selectpicker();
	});
</script>