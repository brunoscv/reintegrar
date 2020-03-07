<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white has-shadow">
					<div class="panel-heading mt2">
						<h4 class="panel-title"><i class="fa fa-user-md"></i> Atendimentos Diários</h4>
						<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
					</div>
					<div class="panel-body">
						<?php $this->load->view('layout/messages.php'); ?>
						<div class="col-md-9 col-xs-9">
							<div class="table-responsive" id="dataTables">
								<!-- <?php $this->load->view('layout/search.php'); ?> -->
									<div>
									<table class="display datatable table table-hover mg-top-20">
											<thead>
												<tr>
													<!-- <th>#</th> -->
													<th>Horário</th>
													<!-- <th>Dia</th> -->
													<!-- 
														<th>Especialidade</th> -->
													<th>Paciente</th>
													<th>Profissional</th>
													<!-- <th>Planos</th>-->
													<th>Data</th> 
													<th class="td-actions text center" <?php echo $displayed; ?>></th>
												</tr>
											</thead>
											<tbody id="consultas-abertas">
												<?php if($listaConsultas) { ?>
													<?php foreach($listaConsultas as $item): ?>
														<tr id="presenca_consulta_<?php echo $item->horario_consulta_id; ?>">
															<!-- <td><?php echo $item->horario_consulta_id; ?></td> -->
															<td style="font-weight:bold"><?php echo strtoupper($item->desc_horario); ?></td>
															<!-- <td><?php echo $item->desc_dia_semana; ?></td> -->
															<td style="font-weight:bold"><?php echo  strtoupper($item->nome_pac); ?></td>
															<!-- 
															<td><?php echo $item->nome_espec; ?></td> -->
															 <td style="font-weight:bold"><?php echo $item->nome_prof; ?></td>
															<!--<td><?php echo $item->nome_plano; ?></td>-->
															<td style="font-weight:bold"><?php echo date("d/m/Y", strtotime($item->data)); ?></td> 
															<td class="td-actions" <?php echo $displayed; ?>>
																<button type="button" 
																		id="btn_consulta_<?php echo $item->id;?>"
																		consultas_id="<?php echo $item->id;?>"
																		dias_semana_id="<?php echo $item->dia_semana_id;?>"
																		horarios_id="<?php echo $item->horario_id;?>"
																		horario_consulta_id="<?php echo $item->horario_consulta_id;?>"
																		status_faturamento="1"
																		class="btn btn-sm-table btn-success salvarPresencaAtendimento"><strong>P</strong>
																</button>
																<button type="button" 
																		id="btn_consulta_<?php echo $item->id;?>"
																		consultas_id="<?php echo $item->id;?>"
																		dias_semana_id="<?php echo $item->dia_semana_id;?>"
																		horarios_id="<?php echo $item->horario_id;?>"
																		horario_consulta_id="<?php echo $item->horario_consulta_id;?>"
																		status_faturamento="0"
																		class="btn btn-sm-table btn-warning salvarPresencaAtendimento"><strong>D</strong>
																</button>
																<button type="button" 
																		id="btn_consulta_<?php echo $item->id;?>"
																		consultas_id="<?php echo $item->id;?>"
																		dias_semana_id="<?php echo $item->dia_semana_id;?>"
																		horarios_id="<?php echo $item->horario_id;?>"
																		horario_consulta_id="<?php echo $item->horario_consulta_id;?>"
																		status_faturamento="2"
																		class="btn btn-sm-table btn-danger salvarPresencaAtendimento"><strong>F</strong>
																		<!-- <i class="fa fa-close"></i> -->
																</button>
																<button type="button" 
																		id="btn_consulta_<?php echo $item->id;?>"
																		consultas_id="<?php echo $item->id;?>"
																		dias_semana_id="<?php echo $item->dia_semana_id;?>"
																		horarios_id="<?php echo $item->horario_id;?>"
																		horario_consulta_id="<?php echo $item->horario_consulta_id;?>"
																		status_faturamento="2"
																		class="btn btn-sm-table btn-primary">
																		<i class="fa fa-comment"></i>
																		<span class="badge">5</span>
																</button>
															</td>
														</tr>
													<?php endforeach; ?>
													<!-- Script Template Mustache -->
														<script id="consultas-template" type="x-tmpl-mustache">
															<tr id='presenca_consulta_{{horario_consulta_id}}'>
																<td>{{id}}</td>
																<td>{{desc_horario}}</td>
																<td>{{desc_dia_semana}}</td>
																<td>{{nome_pac}}</td>
																<td>{{nome_prof}}</td>
																<td>{{nome_espec}}</td>
																<td>{{data}}</td>
																<td><button type='button' id='btn_consulta_{{id}}' 
																					consultas_id = "{{id}}"
																					dias_semana_id = "{{dias_semana_id}}"
																					horarios_id = "{{horarios_id}}" 
																					horario_consulta_id = "{{horario_consulta_id}}" 
																			class="btn btn-sm-table btn-success salvarPresencaAtendimento"><strong>CF</strong>
																	</button>
																	<button type='button' id='btn_consulta_{{id}}' 
																					consultas_id = "{{id}}"
																					dias_semana_id = "{{dias_semana_id}}"
																					horarios_id = "{{horarios_id}}" 
																					horario_consulta_id = "{{horario_consulta_id}}" 
																			class="btn btn-sm-table btn-warning #salvarPresencaAtendimento"><strong>SF</strong>
																	</button>
																	<button type='button' id='btn_consulta_{{id}}' 
																					consultas_id = "{{id}}"
																					dias_semana_id = "{{dias_semana_id}}"
																					horarios_id = "{{horarios_id}}" 
																					horario_consulta_id = "{{horario_consulta_id}}" 
																			class="btn btn-small btn-danger #salvarPresencaAtendimento">
																			<i class='fa fa-close'></i>
																	</button>
																</td>
															</tr>	
														</script>
													<!-- Script Template Mustache -->
													<?php } else { ?>
														<tr id="presenca_consulta">
															<td><p> <i>Nenhuma consulta encontrada. </i></p></td>
														</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								<div class="paginate">
									<?php echo (isset($paginacao)) ? $paginacao : ''; ?>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-xs-3">
							<div id="calendario"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white has-shadow">
					<div class="panel-heading">
						<h4 class="panel-title"><i class="fa fa-user-md"></i> Reposições Diárias</h4>
						<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
					</div>
					<div class="panel-body">
						<?php $this->load->view('layout/messages.php'); ?>
						<div class="col-md-12">
							<div class="table-responsive" id="dataTables">
								<?php $this->load->view('layout/search.php'); ?>
									<div>
									<table class="display table table-hover mg-top-20 tablesaw tablesaw-stack" data-tablesaw-mode="stack">
											<thead>
												<tr>
													<th>#</th>
													<th>Horário</th>
													<th>Dia</th>
													<th>Paciente</th>
													<th>Profissional</th>
													<th>Data</th>
													<th>Status</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody id="reposicoes-abertas">
												<?php if($listaReposicoes) { ?>
													<?php foreach($listaReposicoes as $item): ?>
														<tr id="presenca_reposicao_<?php echo $item->horario_consulta_id; ?>">
															<td><?php echo $item->horario_consulta_id; ?></td>
															<td><?php echo $item->desc_horario; ?></td>
															<td><?php echo $item->desc_dia_semana; ?></td>
															<td><?php echo $item->nome_pac; ?></td>
															<td><?php echo $item->nome_prof; ?></td>
															<td><?php echo date("d/m/Y", strtotime($item->data)); ?></td>
															<td class="td-actions">
																<button type="button" 
																		id="btn_reposicao_<?php echo $item->id;?>"
																		consultas_id="<?php echo $item->id;?>"
																		dias_semana_id="<?php echo $item->dia_semana_id;?>"
																		horarios_id="<?php echo $item->horario_id;?>"
																		horario_consulta_id="<?php echo $item->horario_consulta_id;?>"
																		class="btn btn-danger salvarPresencaReposicao">
																		<i class="fa fa-check"></i>
																</button>
															</td>
														</tr>
													<?php endforeach; ?>
													<!-- Script Template Mustache -->
														<script id="reposicao-template" type="x-tmpl-mustache">
															
																<tr id='presenca_reposicao_{{horario_consulta_id}}'>
																	<td>{{id}}</td>
																	<td>{{desc_horario}}</td>
																	<td>{{desc_dia_semana}}</td>
																	<td>{{nome_pac}}</td>
																	<td>{{nome_prof}}</td>
																	<td>{{data}}</td>
																	<td><button type='button' id='btn_reposicao_{{id}}' 
																					  consultas_id = "{{id}}"
																					  dias_semana_id = "{{dias_semana_id}}"
																					  horarios_id = "{{horarios_id}}" 
																					  horario_consulta_id = "{{horario_consulta_id}}" 
																				class="btn btn-small btn-danger salvarPresencaReposicao">
																				<i class='fa fa-check'></i>
																		</button>
																	</td>
																</tr>	
															
														</script>
													<!-- Script Template Mustache -->
													<?php } else { ?>
														<tr id="presenca_reposicao">
															<td><p> <i>Nenhuma reposicao encontrada. </i></p></td>
														</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								<div class="paginate">
									<?php echo (isset($paginacao)) ? $paginacao : ''; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white has-shadow">
					<div class="panel-heading">
						<h4 class="panel-title"><i class="fa fa-user-md"></i> Consultas Diárias Realizadas</h4>
						<a href="<?php echo base_url().'dashboard';?>" class="btn btn-primary pull-right" id="#atualizarAtendimentos">
						<span class="fa fa-refresh"></span> Atualizar </a>
						<div class="alterar-visualizacao"></div>
					</div>
					<div class="panel-body">
						<?php $this->load->view('layout/messages.php'); ?>
						<div class="col-md-12">
							<div class="table-responsive" id="dataTables">
								<?php $this->load->view('layout/search.php'); ?>
									<div>
									<table class="display table table-hover mg-top-20">
											<thead>
												<tr>
													<th>#</th>
													<th>Horário</th>
													<th>Dia</th>
													<th>Paciente</th>
													<th>Profissional</th>
													<th <?php echo $displayed; ?>>Tipo</th>
													<th>Data</th>
													<th>Status</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody id="atendimentos-abertos">
												<?php if($listaConsultasRealizadas) { ?>
													<?php foreach($listaConsultasRealizadas as $consulta): ?>
														<tr id="atendimentos_realizados">
															<td><?php echo $consulta->horario_consulta_id; ?></td>
															<td><?php echo $consulta->desc_horario; ?></td>
															<td><?php echo $consulta->desc_dia_semana; ?></td>
															<td><?php echo $consulta->nome_pac; ?></td>
															<td><?php echo $consulta->nome_prof; ?></td>
															<td <?php echo $displayed; ?>><?php echo $consulta->tipo; ?></td>
															<td><?php echo date("d/m/Y", strtotime($consulta->data)); ?></td>
															<td class="td-actions">
															<?php if($consulta->tipo == "1") { ?>
																<button type="button" 
																		id="btn_consulta_realizada_<?php echo $consulta->id;?>"
																		consultas_id="<?php echo $consulta->id;?>"
																		dias_semana_id="<?php echo $consulta->dia_semana_id;?>"
																		
																		horario_consulta_id="<?php echo $consulta->horario_consulta_id;?>"
																		
																		data_consulta="<?php echo $consulta->data;?>"
																		class="btn btn-sm-table btn-success resetar_atendimento_realizado"><strong>P</strong>
																</button>
															<?php } elseif ($consulta->tipo == "2") { ?>
																<button type="button" 
																		id="btn_consulta_realizada_<?php echo $consulta->id;?>"
																		consultas_id="<?php echo $consulta->id;?>"
																		dias_semana_id="<?php echo $consulta->dia_semana_id;?>"
																		
																		horario_consulta_id="<?php echo $consulta->horario_consulta_id;?>"
																		
																		data_consulta="<?php echo $consulta->data;?>"
																		class="btn btn-sm-table btn-danger resetar_atendimento_realizado"><strong>F</strong>
																</button>
															<?php } elseif ($consulta->tipo == "0") { ?>
																<button type="button" 
																		id="btn_consulta_realizada_<?php echo $consulta->id;?>"
																		consultas_id="<?php echo $consulta->id;?>"
																		dias_semana_id="<?php echo $consulta->dia_semana_id;?>"
																		
																		horario_consulta_id="<?php echo $consulta->horario_consulta_id;?>"
																	
																		data_consulta="<?php echo $consulta->data;?>"
																		class="btn btn-sm-table btn-warning resetar_atendimento_realizado"><strong>D</strong>
																</button>
															<?php } ?>
															</td>
														</tr>
													<?php endforeach; ?>
													<!-- Script Template Mustache -->
														<script id="atendimentos-template" type="x-tmpl-mustache">
															{{#data}}
															
																<td>{{horario_consulta_id}}</td>
																<td>{{desc_horario}}</td>
																<td>{{desc_dia_semana}}</td>
																<td>{{nome_pac}}</td>
																<td>{{nome_prof}}</td>
																<td>{{data}}</td>
																<td class="td-actions"><button type='button' id='btn_reposicao_{{id}}' 
																					consultas_id = "{{id}}"
																					dias_semana_id = "{{dias_semana_id}}"
																					horarios_id = "{{horarios_id}}" 
																					horario_consulta_id = "{{horario_consulta_id}}" 
																			class="btn btn-small btn-success #salvarPresencaReposicao">
																			<i class='fa fa-check'></i>
																	</button>
																</td>
															
															{{/data}}
														</script>
													<!-- Script Template Mustache -->
													<?php } else { ?>
														<tr id="atendimentos_realizados">
															<td><p> <i>Nenhuma reposicao encontrada. </i></p></td>
														</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								<div class="paginate">
									<?php echo (isset($paginacao)) ? $paginacao : ''; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/dashboard/js.js"></script>
<script>
	$(document).ready(function() {
		$(".datatable").DataTable({
			"paging": false
		});
		$("#calendario").datepicker({
			autoSize: true,
			todayHighlight: true,
			toggleActive: true
		});
	});
</script>