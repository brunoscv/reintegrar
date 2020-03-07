<div class="page-title">
	<div class="container">
		<h3>Faturamento</h3>
	</div>
</div>
<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Faturamento</li>
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
									<h4 class="panel-title">Controle de Faturamento</h4>
									<a href="<?php echo site_url("faturamento/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar  </a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
									<?php $this->load->view('layout/search.php'); ?>
										<table class="display table table-hover mg-top-20">
											<thead>
												<tr>
													<th>Id</th>
													<th>Pacientes</th>
													<th>Profissionais</th>
													<th>Especialidades</th>
													<th>Plano/Proced</th>
													<th>Consultas</th>
													<th>Item Consulta</th>
													<th>Valor</th>
													<th>Tipo Faturamento</th>
													<th>Status</th>
													<th>Criado</th>
													<th>Modificado</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaFaturamento as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->pacientes_id; ?></td>
														<td><?php echo $item->profissionais_id; ?></td>
														<td><?php echo $item->especialidades_id; ?></td>
														<td><?php echo $item->plano_procedimento_id; ?></td>
														<td><?php echo $item->consultas_id; ?></td>
														<td><?php echo $item->item_consulta_id; ?></td>
														<td><?php echo $item->valor; ?></td>
														<td><?php echo $item->tipo; ?></td>
														<td><?php echo $item->status; ?></td>
														<td><?php echo $item->createdAt; ?></td>
														<td><?php echo $item->updatedAt; ?></td>
														<td class="td-actions">
															<a href="<?php echo site_url("faturamento/editar/".$item->id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
															<a href="<?php echo site_url("faturamento/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
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