<div class="page-title">
	<div class="container">
		<h3>Procedimento por Plano</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Procedimento por Plano</li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Procedimento por Plano</h4>
									<a href="<?php echo site_url("planoprocedimento/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar   </a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<?php echo $this->load->view('layout/search.php'); ?>
										<table class="display table table-bordered mg-top-20" id="tabela">
											<thead>
												<tr>
													<th>Codigo</th>
													<th>Planos</th>
													<th>Especialidades</th>
													<th>Valor</th>
													<th>Data</th>
													<th>Status</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaPlanoProcedimento as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->nome_plano; ?></td>
														<td><?php echo $item->nome_espec; ?></td>
														<td><?php echo number_format($item->valor, 2, ',', '.'); ?></td>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														<?php if ($item->status == 1) { ?>
																<td><a href="" class="icone icone-success"><i class="fa fa-check"> </i></a></td>
															<?php } else { ?>
																<td><a href="" class="icone icone-success"><i class="fa fa-times"> </i></a></td>
															<?php } ?>
														<td class="td-actions">
															<a href="<?php echo site_url("planoprocedimento/editar/".$item->id); ?>" class="btn btn-sm-table btn-primary"><i class="fa fa-pencil"> </i></a>
															<!-- <a href="<?php echo site_url("planoprocedimento/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td> -->
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/planoprocedimento/js.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			$("#tabela").DataTable({
				"bJQueryUI": false,
				"bFilter": false,
				"bInfo": false,
				"bPaginate": false,
				"aaSorting": [[ 0, 'desc' ]], 
			});
		});
	</script>