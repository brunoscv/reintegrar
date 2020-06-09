<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-white has-shadow">
				<div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Faturamento - Receita</h4>
									<!-- <a href="<?php echo site_url("faturamento/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar  </a> -->
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<h3 class="right" <?php echo $displayed; ?>><?php echo "Valor Total: R$ " . number_format($listaValor, 2, ',', '.'); ?></h3>
									<div class="table-responsive">
										<?php $this->load->view('layout/filters.php'); ?>
										<table class="display table tablesaw tablesaw-stack" data-tablesaw-mode="stack" style="margin-top:2em;">
											<thead>
												<tr>
													<th>#</th>
													<th>Cod. Consulta</th>
													<th>Pacientes</th>
													<th>Profissionais</th>
													<th>Especialidades</th>
													<th>Plano/Proced</th>
													<th <?php echo $displayed; ?>>Valor</th>
													<th>Criado</th>
													
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaFaturamento as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->consultas_id; ?></td>
														<td><?php echo $item->nome_pac; ?></td>
														<td><?php echo $item->nome_prof; ?></td>
														<td><?php echo $item->nome_espec; ?></td>
														<td><?php echo $item->nome_plano; ?></td>
														<td <?php echo $displayed; ?>><?php echo "R$ " . number_format($item->valor, 2, ',', '.'); ?></td>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														
													</tr>
													<?php endforeach; ?>
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
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/faturamento/js.js"></script>
	<!-- <div class="col-md-12">
		<div class="col-md-6">
			<h3 <?php echo $color?>><?php echo $tipo . " Mensal - R$ " . $valorMensalPorTipo[0]->valor; ?></h3>
		</div>
		<div class="col-md-6">
			<h3 <?php echo $color?>><?php echo $tipo . " Diária - R$ " . $valorDiarioPorTipo[0]->valor; ?></h3>
			<td class="td-actions">
			<a href="<?php echo site_url("faturamento/editar/".$item->id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
			<a href="<?php echo site_url("faturamento/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
		</div>
	</div> -->