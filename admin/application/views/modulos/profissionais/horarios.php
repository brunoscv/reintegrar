<div class="page-title">
	<div class="container">
		<h3> Horarios de Profissionais</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li> Horarios de Profissionais</li>
	</ol>
</div> -->
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
									<h4 class="panel-title">Controle de Horarios de Profissionais</h4>
									<a href="<?php echo site_url("profissionais/dia_semana/" . $profissionais_id );?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>

								<div class="panel-body" style="margin-top:10px;">
									
									<div class="table-responsive">
										<?php echo $this->load->view('layout/search.php'); ?>
										<table class="display table table-bordered mg-top-20">
										<div class="col-md-12 mg-top-20">
											<div class="col-md-4">
												<p class="text-center"><b>Cód. Profissional:</b> <span><?php echo $profissionais[0]->id;?></span></p>
											</div>
											<div class="col-md-4">
												<p class="text-center"><b>Profissional:</b> <span><?php echo $profissionais[0]->nome_prof;?></span></p>
											</div>
											<div class="col-md-4">
												<p class="text-center"><b>Especialidade:</b> <span><?php echo $profissionais[0]->nome_espec;?></span></p>
											</div>
										</div>
											<thead>
												<tr>
													<th>Codigo</th>
													<th>Dia da Semana</th>
													<th>Horario</th>
													<th>Data</th>
													<th class="td-actions">Status</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($listaHorarios as $item): ?>
													<tr>
														<td><?php echo $item->id; ?></td>
														<td><?php echo $item->desc_dia_semana; ?></td>
														<td><?php echo $item->desc_horario; ?></td>
														<td><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
														<?php if ($item->status == 1) { ?>
														<td class="td-actions"><button type="button" 
														 	horario_id="<?php echo $item->id ?>"
														 	id="btn-horario_<?php echo $item->id;?>" 
													        status="<?php echo $item->status; ?>" class="btn btn-sm-table btn-success salvarHorarioProfissional"><i class="fa fa-check"></i>
															</button>
														</td>
														<?php } else { ?>
														<td class="td-actions"><button type="button" 
														 	horario_id="<?php echo $item->id ?>" 
														 	id="btn-horario_<?php echo $item->id;?>" 
													        status="<?php echo $item->status; ?>" class="btn btn-sm-table btn-danger salvarHorarioProfissional"><i class="fa fa-check"></i>
															</button>
														</td>
														<?php } ?>
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
	<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/profissionais/js.js"></script> -->
	<script type="text/javascript">
		$(document).ready(function() {
			$("body").on('click','.salvarHorarioProfissional',function(event) {
				var horario_id = $(this).attr("horario_id");
				var status = $(this).attr("status");
				
				html = $(this).html();
				
				$.ajax({
					url:  base_url + 'profissionais/salvarHorarioProfissional/' + horario_id,
					type: 'POST',
					context: this,
					data: {frenquecia_id: horario_id},
					beforeSend:function(){
	                	$(this).html("<i class='fa fa-2x fa-spin fa-spinner align-middle'></i>");
		            },
		            complete:function(data){
		 				
		 				 if(status == 1) {
		               		$('#btn-horario_' + horario_id).html("<i class='fa fa-check align-middle'></i>").removeClass("btn-success").addClass("btn-danger").attr("status", 0);

						} else {
							$('#btn-horario_' + horario_id).html("<i class='fa fa-check align-middle'></i>").removeClass("btn-danger").addClass("btn-success").attr("status", 1);
		               	}	

		              	toastr.success("Ação completada com sucesso");
		                console.log(data);    
		            },
		            success: function (data) {  
					   console.log(data);    
		            }
				});
			});
		});
	</script>