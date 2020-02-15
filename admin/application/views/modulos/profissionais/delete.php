<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-transparent">
                <div class="panel-body">
					<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
				                    <h4 class="panel-title">Profissionais / Remover</h4>
				                    <a href="<?php echo site_url("profissionais/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Todos </a>
				                </div>
								<div class="panel-body" style="margin-top:10px;">
									<?php $this->load->view("layout/messages"); ?>
									<form id="form_usuario" class="form-horizontal" method="post">
										<div class="alert alert-danger" role="alert">
					                    	<strong>Atenção!</strong> 
					                    	Esta ação não poderá ser desfeita.
					                	</div>
					                	<div class="form-group">
											<label class="col-sm-2 control-label" for="id">Cod.</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("id", $item->id); ?>" name="id" id="id">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="nome_prof">Nome</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("nome_prof", $item->nome_prof); ?>" name="nome_prof" id="nome_prof">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="telefone_prof">Telefone</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("telefone_prof", $item->telefone_prof); ?>" name="telefone_prof" id="telefone_prof">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="conselhos_id">Conselho</label>
												<div class="col-sm-10">
													<?php echo form_dropdown('conselhos_id', $listaConselhos, set_value('conselhos_id', @$item->conselhos_id), 
													'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="conselhos" disabled=""'); ?>
													<?php echo form_error('conselhos_id'); ?>
												</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="num_conselho_prof">Num Conselho</label>
											<div class="col-sm-10">
												<input type="text" disabled="" class="form-control" value="<?php echo set_value("num_conselho_prof", $item->num_conselho_prof); ?>" name="telefone_prof" id="telefone_prof">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="estados_id">UF Conselho</label>
												<div class="col-sm-10">
													<?php echo form_dropdown('estados_id', $listaEstados, set_value('estados_id', @$item->estados_id), 
													'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="conselhos" disabled=""'); ?>
													<?php echo form_error('estados_id'); ?>
												</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label" for="especialidades_id">Especialidade</label>
												<div class="col-sm-10">
													<?php echo form_dropdown('especialidades_id', $listaEspecialidades, set_value('especialidades_id', @$item->especialidades_id), 
													'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="conselhos" disabled=""'); ?>
													<?php echo form_error('especialidades_id'); ?>
												</div>
										</div>
										
										<div class="form-group">
											<div class="col-sm-10 col-offset-2">
												<input type="submit" name="enviar" class="btn btn-danger" value="Apagar" />
												<a href="<?php echo site_url("profissionais")?>" class="btn">
													Cancelar
												</a>
											</div>
										</div>
									</form>
			</div>
			<!-- /widget-content -->
		</div>
		<!-- /widget -->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/profissionais/js.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/profissionais/validate.js"></script>
	</div>
</div>