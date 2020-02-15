<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
			<div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Controle de Atendimentos / Remover</h4>
					<a href="<?php echo site_url("atendimentos/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view("layout/messages"); ?>
					<form id="form_usuario" class="form-horizontal" method="post">
						<div class="alert alert-danger" role="alert">
							<strong>Atenção!</strong> 
							Esta ação não poderá ser desfeita.
						</div>
												<div class="form-group">
							<label class="col-sm-2 control-label" for="id">Cod.</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("id", $item->id); ?>" name="id" id="id">
							</div>
						</div>
												<div class="form-group">
							<label class="col-sm-2 control-label" for="consultas_id">Cod. Consulta</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("consultas_id", $item->consultas_id); ?>" name="consultas_id" id="consultas_id">
							</div>
						</div>
												<div class="form-group">
							<label class="col-sm-2 control-label" for="qtd_atendimentos">Qtd Atendimentos</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("qtd_atendimentos", $item->qtd_atendimentos); ?>" name="qtd_atendimentos" id="qtd_atendimentos">
							</div>
						</div>
												<div class="form-group">
							<label class="col-sm-2 control-label" for="freq_atendimentos">Freq. Atendimentos</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("freq_atendimentos", $item->freq_atendimentos); ?>" name="freq_atendimentos" id="freq_atendimentos">
							</div>
						</div>
												<div class="form-group">
							<label class="col-sm-2 control-label" for="data_ref">Data Ref.</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("data_ref", $item->data_ref); ?>" name="data_ref" id="data_ref">
							</div>
						</div>
												<div class="form-group">
							<label class="col-sm-2 control-label" for="status">Status</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("status", $item->status); ?>" name="status" id="status">
							</div>
						</div>
												<div class="form-group">
							<label class="col-sm-2 control-label" for="createdAt">Criado</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("createdAt", $item->createdAt); ?>" name="createdAt" id="createdAt">
							</div>
						</div>
												<div class="form-group">
							<label class="col-sm-2 control-label" for="updatedAt">Modificado</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("updatedAt", $item->updatedAt); ?>" name="updatedAt" id="updatedAt">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-10 col-offset-2">
								<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
								<a href="<?php echo site_url("atendimentos")?>" class="btn">
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