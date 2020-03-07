<form class="form-inline" style="margin-top:13px;" action="<?php echo current_url(); ?>">
	<div class="form-group">
		<div class="input-group m-b-sm mb1 ">
			<input id="filtro_data_inicio" name="filtro_data_inicio" value="<?php echo $this->input->get("filtro_data_inicio"); ?>" placeholder="Data Início" class="form-control" type="text">
			<span class="input-group-btn">
				<button type="button" class="btn btn-default">
					<i class="fa fa-calendar"></i>
				</button>
			</span>
		</div>
		<div class="input-group m-b-sm mb1">
			<input id="filtro_data_fim" name="filtro_data_fim" value="<?php echo $this -> input -> get("filtro_data_fim"); ?>" placeholder="Data Fim" class="form-control" type="text">
			<span class="input-group-btn">
				<button type="button" class="btn btn-default">
					<i class="fa fa-calendar"></i>
				</button>
			</span>
		</div>
		<a class="btn btn-default ajax" href="<?php echo site_url( strtolower(get_active_class() . '/' . get_active_method()) ); ?>"><span class="fa fa-eraser"></span></a>
		<button type="submit" class="btn btn-success"><span class="fa fa-filter"></span> Filtrar</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function(event) {
		$("#filtro_data_inicio").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			language: "pt",
			todayHighlight: true
		});
		$("#filtro_data_fim").datepicker({
			format: 'dd/mm/yyyy',
			autoclose: true,
			language: "pt",
			todayHighlight: true
		});
		$("#filtro_data_inicio").mask("99/99/9999");
		$("#filtro_data_fim").mask("99/99/9999");
	});
</script>