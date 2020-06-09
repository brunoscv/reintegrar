<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Confirmação de Presença em Consulta</h4>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">
											×
										</button>
										<strong><i class="fa fa-info"></i></strong> <?php echo "Confirma a data da presença do paciente à consulta."; ?>
									</div>
									<form id="form_consulta" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">	
										<p><b>Abaixo estão algumas informações do Paciente: </b></p>
										<div class="form-group">
											<span class="col-md-3"><b>Paciente: </b><?php echo $item[0]->nome_pac;?></span>
											<span class="col-md-3"><b>Profissional: </b><?php echo $item[0]->nome_prof;?></span>
											<span class="col-md-3"><b>Especialidade: </b><?php echo $item[0]->nome_espec;?></span>
											<span class="col-md-3"><b>Plano: </b><?php echo $item[0]->nome_plano;?></span>
										</div>
										<div class="form-group">
											<span class="col-md-2"><b>Cod. Consulta: </b><?php echo $item[0]->cod_consulta;?></span>
											<span class="col-md-2"><b>Horário: </b><?php echo $item[0]->desc_horario;?></span>
											<span class="col-md-3"><b>Dia da Semana: </b><?php echo $item[0]->desc_dia_semana;?></span>
											<span class="col-md-2"><b>Periodo Consulta: </b><?php echo date("m/Y", strtotime($item[0]->data));?></span>
											<span class="col-md-3"><b>Data: </b><input name="data" type="text" id="data" class="form-control" value="<?php echo set_value("data", @$item->data) ?>" /></span>
										</div>
										<div class="form-actions">
											<div class="col-sm-12">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("itemconsulta/ver/" . $item[0]->periodo_consulta_id); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.form-group {
		margin-bottom: 30px;
		margin-top: 30px;
	}
	.panel {
	    box-shadow: 0 0px 0px 0px rgba(0, 0, 0, 0.1);
	    border: 0!important;
	    margin-bottom: 25px;
	    border-radius: 0;
	}
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$("#data").datepicker( {
			format: 'dd/mm/yyyy',
			todayHighlight: true,
			language: "BR",
			days: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"]
		});
	});
</script>
							