<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("perfis")?>">Perfil</a></li>
        <li>Remover Perfil</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Perfis</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<?php echo $this->load->view("layout/messages"); ?>
                	<div class="row">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Perfis de Acesso</h4>
				                    <a href="<?php echo site_url("perfis/criar/");?>" class="btn btn-primary pull-right"> Adicionar perfil </a>
				                </div>
								<div class="panel-body">
									<div class="table-responsive">
                						<?php echo $this->load->view('layout/search.php'); ?>
										<table class="display table" style="width: 100%; cellspacing: 0;">
											<thead>
												<tr>
													<th>Descrição</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaPerfis as $perfil): ?>
												<tr>
													<td><?php echo $perfil->descricao; ?></td>
													<td class="td-actions">
														<a href="<?php echo site_url('perfis/editar/'.$perfil->id); ?>" class="btn btn-small btn-success"><i class="btn-icon-only fa fa-pencil"> </i></a>
														<a href="<?php echo site_url("perfis/delete/".$perfil->id)?>" class="btn btn-danger btn-small"><i class="btn-icon-only fa fa-times"> </i></a>
													</td>
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