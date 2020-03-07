<div class="page-title">
	<div class="container">
		<h3>Item Consulta</h3>
	</div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
					<?php echo $this->load->view('layout/messages.php'); ?>
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Controle de Item Consulta</h4>
									<a href="<?php echo site_url("periodoconsulta/ver/". $listaItemConsulta[0]->cod_consulta);?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="table-responsive">
										<table class="display table table-hover mg-top-20">
											<div class="col-md-12">
												<div class="col-md-3">
													<p class="text-center"><b>Paciente:</b> <span><?php echo $listaItemConsulta[0]->nome_pac;?></span></p>
												</div>
												<div class="col-md-3">
													<p class="text-center"><b>Profissional:</b> <span><?php echo $listaItemConsulta[0]->nome_prof;?></span></p>
												</div>
												<div class="col-md-3">
													<p class="text-center"><b>Especialidade:</b> <span><?php echo $listaItemConsulta[0]->nome_espec;?></span></p>
												</div>
												<div class="col-md-3">
													<p class="text-center"><b>Plano:</b> <span><?php echo $listaItemConsulta[0]->nome_plano;?></span></p>
												</div>
											</div>
											<thead>
												<tr>
													<th>#</th>
													<th>Cod Consulta</th>
													<th>Horário</th>
													<th>Dia Semana</th>
													<th>Periodo Consulta</th>
													<th>Status</th>
													<th class="td-actions"></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaItemConsulta as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->cod_consulta; ?></td>
														<td><?php echo $item->desc_horario; ?></td>
														<td><?php echo $item->desc_dia_semana; ?></td>
														<td><?php echo date("m/Y", strtotime($item->data)); ?></td>
														<td><?php echo (@$item->status == 1 ? '<span class="label label-success"> Ativo </span>' : '<span class="label label-danger"> Inativo </span>') ?></td>
														<!-- <td class="td-actions">
															<a 
																href="<?php echo site_url("itemconsulta/consulta/" . $item->periodo_consulta_id . "/" . $item->id);?>" class="btn btn-primary"
																data-widget="buscaConsulta"
																data-dialog="one"
																data-width="90%"
																data-label="#menupai"
																data-value="#menus_id"
																data-title="Consulta"
															><i class="fa fa-medkit"></i> </a>
															<a href="<?php echo site_url("itemconsulta/editar/".$item->id); ?>" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a>
															<a href="<?php echo site_url("itemconsulta/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td> -->
															<td class="td-actions">
																<button type="button" 
																		class="btn btn-default fa fa-ellipsis-v" 
																		id="myPopover" 
																		data-toggle="popover"
																		data-anamation="true"
																		data-html="true"
																		data-content="<a href='<?php echo site_url("itemconsulta/editar/".$item->id); ?>' class='ver'>
																						<p><i class='btn-icon-only fa fa-pencil'></i></span> Editar</p>
																						<a href='<?php echo site_url("itemconsulta/deletar/". $item->id); ?>' class='editar_info'>
																						<p><i class='btn-icon-only fa fa-trash'></i></span> Deletar</p> "
																		data-placement="bottom">
																</button>
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
	</div>
<!-- 	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/itemconsulta/js.js"></script> -->
<script type="text/javascript">
    $(document).ready(function(event) {
        $('[data-toggle="popover"]').popover(); 
    });
</script>