<div class="page-title">
	<div class="container">
		<h3>Periodos por Consulta</h3>
	</div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Controle de Períodos de Consulta</h4>
					<a href="<?php echo site_url("consultas/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="display table table-hover mg-top-20">
							<div class="col-md-12">
								<div class="col-md-3">
									<p class="text-center"><b>Paciente:</b> <span><?php echo $listaConsultas[0]->nome_pac;?></span></p>
								</div>
								<div class="col-md-3">
									<p class="text-center"><b>Profissional:</b> <span><?php echo $listaConsultas[0]->nome_prof;?></span></p>
								</div>
								<div class="col-md-3">
									<p class="text-center"><b>Especialidade:</b> <span><?php echo $listaConsultas[0]->nome_espec;?></span></p>
								</div>
								<div class="col-md-3">
									<p class="text-center"><b>Plano:</b> <span><?php echo $listaConsultas[0]->nome_plano;?></span></p>
								</div>
							</div>
							<thead>
								<tr>
									<th>#</th>
									<th>Horário</th>
                                    <th>Dia Semana</th>
									<th>Mensalidade</th>
									<th>Status</th>
                                    <th>Falta Antecipada</th>
									<th class="td-actions"></th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($listaConsultas as $atendimento): ?>
								<tr>
									<td><?php echo $atendimento->id; ?></td>
                                    <td><?php echo $atendimento->desc_horario; ?></td>
                                    <td><?php echo $atendimento->desc_dia_semana; ?></td>
									<td><?php echo date("m/Y", strtotime($atendimento->data)); ?></td>
									<td><?php echo (@$atendimento->status == 1 ? '<span class="label label-success"> Ativo </span>' : '<span class="label label-danger"> Inativo </span>') ?></td>
                                    <td class="td-actions">
										<button type="button" 
												class="btn btn-default fa fa-ellipsis-v" 
												id="myPopover" 
												data-toggle="popover"
												data-anamation="true"
												data-html="true"
												data-content="<a href='<?php echo site_url("itemconsulta/ver/".$atendimento->id); ?>' class='ver'>
																<p><i class='btn-icon-only fa fa-eye'></i></span> Ver</p>
																<a href='<?php echo site_url("itemconsulta/editar/". $atendimento->id); ?>' class='editar_info'>
																<p><i class='btn-icon-only fa fa-pencil'></i></span> Editar</p> "
												data-placement="bottom">
										</button>
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
<!-- 	<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/matriculas/js.js"></script> -->
	<style type="text/css">
		.form-control {
			border: none !important;
		}
		.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
	    background-color: #fff !important;
	    opacity: 1; 
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(event) {
			$('[data-toggle="popover"]').popover(); 
		});
	</script>