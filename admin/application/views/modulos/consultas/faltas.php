<div class="page-title">
	<div class="container">
		<h3>Inserir Faltas Antecipadas</h3>
	</div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Controle de Períodos de Consulta</h4>
                    
					<a href="<?php echo site_url("consultas/");?>" class="btn btn-primary pull-right"><span class="fa fa-arrow-left"></span> Voltar </a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					
							<div class="col-md-12">
								<div class="col-md-3">
									<p class="text-center"><b>Paciente:</b> <span><?php echo $consultas[0]->nome_pac;?></span></p>
								</div>
								<div class="col-md-3">
									<p class="text-center"><b>Profissional:</b> <span><?php echo $consultas[0]->nome_prof;?></span></p>
								</div>
								<div class="col-md-3">
									<p class="text-center"><b>Especialidade:</b> <span><?php echo $consultas[0]->nome_espec;?></span></p>
								</div>
								<div class="col-md-3">
									<p class="text-center"><b>Plano:</b> <span><?php echo $consultas[0]->nome_plano;?></span></p>
								</div>
							</div>
						
                            <form id="form_consultas" action="<?php echo current_url();?>" class="form-horizontal" method="post">
								<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
                                   
                                    <div class="col-sm-12" style="background-color: #eee; padding:1.5em; margin-bottom:1em">
											
											<div class="form-group fieldGroup">
												<div class="col-sm-6">
													<label class="col-sm-12" for="dias_semana_id">DIA SEMANA: </label>
													<div class="col-sm-12">
														<div class="input-group">
															<?php echo form_dropdown('dias_semana_id', $listaDiaSemana, set_value('dias_semana_id', @$item->dias_semana_id), 
															'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox dias_semana"'); ?>
															<span class="input-group-addon" style="border-radius: 0"><i class="fa fa-calendar"></i></span>
														</div>
													</div>
													<?php echo form_error('dias_semana_id'); ?>
												</div>
												<div class="col-sm-6">
													<label class="col-sm-12" for="horarios_id">HORÁRIO: </label>
													<div class="col-sm-12">
														<div class="input-group">
															<?php echo form_dropdown('horarios_id', $listaHorarios, set_value('horarios_id', @$item->horarios_id), 
															'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox horarios"'); ?>
															<span class="input-group-addon" style="border-radius: 0"><i class="fa fa-clock-o"></i></span>	
														</div>
													</div>	
													<?php echo form_error('horarios_id'); ?>
												</div>
											</div>
											
									</div>
                                    <div class="form-group">
                                        <label class="col-sm-12" for="data">DATA FALTA: </label>
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <?php if (@$item->data_inicio) { ?>
                                                    <input name="data_presenca" type="text" id="data_presenca" class="form-control" value="<?php echo set_value("data_presenca", date("d/m/Y", strtotime(@$item->data_presenca))) ?>" />
                                                <?php } else { ?>
                                                    <input name="data_presenca" type="text" id="data_presenca" class="form-control" value="<?php echo set_value("data_presenca", @$item->data_presenca) ?>" />
                                                <?php } ?>
                                                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                            </div>
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
<!-- 	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/matriculas/js.js"></script> -->
	<script type="text/javascript">
		$(document).ready(function(event) {
			$('[data-toggle="popover"]').popover(); 

            $("#data_presenca").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			language: "pt",
			todayHighlight: true
		});
		$("#pacientes").selectpicker();
		$("#especialidades_id").selectpicker();
		$("#profissionais_id").selectpicker();
		$("#planos_id").selectpicker();
		});
	</script>