<div class="page-title">
	<div class="container">
	<h3>Periodos Por Consulta</h3>
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
									<h4 class="panel-title">Periodos Por Consulta</h4>
									<!-- <a href="<?php echo site_url("periodoconsulta/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar   </a> -->
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<?php $this->load->view('layout/search.php'); ?>
										<table class="display table">
											<thead>
												<tr>
													<th>Id</th>
													<th>Data Atendimento</th>
													<th>Status</th>
													<th>Cod. Consulta</th>
													<th>Data</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaPeriodoConsulta as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->data; ?></td>
														<td><?php echo $item->status; ?></td>
														<td><?php echo $item->consultas_id; ?></td>
														<td><?php echo $item->createdAt; ?></td>
														<td class="td-actions">
															<a href="<?php echo site_url("periodoconsulta/editar/".$item->id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
															<a href="<?php echo site_url("periodoconsulta/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/periodoconsulta/js.js"></script>