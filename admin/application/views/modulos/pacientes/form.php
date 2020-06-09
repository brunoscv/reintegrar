<div class="page-title">
	<div class="container">
		<h3>Pacientes</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("pacientes")?>">Pacientes</a></li>
		<li>Adicionar Paciente </li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent has-shadow">
				<div class="panel-body">
				<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Pacientes / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("pacientes/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
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
											<label class="col-sm-2 control-label" for="email_pac">Email</label>
											<div class="col-sm-10">
												<input name="email_pac" type="text" id="email_pac" class="form-control" value="<?php echo set_value("email_pac", @$item->email_pac) ?>" />
												<?php echo form_error('email_pac'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="rg">RG</label>
											<div class="col-sm-10">
												<input name="rg" type="text" id="rg" class="form-control" value="<?php echo set_value("rg", @$item->rg) ?>" />
												<?php echo form_error('rg'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="cpf">CPF</label>
											<div class="col-sm-10">
												<input name="cpf" type="text" id="cpf" class="form-control" value="<?php echo set_value("cpf", @$item->cpf) ?>" />
												<?php echo form_error('cpf'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="carteira">Carteira</label>
											<div class="col-sm-10">
												<input name="carteira" type="text" id="carteira" class="form-control" value="<?php echo set_value("carteira", @$item->carteira) ?>" />
												<?php echo form_error('carteira'); ?>
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
											<label class="col-sm-2 control-label" for="nome_plano">Plano de Saúde</label>
											<div class="col-sm-10">
												<?php echo form_dropdown('planos_id', $listaPlanos, set_value('planos_id', @$item->planos_id), 'class="form-control" id="planos_id"'); ?>
												<?php echo form_error('planos_id'); ?>
											</div>
										</div>
										<div class="form-actions">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("pacientes"); ?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/pacientes/js.js"></script>
							<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/pacientes/validate.js"></script>
							<script type="text/javascript">
								jQuery(document).ready(function($) {
									$("#telefone_pac").mask("(99)99999-9999");
									$("#telefone_pac2").mask("(99)99999-9999");
									$("#telefone_pac_fixo").mask("(99)9999-9999");
									$("#data_nasc").mask("99/99/9999");
									$('#cpf').mask("999.999.999-99");

									// $("#data_nasc").datepicker( {
									// 	format: 'dd/mm/yyyy',
									// 	todayHighlight: true,
									// 	language: "BR",
									// 	days: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"]
									// });
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>