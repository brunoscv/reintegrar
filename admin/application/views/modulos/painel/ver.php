<div class="page-title">
	<div class="container">
		<h3>Pacientes</h3>
	</div>
</div>
<!-- <div class="page-breadcrumb">
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url(); ?>">Home</a></li>
		<li><a href="<?php echo site_url("pacientes")?>">Pacientes</a></li>
		<li>Ver Paciente </li>
	</ol>
</div> -->
<div id="main-wrapper" class="container">
	<div class="row" data-container="all">
		<div class="col-md-12">
			<div class="panel panel-transparent">
				<div class="panel-body">
				<div class="row" data-container="all">
						<div class="col-md-12" data-container="main">
							<div class="panel panel-default">
								<div class="panel-heading clearfix">
									<h4 class="panel-title">Pacientes / <?php echo (@$paciente->id) ? "Ver" : "Adicionar"?> </h4>
									<a href="<?php echo site_url("pacientes/");?>" class="btn btn-primary pull-right"><span class="fa fa-list"></span> Ir para a Listagem</a>
								</div>
								<div class="panel-body" style="margin-top:10px;">
									<div class="col-sm-12">
										<label class="col-sm-2 control-label" for="nome_pac"><strong>Nome: </strong></label>
										<div class="col-sm-10">
											<p><?php echo @$paciente->nome_pac; ?></p>
										</div>
									</div>
									<div class="col-sm-12">
										<label class="col-sm-2 control-label" for="filiacao"><strong>Filiação: </strong></label>
										<div class="col-sm-10">
											<p><?php echo @$paciente->filiacao ?> </p>
										</div>
									</div>
									<div class="col-sm-12">
										<label class="col-sm-2 control-label" for="data_nasc"><strong>Data Nascimento: </strong></label>
										<div class="col-sm-10">
											<?php if (@$paciente->data_nasc) { ?>
												<?php echo date("d/m/Y", strtotime(@$paciente->data_nasc)) ?> </p>
											<?php } else { ?>
												<p><?php echo @$paciente->data_nasc ?> </p>
											<?php } ?>
										</div>
									</div>
									<div class="col-sm-12">
										<label class="col-sm-2 control-label" for="email_pac"><strong>Email: </strong></label>
										<div class="col-sm-10">
											<p><?php echo @$paciente->email_pac ?></p>
										</div>
									</div>
									<div class="col-sm-12">
										<label class="col-sm-2 control-label" for="telefone_pac"><strong>Telefone: </strong></label>
										<div class="col-sm-10">
											<p><?php echo @$paciente->telefone_pac ?></p>
										</div>
									</div>
									<div class="col-sm-12">
										<label class="col-sm-2 control-label" for="telefone_pac2"><strong>Telefone 2: </strong></label>
										<div class="col-sm-10">
											<p><?php echo @$paciente->telefone_pac2 ?> </p>
										</div>
									</div>
									<div class="col-sm-12">
										<label class="col-sm-2 control-label" for="telefone_pac_fixo"><strong>Telefone Fixo: </strong></label>
										<div class="col-sm-10">
											<p><?php echo @$paciente->telefone_pac_fixo ?> </p>
										</div>
									</div>
									<div class="col-sm-12">
										<label class="col-sm-2 control-label" for="nome_plano"><strong>Plano de Saúde: </strong></label>
										<div class="col-sm-10">
											<p><?php echo @$paciente->nome_plano ?> </p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>