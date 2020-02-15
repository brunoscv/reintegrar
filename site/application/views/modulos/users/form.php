<div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("users")?>">Users</a></li>
		<li>Adicionar User </li>
	</ol>
</div>
<div class="page-title">
	<div class="container">
		<h3>Controle de Users</h3>
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
				<h4 class="panel-title">Users / <?php echo (@$item->id) ? "Editar" : "Adicionar"?> </h4>
				<a href="<?php echo site_url("users/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
			</div>
			<div class="panel-body" style="margin-top:10px;">
				<?php echo $this->load->view('layout/messages.php'); ?>
				<form id="form_users" action="<?php echo current_url(); ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="usuario">Nome</label>
						<div class="col-sm-10">
							<input name="usuario" type="text" id="usuario" class="form-control" value="<?php echo set_value("usuario", @$item->usuario) ?>" />
							<?php echo form_error('usuario'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="email">Email</label>
						<div class="col-sm-10">
							<input name="email" type="text" id="email" class="form-control" value="<?php echo set_value("email", @$item->email) ?>" />
							<?php echo form_error('email'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="senha">Senha</label>
						<div class="col-sm-10">
							<?php if(@$item->id): ?>
								<?php $classHtml = "class='form-control ignore'";?>
							<?php else : ?>
								<?php $classHtml = "class='form-control'";?>
							<?php endif;?>
							<input name="senha" type="password" id="senha" <?php echo $classHtml;?> value="<?php echo set_value("senha") ?>" />
							<?php if(@$item->id): ?>
							<button type="button" class="btn" id="alterar_senha">
								Alterar Senha
							</button>
							<? endif;?>

							<?php echo form_error('senha'); ?>
						</div>
					</div>
					<?php if( @$item->imagem ): ?>
						<div class="form-group imagem-upload">
							<label class="col-sm-2 control-label" for="imagem">Imagem Questão</label>
							<div class="col-sm-6">
								<div class="imagem-questao">
									<img src="<?php echo base_url() . 'public/uploads/usuarios/' . @$item->imagem;?>" width=100 height=100>
									<!-- <input type="hidden" name="imagem" value="<?php echo @$item->imagem; ?>"> -->
								</div>
							</div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-danger remover-imagem">Remover</button>
							</div>
						</div>
					<?php endif; ?>
					<div class="form-group input-upload">
						<label class="col-sm-2 control-label" for="imagem">Imagem Aux.</label>
						<div class="col-sm-10">
							<input name="imagem" type="file" id="imagem" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="estados_id">Estado</label>
						<div class="col-sm-4">
							<?php echo form_dropdown('estados', $listaEstados, 
							set_value('listaEstados', @$item->estados_id), 'class="form-control" id="estados"') ;?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="cidades_id">Cidade</label>
						<div class="col-sm-10">
							<?php echo form_dropdown('cidades', $listaCidades, 
							set_value('listaCidades', @$item->cidades_id), 'class="form-control" id="cidades"') ;?>
							<!-- <select name="cidades" id="cidades"></select> -->
						</div>
					</div>


					<div class="form-actions">
						<div class="col-sm-10 col-offset-2">
							<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
							<a href="<?php echo site_url("users"); ?>" class="btn">
								Cancelar
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/users/js.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/users/validate.js"></script>
	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		<?php if(@$item->id): ?>
			$("#senha").hide();
			$("#alterar_senha").show();
			 $("#alterar_senha").click(function(event) {
			 		$("#alterar_senha").hide();
					$("#senha").show();
			 });
			
		<?php endif; ?>

		//Hide-show dos divs de alternativas e imagem caso o controller seja editar();
		<?php if(@$item->imagem): ?>
			$(".input-upload").hide();
		<?php else: ?>
			$(".input-upload").show();
		<?php endif; ?>

		$(".remover-imagem").click(function(event) {			
			var confirm = window.confirm("Deseja realmente excluir esse campo?");
				if(confirm == true) {
					$(".imagem-upload").remove();
					$(".input-upload").show();
				}
		});

	$("#estados").change(function(event) {
			estados_id = $('#estados').val();
			$.ajax({
				url: '<?php echo site_url(); ?>users/listaCidades',
				type: 'POST',
				dataType:"json",
				data: {estados_id: estados_id},
				success: function(data) {
					var sel = $("#cidades");
					sel.html("");
					sel.append('<option value="">Selecione uma cidade</option>');
					
					var listaCidades = data.listaCidades;				
					for (var i=0; i<listaCidades.length; i++) {
						sel.append('<option value="' + listaCidades[i].id + '">' + listaCidades[i].nome + '</option>');
					}
				}
			})
			.fail(function() {
				console.log("error");
			})
		});
	});						
</script>