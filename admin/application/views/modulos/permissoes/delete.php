<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("usuarios")?>">Permissoes</a></li>
        <li>Remover Permissoe </li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Permissoes</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Controle de Permissoes / Remover</h4>
				                    <a href="<?php echo site_url("permissoes/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
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
											<label class="col-sm-2 control-label" for="metodos_id">metodos_id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("metodos_id", $item->metodos_id); ?>" name="metodos_id" id="metodos_id">
											</div>
										</div>
																				<div class="form-group">
											<label class="col-sm-2 control-label" for="usuarios_id">usuarios_id</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("usuarios_id", $item->usuarios_id); ?>" name="usuarios_id" id="usuarios_id">
											</div>
										</div>
										
										<div class="form-group">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
												<a href="<?php echo site_url("permissoes")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/permissoes/js.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/permissoes/validate.js"></script>
	</div>
</div>