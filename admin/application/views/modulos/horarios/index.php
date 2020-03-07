<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>Horarios</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Horarios</h3>
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
				                    <h4 class="panel-title">Controle de Horarios</h4>
				                    <a href="<?php echo site_url("horarios/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Horario </a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<table class="display table">
											<thead>
												<tr>
													<th>Id</th>
													<th>Horário</th>
													<th>Status</th>
													<th>createdAt</th>
													<th>updatedAt</th>
																										<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaHorarios as $item): ?>
												<tr>
													<td><?php echo $item->id; ?></td>
													<td><?php echo $item->desc_horario; ?></td>
													<td><?php echo $item->status; ?></td>
													<td><?php echo $item->createdAt; ?></td>
													<td><?php echo $item->updatedAt; ?></td>
																										<td class="td-actions">
														<a href="<?php echo site_url("horarios/editar/".$item->id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
														<a href="<?php echo site_url("horarios/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/horarios/js.js"></script>