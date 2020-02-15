<div class="row">
	<div class="span4">
		<?php echo $this->load->view('layout/search.php'); ?>
	</div>
	<div class="span8">
		<div class="widget">
			<div class="widget-header">
				<i class="fa fa-user"></i>
				<h3>Usuários</h3>
			</div>
			<!-- /widget-header -->
			<div class="widget-content">
				<?php echo $this->load->view("layout/messages"); ?>
				<form id="form_usuario" class="form-horizontal" method="post">
					<fieldset>
						<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">
								×
							</button>
							<strong>Atenção!</strong> Esta ação não poderá ser desfeita.
						</div>
						<div class="control-group">
							<label class="control-label" for="usuario">Usuário</label>
							<div class="controls">
								<input type="text" disabled="" class="span2" value="<?php echo set_value("usuario", $item->usuario); ?>" name="usuario" id="usuario" placeholder="ex: efortes">
							</div>
							<!-- /controls -->
						</div>
						<!-- /control-group -->

						<div class="control-group">
							<label class="control-label" for="nome">Nome</label>
							<div class="controls">
								<input type="text" disabled="" value="<?php echo set_value("nome", $item->nome); ?>" class="span4" name="nome" id="nome">
							</div>
							<!-- /controls -->
						</div>
						<!-- /control-group -->

						<div class="control-group">
							<label class="control-label" for="email">E-mail</label>
							<div class="controls">
								<input type="email" disabled="" value="<?php echo set_value("email", $item->email); ?>" class="span4" name="email" id="email" value="">
							</div>
							<!-- /controls -->
						</div>
						<!-- /control-group -->

						<div class="form-actions">
							<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
							<a href="<?php echo site_url("usuariosadicionais")?>" class="btn">
								Cancelar
							</a>
						</div>
						<!-- /form-actions -->
					</fieldset>
				</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuariosadicionais/js.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuariosadicionais/validate.js"></script>
	</div>
</div>