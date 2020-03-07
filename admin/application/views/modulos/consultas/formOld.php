<div class="page-title">
	<div class="container">
		<h3>Controle de Consultas</h3>
	</div>
</div>
<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("consultas")?>">Consultas</a></li>
		<li>Adicionar Consulta </li>
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
									<h4 class="panel-title">Consultas / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("consultas/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<!-- <form id="form_consultas" action="<?php echo current_url(); ?>" class="form-horizontal" method="post"> -->
									<form id="form_consultas" class="form-horizontal">
									<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="pacientes_id">Paciente</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('pacientes_id', $listaPacientes, set_value('pacientes_id', @$item->pacientes_id), 'class="form-control" id="pacientes_id"'); ?>
												<?php echo form_error('pacientes_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="plano_procedimento_id">Proc./Plano</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('plano_procedimento_id', $listaProcedimentos, set_value('plano_procedimento_id', @$item->plano_procedimento_id), 'class="form-control" id="plano_procedimento"'); ?>
												<?php echo form_error('plano_procedimento_id'); ?>
											</div>
										</div>
										<div class="form-group" id="selectProfissionais">
											<label class="col-sm-2 control-label" for="profissionais_id">Profissional</label>
											<div class="col-sm-10">
												<!-- <?php echo form_dropdown('profissionais_id', $listaProfissionais, set_value('profissionais_id', @$item->profissionais_id), 'class="form-control"'); ?>
												<?php echo form_error('profissionais_id'); ?> -->
												<select class="form-control" id="profissionais" name="profissionais_id">
													<option value='0'>Escolha um Profissional</option>
												</select>
											</div>
										</div>
										<div class="form-group" id="selectProfissionais">
											<label class="col-sm-2 control-label" for="profissionais_id">Frequência</label>
											<div class="col-sm-10">
												<!-- <?php echo form_dropdown('profissionais_id', $listaProfissionais, set_value('profissionais_id', @$item->profissionais_id), 'class="form-control"'); ?>
												<?php echo form_error('profissionais_id'); ?> -->
												<select class="form-control" id="profissionais" name="profissionais_id">
													<option value='0'>Escolha a Frequência de Atendimentos</option>
												</select>
											</div>
										</div>
										
										<div class="form-actions">
											<div class="col-sm-12" style="padding-right: 0;">
												<input type="button" name="buscarHorarios" class="btn btn-primary buscarHorarios pull-right" value="Buscar Horários" />
												
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>				
					<!-- Div com os horarios disponiveis -->
					<div class="col-md-12" data-container="main">
						<div class="panel panel-default">
							<div class="panel-heading clearfix">
								<h4 class="panel-title">Horários Disponíveis</h4>
							</div>
							<div class="panel-body" style="margin-top:10px;">
								<table class="display table">
									<thead>
										<tr>
											<th>Horário</th>
											<th>Dia da Semana</th>
											<th rowspan="3">Profissional</th>
											<th>Data</th>
											<th class="td-actions">Selecionar</th>
										</tr>
									</thead>
									<tbody id="horarios_abertas">
										<?php if(@$listaItemConsulta) { ?>
											<?php foreach($listaItemConsulta as $item): ?>
												<tr id="horarios_presencas_<?php echo $item->id; ?>">
													<td><?php echo $item->desc_horario; ?></td>
													<td><?php echo $item->desc_dia_semana; ?></td>
													<td><?php echo $item->nome_prof; ?></td>
													<td><?php echo date("d/m/Y", strtotime($item->data)); ?></td>
													<td class="td-actions">
														<button type="button" id = "btn-paciente_<?php echo $item->id; ?>"
																frequencia_id = "<?php echo $item->id; ?>"
															    class="btn btn-small btn-danger salvarPresencaPaciente">
															    <i class="fa fa-check"></i>
														</button>	
													</td>
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
	  <tr id="horarios_presencas_{{id}}">
	    <td>{{desc_horario}}</td>
	    <td>{{desc_dia_semana}}</td>
	    <td>{{nome_prof}}</td>
	    <td>{{data}}</td>
	    <td><button type='button' id='btn-paciente_{{id}}' frequencia_id='{{id}}' 
	                class='btn btn-small btn-danger salvarPresencaPaciente'>
	                <i class='fa fa-check'></i>
	        </button>
	    </td>
	 </tr>
	</script>
	<!-- Script Template Mustache -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/js.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/validate.js"></script>