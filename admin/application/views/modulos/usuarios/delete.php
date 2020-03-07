<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("usuarios")?>">Usuário</a></li>
        <li>Adicionar Usuário</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Usuários</h3>
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
				                    <h4 class="panel-title">Usuários do Sistema / Remover</h4>
				                    <a href="<?php echo site_url("usuarios/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Listagem de Usuários</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_usuario" class="form-horizontal" method="post">
										<div class="alert alert-danger" role="alert">
					                    	<strong>Atenção!</strong> 
					                    	Esta ação não poderá ser desfeita.
					                	</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="usuario">Usuário</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("usuario", $item->usuario); ?>" name="usuario" id="usuario" placeholder="ex: efortes">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="nome">Nome</label>
											<div class="col-sm-10">
												<input type="text" disabled="" value="<?php echo set_value("nome", $item->nome); ?>" class="form-control" name="nome" id="nome">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="email">E-mail</label>
											<div class="col-sm-10">
												<input type="email" disabled="" value="<?php echo set_value("email", $item->email); ?>" class="form-control" name="email" id="email" value="">
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
												<a href="<?php echo site_url("usuarios")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuarios/js.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuarios/validate.js"></script>
	</div>
</div>