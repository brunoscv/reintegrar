<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
			<div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Atendimentos / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
					<a href="<?php echo site_url("atendimentos/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view('layout/messages.php'); ?>
					<form id="form_atendimentos" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
																				<div class="form-group">
								<label class="col-sm-2 control-label" for="id">Cod.</label>
								<div class="col-sm-10">
									<input name="id" type="text" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
								<?php echo form_error('id'); ?>
								</div>
							</div>
																											<div class="form-group">
								<label class="col-sm-2 control-label" for="consultas_id">Cod. Consulta</label>
								<div class="col-sm-10">
									<input name="consultas_id" type="text" id="consultas_id" class="form-control" value="<?php echo set_value("consultas_id", @$item->consultas_id) ?>" />
								<?php echo form_error('consultas_id'); ?>
								</div>
							</div>
																											<div class="form-group">
								<label class="col-sm-2 control-label" for="qtd_atendimentos">Qtd Atendimentos</label>
								<div class="col-sm-10">
									<input name="qtd_atendimentos" type="text" id="qtd_atendimentos" class="form-control" value="<?php echo set_value("qtd_atendimentos", @$item->qtd_atendimentos) ?>" />
								<?php echo form_error('qtd_atendimentos'); ?>
								</div>
							</div>
																											<div class="form-group">
								<label class="col-sm-2 control-label" for="freq_atendimentos">Freq. Atendimentos</label>
								<div class="col-sm-10">
									<input name="freq_atendimentos" type="text" id="freq_atendimentos" class="form-control" value="<?php echo set_value("freq_atendimentos", @$item->freq_atendimentos) ?>" />
								<?php echo form_error('freq_atendimentos'); ?>
								</div>
							</div>
																											<div class="form-group">
								<label class="col-sm-2 control-label" for="data_ref">Data Ref.</label>
								<div class="col-sm-10">
									<input name="data_ref" type="text" id="data_ref" class="form-control" value="<?php echo set_value("data_ref", @$item->data_ref) ?>" />
								<?php echo form_error('data_ref'); ?>
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
								<a href="<?php echo site_url("atendimentos"); ?>" class="btn">
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
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/atendimentos/js.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/atendimentos/validate.js"></script>