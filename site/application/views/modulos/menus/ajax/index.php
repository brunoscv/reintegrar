<div class="row" data-container="all">
	<div class="col-md-4">
		<?php echo $this->load->view('layout/search.php'); ?>
	</div>
	<div class="col-md-8" data-container="main">
		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<div class="panel-title">
					Menus
				</div>
			</div>
			<!-- /widget-header -->
			<div class="panel-body">
				<?php echo $this->load->view("layout/messages"); ?>
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
							<td><?php echo $menu->descricao; ?></td>
							<td class="td-actions">
								<a data-item data-label="<?php echo $menu->descricao; ?>" data-value="<?php echo $menu->id; ?>" class="btn btn-small btn-success">
									<i class="btn-icon-only fa fa-check"></i>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div class="paginate">
					<?php echo (isset($paginacao)) ? $paginacao : ''; ?>
				</div>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
	</div>
</div>
<!-- /row -->