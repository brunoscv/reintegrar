<div class="page-title">
	<div class="container">
		<h3>Profissionais</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Profissionais</li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
					<?php $this->load->view('layout/messages.php'); ?>
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Profissionais</h4>
									<a href="<?php echo site_url("profissionais/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Profissionais </a>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<?php $this->load->view('layout/search.php'); ?>
										<table class="display table table-bordered mg-top-20">
											<thead>
												<tr>
													<th>Codigo</th>
													<th>Nome</th>
													<th>Telefone</th>
													<th>Email</th>
													<th>Especialidade</th>
													<th>Status</th>
													<th>Data</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaProfissionais as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->nome_prof; ?></td>
														<td><?php echo $item->telefone_prof; ?></td>
														<td><?php echo $item->email_prof; ?></td>
														<td><?php echo $item->nome_espec; ?></td>
														<?php if ($item->status == 1) { ?>
															<td><span class="icone icone-success"><i class="fa fa-check"> </i></span></td>
														<?php } else { ?>
															<td><span class="icone icone-danger"><i class="fa fa-times"> </i></span></td>
														<?php } ?>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														<td class="td-actions">
															<!-- <a href="<?php echo site_url("profissionais/adicionar_horario/".$item->id); ?>" class="btn btn-small btn-primary" alt="Horários"><i class="fa fa-clock-o"> </i></a> -->
															<a href="<?php echo site_url("profissionais/editar/".$item->id); ?>" class="btn btn-sm-table btn-primary"><i class="fa fa-pencil"> </i></a>
															<a href="<?php echo site_url("profissionais/dia_semana/".$item->id); ?>" class="btn btn-sm-table btn-pagination"><i class="fa fa-calendar"> </i></a>
															<!-- <a href="<?php echo site_url("profissionais/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a> -->
														</td>
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/profissionais/js.js"></script>