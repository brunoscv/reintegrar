<div class="page-title">
	<div class="container">
		<h3>Dashboard</h3>

	</div>
</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h4 class="panel-title"><i class="fa fa-line-chart"></i>Ultimos Projetos Adicionados</h4>
					<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
				</div>
				<div class="panel-body">
					<?php $this->load->view('layout/messages.php'); ?>
					<div class="col-md-12">
						<div class="table-responsive" id="dataTables">
							<?php $this->load->view('layout/search.php'); ?>
								<div>
								<table class="display table table-bordered mg-top-20">
										<thead>
											<tr>
												<th>Id</th>
												<th>Cliente</th>
												<th>Área de Desejo</th>
												<th>Data</th>
												<th>Status</th>
												<th class="td-actions"></th>
											</tr>
										</thead>
										<tbody id="consultas-abertas">
											<?php if(@$listaItemConsulta) { ?>
												<?php foreach($listaItemConsulta as $item): ?>
													<tr id="presenca_consulta_<?php echo $item->id; ?>">
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->cod_consulta; ?></td>
														<td><?php echo $item->desc_horario; ?></td>
														<td><?php echo $item->desc_dia_semana; ?></td>
														
														<td><?php echo date("d/m/Y", strtotime($item->data)); ?></td>
														<td class="td-actions">
															<button type="button" id = "btn-paciente_<?php echo $item->id; ?>"
																	frequencia_id = "<?php echo $item->id; ?>"
																    class="btn btn-small btn-danger salvarPresencaPaciente">
																    <i class="fa fa-check"></i>
															</button>
															
														</td>
													</tr>
												<?php endforeach; ?>
											<?php } else { ?>
													<tr id="presenca_consulta">
														<td><p> <i>Nenhuma consulta encontrada. </i></p></td>
													</tr>
													
											<?php } ?>
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
	<!-- Script Template Mustache -->
	<script id="user-template" type="x-tmpl-mustache">
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
	</script>
	<!-- Script Template Mustache -->

	<!-- Script Template Mustache -->
	<script id="consulta-template" type="x-tmpl-mustache">
	  <tr id='presenca_consulta_{{id}}'>
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
	</script>
	<!-- Script Template Mustache -->
	<script type="text/javascript">
		$(document).ready(function() {
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
		        		$('#presenca_consulta_' + frequencia_id).html("");
						var json_obj = data.consultas_abertas; //parse JSON
		               
		               if(data.sucesso == true) {
				        	for (var i in json_obj) {
		                   		var template = $('#user-template').html();
			        			Mustache.parse(template); // optional, speeds up future uses
		                        var rendered = Mustache.render(template, json_obj[i]);
		                        $('#presenca_consulta').append(rendered);
		                    }
			          		toastr.success("Ação Completada com Sucesso");    
		               } else {
			               	toastr.error("Ação não pode ser executada");
		               }
					   console.log(json_obj[i]);    
		            }
				});
			});

			$("body").on('click','#btn-gerarconsultas',function(event) {
				
				html = $(this).html();
				
				$.ajax({
					url:  base_url + 'dashboard/gerarConsultas/',
					type: 'POST',
					context: this,
					dataType:"json",
					
					beforeSend:function(){
		            	$(this).html("<i class='fa fa-2x fa-spin fa-spinner align-middle'></i>");

		            },
		            complete:function(data){
		            	$(this).html("<i class='fa fa-check'></i>");
		            	$("#com-consulta-aviso").html("<i>As consultas para a data atual foram geradas com sucesso.</i>");
		              console.log(data);      
		            },
		            success: function (data) {
		        		$('#presenca_consulta').html("");
		            	$("#com-consulta-aviso").html("");
						var json_obj = data.consultas_abertas; //parse JSON
		               
		               if(data.sucesso == true) {
				        	for (var i in json_obj) {
		                   		var template = $('#consulta-template').html();
			        			Mustache.parse(template); // optional, speeds up future uses
		                        var rendered = Mustache.render(template, json_obj[i]);
		                        $('#consultas-abertas').append(rendered);
		                    }
			          		toastr.success("Ação Completada com Sucesso");    
		               } else {
			               	toastr.error("Ação não pode ser executada");
		               }
					   console.log(template);    
		            }
				});
			});
		});
	</script>
	