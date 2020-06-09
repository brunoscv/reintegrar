<div class="page-title">
	<div class="container">
		<h3>Pacientes</h3>
	</div>
</div>
<div id="main-wrapper" class="container">
	<div class="panel-body" style="margin-top:10px;">
		<?php $this->load->view('layout/messages.php'); ?>
		<form id="form_pacientes" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
		<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
			<div class="form-group">
				<label class="col-sm-2 control-label" for="nome_pac">Nome</label>
				<div class="col-sm-10">
					<input name="nome_pac" type="text" id="nome_pac" class="form-control" value="<?php echo set_value("nome_pac", @$item->nome_pac) ?>" />
					<?php echo form_error('nome_pac'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="filiacao">Filiação</label>
				<div class="col-sm-10">
					<input name="filiacao" type="text" id="filiacao" class="form-control" value="<?php echo set_value("filiacao", @$item->filiacao) ?>" />
					<?php echo form_error('filiacao'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="data_nasc">Data Nascimento</label>
				<div class="col-sm-10">
					<?php if (@$item->data_nasc) { ?>
						<input name="data_nasc" type="text" id="data_nasc" class="form-control" value="<?php echo set_value("data_nasc", date("d/m/Y", strtotime(@$item->data_nasc))) ?>" />
					<?php } else { ?>
						<input name="data_nasc" type="text" id="data_nasc" class="form-control" value="<?php echo set_value("data_nasc", @$item->data_nasc) ?>" />
					<?php } ?>
					<?php echo form_error('data_nasc'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="rg_cpf">RG/CPF</label>
				<div class="col-sm-10">
					<input name="rg_cpf" type="text" id="rg_cpf" class="form-control" value="<?php echo set_value("rg_cpf", @$item->rg_cpf) ?>" />
					<?php echo form_error('rg_cpf'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="email_pac">Email</label>
				<div class="col-sm-10">
					<input name="email_pac" type="text" id="email_pac" class="form-control" value="<?php echo set_value("email_pac", @$item->email_pac) ?>" />
					<?php echo form_error('email_pac'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="telefone_pac">Telefone</label>
				<div class="col-sm-10">
					<input name="telefone_pac" type="text" id="telefone_pac" class="form-control" value="<?php echo set_value("telefone_pac", @$item->telefone_pac) ?>" />
					<?php echo form_error('telefone_pac'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="telefone_pac2">Telefone 2</label>
				<div class="col-sm-10">
					<input name="telefone_pac2" type="text" id="telefone_pac2" class="form-control" value="<?php echo set_value("telefone_pac2", @$item->telefone_pac2) ?>" />
					<?php echo form_error('telefone_pac2'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="telefone_pac_fixo">Telefone Fixo</label>
				<div class="col-sm-10">
					<input name="telefone_pac_fixo" type="text" id="telefone_pac_fixo" class="form-control" value="<?php echo set_value("telefone_pac_fixo", @$item->telefone_pac_fixo) ?>" />
					<?php echo form_error('telefone_pac_fixo'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="matricula">Matricula</label>
				<div class="col-sm-10">
				<input name="telefone_pac_fixo" type="text" id="matricula" class="form-control" value="<?php echo set_value("matricula", @$item->matricula) ?>" />
					<?php echo form_error('matricula'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="nome_plano">Plano de Saúde</label>
				<div class="col-sm-10">
					<?php echo form_dropdown('planos_id', $listaPlanos, set_value('planos_id', @$item->planos_id), 'class="form-control" id="planos_id"'); ?>
					<?php echo form_error('planos_id'); ?>
				</div>
			</div>
			<div class="form-actions">
				<div class="col-sm-10 col-offset-2">
					<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
					<a href="<?php echo site_url("consultas/criar"); ?>" class="btn">
						Cancelar
					</a>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#form_pacientes").validate({
				ignore : [],
				errorElement : "em",
				onfocusout : function(element) {
					if ((!this.check(element) || !this.checkable(element) ) && (element.name in this.submitted || !this.optional(element))) {
						var currentObj = this;
						var currentElement = element;
						var delay = function() {
							currentObj.element(currentElement);
						};
						setTimeout(delay, 0);
					}
				},
				invalidHandler : function(form, validator) {
					var errors = validator.numberOfInvalids();
					if (errors) {
						validator.errorList[0].element.focus();
						var aba = $(validator.errorList[0].element).parents('div.tab-pane').attr('id');
						$("[href='#" + aba + "']").click();
					}
					return false;
				},
				rules : {
					id:{ }, nome_pac:{required:true}, email_pac:{ },
					telefone_pac:{required:true}, status:{ }, createdAt:{ }, updatedAt:{ }
				}
		});
		//Mascaras
		$("#telefone_pac").mask("(99)99999-9999");
		$("#telefone_pac2").mask("(99)99999-9999");
		$("#telefone_pac_fixo").mask("(99)9999-9999");
		$("#data_nasc").mask("99/99/9999");
	});
</script>
