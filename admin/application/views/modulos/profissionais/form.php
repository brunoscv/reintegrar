<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Profissionais / <?php echo (@$item->id) ? "Editar" : "Novo"?></h4>
					<a href="<?php echo site_url("profissionais/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Todos </a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<?php $this->load->view('layout/messages.php'); ?>
					<form id="form_profissionais" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
						<input name="id" type="hidden" id="id" class="form-control" value="<?php echo set_value("id", @$item->id) ?>" />
						
						<div class="form-group">
							<label class="col-sm-2 control-label" for="nome_prof">Nome</label>
								<div class="col-sm-10">
									<input name="nome_prof" type="text" id="nome_prof" class="form-control" value="<?php echo set_value("nome_prof", @$item->nome_prof) ?>" />
									<?php echo form_error('nome_prof'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="telefone_prof">Telefone</label>
								<div class="col-sm-10">
									<input name="telefone_prof" type="text" id="telefone_prof" class="form-control" value="<?php echo set_value("telefone_prof", @$item->telefone_prof) ?>" />
									<?php echo form_error('telefone_prof'); ?>
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="conselhos_id">Conselho</label>
								<div class="col-sm-10">
								<?php echo form_dropdown('conselhos_id', $listaConselhos, set_value('conselhos_id', @$item->conselhos_id), 
									'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="conselhos"'); ?>
									<?php echo form_error('conselhos_id'); ?>
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="num_conselho_prof">Num Conselho</label>
								<div class="col-sm-10">
									<input name="num_conselho_prof" type="text" id="num_conselho_prof" class="form-control" value="<?php echo set_value("num_conselho_prof", @$item->num_conselho_prof) ?>" />
									<?php echo form_error('num_conselho_prof'); ?>
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="estados_id">UF Conselho</label>
								<div class="col-sm-10">
								<?php echo form_dropdown('estados_id', $listaEstados, set_value('estados_id', @$item->estados_id), 
									'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="estados"'); ?>
									<?php echo form_error('estados_id'); ?>
								</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="especialidades_id">Especialidade</label>
								<div class="col-sm-10">
									<?php echo form_dropdown('especialidades_id', $listaEspecialidades, set_value('especialidades_id', @$item->especialidades_id), 
									'data-size="7" data-live-search="true" class="form-control fill_selectbtn_in own_selectbox" id="especialidades"'); ?>
									<?php echo form_error('especialidades_id'); ?>
								</div>
						</div>

						<div class="form-actions">
							<div class="col-sm-10 col-offset-2">
								<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
								<a href="<?php echo site_url("profissionais"); ?>" class="btn">
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/profissionais/js.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/profissionais/validate.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
		$("#telefone_prof").mask("(99)99999-9999");
		// $("#cpf_prof").mask("999.999.999-99");
		// $("#especialidades").select2();
		$("#especialidades").selectpicker();
		$("#conselhos").selectpicker();
		$("#estados").selectpicker();
	});
</script>