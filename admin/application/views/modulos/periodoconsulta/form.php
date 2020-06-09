<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("periodo_consulta")?>">Periodos Por Consulta</a></li>
		<li>Adicionar   </li>
	</ol>
</div>
<div class="page-title">
	<div class="container">
		<h3>Controle de Periodos Por Consulta</h3>
	</div>
</div>
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
								<h4 class="panel-title">Periodos Por Consulta / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("periodoconsulta/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<form id="form_periodo_consulta" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">

										<div class="form-group">
											<label class="col-sm-2 control-label" for="id">Id</label>
											<div class="col-sm-10">
												<input name="id" type="text" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
												<?php echo form_error('id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="data">Data Atendimento</label>
											<div class="col-sm-10">
												<input name="data" type="text" id="data" class="form-control" value="<?php echo set_value("data", @$item->data) ?>" />
												<?php echo form_error('data'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="status">Status</label>
											<div class="col-sm-10">
												<input name="status" type="text" id="status" class="form-control" value="<?php echo set_value("status", @$item->status) ?>" />
												<?php echo form_error('status'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="consultas_id">Cod. Consulta</label>
											<div class="col-sm-10">
												<input name="consultas_id" type="text" id="consultas_id" class="form-control" value="<?php echo set_value("consultas_id", @$item->consultas_id) ?>" />
												<?php echo form_error('consultas_id'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="createdAt">createdAt</label>
											<div class="col-sm-10">
												<input name="createdAt" type="text" id="createdAt" class="form-control" value="<?php echo set_value("createdAt", @$item->createdAt) ?>" />
												<?php echo form_error('createdAt'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="updatedAt">updatedAt</label>
											<div class="col-sm-10">
												<input name="updatedAt" type="text" id="updatedAt" class="form-control" value="<?php echo set_value("updatedAt", @$item->updatedAt) ?>" />
												<?php echo form_error('updatedAt'); ?>
											</div>
										</div>


										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("periodoconsulta"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/periodoconsulta/js.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/periodoconsulta/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>