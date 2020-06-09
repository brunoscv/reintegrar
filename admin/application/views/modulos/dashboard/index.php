
<!-- Cards Header -->
<style type="text/css">
.table th, .table td {
    padding: 0.2em 0;
    vertical-align: middle;
}
.table-responsive {
    /* display: block; */
    overflow-x: hidden;
    /* width: 100%; */
    -webkit-overflow-scrolling: touch;
}
</style>
<div class="header bg-gradient-template pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<h6 class="h2 text-white d-inline-block mb-0">Default</h6>
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark">
							<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#">Dashboards</a></li>
							<li class="breadcrumb-item active" aria-current="page">Default</li>
						</ol>
					</nav>
				</div>
				<!-- <div class="col-lg-6 col-5 text-right">
					<a href="#" class="btn btn-sm btn-neutral">New</a>
					<a href="#" class="btn btn-sm btn-neutral">Filters</a>
				</div> -->
			</div>
		</div>
	</div>
</div>
<!-- Cards Header -->
 <!-- Page content -->
 <div class="container-fluid mt--6">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
			  <h3 class="mb-1">Consultas Marcadas para Hoje</h3>
			  <?php $this->load->view('layout/messages.php'); ?>
            </div>
            <div class="table-responsive">
              <table class="table table-flush datatable">
                <thead class="thead-light">
					<!-- <th>#</th> -->
					<th>Horário</th>
					<!-- <th>Dia</th> -->
					<!-- 
						<th>Especialidade</th> -->
					<th>Paciente</th>
					<th>Profissional</th>
					<!-- <th>Planos</th>-->
					<th>Data</th> 
					<th class="text-center" <?php echo $displayed; ?>></th>
				</thead>
				<tbody id="consultas-abertas">
					<?php if($listaConsultas) { ?>
						<?php foreach($listaConsultas as $item): ?>
							<tr id="presenca_consulta_<?php echo $item->horario_consulta_id; ?>">
								<!-- <td><?php echo $item->horario_consulta_id; ?></td> -->
								<td style=""><?php echo strtoupper($item->desc_horario); ?></td>
								<!-- <td><?php echo $item->desc_dia_semana; ?></td> -->
								<td style=""><?php echo  strtoupper($item->nome_pac); ?></td>
								<!-- 
								<td><?php echo $item->nome_espec; ?></td> -->
									<td style=""><?php echo $item->nome_prof; ?></td>
								<!--<td><?php echo $item->nome_plano; ?></td>-->
								<td style=""><?php echo date("d/m/Y", strtotime($item->data)); ?></td> 
								<td class="td-actions" <?php echo $displayed; ?>>
									<button type="button" 
											id="btn_consulta_<?php echo $item->id;?>"
											consultas_id="<?php echo $item->id;?>"
											dias_semana_id="<?php echo $item->dia_semana_id;?>"
											horarios_id="<?php echo $item->horario_id;?>"
											horario_consulta_id="<?php echo $item->horario_consulta_id;?>"
											status_faturamento="1"
											class="btn btn-sm btn-success salvarPresencaAtendimento"><strong>P</strong>
									</button>
									<button type="button" 
											id="btn_consulta_<?php echo $item->id;?>"
											consultas_id="<?php echo $item->id;?>"
											dias_semana_id="<?php echo $item->dia_semana_id;?>"
											horarios_id="<?php echo $item->horario_id;?>"
											horario_consulta_id="<?php echo $item->horario_consulta_id;?>"
											status_faturamento="0"
											class="btn btn-sm btn-warning salvarPresencaAtendimento"><strong>D</strong>
									</button>
									<button type="button" 
											id="btn_consulta_<?php echo $item->id;?>"
											consultas_id="<?php echo $item->id;?>"
											dias_semana_id="<?php echo $item->dia_semana_id;?>"
											horarios_id="<?php echo $item->horario_id;?>"
											horario_consulta_id="<?php echo $item->horario_consulta_id;?>"
											status_faturamento="2"
											class="btn btn-sm btn-danger salvarPresencaAtendimento"><strong>F</strong>
											<!-- <i class="fa fa-close"></i> -->
									</button>
									<button type="button" 
											id="btn_consulta_<?php echo $item->id;?>"
											consultas_id="<?php echo $item->id;?>"
											dias_semana_id="<?php echo $item->dia_semana_id;?>"
											horarios_id="<?php echo $item->horario_id;?>"
											horario_consulta_id="<?php echo $item->horario_consulta_id;?>"
											status_faturamento="2"
											class="btn btn-sm btn-primary comentarios">
											<i class="fa fa-comment"></i>
									</button>
								</td>
							</tr>
						<?php endforeach; ?>
						<!-- Script Template Mustache -->
							<script id="consultas-template" type="x-tmpl-mustache">
								<tr id='presenca_consulta_{{horario_consulta_id}}'>
									<td>{{id}}</td>
									<td>{{desc_horario}}</td>
									<td>{{desc_dia_semana}}</td>
									<td>{{nome_pac}}</td>
									<td>{{nome_prof}}</td>
									<td>{{nome_espec}}</td>
									<td>{{data}}</td>
									<td><button type='button' id='btn_consulta_{{id}}' 
														consultas_id = "{{id}}"
														dias_semana_id = "{{dias_semana_id}}"
														horarios_id = "{{horarios_id}}" 
														horario_consulta_id = "{{horario_consulta_id}}" 
												class="btn btn-sm btn-success salvarPresencaAtendimento"><strong>CF</strong>
										</button>
										<button type='button' id='btn_consulta_{{id}}' 
														consultas_id = "{{id}}"
														dias_semana_id = "{{dias_semana_id}}"
														horarios_id = "{{horarios_id}}" 
														horario_consulta_id = "{{horario_consulta_id}}" 
												class="btn btn-sm btn-warning #salvarPresencaAtendimento"><strong>SF</strong>
										</button>
										<button type='button' id='btn_consulta_{{id}}' 
														consultas_id = "{{id}}"
														dias_semana_id = "{{dias_semana_id}}"
														horarios_id = "{{horarios_id}}" 
														horario_consulta_id = "{{horario_consulta_id}}" 
												class="btn btn-small btn-danger #salvarPresencaAtendimento">
												<i class='fa fa-close'></i>
										</button>
									</td>
								</tr>	
							</script>
						<!-- Script Template Mustache -->
						<?php } else { ?>
							<tr id="presenca_consulta">
								<td><p> <i>Nenhuma consulta encontrada. </i></p></td>
							</tr>
					<?php } ?>
				</tbody>
			</table>
		   </div>
		</div>
	</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/dashboard/js.js"></script>
<script type="text/javascript">
	var base_url = "<?= base_url(); ?>";
	var consultas_id = $(this).attr("consultas_id");
	$(document).ready(function() {
		$(".datatable").DataTable({
			"paging": false
		});

		$("body").on('click', '.comentarios', function (event) {
			var consultas_id = $(this).attr("consultas_id");
			window.location.href = base_url + "dashboard/comentarios/" + consultas_id;
		});
	});
</script>