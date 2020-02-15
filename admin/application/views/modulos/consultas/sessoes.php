<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Controle de Sessões</h4>
					<a href="<?php echo site_url("consultas/atendimentos/" . $listaAtendimentos[0]->consultas_id);?>" class="btn btn-primary pull-right"><span class="fa fa-arrow-left"></span> Voltar </a>
				</div>
				<div class="panel-body" style="margin-top:10px;">
					<div class="table-responsive">
						<?php $this->load->view('layout/search.php'); ?>
						<table class="display table table-hover mg-top-20 tablesaw tablesaw-stack" data-tablesaw-mode="stack">
							<thead>
								<tr>
									<th>#</th>
									<th>Consulta</th>
									<th>Paciente</th>
									<th>Profissional</th>
									<th style="text-align:center">Data Atd.</th>
									<th style="text-align:center">Presença</th>
									<th style="text-align:center">Status</th>
									<th style="text-align:center">Criado</th>
									<th class="td-actions"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($listaAtendimentos as $item): ?>
								<tr>
									<!-- <td><span class="label label-danger"> Inativo </span></td> -->
									<td><?php echo $item->id; ?></td>
									<td><?php echo $item->consultas_id; ?></td>
									<td><?php echo $item->nome_pac; ?></td>
									<td><?php echo $item->nome_prof; ?></td>
									<td style="text-align:center"><?php echo ( (!$item->data_atendimento)  ? "<span class=''> <input type='text' class='form-control data_atendimento' name='data_atendimento' id='data_atendimento_{$item->id}' style='text-align:center'/> <p id='mensagem_{$item->id}' style='color: red;font-size: 11px;font-style: italic;'></p> </span>" : date('d/m/Y H:i', strtotime($item->data_atendimento)) ); ?></td>
									<td style="text-align:center"><?php echo (($item->presenca == 1) ? "<span class='btn btn-success mudarPresenca' sessoes_id='{$item->id}' presenca='{$item->presenca}' consultas_id='{$item->consultas_id}' atendimentos_id='{$item->atendimentos_id}'><i class='fa fa-check'></i> </span>" : "<span class='btn btn-danger mudarPresenca' sessoes_id='{$item->id}' presenca='{$item->presenca}' consultas_id='{$item->consultas_id}' atendimentos_id='{$item->atendimentos_id}'><i class='fa fa-check'></i> </span>"); ?></td>
									<td style="text-align:center"><?php echo (($item->status == 1) ? '<span class="label label-success"> Ativo </span>' : (($item->status == 2) ? '<span class="label label-success"> Concluído </span>' : '<span class="label label-danger"> Inativo </span>')); ?></td>
									<td style="text-align:center"><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
									<td  style="text-align:center" class="td-actions">
										<button type="button" 
												class="btn btn-default fa fa-ellipsis-v" 
												id="myPopover" 
												data-toggle="popover"
												data-anamation="true"
												data-html="true"
												data-content="<a href='<?php echo site_url("consultas/editar_atendimentos/".$item->id); ?>' class='editar_info'>
																<p><i class='btn-icon-only fa fa-pencil'></i></span> Editar</p>
																<a href='<?php echo site_url("atendimentos/delete_atendimentos/".$item->id); ?>' class='delete_info'>
																<p><i class='btn-icon-only fa fa-trash'></i></span> Excluir</p> "
												data-placement="bottom">
										</button>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<div class="paginate pull-right">
							<?php echo (isset($paginacao)) ? $paginacao : ''; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>assets/plugins/bootbox/bootbox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/consultas/js.js"></script>
<style type="text/css">
	.focus-danger {
		border-color: #d9534f;
		outline: 0;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
	}
</style>

<script type="text/javascript">
    $(document).ready(function(event) {
        $('[data-toggle="popover"]').popover();
		// $('.data_atendimento').datepicker({
		// 	format: 'dd/mm/yyyy',
		// 	autoclose: true,
		// 	locale: "pt-br",
		// 	todayHighlight: true
		// }).setLocale('pt-BR');
		// $("body").on('click', '.data_atendimento', function(event){
		// 	$('.data_atendimento').datetimepicker('show');
		// });
		$("body").on('click', '.data_atendimento', function(event){
			$.datetimepicker.setLocale('pt-BR');
			$('.data_atendimento').datetimepicker({
				inline:false,
				format: 'd/m/Y H:i',
				// mask: '99/99/9999 99:99',
				monthChangeSpinner: false,
				closeOnDateSelect: false,
				closeOnTimeSelect: true,
				closeOnWithoutClick: false,
				closeOnInputClick: true,
				openOnFocus: true,
				timepicker: true,
				datepicker: true,
				// todayButton: true,
				prevButton: true,
				nextButton: true,
				defaultSelect: true,
				allowBlank: true,
				defaultTime: false,
				defaultDate: false
			});
			//$('.data_atendimento').datetimepicker('show');
		});
		$('.data_atendimento').mask("99/99/9999 99:99");
    });
</script>