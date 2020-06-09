$.post('<?php echo base_url();?>',
            function(data) {
                //alert(data);
            $('#calendar').fullCalendar({
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
                header: {
                    left: 'prev',
                    center: 'title',
                    right: 'next,month,agendaDay'
                },
                defaultDate: '2018-03-12',
                weekNumberTitle: 'S',
                editable: true,
                navLinks: true, // can click day/week names to navigate views
                eventLimit: true, // allow "more" link when too many events
                eventColor: "#0A212C",
                viewRender: function(){
                    $('#preloader').hide();
                },
                dayClick: function(date){
                        //...
                },
                events: data
            });
        });
    });