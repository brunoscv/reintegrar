<div class="page-title">
	<div class="container">
		<h3>Especialidades</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Especialidades</li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent has-shadow">
				<div class="panel-body">
					<?php echo $this->load->view('layout/messages.php'); ?>
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Especialidades</h4>
									<a href="<?php echo site_url("especialidades/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Especialidade </a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<?php echo $this->load->view('layout/search.php'); ?>
										<table class="display table table-condensed table-hover mg-top-20">
											<thead>
												<tr>
													<th>#</th>
													<th>Nome</th>
													<th>Data</th>
													<th>Status</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaEspecialidades as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->nome_espec; ?></td>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														<td><?php echo ($item->status == 1) ? '<span class="label label-success"> Ativo </span>' : '<span class="label label-danger"> Inativo </span>';?></td>
														<!-- <td class="td-actions">
															<a href="<?php echo site_url("especialidades/editar/".$item->id); ?>" class="btn btn-sm-table btn-primary"><i class="fa fa-pencil"> </i></a>
															<a href="<?php echo site_url("especialidades/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a>
														</td> -->
														<td class="td-actions">
															<button type="button" 
																	class="btn btn-default fa fa-ellipsis-v" 
																	id="myPopover" 
																	data-toggle="popover"
																	data-trigger="focus"
																	data-anamation="true"
																	data-html="true"
																	data-content="<a href='<?php echo site_url("especialidades/editar/".$item->id); ?>' class='ver_info'>
																					<p><i class='btn-icon-only fa fa-eye'></i></span> Ver</p>
																					<a href='<?php echo site_url("especialidades/delete/".$item->id); ?>' class='editar_info'>
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/especialidades/js.js"></script>
	<script type="text/javascript">
    $(document).ready(function(event) {
        $('[data-toggle="popover"]').popover();
    });
</script>