<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Controle de Atendimentos</h4>
					<a href="<?php echo site_url("atendimentos/criar");?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Adicionar Atendimento </a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<div class="table-responsive">
						<?php $this->load->view('layout/search.php'); ?>
						<table class="display table table-hover mg-top-20">
							<thead>
								<tr>
																		<th>Cod.</th>
																		<th>Cod. Consulta</th>
																		<th>Qtd Atendimentos</th>
																		<th>Freq. Atendimentos</th>
																		<th>Data Ref.</th>
																		<th>Status</th>
																		<th>Criado</th>
																		<th>Modificado</th>
																		<th class="td-actions"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($listaAtendimentos as $item): ?>
								<tr>
									<!-- <td><span class="label label-danger"> Inativo </span></td> -->
																		<td><?php echo $item->id; ?></td>
																		<td><?php echo $item->consultas_id; ?></td>
																		<td><?php echo $item->qtd_atendimentos; ?></td>
																		<td><?php echo $item->freq_atendimentos; ?></td>
																		<td><?php echo $item->data_ref; ?></td>
																		<td><?php echo $item->status; ?></td>
																		<td><?php echo $item->createdAt; ?></td>
																		<td><?php echo $item->updatedAt; ?></td>
																		<td class="td-actions">
										<button type="button" 
												class="btn btn-default fa fa-ellipsis-v" 
												id="myPopover" 
												data-toggle="popover"
												data-anamation="true"
												data-html="true"
												data-content="<a href='<?php echo site_url("atendimentos/editar/".$item->id); ?>' class='editar_info'>
																<p><i class='btn-icon-only fa fa-pencil'></i></span> Editar</p>
																<a href='<?php echo site_url("atendimentos/delete/".$item->id); ?>' class='delete_info'>
																<p><i class='btn-icon-only fa fa-trash'></i></span> Excluir</p> "
												data-placement="bottom">
										</button>
									</td>
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
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/atendimentos/js.js"></script> -->
<script type="text/javascript">
    $(document).ready(function(event) {
        $('[data-toggle="popover"]').popover(); 
    });
</script>