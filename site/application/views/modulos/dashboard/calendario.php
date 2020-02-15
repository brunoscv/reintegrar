<style type="text/css">
.calendar {
    font-family: Arial, Verdana, Sans-serif;
    width: 100%;
    min-width: 960px;
    border-collapse: collapse;
}

.calendar tbody tr:first-child th {
    color: #505050;
    margin: 0 0 10px 0;
}

.day_header {
    font-weight: normal;
    text-align: center;
    color: #757575;
    font-size: 14px;
}

.calendar td {
    width: 14%; /* Force all cells to be about the same width regardless of content */
    border:1px solid #CCC;
    height: 100px;
    vertical-align: top;
    font-size: 10px;
    padding: 0;
}

.calendar td:hover {
    background: #F3F3F3;
    cursor: pointer;
}

.day_listing {
    display: block;
    text-align: right;
    font-size: 14px;
    color: #2C2C2C;
    padding: 10px 10px 0 0;
}
.cal_content {
    display: block;
    text-align: center;
    font-size: 14px;
    color: #fff;
    padding: 3px 0 3px 10px;
    background-color: green;
    /* border-radius: 0%; */
    margin: 5px 5px 0px 0px;
}

div.today {
    background: #E9EFF7;
    height: 100%;
}

.cal_prev {
	float: left;
	padding: 15px;
}

.cal_month {
	text-align: center;
    padding: 15px;
}

.cal_next {
	float: right;
	padding: 15px;
}
</style>
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
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-calendar"></i> Calendário</h4>
				<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
			</div>
			<div class="panel-body">
				<?php echo $this->load->view('layout/messages.php'); ?>
				<div class="row">
					<div class="col-md-12">
						<?php echo $calendario; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="display table">
							<thead>
								<tr>
									<th>Id</th>
									<th>Cod Consulta</th>
									<th>Horário</th>
									<th>Dia</th>
									<th>Paciente</th>
									<th>Profissional</th>
									<th>Data</th>
									<th>Status</th>
									<th class="td-actions"></th>
								</tr>
							</thead>
							<tbody id="consultas_abertas">
								<?php if(@$listaItemConsulta) { ?>
									<?php foreach($listaItemConsulta as $item): ?>
										<tr id="consultas_presencas_<?php echo $item->id; ?>">
											<td><?php echo $item->id; ?></td>
											<td><?php echo $item->cod_consulta; ?></td>
											<td><?php echo $item->desc_horario; ?></td>
											<td><?php echo $item->desc_dia_semana; ?></td>
											<td><?php echo $item->nome_pac; ?></td>
											<td><?php echo $item->nome_prof; ?></td>
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
										<tr id="consultas_presencas">
											<td><p> <i>Nenhuma consulta encontrada. </i></p></td>
										</tr>		
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Script Template Mustache -->
	<script id="calendario-template" type="x-tmpl-mustache">
	  <tr id="consultas_presencas_{{id}}">
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/dashboard/calendario.js"></script>