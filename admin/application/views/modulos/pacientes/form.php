<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Pacientes / Editar</h4>
					<a href="<?php echo site_url("pacientes");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Todos</a>
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
							<label class="col-sm-2 control-label" for="telefone_pac">Telefone</label>
							<div class="col-sm-10">
								<input name="telefone_pac" type="text" id="telefone_pac" class="form-control" value="<?php echo set_value("telefone_pac", @$item->telefone_pac) ?>" />
							<?php echo form_error('telefone_pac'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="telefonedois_pac">Telefone(s) Auxiliar(es) (Opcional)</label>
							<div class="col-sm-10">
								<input name="telefonedois_pac" type="text" id="telefonedois_pac" class="form-control" value="<?php echo set_value("telefonedois_pac", @$item->telefonedois_pac) ?>" />
							<?php echo form_error('telefonedois_pac'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="carteira_pac">Carteira</label>
							<div class="col-sm-10">
								<input name="carteira_pac" type="text" id="carteira_pac" class="form-control" value="<?php echo set_value("carteira_pac", @$item->carteira_pac) ?>" />
							<?php echo form_error('carteira_pac'); ?>
							</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label" for="convenios_id">Convênios</label>
							<div class="col-sm-10">
								<?php echo form_dropdown('convenios_id', $listaConvenios, set_value('convenios_id', @$item->convenios_id), 
								'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="convenios"'); ?>
								<?php echo form_error('convenios_id'); ?>
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
							<label class="col-sm-2 control-label" for="nome_responsavel">Responsável</label>
							<div class="col-sm-10">
								<input name="nome_responsavel" type="text" id="nome_responsavel" class="form-control" value="<?php echo set_value("nome_responsavel", @$item->nome_responsavel) ?>" />
							<?php echo form_error('nome_responsavel'); ?>
							</div>
						</div>
						<div id="mensagem"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="cep_pac">CEP</label>
							<div class="col-sm-10">
								<input name="cep_pac" type="text" id="cep_pac" class="form-control" value="<?php echo set_value("cep_pac", @$item->cep_pac) ?>" />
							<?php echo form_error('cep_pac'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="endereco_pac">Endereço</label>
							<div class="col-sm-10">
								<input name="endereco_pac" type="text" id="endereco_pac" class="form-control" value="<?php echo set_value("endereco_pac", @$item->endereco_pac) ?>" />
							<?php echo form_error('endereco_pac'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="numero_pac">Numero</label>
							<div class="col-sm-10">
								<input name="numero_pac" type="text" id="numero_pac" class="form-control" value="<?php echo set_value("numero_pac", @$item->numero_pac) ?>" />
							<?php echo form_error('numero_pac'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="bairro_pac">Bairro</label>
							<div class="col-sm-10">
								<input name="bairro_pac" type="text" id="bairro_pac" class="form-control" value="<?php echo set_value("bairro_pac", @$item->bairro_pac) ?>" />
							<?php echo form_error('bairro_pac'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="complemento_pac">Complemento</label>
							<div class="col-sm-10">
								<input name="complemento_pac" type="text" id="complemento_pac" class="form-control" value="<?php echo set_value("complemento_pac", @$item->complemento_pac) ?>" />
							<?php echo form_error('complemento_pac'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="cidade_pac">Cidade</label>
							<div class="col-sm-10">
								<input name="cidade_pac" type="text" id="cidade_pac" class="form-control" value="<?php echo set_value("cidade_pac", @$item->cidade_pac) ?>" />
							<?php echo form_error('cidade_pac'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="uf_pac">UF</label>
							<div class="col-sm-10">
								<input name="uf_pac" type="text" id="uf_pac" class="form-control" value="<?php echo set_value("uf_pac", @$item->uf_pac) ?>" />
							<?php echo form_error('uf_pac'); ?>
							</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label" for="status">Status</label>
							<div class="col-sm-10">
								<?php echo form_dropdown('status', $listaStatus, set_value('status', @$item->descricao), 
								'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="status"'); ?>
								<?php echo form_error('status'); ?>
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
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/convenios/js.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/convenios/validate.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#telefone_pac").mask("(99)99999-9999");
		// $("#telefone_pac2").mask("(99)99999-9999");
		// $("#telefone_pac_fixo").mask("(99)9999-9999");
		$("#data_nasc").mask("99/99/9999");
		$("#cep_pac").mask("99999-999");
		$("#convenios").selectpicker();

		// $("#data_nasc").datepicker( {
		// 	format: 'dd/mm/yyyy',
		// 	todayHighlight: true,
		// 	language: "BR",
		// 	days: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"]
		// });
	});

	// Método para consultar o CEP
	$('#cep_pac').on('blur', function(){
		if($.trim($("#cep_pac").val()) != ""){
			$("#mensagem").html('(Aguarde, consultando CEP ...)');
			$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep_pac").val(), function(){
				if(resultadoCEP["resultado"]){
					$("#endereco_pac").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
					$("#bairro_pac").val(unescape(resultadoCEP["bairro"]));
					$("#cidade_pac").val(unescape(resultadoCEP["cidade"]));
					$("#uf_pac").val(unescape(resultadoCEP["uf"]));
				}
				$("#mensagem").html('');
			});				
		}			
	});
</script>

