<div class="page-title">
	<div class="container">
		<h3>Item Consulta</h3>
	</div>
</div>
<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Item Consulta</li>
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
									<h4 class="panel-title">Controle de Item Consulta</h4>
									<!-- <a href="<?php echo site_url("itemconsulta/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar   </a> -->
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<?php echo $this->load->view('layout/search.php'); ?>
										<table class="display table">
											<thead>
												<tr>
													<th>Id</th>
													<th>Horário</th>
													<th>Dia Semana</th>
													<th>Status</th>
													<th>Periodo Consuta</th>
													<th>Cod Consulta</th>
													<th>createdAT</th>
													<th>updatedAt</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaItemConsulta as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->horarios_id; ?></td>
														<td><?php echo $item->dia_semana_id; ?></td>
														<td><?php echo $item->status; ?></td>
														<td><?php echo $item->periodo_consulta_id; ?></td>
														<td><?php echo $item->consultas_id; ?></td>
														<td><?php echo $item->createdAT; ?></td>
														<td><?php echo $item->updatedAt; ?></td>
														<td class="td-actions">
															<a href="<?php echo site_url("itemconsulta/editar/".$item->id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
															<a href="<?php echo site_url("itemconsulta/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
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
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/itemconsulta/js.js"></script> -->