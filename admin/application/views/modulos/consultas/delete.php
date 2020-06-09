<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("usuarios")?>">Consultas</a></li>
        <li>Remover Consulta </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Consultas</h3>
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
				                    <h4 class="panel-title">Controle de Consultas / Remover</h4>
				                    <a href="<?php echo site_url("consultas/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php $this->load->view("layout/messages"); ?>
									<form id="form_usuario" class="form-horizontal" method="post">
										<div class="alert alert-danger" role="alert">
					                    	<strong>Atenção!</strong> 
					                    	Esta ação não poderá ser desfeita.
					                	</div>
					                											<div class="form-group">
											<label class="col-sm-2 control-label" for="id">Codigo</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("id", $item->id); ?>" name="id" id="id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="valor">Valor</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("valor", $item->valor); ?>" name="valor" id="valor">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="status">Status</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("status", $item->status); ?>" name="status" id="status">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="plano_procedimento_id">Proc./Plano</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("plano_procedimento_id", $item->plano_procedimento_id); ?>" name="plano_procedimento_id" id="plano_procedimento_id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="pacientes_id">Paciente</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("pacientes_id", $item->pacientes_id); ?>" name="pacientes_id" id="pacientes_id">
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
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
												<a href="<?php echo site_url("consultas")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/js.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/validate.js"></script>
	</div>
</div>