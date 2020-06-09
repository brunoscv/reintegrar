<div class="page-title">
	<div class="container">
		<h3>Procedimento por Plano</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("plano_procedimento")?>">Procedimento por Plano</a></li>
		<li>Adicionar   </li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
				<?php $this->load->view('layout/messages.php'); ?>
				<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Procedimento por Plano / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("planoprocedimento/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<form id="form_plano_procedimento" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
									<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="planos_id">Planos</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('planos_id', $listaPlanos, set_value('planos_id', @$item->planos_id), 
												'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="planos"'); ?>
												<?php echo form_error('planos_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="especialidades_id">Especialidades</label>
											<div class="col-sm-10">
											<?php echo form_dropdown('especialidades_id', $listaEspecialidades, set_value('especialidades_id', @$item->especialidades_id), 
												'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="especialidades"'); ?>
												<?php echo form_error('especialidades_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="valor">Valor</label>
											<div class="col-sm-10">
												<!-- <input name="valor" type="text" id="valor" class="form-control" value="<?php echo set_value("valor", @$item->valor) ?>" onkeyup="formatarMoeda();" />
												<?php echo form_error('valor'); ?> -->
												<input name="valor" type="text" id="valor" class="form-control" value="<?php echo set_value("valor", @$item->valor) ?>" />
											</div>
										</div>
										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("planoprocedimento"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/planoprocedimento/js.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/planoprocedimento/validate.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/planoprocedimento/moeda.js"></script>
							<script type="text/javascript">
								jQuery(document).ready(function() {
									$("#planos").selectpicker();
									$("#especialidades").selectpicker();
									$("#valor").maskedcoin();
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>