<div class="page-title">
	<div class="container">
		<h3>Permissoes</h3>
	</div>
</div>
<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Permissoes</li>
	</ol>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
					<?php $this->load->view('layout/messages.php'); ?>
					<div class="row" data-container="all">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Permissoes</h4>
									<a href="<?php echo site_url("permissoes/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Permissoe </a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<?php $this->load->view('layout/search.php'); ?>
										<table class="display table">
											<thead>
												<tr>
													<th>Código</th>
													<th>Controller</th>
													<th>Métodos</th>
													<th>Usuário</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaPermissoes as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo ucfirst($item->classe); ?></td>
														<td><?php echo ucfirst($item->metodo); ?></td>
														<td><?php echo $item->nome; ?></td>
														<td class="td-actions">
														<a href="<?php echo site_url("permissoes/editar/".$item->usuarios_id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
															<a href="<?php echo site_url("permissoes/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/permissoes/js.js"></script>