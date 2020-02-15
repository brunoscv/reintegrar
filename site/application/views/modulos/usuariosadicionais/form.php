<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("clientes")?>">Clientes</a></li>
        <li>Adicionar Usuário</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Clientes</h3>
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
				                    <h4 class="panel-title">Clientes / Usuários adicionais / <?php echo (@$item->id) ? "Editar" : "Novo"?></h4>
				                    <a href="<?php echo site_url("usuariosadicionais");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Listagem de Usuários</a>
				                </div>
				                <div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_usuario" action="<?php echo current_url(); ?>?clientes_id=<?php echo $this->clientes_id; ?>" class="form-horizontal" method="post">
										<input type="hidden" id="id" name="id" value="<?php echo set_value("id", @$item->id); ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="cliente">Cliente</label>
											<div class="col-sm-10">
												<input type='hidden' value='<?php echo @$clienteAtual->id; ?>' name='clientes_id'/>
												<strong><?php echo $clienteAtual->nome_empresa?></strong>
												<?php echo form_error('clientes_id'); ?>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-2 control-label" for="nome">Nome</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?php echo set_value("nome", @$item->nome); ?>" name="nome" id="nome">
												<?php echo form_error('nome'); ?>
											</div>
											<!-- /controls -->
										</div>
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="usuario">Usuário</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?php echo set_value("usuario", @$item->usuario); ?>" name="usuario" id="usuario" placeholder="ex: efortes">
												<?php echo form_error('usuario'); ?>
												<p class="help-block">
													Seu nome de usuário para acessar o sistema
												</p>
											</div>
											<!-- /controls -->
										</div>
										<!-- /control-group -->
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="email">E-mail</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?php echo set_value("email", @$item->email); ?>" name="email" id="email" placeholder="ex: exemplo@email.com">
												<?php echo form_error('email'); ?>
											</div>
											<!-- /controls -->
										</div>
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="senha">Senha</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="senha" id="senha">
											</div>
											<!-- /controls -->
										</div>
										<!-- /control-group -->

										<div class="form-group">
											<label class="col-sm-2 control-label" for="senha2">Confirmação</label>
											<div class="col-sm-10">
												<input type="password" class="form-control" name="senha2" id="senha2">
											</div>
											<!-- /controls -->
										</div>
										<!-- /control-group -->

										<div class="form-group">
											<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
											<a href="<?php echo site_url("usuariosadicionais")?>" class="btn">
												Cancelar
											</a>
										</div>
									</form>
									<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuariosadicionais/js.js"></script>
									<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/usuariosadicionais/validate.js"></script>
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
	</div>
</div>