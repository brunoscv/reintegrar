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
								<div id="teste"></div>
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

											<th>Data</th>
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
												<td><?php echo $item->nome_pac; ?></td>
												<td><?php echo $item->nome_prof; ?></td>
												<!-- <td><?php echo $item->nome_espec; ?></td>
												<td><?php echo $item->nome_plano; ?></td>
												<td><?php echo $item->item_consulta_id; ?></td>-->
												<td><?php echo date("d/m/Y", strtotime($item->data)); ?></td>
												<td class="td-actions">
													<!-- <a href="<?php echo site_url("itemconsulta/presenca_consulta/".$item->presenca); ?>" class="btn btn-small btn-danger"><i class="fa fa-check"> </i></a> -->
													<button type="button" id = "btn-paciente_<?php echo $item->id; ?>"
															frequencia_id = "<?php echo $item->id; ?>"
														    class="btn btn-small btn-danger salvarPresencaPaciente">
														    <i class="fa fa-check"></i>
													</button>
													
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
</div>
	<!-- Script Template Mustache -->
	<script id="user-template" type="x-tmpl-mustache">
		<div>
			<tr>
			    <td>{{id}}</td>
			    <td>{{cod_consulta}}</td>
			    <td>{{desc_horario}}</td>
			    <td>{{desc_dia_semana}}</td>
			    <td>{{nome_pac}}</td>
			    <td>{{nome_prof}}</td>
			    <td>{{data}}</td>
			    <td><button type='button' id='btn-paciente_{{id}}' frequencia_id='{{id}}' 
			                class='btn btn-small btn-danger salvarPresencaPaciente'>
			                <i class='fa fa-check'></i>
			        </button>
			    </td>
			</tr>	
		</div>
	</script>
	<!-- Script Template Mustache -->
	<script type="text/javascript">

		$("body").on('click','.salvarPresencaPaciente',function(event) {
			var frequencia_id = $(this).attr("frequencia_id");
			var presenca = $(this).attr("presenca");
			    html = $(this).html();
			
			$.ajax({
				url:  base_url + 'itemconsulta/presenca_consulta/' + frequencia_id,
				type: 'POST',
				context: this,
				dataType:"json",
				data: {id: frequencia_id},
				
				beforeSend:function(){
	            	$(this).html("<i class='fa fa-2x fa-spin fa-spinner align-middle'></i>");
	            },
	            complete:function(data){
	            	$(this).html("<i class='fa fa-check'></i>");
	              console.log(data);      
	            },
	            success: function (data) {
					$('#teste').html("");
			       
				   var json_obj = data.consultas_abertas; //parse JSON
	               
	               if(data.sucesso == true) {
	             
			        	for (var i in json_obj) {
	                   		var template = $('#user-template').html();
		        			Mustache.parse(template); // optional, speeds up future uses
	                        var rendered = Mustache.render(template, json_obj[i]);
	                        $('#teste').append(rendered);
	                    }
		          //       toastr.success("Ação Completada com Sucesso");
		               
	               } else {
		               	toastr.error("Ação não pode ser executada");
	               }
				   console.log(data);    
	            }
			});
		});
	</script>
	