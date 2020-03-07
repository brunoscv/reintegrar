<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("usuarios")?>">Pacientes</a></li>
        <li>Remover Paciente </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Pacientes</h3>
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
				                    <h4 class="panel-title">Controle de Pacientes / Remover</h4>
				                    <a href="<?php echo site_url("pacientes/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view("layout/messages"); ?>
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
											<label class="col-sm-2 control-label" for="nome_pac">Nome</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("nome_pac", $item->nome_pac); ?>" name="nome_pac" id="nome_pac">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="email_pac">Email</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("email_pac", $item->email_pac); ?>" name="email_pac" id="email_pac">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="telefone_pac">Telefone</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("telefone_pac", $item->telefone_pac); ?>" name="telefone_pac" id="telefone_pac">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="status">Status</label>
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
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
												<a href="<?php echo site_url("pacientes")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/pacientes/js.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/pacientes/validate.js"></script>
	</div>
</div>