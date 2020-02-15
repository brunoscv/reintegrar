<div class="page-title">
	<div class="container">
		<h3>Dashboard</h3>
	</div>
</div>
<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="/">Home</a></li>
		<li>Dashboard</li>
	</ol>
</div>
<div id="main-wrapper" class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-line-chart"></i> Nossos Dados</h4>
					<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
				</div>
				<div class="panel-body">
					<div class="col-md-3">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h4 class="panel-title"><i class="fa fa-line-chart"></i> Novos Pacientes</h4>
								<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
							</div>
							<div class="panel-body">
								<p style="font-size: 4em; text-align: right">36</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h4 class="panel-title"><i class="fa fa-line-chart"></i> Consultas Realizadas</h4>
								<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
							</div>
							<div class="panel-body">
								<p style="font-size: 4em; text-align: right">140</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h4 class="panel-title"><i class="fa fa-line-chart"></i> Novos Planos</h4>
								<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
							</div>
							<div class="panel-body">
								<p style="font-size: 4em; text-align: right">12</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h4 class="panel-title"><i class="fa fa-line-chart"></i> Nova Especialidades</h4>
								<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
							</div>
							<div class="panel-body">
								<p style="font-size: 4em; text-align: right">6</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-line-chart"></i> Agenda Diária</h4>
					<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
				</div>
				<div class="panel-body">
					<?php echo $this->load->view('layout/messages.php'); ?>
					<div class="col-md-12">
						<div class="table-responsive" id="dataTables">
							<?php echo $this->load->view('layout/search.php'); ?>
							<table class="display table">
								<thead>
									<tr>
										<th>Id</th>
										<th>Cod Consulta</th>
										<th>Horário</th>
										<th>Dia</th>
										<th>Paciente</th>
										<th>Profissional</th>
										<!--<th>Especialidade</th>
										<th>Plano</th> -->

										<th>Status</th>
										<th>Data</th>
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
											<td><?php echo $item->nome_pac; ?></td>
											<td><?php echo $item->nome_prof; ?></td>
											<!-- <td><?php echo $item->nome_espec; ?></td>
											<td><?php echo $item->nome_plano; ?></td>
											<td><?php echo $item->item_consulta_id; ?></td>-->
											<td><?php echo date("d/m/Y", strtotime($item->data)); ?></td>
											<td class="td-actions">
												<a href="<?php echo site_url("itemconsulta/presenca_consulta/".$item->presenca); ?>" class="btn btn-small btn-danger"><i class="fa fa-check"> </i></a>
												
											</td>
												<!-- <a href="<?php echo site_url("itemconsulta/ver/".$item->periodo_consulta_id); ?>" class="btn btn-small btn-primary"><i class="fa fa-medkit"> </i></a></td> -->
												<!-- <a href="<?php echo site_url("itemconsulta/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td> -->
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
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-line-chart"></i> Pacientes Presentes</h4>
					<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="display table">
								<thead>
									<tr>
										<th>Id</th>
										<th>Cod Consulta</th>
										<th>Horário</th>
										<th>Dia</th>
										<th>Paciente</th>
										<th>Profissional</th>
										<th>Especialidade</th>
										<th>Plano</th><!-- 
										<th>Status</th> -->
										<th>Data</th>
										<th class="td-actions"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaItemConsultaPresente as $items): ?>
										<tr>
											<td><?php echo $items->id; ?></td>
											<td><?php echo $items->cod_consulta; ?></td>
											<td><?php echo $items->desc_horario; ?></td>
											<td><?php echo $items->desc_dia_semana; ?></td>
											<td><?php echo $items->nome_pac; ?></td>
											<td><?php echo $items->nome_prof; ?></td>
											<td><?php echo $items->nome_espec; ?></td>
											<td><?php echo $items->nome_plano; ?></td><!-- 
											<td><?php echo $items->status; ?></td> -->
											<td><?php echo date("d/m/Y", strtotime($items->data)); ?></td>
											<td class="td-actions">
												<button type="button" class="btn btn-small btn-success"><i class="fa fa-check"> </i></button></td>
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
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-line-chart"></i> Pacientes Ausentes</h4>
					<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="display table">
								<thead>
									<tr>
										<th>Id</th>
										<th>Cod Consulta</th>
										<th>Horário</th>
										<th>Dia</th>
										<th>Paciente</th>
										<th>Profissional</th>
										<th>Especialidade</th>
										<th>Plano</th><!-- 
										<th>Status</th> -->
										<th>Data</th>
										<th class="td-actions"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaItemConsultaAusente as $items): ?>
										<tr>
											<td><?php echo $items->id; ?></td>
											<td><?php echo $items->cod_consulta; ?></td>
											<td><?php echo $items->desc_horario; ?></td>
											<td><?php echo $items->desc_dia_semana; ?></td>
											<td><?php echo $items->nome_pac; ?></td>
											<td><?php echo $items->nome_prof; ?></td>
											<td><?php echo $items->nome_espec; ?></td>
											<td><?php echo $items->nome_plano; ?></td><!-- 
											<td><?php echo $items->status; ?></td> -->
											<td><?php echo date("d/m/Y", strtotime($items->data)); ?></td>
											<td class="td-actions">
												<button type="button" class="btn btn-small btn-danger"><i class="fa fa-check"> </i></button></td>
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
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-line-chart"></i> Agenda por Profissional</h4>
					<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
				</div>
				<div class="panel-body">
					<form class="form-inline" style="margin-top:10px;" action="#">
						
						<div class="form-group m-b-sm">
							<?php echo form_dropdown('profissionais_id', $listaProfissionais,$this->input->get("profissionais_id"), 'class="form-control m-b-sm" id="profissionais_id"'); ?>
						</div>
						<button type="button" class="btn btn-success m-b-sm procurarAgendamentos">
							<i class="fa fa-search"></i>
						</button>
						
						<div class="form-group">
							<a class="ajax" href="<?php echo site_url( strtolower(get_active_class()) ); ?>"><span class="fa fa-eraser"></span> Limpar Filtro</a>
						</div>
					</form>
            		<div class="alert alert-warning" role="alert">
                    	<i class="fa fa-exclamation-circle"></i> <span>Utilize o campo de busca para procurar a Agenda do Profissional.</span>
                	</div>
					<div class="col-md-12">
						<div id="agendamentos">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-line-chart"></i> Contratos Inadimplentes</h4>
					<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="table-responsive">
							<?php echo $this->load->view('layout/search.php'); ?>
							<table class="display table">
								<thead>
									<tr>
										<th>Id</th>
										<th>Nome Paciente</th>
										<th>Profissional</th>
										<th>Especialidade</th>
										<th>Plano</th>
										<th>Data Renovacao</th>
										<th class="td-actions"></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaItemConsulta as $item): ?>
										<tr>
											<td><?php echo $item->id; ?></td>
											<td><?php echo $item->nome_pac; ?></td>
											<td><?php echo $item->nome_prof; ?></td>
											<td><?php echo $item->nome_espec; ?></td>
											<td><?php echo $item->nome_plano; ?></td>
											<td><?php echo date("d/m/Y", strtotime($item->data)); ?></td>
											<td class="td-actions">
												<a href="<?php echo site_url("itemconsulta/ver/".$item->id); ?>" class="btn btn-small btn-danger"><i class="fa fa-check"> </i></a></td>
												<!-- <a href="<?php echo site_url("itemconsulta/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td> -->
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
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/dashboard/js.js"></script> -->
	<script type="text/javascript">
	
		$("body").on('click','.salvarPresencaPaciente',function(event) {
			var frequencia_id = $(this).attr("frequencia_id");
			var presenca = $(this).attr("presenca");
			
			html = $(this).html();
			$.ajax({
				url:  base_url + 'itemconsulta/salvarPresencaPaciente/' + frequencia_id,
				type: 'POST',
				context: this,
				data: {matricula_turma_id: matricula_turma_id},
				beforeSend:function(){
                	$(this).html("<i class='fa fa-2x fa-spin fa-spinner align-middle'></i>");
	            },
	            complete:function(data){
	              console.log(data);      
	            },
	            success: function (data) {
	               
	               if(data.sucesso == true) {
		               
	               } else {
		               	toastr.error("Ação não pode ser executada");
	               }
				   console.log(data);    
	            }
			});
		});
	</script>
</div>
	