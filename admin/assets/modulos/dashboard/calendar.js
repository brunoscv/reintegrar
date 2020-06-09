$(function() {
	$(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev',
                center: 'title',
                right: 'next,month,agendaDay'
            },
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
                    'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],         
            buttonText: {
                today:    'Hoje',
                month:    'Mês',
                week:     'Semana',
                day:      'Dia'
            },
            navLinks: true, // can click day/week names to navigate views
            eventColor: "#0A212C",
            eventSources: [
                // your event source
                {
                  url: 'dashboard/eventos',
                  type: 'POST',
                  data: {
                    custom_param1: 'something',
                    custom_param2: 'somethingelse'
                  },
                  error: function() {
                    alert('there was an error while fetching events!');
                  },
                  color: 'yellow',   // a non-ajax option
                  textColor: 'black' // a non-ajax option
                }

                // any other sources...

              ]

       });
    });       
});