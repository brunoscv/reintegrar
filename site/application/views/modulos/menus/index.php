<div class="page-title">
    <div class="container">
        <h3>Menus</h3>
    </div>
</div>
<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>Menus</li>
    </ol>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
                	<div class="row">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<a href="<?php echo site_url("menus/criar/");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span>Adicionar menu</a>
				                    <div class="panel-title">
				                    	Menus do Sistema
				                    </div>

				                </div>
								<div class="panel-body">
									<?php echo $this->load->view("layout/messages"); ?>
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
												<?php foreach($listaMenus as $menu): ?>
												<tr>
													<td><i class="<?php echo $menu->icone; ?>"></i> <?php echo $menu->descricao; ?></td>
													<td class="td-actions">
														<a href="<?php echo site_url('menus/editar/'.$menu->id); ?>" class="btn btn-small btn-success"><i class="btn-icon-only fa fa-pencil"> </i></a>
														<a href="<?php echo site_url("menus/delete/".$menu->id)?>" class="btn btn-danger btn-small"><i class="btn-icon-only fa fa-times"> </i></a>
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
	<!-- endrow -->
</div>