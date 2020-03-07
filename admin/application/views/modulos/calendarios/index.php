<div id="main-wrapper" class="container" style="margin-top:2em;">
	<div class="row" data-container="all">
		<div class="panel panel-white has-shadow">
			<div class="panel-heading">
				<h4 class="panel-title"><i class="fa fa-calendar"></i> Agenda Diária</h4>
				<div class="alterar-visualizacao" id='alterar-visualizacao'></div>
			</div>
			<div class="panel-body">
				<?php $this->load->view('layout/messages.php'); ?>
				<div class="col-md-12">
					<form class="form-inline" style="margin-top:10px;" action="<?php echo site_url( strtolower(get_active_class()) ); ?>">
						<div class="input-group m-b-sm">
								<?php echo form_dropdown('profissionais_id', $listaProfissionais, set_value('profissionais_id',  $this->input->get("profissionais_id")), 
								'data-size="7" data-live-search="true" class="form-control fill_select btn_in own_selectbox"'); ?>
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
					<div id="calendario" style="margin-top:2em"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/calendarios/js.js"></script>
<script type="text/javascript">
	var events = <?php echo json_encode($data); ?>;
	$(document).ready(function() {
        var calendar = $('#calendario').fullCalendar({
			header: {
				left:   '',
				center: 'title',
				right:  'today prev,next'
			},
			contentHeight: 640,
			allDaySlot: false,
            hiddenDays: [ 0 ],
            //defaultView: 'agendaWeek',
			defaultView: $(window).width() < 765 ? 'basicDay':'agendaWeek',
            minTime: '07:00:00',
            maxTime: '21:00:00',
            ignoreTimezone: false,
			aspectRatio: 1.6,
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
            columnFormat: {
                month: 'dddd',
                week: 'dddd',
                day: ''
            },
            axisFormat: 'H:mm',
            timeFormat: {
                // '': 'H:mm',
                //agenda: 'H:mm{ - H:mm}'
            },
            buttonText: {
                prev: "<<",
                next: ">>",
                prevYear: "&nbsp;&lt;&lt;&nbsp;",
                nextYear: "&nbsp;&gt;&gt;&nbsp;",
                today: "Hoje",
                month: "Mês",
                week: "Semana",
                day: "Dia"
            },
            events: events
        });
    });
</script>
<style type="text/css">
.fc-event {
	font-size:1.2em !important;
}
.fc-divider {
	display:none !important;
}

@media only screen and (max-width: 768px) {
  /* For mobile phones: */
	.fc-day-grid-event {
    	margin: 10px 1px 0;
    	padding: 0 1px;
	}
	.fc-day-grid-event .fc-content {
		padding: 1em;
		white-space: normal;
	}
	.fc-center h2 {
		margin: 0.22em 0;
		font-size: 1.4em;
	}

	.panel .panel-heading {
    	padding: 20px 25px;
	}
}
</style>