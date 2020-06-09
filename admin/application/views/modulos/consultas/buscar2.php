<div class="page-title">
	<div class="container">
		<h3>Controle de Consultas</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("consultas")?>">Consultas</a></li>
		<li>Buscar Consulta </li>
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
									<h4 class="panel-title">Consultas / <?php echo (@$item->frequencia_id) ? "Editar" : "Buscar"?> </h4>
									<a href="<?php echo site_url("consultas/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body">
									<form id="form_consultas" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
									
										<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->frequencia_id) ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="paciente_id">Paciente: </label>
											<div class="col-sm-9">
												<div class="input-group">
												<?php echo form_dropdown('pacientes_id', $listaPacientes, set_value('pacientes_id', @$item->pacientes_id), 
												'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox" id="pacientes"'); ?>
												<?php echo form_error('pacientes_id'); ?>
									    			<span class="input-group-addon" style="border-radius: 0"><i class="fa fa-users"></i></span>
									    		</div>
											</div>
											<a href="<?php echo site_url("consultas/pacientes");?>" class="btn btn-primary"
												data-widget="buscaPaciente"
												data-dialog="one"
												data-width="90%"
												data-label="#menupai"
												data-value="#pacientes_id"
												data-title="Pacientes">
											<span class="fa fa-plus"></span>
											</a>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="especialidades_id">Especialidade: </label>
											<div class="col-sm-9">
												<?php echo form_dropdown('especialidade_id', $listaEspecialidades, set_value('especialidade_id', @$item->especialidade_id), 
												'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox" id="especialidade_id"'); ?>
												<?php echo form_error('especialidade_id'); ?>
											</div>
										</div>
										<div class="form-group" id="selectProfissionais">
											<label class="col-sm-2 control-label" for="profissionais_id">Profissional: </label>
											<div class="col-sm-9">
												<select class="form-control fill_select btn_in own_select boxdropdown-toggle" id="profissionais_id" name="profissionais_id"
												data-size="7" data-live-search="true">
													<option value='0'>Escolha um Profissional</option>
												</select>
											</div>
										</div>		
								</div>
							</div>
						</div>				
					<!-- Div com os horarios disponiveis -->
					<div class="col-md-12" data-container="main">
						<div class="panel panel-default">
							<div class="panel-heading clearfix">
								<h4 class="panel-title">Horários Disponíveis</h4>
							</div>
							<div class="panel-body">
							<table class="display table table-bordered mg-top-20">
									<thead>
										<tr>
											<th rowspan="3">Profissional</th>
											<th>Dia da Semana</th>
											<th>Horário</th>
											<!-- <th>Cod.Consulta</th>
											<th rowspan="3">Paciente</th>
											<th>Data</th> -->
											<th class="td-actions" style="text-align:center">Adicionar</th>
										</tr>
									</thead>
									<tbody id="horarios_abertos">
										<?php if(@$listaHorarios) { ?>
											<?php foreach($listaHorarios as $item): ?>
												<tr id="horarios_presencas_<?php echo $item->frequencia_id; ?>">
													<td><?php echo $item->nome_prof; ?></td>
													<td><?php echo $item->desc_dia_semana; ?></td>
													<td><?php echo $item->desc_horario; ?></td>
													<!-- <td><?php echo $item->consultas_id; ?></td>
													<td><?php echo $item->paciente; ?></td>
													<td><?php echo date("d/m/Y", strtotime($item->data_consulta)); ?></td> -->
												</tr>
											<?php endforeach; ?>
										<?php } else { ?>
												<tr id="horarios_presencas">
													<td><p> <i class="fa fa-exclamation-circle"></i> <i>Nenhum horário a ser mostrado.</i> </p>
													</td>
												</tr>		
										<?php } ?>
									</tbody>
								</table>
								<div class="form-actions">
									<div class="col-sm-12" style="padding-right: 0;">
										<input type="button" name="buscar_horarios" class="btn btn-primary buscar_horarios pull-right" value="Salvar Consulta" />
										
									</div>
								</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Div com os horarios disponiveis -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Script Template Mustache -->
<script id="horarios-template" type="x-tmpl-mustache">
	<tr id="horarios_presencas_{{frequencia_id}}">
		<td>{{nome_prof}}</td>
		<td>{{desc_dia_semana}}</td>
		<td>{{desc_horario}}</td>
		<!-- <td>{{consultas_id}}</td>
		<td>{{paciente}}</td>
		<td>{{data_consulta}}</td> -->
		<td style="text-align:center">
			<!-- <a href="<?php echo site_url("consultas/criar/{{frequencia_id}}");?>" 
			class="btn btn-sm-table btn-primary" id=""><span class="fa fa-search"></span>
			</a> -->
			<input type="checkbox" name="horarios_id" value="{{horarios_id}}" /><br />
			
		</td>
	</tr>
</script>
<!-- Script Template Mustache -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/js.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/validate.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		$("#pacientes").selectpicker();
		$("#especialidade_id").selectpicker();
		//$("#profissionais_id").selectpicker();
	});
</script>