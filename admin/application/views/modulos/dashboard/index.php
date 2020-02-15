<div class="page-title">
	<div class="container">
		<h3>Dashboard</h3>
	</div>
</div>
<section class="dashboard-header">
	<div class="container-fluid">
		<div class="row">
			<!-- Statistics -->
			<div class="statistics col-lg-3 col-12">
				<div class="statistic d-flex align-items-center bg-white has-shadow">
					<div class="icon bg-red"><i class="fa fa-tasks"></i></div>
					<div class="text"><strong><?php echo $qtd_atd;?></strong><br><small>Atendimentos Realizados</small></div>
				</div>
				<div class="statistic d-flex align-items-center bg-white has-shadow">
					<div class="icon bg-green"><i class="fa fa-calendar-o"></i></div>
					<div class="text"><strong>108</strong><br><small>Especialidades Cadastradas</small></div>
				</div>
				<div class="statistic d-flex align-items-center bg-white has-shadow">
					<div class="icon bg-orange"><i class="fa fa-paper-plane-o"></i></div>
					<div class="text"><strong>15</strong><br><small>Convênios Atendidos</small></div>
				</div>
			</div>
			<div class="col-lg-9 col-12">
				<div class="panel panel-white has-shadow">
					<div class="panel-heading clearfix">
						<h4 class="panel-title">Perfis de Acesso</h4>
					</div>
					<div class="panel-body" style="margin-top:10px;">
						<!-- Pie Chart  -->
						<div class="col-lg-5 col-12">
							<div class="pie-chart d-flex align-items-center justify-content-center">
								<canvas id="pieChart"></canvas>
							</div>
							<div id="legends" class="chart-legend"></div>
							<style type="text/css">
								.chart-legend li span {
									display: inline-block;
									width: 12px;
									height: 12px;
									margin-right: 5px;
								}
							</style>
						</div>
						<!-- Line Chart  -->
						<div class="col-lg-7 col-12">
							<div class="line-chart d-flex align-items-center justify-content-center">
								<canvas id="lineChart"></canvas>
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
						<h4 class="panel-title"><i class="fa fa-line-chart"></i> Agenda Diária</h4>
						<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
					</div>
					<div class="panel-body">
						<?php $this->load->view('layout/messages.php'); ?>
						<div class="col-md-12">
							<div class="table-responsive" id="dataTables">
								<?php $this->load->view('layout/search.php'); ?>
								<table class="display table mg-top-20">
									<thead>
										<tr>
											<th>#</th>
											<th>Coluna 1</th>
											<th>Coluna 2</th>
											<th>Coluna 3</th>
											<th>Coluna 4</th>
											<th class="td-actions"></th>
										</tr>
									</thead>
									<tbody id="consultas-abertas">
										<?php if(@$listaItemConsulta) { ?>
											<?php foreach(@$listaItemConsulta as $item): ?>
												<tr id="presenca_consulta_<?php echo $item->id; ?>">
													<td><?php echo $item->id; ?></td>
													<td><?php echo $item->cod_consulta; ?></td>
													<td><?php echo $item->desc_horario; ?></td>
													<td><?php echo $item->desc_dia_semana; ?></td>
													<td><?php echo $item->nome_pac; ?></td>
													<td class="td-actions">
														<button type="button" 
																class="btn btn-default fa fa-ellipsis-v" 
																id="myPopover" 
																data-toggle="popover"
																data-anamation="true"
																data-html="true"
																data-content="<a href='<?php echo site_url("perfis/editar/".$item->id); ?>' class='editar_info'>
																				<p><i class='btn-icon-only fa fa-pencil'></i></span> Editar</p>
																				<a href='<?php echo site_url("perfis/delete/". $item->id); ?>' class='delete_info'>
																				<p><i class='btn-icon-only fa fa-trash'></i></span> Excluir</p> "
																data-placement="bottom">
														</button>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php } else { ?>
												<tr id="presenca_consulta">
													<td><p> <i>Nenhuma busca encontrada. </i></p></td>
												</tr>
												
										<?php } ?>
									</tbody>
								</table>	
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