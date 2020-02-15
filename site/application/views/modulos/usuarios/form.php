<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("usuarios")?>">Usuário</a></li>
        <li>Adicionar Usuário</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Usuários</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-4">
							<?php echo $this->load->view('layout/search.php'); ?>
						</div>
						<div class="col-md-8" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Usuários do Sistema / <?php echo (@$item->id) ? "Editar" : "Novo"?></h4>
				                    <a href="<?php echo site_url("usuarios/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Listagem de Usuários</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_usuario" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
										<input type="hidden" id="id" name="id" value="<?php echo set_value("id", @$item->id); ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="nome">Nome</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?php echo set_value("nome", @$item->nome); ?>" name="nome" id="nome">
												<?php echo form_error('nome'); ?>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="usuario">Usuário</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" value="<?php echo set_value("usuario", @$item->usuario); ?>" name="usuario" id="usuario" placeholder="ex: efortes">
												<?php echo form_error('usuario'); ?>
												<p class="help-block">
													Seu nome de usuário para acessar o sistema
												</p>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="email">E-mail</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?php echo set_value("email", @$item->email); ?>" name="email" id="email" placeholder="ex: exemplo@email.com">
												<?php echo form_error('email'); ?>
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="senha">Senha</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="senha" id="senha">
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="senha2">Confirmação</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="senha2" id="senha2">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="senha2">Perfis de acesso</label>
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
								})
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>