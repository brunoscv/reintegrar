
<div class="page-title">
	<div class="container">
		<h3>Controle de Consultas</h3>
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
									<h4 class="panel-title">Consultas / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("consultas/");?>" class="btn btn-primary pull-right"><span class="fa fa-arrow-left"></span> Voltar</a>
								</div>
								<div class="panel-body">
									<form id="form_consultas" action="<?php echo current_url();?>" class="form-horizontal" method="post">
										<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
										<div class="form-group">
											<label class="col-sm-12" for="paciente_id">PACIENTE: </label>
											<div class="col-sm-12">
												<?php echo form_dropdown('pacientes_id', $listaPacientes, set_value('pacientes_id', @$item->pacientes_id), 
												'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox" 
												id="pacientes"'); ?>
												<!--<div class="input-group">
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
									    		</div>-->
												<?php echo form_error('pacientes_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-12" for="especialidades_id">ESPECIALIDADE: </label>
											<div class="col-sm-12">
												<?php echo form_dropdown('especialidades_id', $listaEspecialidades, set_value('especialidades_id', @$item->especialidades_id), 
												'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox" id="especialidades_id" consulta_id ="<?php echo @$item->id;?>"'); ?>
												<?php echo form_error('especialidades_id'); ?>
											</div>
										</div>
										<!-- <div class="form-group" id="selectProfissionais">
											<label class="col-sm-12" for="profissionais_id">PROFISSIONAL: </label>
											<div class="col-sm-12">
												<?php echo form_dropdown('profissionais_id', $listaProfissionais, set_value('profissionais_id', @$item->profissionais_id), 
												'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox" id="profissionais_id"'); ?>
												<?php echo form_error('profissionais_id'); ?>
												</select>
											</div>
										</div> -->
										<div class="form-group">
											<label class="col-sm-12" for="profissionais_id">PROFISSIONAL: </label>
											<div class="col-sm-12">
												<?php echo form_dropdown('profissionais_id', $listaProfissionais, set_value('profissionais_id', @$item->profissionais_id), 
												'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox" id="profissionais_id"'); ?>
												<?php echo form_error('profissionais_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-12" for="planos_id">PLANOS: </label>
											<div class="col-sm-12">
												<?php echo form_dropdown('planos_id', $listaPlanos, set_value('planos_id', @$item->planos_id), 
												'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox" id="planos_id"'); ?>
												<?php echo form_error('planos_id'); ?>
											</div>
										</div>
										<div class="col-sm-12" style="background-color: #eee; padding:1.5em; margin-bottom:1em">
											<div class="form-group">
												<div class="col-sm-12">
													<a href="javascript:void(0)" class="btn btn-primary pull-right" id="adicionar_horario" consultas_id=<?php echo $item->id?>><i class="fa fa-plus"></i> Adicionar Horário</a>	
												</div>
											</div>
												<?php foreach ($item->horarios as $key => $value) { ?>
													<div id="horarios">
														<div class="form-group fieldGroup">
															<div class="col-sm-4">
																<label class="col-sm-12" for="dias_semana_id">DIA SEMANA: </label>
																<div class="col-sm-12">
																	<div class="input-group">
																		<?php echo form_dropdown('dias_semana_id[]', $listaDiaSemana, set_value('dia_semana_id', @$value->dia_semana_id), 
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
																		<?php echo form_dropdown('horarios_id[]', $listaHorarios, set_value('horarios_id', @$value->horarios_id), 
																		'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox horarios"'); ?>
																		<span class="input-group-addon" style="border-radius: 0"><i class="fa fa-clock-o"></i></span>	
																	</div>
																</div>	
																<?php echo form_error('horarios_id'); ?>
															</div>
															<div class="col-sm-4">
																<div class="col-sm-12" style="padding: 1.75em 0 0 0;">
																	<button type="button" class="btn btn-danger remover_horario" id="<?php echo @$value->horario_consulta?>"><i class="fa fa-trash"></i></button>
																</div>
															</div>
														</div>
												</div>
												<?php } ?>
											
										</div>
										<div class="form-group">
											<label class="col-sm-12" for="observacoes">OBSERVAÇÕES: </label>
											<div class="col-sm-12">
												<textarea id="observacoes" class="form-control" type="text" name="observacoes"><?php echo @$item->observacoes;?></textarea>
												<?php echo form_error('planos_id'); ?>
											</div>
										</div>
										
										<div class="form-actions">
											<div class="col-sm-12">
												<input type="submit" name="enviar" class="btn btn-primary pull-right" value="Salvar" />
												<a href="<?php echo site_url("consultas"); ?>" class="btn pull-right">
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
	<!-- Script Template Mustache -->
	<script id="horarios-template" type="x-tmpl-mustache">
		<div>
			<div class="form-group fieldGroup">
				<div class="col-sm-4">
					<label class="col-sm-12" for="dias_semana_id">DIA SEMANA: </label>
					<div class="col-sm-12">
						<div class="input-group">
							<select name="dias_semana_id[]" data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox dias_semana">
								<option value="1">Segunda-feira</option>
								<option value="2">Terça-feira</option>
								<option value="3">Quarta-feira</option>
								<option value="4">Quinta-feira</option>
								<option value="5">Sexta-feira</option>
								<option value="6">Sábado</option>
							</select>
						<span class="input-group-addon" style="border-radius: 0"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
					{{{<?php echo form_error('dias_semana_id'); ?>}}}
				</div>
				<div class="col-sm-4">
					<label class="col-sm-12" for="horarios_id">HORÁRIO: </label>
					<div class="col-sm-12">
						<div class="input-group">
							<select name="horarios_id[]" data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox horarios">
								<option value="1">08:00</option>
								<option value="2">08:30</option>
								<option value="3">09:00</option>
								<option value="4">09:30</option>
								<option value="5">10:00</option>
								<option value="6">10:30</option>
								<option value="7">11:00</option>
								<option value="8">11:30</option>
								<option value="9">12:00</option>
								<option value="10">12:30</option>
								<option value="11">13:00</option>
								<option value="12">13:30</option>
								<option value="13">14:00</option>
								<option value="14">14:30</option>
								<option value="15">15:00</option>
								<option value="16">15:30</option>
								<option value="17">16:00</option>
								<option value="18">16:30</option>
								<option value="19">17:00</option>
								<option value="20">17:30</option>
								<option value="21">18:00</option>
								<option value="22">18:30</option>
								<option value="23">19:00</option>
								<option value="24">19:30</option>
								<option value="25">20:00</option>
								<option value="26">20:30</option>
							</select>
							<span class="input-group-addon" style="border-radius: 0"><i class="fa fa-clock-o"></i></span>
						</div>
					</div>	
					{{{<?php echo form_error('horarios_id'); ?>}}}
				</div>
				<div class="col-sm-4">
					<div class="col-sm-12" style="padding: 1.75em 0 0 0;">
						<button type="button" class="btn btn-danger remover_horario" id="{{horario_id}}"><i class="fa fa-trash"></i></button>
					</div>
				</div>
			</div>
		</div>
	</script>
	<!-- Script Template Mustache -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/editar.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/validate.js"></script> -->