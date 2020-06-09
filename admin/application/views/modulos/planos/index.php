<div class="page-title">
	<div class="container">
		<h3>Planos</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Planos</li>
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
									<h4 class="panel-title">Controle de Planos</h4>
									<a href="<?php echo site_url("planos/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Plano </a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<?php $this->load->view('layout/search.php'); ?>
										<table class="display table table-bordered mg-top-20">
											<thead>
												<tr>
													<th>Codigo</th>
													<th>Nome</th>
													<th>Telefone</th>
													<th>Email</th>
													<th>Data</th>
													<th>Status</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaPlanos as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->nome_plano; ?></td>
														<td><?php echo $item->telefone_plano; ?></td>
														<td><?php echo $item->email_plano; ?></td>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														<?php if ($item->status == 1) { ?>
																<td><a href="" class="icone icone-success"><i class="fa fa-check"> </i></a></td>
															<?php } else { ?>
																<td><a href="" class="icone icone-dange"><i class="fa fa-times"> </i></a></td>
															<?php } ?>
														<td class="td-actions">
															<a href="<?php echo site_url("planos/editar/".$item->id); ?>" class="btn btn-sm-table btn-primary"><i class="fa fa-pencil"> </i></a><!-- 
															<a href="<?php echo site_url("planos/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td> -->
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/planos/js.js"></script>