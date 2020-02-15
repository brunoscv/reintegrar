<div class="row" style="padding: 2em;">
	<?php foreach($listaAgendaConsulta as $item): ?>
		<?php foreach ($item as $key => $i): ?>
			<div class="dias_semana">
				<h3 class="text-center">
					<?php echo $i[0]->desc_dia_semana ?>
				</h3>
				<?php foreach ($i as $key => $dados): ?>
					<p class="text-left">
						<?php echo $dados->desc_horario . " - " . $dados->nome_pac;?>
					</p>

				<?php endforeach ?>
			</div>
		<?php endforeach ?>
	<?php endforeach; ?>
</div>
<style type="text/css">
    .dias_semana {
    	width: 19.666667%;	
    	position: relative;
	    min-height: 1px;
	    padding-right: 15px;
	    padding-left: 15px;
   		float: left;
    }
</style>