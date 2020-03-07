<div class="page-title">
	<div class="container">
		<h3>Horarios dos Profissionais</h3>
	</div>
</div>
<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Horarios dos Profissionais</li>
	</ol>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
					<?php echo $this->load->view('layout/messages.php'); ?>
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Horarios dos Profissionais</h4>
									<a href="<?php echo site_url("horariosprofissionais/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Horario Profissionai </a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/search.php'); ?>
									<div class="table-responsive">
										<table class="display table">
											<thead>
												<tr>
													<th>Código Horário</th>
													<th>Profissional</th>
													<th>Dia da Semana</th>
													<th>Horario</th>
													<th>Status</th>
													<th>Data</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaHorariosProfissionais as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->nome_prof; ?></td>
														<td><?php echo $item->desc_dia_semana; ?></td>
														<td><?php echo $item->desc_horario; ?></td>
														<?php if ($item->status == 1) { ?>
																<td><a href="" class="btn btn-small btn-success"><i class="fa fa-check"> </i></a></td>
															<?php } else { ?>
																<td><a href="" class="btn btn-small btn-danger"><i class="fa fa-times"> </i></a></td>
															<?php } ?>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														<td class="td-actions">
															<a href="<?php echo site_url("horariosprofissionais/editar/".$item->id); ?>" class="btn btn-small btn-primary"><i class="fa fa-pencil"> </i></a>
															<!-- <a href="<?php echo site_url("horariosprofissionais/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td> -->
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
											<div class="paginate pull-right">
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/horariosprofissionais/js.js"></script>