<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("perfis")?>">Perfil</a></li>
        <li>Adicionar Perfil</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Perfis</h3>
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
				                    <h4 class="panel-title">Perfis de Acesso / <?php echo (@$item->id) ? "Editar" : "Novo"?></h4>
				                    <a href="<?php echo site_url("perfis/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Listagem de Perfis</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>
									<form id="form_perfil" class="form-horizontal" method="post">
										<input type="hidden" id="id" name="id" value="<?php echo set_value("id", @$item->id); ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="descricao">Descrição</label>
											<div class="col-sm-10">
												<input type="text" value="<?php echo set_value("descricao", @$item->descricao); ?>" class="form-control" name="descricao" id="descricao">
												<?php echo form_error('descricao'); ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="descricao">Menus</label>
											<div class="col-sm-10">
												<?php $values = ($this->input->post("menus")) ? @$this->input->post("menus") : @$item->menus; ?>
												<?php echo recursiveFormMenuList('menus[]',$listaMenus, $values, 'id="menus"'); ?>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("perfis")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/perfis/js.js"></script>
						<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/perfis/validate.js"></script>
						<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-checktree.js"></script>
						<script type="text/javascript">
							$(function(){
								$("#menus").checktree();
							})
						</script>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>