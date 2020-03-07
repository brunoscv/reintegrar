<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("faturamento")?>">Faturamento</a></li>
        <li>Adicionar  </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Controle de Faturamento</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-4">
							<?php echo $this->load->view('layout/search.php'); ?>
						</div>
						<div class="col-md-8" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Faturamento / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
				                    <a href="<?php echo site_url("faturamento/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_faturamento" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">

																					<div class="form-group">
												<label class="col-sm-2 control-label" for="id">Id</label>
												<div class="col-sm-10">
													<input name="id" type="text" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
<?php echo form_error('id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="pacientes_id">Pacientes</label>
												<div class="col-sm-10">
													<input name="pacientes_id" type="text" id="pacientes_id" class="form-control" value="<?php echo set_value("pacientes_id", @$item->pacientes_id) ?>" />
<?php echo form_error('pacientes_id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="profissionais_id">Profissionais</label>
												<div class="col-sm-10">
													<input name="profissionais_id" type="text" id="profissionais_id" class="form-control" value="<?php echo set_value("profissionais_id", @$item->profissionais_id) ?>" />
<?php echo form_error('profissionais_id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="especialidades_id">Especialidades</label>
												<div class="col-sm-10">
													<input name="especialidades_id" type="text" id="especialidades_id" class="form-control" value="<?php echo set_value("especialidades_id", @$item->especialidades_id) ?>" />
<?php echo form_error('especialidades_id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="plano_procedimento_id">Plano/Proced</label>
												<div class="col-sm-10">
													<input name="plano_procedimento_id" type="text" id="plano_procedimento_id" class="form-control" value="<?php echo set_value("plano_procedimento_id", @$item->plano_procedimento_id) ?>" />
<?php echo form_error('plano_procedimento_id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="consultas_id">Consultas</label>
												<div class="col-sm-10">
													<input name="consultas_id" type="text" id="consultas_id" class="form-control" value="<?php echo set_value("consultas_id", @$item->consultas_id) ?>" />
<?php echo form_error('consultas_id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="item_consulta_id">Item Consulta</label>
												<div class="col-sm-10">
													<input name="item_consulta_id" type="text" id="item_consulta_id" class="form-control" value="<?php echo set_value("item_consulta_id", @$item->item_consulta_id) ?>" />
<?php echo form_error('item_consulta_id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="valor">Valor</label>
												<div class="col-sm-10">
													<input name="valor" type="text" id="valor" class="form-control" value="<?php echo set_value("valor", @$item->valor) ?>" />
<?php echo form_error('valor'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="tipo">Tipo Faturamento</label>
												<div class="col-sm-10">
													<input name="tipo" type="text" id="tipo" class="form-control" value="<?php echo set_value("tipo", @$item->tipo) ?>" />
<?php echo form_error('tipo'); ?>
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
												<label class="col-sm-2 control-label" for="createdAt">Criado</label>
												<div class="col-sm-10">
													<input name="createdAt" type="text" id="createdAt" class="form-control" value="<?php echo set_value("createdAt", @$item->createdAt) ?>" />
<?php echo form_error('createdAt'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="updatedAt">Modificado</label>
												<div class="col-sm-10">
													<input name="updatedAt" type="text" id="updatedAt" class="form-control" value="<?php echo set_value("updatedAt", @$item->updatedAt) ?>" />
<?php echo form_error('updatedAt'); ?>
												</div>
											</div>
																															

										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("faturamento"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/faturamento/js.js"></script>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/faturamento/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>