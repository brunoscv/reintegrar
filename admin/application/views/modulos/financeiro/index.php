<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<h3 class="">Financeiro</h3>
			<p>
				<a href="<?php echo site_url("financeiro/criar");?>" class="btn btn-primary"><span class="fa fa-plus"></span> Novo Faturamento </a>
				<a href="<?php echo site_url("financeiro/criar");?>" class="btn btn-primary"><span class="fa fa-archive"></span> Relatório </a>
			</p>
		</div>
        <div class="col-md-12">
            <div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h3 class="panel-title">Lista de Faturamentos</h3>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view("layout/messages"); ?>
					<div class="table-responsive">
						<table class="display table table-financeiro table-striped table-hover mg-top-20">
							<thead>
								<tr>
									<th>Cod.</th>
									<th>Profissional</th>
									<th>Data da Nota</th>
									<th>Qtd Atendimentos</th>
									<th>Valor</th>
									<th>Status</th>
									<th>Criado</th>
									<th class="td-actions"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($listaFinanceiro as $item): ?>
								<tr>
									<!-- <td><span class="label label-danger"> Inativo </span></td> -->
									<td><?php echo $item->id; ?></td>
									<td><?php echo $item->nome_prof; ?></td>
									<td><?php echo date("d/m/Y", strtotime($item->data_nota)); ?></td>
									<td><?php echo $item->qtd_atendimentos; ?></td>
									<td><?php echo $item->valor_nota; ?></td>
									<td><?php echo ($item->status == 1 ? '<span class="label label-success"> Ativo </span>' : '<span class="label label-danger"> Inativo </span>') ?></td>
									<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
									<td class="td-actions">
										<a href="<?php echo site_url("financeiro/editar/".$item->id); ?>" class="mr-2"><i class="fa fa-pencil text-info font-16"></i></a>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/atendimentos/js.js"></script> -->
<script type="text/javascript">
    $(document).ready(function(event) {
		$('[data-toggle="popover"]').popover();
		$('.table-financeiro').dataTable();
    });
</script>