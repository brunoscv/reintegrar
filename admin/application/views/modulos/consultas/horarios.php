<div class="table-responsive">
	<form id="form_horarios" action="<?php echo current_url(); ?>" class="form-horizontal" method="post">
	<!-- <form id="form_turmas" class="form-horizontal"> -->
		<?php foreach($listaHorarios as $key => $item): ?>
			<?php foreach($item as $key => $t): ?>
				<h4 class="panel-title">
					<?php echo $t[0]->desc_dia_semana; ?>
				</h4>
			<table class="display table"> 
				<thead>
					<tr>
						<th>Codigo Horário</th>
						<th>Profissional</th>
						<th>Horário</th>
						<th>Criado</th>
						<th class="td-actions">Selecionados</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($t as $key => $tt): ?>
					<tr>
						<td><?php echo $tt->id; ?></td>
						<td><?php echo $tt->nome_prof; ?></td>
						<td><?php echo $tt->desc_horario; ?></td>
						<td><?php echo date("d/m/Y", strtotime($tt->createdAt)); ?></td>
						<td class="td-actions">
						<!-- <?php if (1 == 1) { ?>
							<button type="button" matricula_turma_id="" 
							        status="" 
							        modalidade="" 
							        turma_completa_id = ""
							        class="btn btn-small btn-success salvarTurmasAluno"><i class="fa fa-check"></i>
							</button>
							<?php } else { ?>
								<button type="button" matricula_turma_id="" 
							         status="" 
							         modalidade="" 
							         turma_completa_id = ""
							         class="btn btn-small btn-danger salvarTurmasAluno"><i class="fa fa-check"></i>
							</button>
						<?php } ?> -->
						<div class="form-group">
							<div class="col-lg-3 margin-bottom-10 pull-right">
								<input type="checkbox" value="<?php echo $tt->id; ?>" name="horarios[]">
							</div>	
						</div> 
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<?php endforeach ?>
		<?php endforeach ?>
		<div class="form-actions">
			<div class="col-sm-10 col-offset-2">
				<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
				<a href="<?php echo site_url("consultas"); ?>" class="btn">
					Cancelar
				</a>
			</div>
		</div>
	</form>
</div>