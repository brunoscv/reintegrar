<div class="page-title">
	<div class="container">
		<h3>Reposição de Consultas</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Consultas</li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<?php echo $this->load->view('layout/messages.php'); ?>
			<div class="panel panel-transparent">
				<div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Reposicoes de Consultas</h4>
									<a href="<?php echo site_url("consultas/criar_reposicao");?>" class="btn btn-primary pull-right">
									<span class="fa fa-plus"></span> Adicionar Reposicao </a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<?php echo $this->load->view('layout/search.php'); ?>
										<table class="display table table-hover mg-top-20">
											<thead>
												<tr>
													<th>#</th>
													<th>Paciente</th>
													<th>Proc./Plano</th>
													<th>Profissional</th>
													<th>Status</th>
													<th>Data</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaConsultas as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->nome_pac; ?></td>
														<td><?php echo $item->nome_plano . " - " . $item->nome_espec; ?></td>
														<td><?php echo $item->nome_prof; ?></td>
														<td><?php echo (@$item->status == 1 ? "<a href=''><span class='label label-success mudarStatus' consultas_id='{$item->id}' status='{$item->status}'> Ativo </span></a>" : "<a href=''><span class='label label-danger mudarStatus' consultas_id='{$item->id}' status='{$item->status}'> Inativo </span></a>") ?></td>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														<td class="td-actions">
															<button type="button" 
																	class="btn btn-default fa fa-ellipsis-v" 
																	id="myPopover" 
																	data-toggle="popover"
																	data-anamation="true"
																	data-html="true"
																	data-content="<a href='<?php echo site_url("periodoconsulta/ver/".$item->id); ?>' class='ver'>
																					<p><i class='btn-icon-only fa fa-eye'></i></span> Ver</p>
																					<a href='<?php echo site_url("consultas/editar/". $item->id); ?>' class='editar_info'>
																					<p><i class='btn-icon-only fa fa-pencil'></i></span> Editar</p> "
																	data-placement="bottom">
															</button>
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
<script src="<?php echo base_url(); ?>assets/plugins/bootbox/bootbox.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/js.js"></script>
<script type="text/javascript">
    $(document).ready(function(event) {
        $('[data-toggle="popover"]').popover(); 
    });
</script>