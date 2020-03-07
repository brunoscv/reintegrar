<div class="page-title">
	<div class="container">
		<h3>Pacientes</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li>Pacientes</li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent has-shadow">
				<div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Pacientes</h4>
									<a href="<?php echo site_url("pacientes/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Pacientes </a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<?php echo $this->load->view('layout/search.php'); ?>
										<table class="display table table-hover table-condensed mg-top-20">
											<thead>
												<tr>
													<th>#</th>
													<th>Nome</th>
													<th>Email</th>
													<th>RG</th>
													<th>CPF</th>
													<th>Carteira</th>
													<th>Telefone</th>
													<th>Data</th>
													<th>Status</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaPacientes as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->nome_pac; ?></td>
														<td><?php echo $item->email_pac; ?></td>
														<td><?php echo $item->rg; ?></td>
														<td><?php echo $item->cpf; ?></td>
														<td><?php echo $item->carteira; ?></td>
														<td><?php echo $item->telefone_pac; ?></td>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														<td><?php echo ($item->status == 1) ? '<span class="label label-success"> Ativo </span>' : '<span class="label label-danger"> Inativo </span>';?></td>
														<td class="td-actions">
															<button type="button" 
																	class="btn btn-default fa fa-ellipsis-v" 
																	id="myPopover" 
																	data-toggle="popover"
																	data-trigger="focus"
																	data-anamation="true"
																	data-html="true"
																	data-content="<a href='<?php echo site_url("pacientes/editar/".$item->id); ?>' class='ver_info'>
																					<p><i class='btn-icon-only fa fa-eye'></i></span> Ver</p>
																					<a href='<?php echo site_url("pacientes/editar/".$item->id); ?>' class='editar_info'>
																					<p><i class='btn-icon-only fa fa-pencil'></i></span> Editar</p> "
																	data-placement="bottom">
															</button>
														</td>
															<!-- <a href="<?php echo site_url("pacientes/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td> -->
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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/pacientes/js.js"></script>
	<script type="text/javascript">
		$(document).ready(function(event) {
			$('[data-toggle="popover"]').popover();
			
		});
</script>