<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("item_consulta")?>">Item_consulta</a></li>
        <li>Adicionar   </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Controle de Item_consulta</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-4">
							<?php $this->load->view('layout/search.php'); ?>
						</div>
						<div class="col-md-8" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Item_consulta / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
				                    <a href="<?php echo site_url("itemconsulta/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php $this->load->view('layout/messages.php'); ?>
									<form id="form_item_consulta" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">

																					<div class="form-group">
												<label class="col-sm-2 control-label" for="id">Id</label>
												<div class="col-sm-10">
													<input name="id" type="text" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
<?php echo form_error('id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="horarios_id">Hor�rio</label>
												<div class="col-sm-10">
													<input name="horarios_id" type="text" id="horarios_id" class="form-control" value="<?php echo set_value("horarios_id", @$item->horarios_id) ?>" />
<?php echo form_error('horarios_id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="dia_semana_id">Dia Semana</label>
												<div class="col-sm-10">
													<input name="dia_semana_id" type="text" id="dia_semana_id" class="form-control" value="<?php echo set_value("dia_semana_id", @$item->dia_semana_id) ?>" />
<?php echo form_error('dia_semana_id'); ?>
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
												<label class="col-sm-2 control-label" for="periodo_consulta_id">Periodo Consuta</label>
												<div class="col-sm-10">
													<input name="periodo_consulta_id" type="text" id="periodo_consulta_id" class="form-control" value="<?php echo set_value("periodo_consulta_id", @$item->periodo_consulta_id) ?>" />
<?php echo form_error('periodo_consulta_id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="consultas_id">Cod Consulta</label>
												<div class="col-sm-10">
													<input name="consultas_id" type="text" id="consultas_id" class="form-control" value="<?php echo set_value("consultas_id", @$item->consultas_id) ?>" />
<?php echo form_error('consultas_id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="createdAT">createdAT</label>
												<div class="col-sm-10">
													<input name="createdAT" type="text" id="createdAT" class="form-control" value="<?php echo set_value("createdAT", @$item->createdAT) ?>" />
<?php echo form_error('createdAT'); ?>
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
												<a href="<?php echo site_url("itemconsulta"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
								<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/itemconsulta/js.js"></script> -->
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/itemconsulta/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>