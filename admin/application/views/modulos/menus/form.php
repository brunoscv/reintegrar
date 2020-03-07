<div class="page-breadcrumb">
    <ol class="breadcrumb container">
    	<li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo site_url("menus")?>">Menus</a></li>
        <li>Adicionar Menu</li>
    </ol>
</div>
<div class="page-title">
    <div class="container">
        <h3>Menus</h3>
    </div>
</div>
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Menus do Sistema / Editar</h4>
				                    <a href="<?php echo site_url("menus");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Listagem de menus</a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php echo $this->load->view('layout/messages.php'); ?>

									<form id="form_menu" class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
										<input type="hidden" id="id" name="id" value="<?php echo set_value("id", @$item->id); ?>" />
										<div class="form-group">
											<label class="col-sm-2 control-label" for="menus_id">Menu</label>
											<div class="col-sm-10">
												<div class="input-group">
												<input readonly="true" type="text" value="<?php echo set_value("menupai", @$item->pai); ?>" class="form-control disabled" name="menupai" id="menupai">
												<a 
													href="<?php echo base_url("menus/index"); ?>" class="input-group-btn btn btn-info"
													data-widget="buscaMenu"
													data-dialog="one"
													data-width="90%"
													data-label="#menupai"
													data-value="#menus_id"
													data-title="Menus"
												><i class="fa fa-search"></i></a>
												<?php echo form_error('menupai'); ?>
												<input type="hidden" value="<?php echo set_value("menus_id",@$item->menus_id)?>" id="menus_id" name="menus_id" />
												</div>
											</div>
											
											<!-- /controls -->
										</div>
										<!-- /control-group -->
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="descricao">Descrição</label>
											<div class="col-sm-10">
												<input type="text" value="<?php echo set_value("descricao", @$item->descricao); ?>" class="form-control" name="descricao" id="descricao">
												<?php echo form_error('descricao'); ?>
											</div>
											<!-- /controls -->
										</div>
										<!-- /control-group -->
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="icone">Ícone</label>
											<div class="col-sm-10">
												<div class="input-group">
													<input type="text" value="<?php echo set_value("icone", @$item->icone); ?>" class="form-control" name="icone" id="icone">
													<div class="input-group-btn btn btn-primary"><i id="preview-icone" class="<?php echo set_value("icone", @$item->icone); ?>"></i></div>
													<?php echo form_error('icone'); ?>
												</div>
											</div>
											<!-- /controls -->
										</div>
										<!-- /control-group -->
										
										<div class="form-group">
											<label class="col-sm-2 control-label" for="url">Url</label>
											<div class="col-sm-10">
												<input type="text" value="<?php echo set_value("url", @$item->url); ?>" class="form-control" name="url" id="url">
												<?php echo form_error('url'); ?>
											</div>
											<!-- /controls -->
										</div>
										<!-- /control-group -->

										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
												<a href="<?php echo site_url("menus")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
										<!-- /form-actions -->
									</form>
								</div>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/menus/js.js"></script>
								<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/menus/validate.js"></script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

