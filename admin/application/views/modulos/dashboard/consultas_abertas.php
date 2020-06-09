<table class="display table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Cod Consulta</th>
			<th>Horário</th>
			<th>Dia</th>
			<th>Paciente</th>
			<th>Profissional</th>
			<!--<th>Especialidade</th>
			<th>Plano</th> -->

			<th>Data</th>
			<th>Status</th>
			<th class="td-actions"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($listaItemConsulta as $item): ?>
			<tr>
				<td><?php echo $item->id; ?></td>
				<td><?php echo $item->cod_consulta; ?></td>
				<td><?php echo $item->desc_horario; ?></td>
				<td><?php echo $item->desc_dia_semana; ?></td>
				<td><?php echo $item->nome_pac; ?></td>
				<td><?php echo $item->nome_prof; ?></td>
				<!-- <td><?php echo $item->nome_espec; ?></td>
				<td><?php echo $item->nome_plano; ?></td>
				<td><?php echo $item->item_consulta_id; ?></td>-->
				<td><?php echo date("d/m/Y", strtotime($item->data)); ?></td>
				<td class="td-actions">
					<!-- <a href="<?php echo site_url("itemconsulta/presenca_consulta/".$item->presenca); ?>" class="btn btn-small btn-danger"><i class="fa fa-check"> </i></a> -->
					<button type="button" id = "btn-paciente_<?php echo $item->id; ?>"
						    class="btn btn-small btn-danger salvarPresencaPaciente">
						    <i class="fa fa-check"></i>
					</button>
					
				</td>
					<!-- <a href="<?php echo site_url("itemconsulta/ver/".$item->periodo_consulta_id); ?>" class="btn btn-small btn-primary"><i class="fa fa-medkit"> </i></a></td> -->
					<!-- <a href="<?php echo site_url("itemconsulta/delete/".$item->id); ?>" class="btn btn-danger btn-small"><i class="fa fa-times"> </i></a></td> -->
				</tr>
		<?php endforeach; ?>
	</tbody>
</table>