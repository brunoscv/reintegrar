<div class="page-title">
	<div class="container">
		<h3> Horarios de Profissionais</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li> Horarios de Profissionais</li>
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
									<h4 class="panel-title">Controle de Horarios de Profissionais</h4>
									<a href="<?php echo site_url("profissionais");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<?php $this->load->view('layout/search.php'); ?>
										<table class="display table table-bordered mg-top-20">
											<div class="col-md-12 mg-top-20">
												<div class="col-md-4">
													<p class="text-center"><b>Cód. Profissional:</b> <span><?php echo $profissionais[0]->id;?></span></p>
												</div>
												<div class="col-md-4">
													<p class="text-center"><b>Profissional:</b> <span><?php echo $profissionais[0]->nome_prof;?></span></p>
												</div>
												<div class="col-md-4">
													<p class="text-center"><b>Especialidade:</b> <span><?php echo $profissionais[0]->nome_espec;?></span></p>
												</div>
											</div>
											<thead>
												<tr>
													<th>Codigo</th>
													<th>Dia da Semana</th>
													<th>Data</th>
													<th>Status</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaDias as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->desc_dia_semana; ?></td>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														<?php if ($item->status == 1) { ?>
															<td><span class="icone icone-success"><i class="fa fa-check"> </i></span></td>
														<?php } else { ?>
															<td><span class="icone icone-danger"><i class="fa fa-times"> </i></span></td>
														<?php } ?>
														<td class="td-actions">
															<a href="<?php echo site_url("profissionais/horarios/". $profissionais_id . "/" . $item->id); ?>" class="btn btn-sm-table btn-primary"><i class="fa fa-clock-o"> </i></a>
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