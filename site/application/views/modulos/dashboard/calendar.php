<style type="text/css">
  #calendar {
    max-width: 100%;
    margin: 0 auto;
  }
</style>
<div id="main-wrapper" class="container">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-calendar"></i> Calendário</h4>
				<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
			</div>
			<div class="panel-body">
				<?php echo $this->load->view('layout/messages.php'); ?>
				<div class="col-md-12">
					<div id='calendar'></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/dashboard/calendar.js"></script>