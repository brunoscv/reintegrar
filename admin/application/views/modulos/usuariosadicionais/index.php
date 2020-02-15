<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>Clientes</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Clientes</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
                	<div class="row">
                		<div class="col-md-4">
                			<?php echo $this->load->view('layout/search.php'); ?>
                		</div>
						<div class="col-md-8" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Usuarios de <?php echo $clienteAtual->nome_empresa?></h4>
									<a href="<?php echo site_url("usuariosadicionais/criar/");?>?clientes_id=<?php echo $this->clientes_id; ?>" class="btn btn-primary pull-right"> Adicionar </a>
								</div>
								<div class="panel-body">
									<?php echo $this->load->view("layout/messages"); ?>
									<div class="table-responsive">
										<table class="display table" style="width: 100%; cellspacing: 0;">
											<thead>
												<tr>
													<th>Usuario</th>
													<th>Data Criação</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaUsuarios as $usuario): ?>
												<tr>
													<td><?php echo $usuario->usuario; ?></td>
													<td><?php $data = new \DateTime($usuario->createdAt); echo $data->format("d/m/Y H:i:s"); ?></td>
													<td class="td-actions">
														<a href="<?php echo site_url('usuariosadicionais/editar/'.$usuario->id); ?>/?clientes_id=<?php echo $this->clientes_id; ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
														<a href="<?php echo site_url("usuariosadicionais/delete/".$usuario->id)?>/?clientes_id=<?php echo $this->clientes_id; ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
												</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
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