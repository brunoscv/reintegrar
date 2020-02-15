<div id="main-wrapper" class="container" style="margin-top: 2em; height: 100vh;">
	<div class="row" data-container="all">
        <div class="col-md-12">
            <div class="panel panel-white has-shadow">
				<div class="panel-heading clearfix">
					<h4 class="panel-title">Controle de Planos de Tratamento</h4>
					<a href="<?php echo site_url("atendimentos/criar/". $listaAtendimentos[0]->consultas_id);?>" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Novo </a>
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
									<th style="text-align:center">Qtds</th>
									<th style="text-align:center">Freq</th>
									<th style="text-align:center">Inicio</th>
									<th style="text-align:center">Fim</th>
									<th style="text-align:center">Sessões</th>
									<th style="text-align:center">Renovar</th>
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
									<td style="text-align:center"><?php echo $item->qtd_atendimentos; ?></td>
									<td style="text-align:center"><?php echo $item->freq_atendimentos; ?></td>
									<td style="text-align:center"><?php echo date("d/m/Y", strtotime($item->data_inicio)); ?></td>
									<td style="text-align:center"><?php echo date("d/m/Y", strtotime($item->data_fim)); ?></td>
									<td class="text-center" style="text-align:center"><a class="btn btn-primary" href="<?php echo base_url().'consultas/sessoes/'. $item->consultas_id . '/' . $item->id;?>"><i class="fa fa-user-md"></i></a></td>
									<td class="text-center" style="text-align:center"><a class="btn btn-warning renovar_atendimentos" consultas_id="<?php echo $item->consultas_id;?>" atendimentos_id="<?php echo $item->id;?>"><i class="fa fa-repeat"></i></a></td>
									<td style="text-align:center"><?php echo (($item->status == 1) ? '<span class="label label-success"> Ativo </span>' : (($item->status == 2) ? '<span class="label label-success"> Concluído </span>' : '<span class="label label-danger"> Inativo </span>')); ?></td>
									<td style="text-align:center"><?php echo date("d/m/Y", strtotime($item->createdAt)); ?></td>
									<td class="td-actions">
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
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/atendimentos/js.js"></script> -->
<script src="<?php echo base_url(); ?>assets/plugins/bootbox/bootbox.js"></script>
<script type="text/javascript">
    $(document).ready(function(event) {
		$('[data-toggle="popover"]').popover();
		
		$("body").on('click', '.renovar_atendimentos', function(event){
            event.preventDefault();
            var consultas_id = $(this).attr("consultas_id"); 
			var atendimentos_id = $(this).attr("atendimentos_id");
          
            bootbox.dialog({
                message: "Tem certeza que deseja <b>RENOVAR</b> esse atendimento por igual período?",
                size: 'small',
                buttons: {
                    cancel: {
                        label: 'Não',
                        className: 'btn-danger',
                        callback: function(){
                            console.log('Custom cancel clicked');
                        }
                    },
                    confirm: {
                        label: 'Sim',
                        className: 'btn-success',
                        callback: function(){
							$.ajax({
								url:  base_url + 'consultas/renovar_atendimentos/' + consultas_id + '/' + atendimentos_id,
								type: "POST",
								dataType: 'json',
								context: this,
								data: { 
									consultas_id: consultas_id,
									atendimentos_id: atendimentos_id,
								},
								beforeSend: function() {
								},
								success: function(data) {
									toastr.success("Ação Completada com Sucesso");
									window.location.href = "/sistema/admin/consultas/sessoes/" + consultas_id + '/' + atendimentos_id;
									//window.location.href = "/saudecasa/admin/consultas/sessoes/" + consultas_id + '/' + atendimentos_id;
								},
								complete: function(data) {
									toastr.success("Ação Completada com Sucesso");
									window.location.href = "/sistema/admin/consultas/sessoes/" + consultas_id + '/' + atendimentos_id;
									//window.location.href = "/saudecasa/admin/consultas/sessoes/" + consultas_id + '/' + atendimentos_id;                                  
									console.log(data);
								}
							});	 
                        }
                    },
                }
            });
        });
    });
</script>