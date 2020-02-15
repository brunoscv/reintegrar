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
							<label class="col-sm-2 control-label" for="nome_pac">Nome</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("nome_pac", @$item->nome_pac); ?>" name="nome_pac" id="nome_pac">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="telefone_pac">Telefone</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("telefone_pac", @$item->telefone_pac); ?>" name="telefone_pac" id="telefone_pac">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="telefonedois_pac">Telefone(s) Auxiliar(es) (Opcional)</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("telefonedois_pac", @$item->telefonedois_pac); ?>" name="telefonedois_pac" id="telefonedois_pac">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="carteira_pac">Carteira</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("carteira_pac", @$item->carteira_pac); ?>" name="carteira_pac" id="carteira_pac">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="convenios_id">Convênios</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("nome_convenio", @$item->nome_convenio); ?>" name="nome_convenio" id="nome_convenio">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="data_nasc">Data Nascimento</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("data_nasc", @$item->data_nasc); ?>" name="data_nasc" id="data_nasc">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="nome_responsavel">Responsável</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("nome_responsavel", @$item->nome_responsavel); ?>" name="nome_responsavel" id="nome_responsavel">
							</div>
						</div>
						<div id="mensagem"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="cep_pac">CEP</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("cep_pac", @$item->cep_pac); ?>" name="cep_pac" id="cep_pac">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="endereco_pac">Endereço</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("endereco_pac", @$item->endereco_pac); ?>" name="endereco_pac" id="endereco_pac">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="numero_pac">Numero</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("numero_pac", @$item->numero_pac); ?>" name="numero_pac" id="numero_pac">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="bairro_pac">Bairro</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("bairro_pac", @$item->bairro_pac); ?>" name="bairro_pac" id="bairro_pac">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="complemento_pac">Complemento</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("complemento_pac", @$item->complemento_pac); ?>" name="complemento_pac" id="complemento_pac">							
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="cidade_pac">Cidade</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("cidade_pac", @$item->cidade_pac); ?>" name="cidade_pac" id="cidade_pac">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="uf_pac">UF</label>
							<div class="col-sm-10">
								<input type="text" disabled="" class="form-control" value="<?php echo set_value("uf_pac", @$item->uf_pac); ?>" name="uf_pac" id="uf_pac">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-10 col-offset-2">
								<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
								<a href="<?php echo site_url("pacientes")?>" class="btn">
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
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/especialidades/js.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/especialidades/validate.js"></script>