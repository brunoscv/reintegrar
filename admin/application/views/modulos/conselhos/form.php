<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Conselhos / Editar</h4>
					<a href="<?php echo site_url("conselhos");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Todos</a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view('layout/messages.php'); ?>

					<form id="form_conselhos" class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
						<input type="hidden" id="id" name="id" value="<?php echo set_value("id", @$item->id); ?>" />
						<div class="form-group">
							<label class="col-sm-2 control-label" for="nome_conselho">Nome Conselho</label>
							<div class="col-sm-10">
								<input type="text" value="<?php echo set_value("nome_conselho", @$item->nome_conselho); ?>" class="form-control" name="nome_conselho" id="nome_conselho">
								<?php echo form_error('nome_conselho'); ?>
							</div>
							<!-- /controls -->
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="status">Status</label>
							<div class="col-sm-10">
								<input type="text" value="<?php echo set_value("status", @$item->status); ?>" class="form-control" name="status" id="status">
								<?php echo form_error('status'); ?>
							</div>
							<!-- /controls -->
						</div>
						<!-- /control-group -->

						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
								<a href="<?php echo site_url("menus")?>" class="btn">
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/conselhos/js.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/conselhos/validate.js"></script>

