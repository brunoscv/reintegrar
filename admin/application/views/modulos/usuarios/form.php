<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
			<div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Usuários do Sistema / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
					<a href="<?php echo site_url("consultas/atendimentos");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view('layout/messages.php'); ?>
					<form id="form_usuario" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
						<input type="hidden" id="id" name="id" value="<?php echo set_value("id", @$item->id); ?>" />
						<div class="form-group">
							<label class="col-sm-2 control-label" for="profissionais_id">Nome: </label>
							<div class="col-sm-10">
								<?php echo form_dropdown('profissionais_id', $listaProfissionais, set_value('profissionais_id', @$item->profissionais_id), 
								'data-size="7" data-live-search="true" class="form-control" id="profissionais"required=""'); ?>
								<?php echo form_error('profissionais_id'); ?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="usuario">Usuário: </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo set_value("usuario", @$item->usuario); ?>" name="usuario" id="usuario" placeholder="ex: brunocarvalho">
								<?php echo form_error('usuario'); ?>
								<p class="help-block">
									<small>Seu nome de usuário para acessar o sistema.</small>
								</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="email">E-mail: </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo set_value("email", @$item->email); ?>" name="email" id="email" placeholder="ex: usuario@email.com">
								<?php echo form_error('email'); ?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="senha">Senha: </label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="senha" id="senha">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="senha2">Confirmação: </label>
							<div class="col-sm-10">
								<input type="password" class="form-control" name="senha2" id="senha2">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="status">Status: </label>
							<div class="col-sm-10">
								<?php echo form_dropdown('status', $listaStatus, set_value('status', @$item->status), 
								'data-size="7" data-live-search="true" class="form-control" id="status" required=""'); ?>
								<?php echo form_error('status'); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label" for="principal">Principal: </label>
							<div class="col-sm-10">
								<div class="checkbox checbox-switch switch-success">
									<label>
										<?php $checked = (@$item->principal==1) ? "checked='checked'" : ''; ?>
										<input type="checkbox" id="principal" name="principal" value="1" <?php echo $checked; ?> />
										<span></span>
									</label>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="senha2">Perfis de acesso: </label>
							<div class="col-sm-10">
								<?php $values = ($this->input->post("perfis")) ? $this->input->post("perfis") : @$item->perfis; ?>
								<?php echo formPerfilList('perfis[]', $listaPerfis, $values,'class="" id="perfis" style="list-style:none;margin:0;padding:0;"'); ?>
							</div>
						</div>
						
						<div class="form-actions">
							<div class="col-sm-10 col-offset-2">
								<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
								<a href="<?php echo site_url("usuarios")?>" class="btn">
									Cancelar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuarios/js.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuarios/validate.js"></script>
			<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-checktree.js"></script>
			<script type="text/javascript">
				$(function(){
					$("#perfis").checktree();
					$("#profissionais").selectpicker();
					$("#status").selectpicker();
				})
			</script>
			<style>
				
			</style>
		</div>
	</div>
</div>