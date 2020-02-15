<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>Usuário</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Usuários</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-4">
							<?php echo $this->load->view('layout/search.php'); ?>
						</div>
						<div class="col-md-8" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Usuários do Sistema</h4>
				                    <a href="<?php echo site_url("usuarios/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Usuário</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<div class="table-responsive">
										<table class="display table">
											<thead>
												<tr>
													<th>Usuário</th>
													<th>Data Criação</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaUsuarios as $usuario): ?>
												<tr>
													<td><?php echo $usuario->usuario; ?></td>
													<td><?php $data = new \DateTime($usuario->createdAt); echo $data->format("d/m/Y H:i:s"); ?></td>
													<td class="td-actions"><a href="<?php echo site_url('usuarios/editar/'.$usuario->id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a><a href="<?php echo site_url("usuarios/delete/".$usuario->id)?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
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