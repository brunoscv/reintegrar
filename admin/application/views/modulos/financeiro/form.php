<div id="main-wrapper" class="container" style="margin-top: 5em; height: 100vh;">
	<div class="row" data-container="all">
		<h4 class="panel-title">Financeiro / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
        <div class="col-md-12">
			<div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<a href="<?php echo site_url("financeiro/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view('layout/messages.php'); ?>
					<form id="form_atendimentos" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
						<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />				
							<div class="form-group">
								<label class="col-sm-2 control-label" for="profissional_id">Profissional</label>
								<div class="col-sm-10">
									<?php echo form_dropdown('profissional_id', $listaProfissionais, set_value('profissional_id', @$item->profissional_id), 
									'data-size="7" data-live-search="true" class="form-control" id="profissionais"'); ?>
									<?php echo form_error('profissional_id'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="data_nota">Data da Nota</label>
								<div class="col-sm-10">
									<input name="data_nota" type="text" id="data_nota" class="form-control" value="<?php echo set_value("data_nota", date("d/m/Y", strtotime(@$item->data_nota))) ?>" />
								<?php echo form_error('data_nota'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="qtd_atendimentos">Qtd. Atendimentos</label>
								<div class="col-sm-10">
									<input name="qtd_atendimentos" type="number" id="qtd_atendimentos" class="form-control" value="<?php echo set_value("qtd_atendimentos", @$item->qtd_atendimentos) ?>" />
								<?php echo form_error('qtd_atendimentos'); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="valor_nota">Valor da Nota</label>
								<div class="col-sm-10">
									<input name="valor_nota" type="number" id="valor_nota" class="form-control" value="<?php echo set_value("valor_nota", @$item->valor_nota) ?>" />
								<?php echo form_error('valor_nota'); ?>
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
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#profissionais").selectpicker();
		$("#data_nota").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			language: "pt",
			todayHighlight: true
		});
		$("#data_inicio").mask("99/99/9999");
		$("#data_fim").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			language: "pt",
			todayHighlight: true
		});
		$("#data_fim").mask("99/99/9999");
	});
</script>