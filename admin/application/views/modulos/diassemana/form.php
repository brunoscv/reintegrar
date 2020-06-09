<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("dias_semana")?>">Dias_semana</a></li>
        <li>Adicionar Dia  </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Controle de Dias_semana</h3>
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
				                    <h4 class="panel-title">Dias_semana / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
				                    <a href="<?php echo site_url("diassemana/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php $this->load->view('layout/messages.php'); ?>
									<form id="form_dias_semana" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">

																					<div class="form-group">
												<label class="col-sm-2 control-label" for="id">Id</label>
												<div class="col-sm-10">
													<input name="id" type="text" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
<?php echo form_error('id'); ?>
												</div>
											</div>
																																<div class="form-group">
												<label class="col-sm-2 control-label" for="desc_dia_semana">Dia Semana</label>
												<div class="col-sm-10">
													<input name="desc_dia_semana" type="text" id="desc_dia_semana" class="form-control" value="<?php echo set_value("desc_dia_semana", @$item->desc_dia_semana) ?>" />
<?php echo form_error('desc_dia_semana'); ?>
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
												<a href="<?php echo site_url("diassemana"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/diassemana/js.js"></script>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/diassemana/validate.js"></script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>