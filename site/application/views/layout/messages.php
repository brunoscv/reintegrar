<?php if( !empty($this->data['msg_error']) ): ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong><i class="fa fa-ban"></i> Atenção!</strong> <?php echo $this->data['msg_error']; ?>
</div>
<?php endif; ?>

<?php if( !empty($this->data['msg_success']) ): ?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">
		×
	</button>
	<strong><i class="fa fa-check"></i></strong> <?php echo $this->data['msg_success']; ?>
</div>
<?php endif; ?>

<?php if( !empty($this->data['msg_empty']) ): ?>
<div class="alert alert-warning">
	<button type="button" class="close" data-dismiss="alert">
		×
	</button>
	<strong><i class="fa fa-exclamation"></i></strong> <?php echo $this->data['msg_empty']; ?>
</div>
<?php endif; ?>