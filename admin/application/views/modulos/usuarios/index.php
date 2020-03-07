<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Usuários do Sistema</h4>
					<a href="<?php echo site_url("usuarios/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Novo </a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view("layout/messages"); ?>
					<div class="table-responsive">
						<?php $this->load->view('layout/search.php'); ?>
						<table class="display table table-hover mg-top-20 tablesaw tablesaw-stack" data-tablesaw-mode="stack">
							<thead>
								<tr>
									<th>#</th>
									<th>Nome</th>
									<th>Usuário</th>
									<th>Especialidade</th>
									<th>Status</th>
									<th>Data Criação</th>
									<th class="td-actions"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($listaUsuarios as $usuario): ?>
								<tr>
									<td><?php echo $usuario->id; ?></td>
									<td><?php echo $usuario->nome_prof; ?></td>
									<td><?php echo $usuario->usuario; ?></td>
									<td><?php echo $usuario->nome_espec; ?></td>
									<td><?php echo (@$usuario->status == 1 ? "<a href=''><span class='label label-success mudarStatus' consultas_id='{$usuario->id}' status='{$usuario->status}'> Ativo </span></a>" : "<a href=''><span class='label label-danger mudarStatus' consultas_id='{$usuario->id}' status='{$usuario->status}'> Inativo </span></a>") ?></td>
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