<div id="main-wrapper" class="container" style="margin-top:2em; height: 100vh">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Faturamento por Planos</h4>
									<a href="<?php echo site_url("faturamento/tipo/1");?>" class="btn btn-primary pull-right"><span class="fa fa-arrow-left"></span> Voltar  </a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
									<?php $this->load->view('layout/search.php'); ?>
										<table class="display table table-hover mg-top-20">
											<thead>
												<tr>
													<th>#</th>
													<th>Nome Plano</th>
													<th>Valor</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaFaturamento as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->nome_plano; ?></td>
														<td><?php echo $item->valor; ?></td>
													<?php endforeach; ?>
												</tbody>
											</table>
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