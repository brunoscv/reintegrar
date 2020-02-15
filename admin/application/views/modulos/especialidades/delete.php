<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Especialidades / Remover</h4>
					<a href="<?php echo site_url("especialidades/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Todos</a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view('layout/messages.php'); ?>
					<form id="form_usuario" class="form-horizontal" method="post">
						<div class="alert alert-danger" role="alert">
							<strong>Atenção!</strong> 
							Esta ação não poderá ser desfeita.
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="nome_espec">Nome Especialidade</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("nome_espec", $item->nome_espec); ?>" name="nome_espec" id="nome_espec" placeholder="ex: efortes">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-10 col-offset-2">
								<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
								<a href="<?php echo site_url("especialidades")?>" class="btn">
									Cancelar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/especialidades/js.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/especialidades/validate.js"></script>