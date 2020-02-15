<form class="form-inline" style="margin-top:10px;" action="<?php echo site_url( strtolower(get_active_class()) ); ?>">
	<div class="form-group">
		<?php echo form_dropdown('filtro_field', $campos, $this->input->get("filtro_field"), 
		'class="form-control m-b-sm"')?>
	</div>
	<div class="input-group m-b-sm">
		<input name="filtro_valor" value="<?php echo $this -> input -> get("filtro_valor"); ?>" placeholder="Pesquisa" class="form-control" type="text">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">
				<i class="fa fa-search"></i>
			</button>
		<a class="btn btn-default ajax" href="<?php echo site_url( strtolower(get_active_class()) ); ?>"><span class="fa fa-eraser"></span></a>
		</span>
	</div>
	<div class="form-group">
	</div>
</form>
	