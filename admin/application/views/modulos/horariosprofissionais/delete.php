<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("usuarios")?>">Horarios_profissionais</a></li>
        <li>Remover Horario Profissionai </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Horarios_profissionais</h3>
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
				                    <h4 class="panel-title">Controle de Horarios_profissionais / Remover</h4>
				                    <a href="<?php echo site_url("horariosprofissionais/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view("layout/messages"); ?>
									<form id="form_usuario" class="form-horizontal" method="post">
										<div class="alert alert-danger" role="alert">
					                    	<strong>Atenção!</strong> 
					                    	Esta ação não poderá ser desfeita.
					                	</div>
					                											<div class="form-group">
											<label class="col-sm-2 control-label" for="id">id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("id", $item->id); ?>" name="id" id="id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="status">status</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("status", $item->status); ?>" name="status" id="status">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="createdAt">createdAt</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("createdAt", $item->createdAt); ?>" name="createdAt" id="createdAt">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="updatedAt">updatedAt</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("updatedAt", $item->updatedAt); ?>" name="updatedAt" id="updatedAt">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="horarios_id">horarios_id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("horarios_id", $item->horarios_id); ?>" name="horarios_id" id="horarios_id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="dias_semana_id">dias_semana_id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("dias_semana_id", $item->dias_semana_id); ?>" name="dias_semana_id" id="dias_semana_id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="profissionais_id">profissionais_id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("profissionais_id", $item->profissionais_id); ?>" name="profissionais_id" id="profissionais_id">
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
												<a href="<?php echo site_url("horariosprofissionais")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/horariosprofissionais/js.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/horariosprofissionais/validate.js"></script>
	</div>
</div>