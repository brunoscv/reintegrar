$(function() {
    $(document).ready(function() {
        var calendar = $('#calendario').fullCalendar({
            allDay: false,
            hiddenDays: [ 0 ],
            // defaultView: 'agendaWeek',
            minTime: '08:00:00',
            maxTime: '21:00:00',
            ignoreTimezone: false,
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
            columnFormat: {
                month: 'dddd',
                week: 'dddd',
                day: ''
            },
            axisFormat: 'H:mm',
            timeFormat: {
                '': 'H:mm',
                agenda: 'H:mm{ - H:mm}'
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
            // events:
            //     {
            //         url:  base_url + 'calendarios/get_consultas/' + 1,
            //         dataType: 'json',
            //         type: 'POST',
            //         data: { 
            //             // profissionais_id: profissionais_id
            //         },
            //         success: function(data) {
            //             console.log(data);
            //         },
            //         error: function(data){
            //             toastr.error("Ação não pode ser executada"); 
            //         }
            //     }

                eventSources: [
                    {
                        events: function(callback) {
                            $.ajax({
                                url:  base_url + 'calendarios/get_consultas/' + 1,
                            dataType: 'json',
                            data: {
                            // our hypothetical feed requires UNIX timestamps
                            //start: start.unix(),
                            //end: end.unix()
                            },
                            success: function(data) {
                                var events = data;
                                 for(var i in data) {
                                     console.log(events[i]);

                                 }
                            }
                            });
                        },
                        color: 'yellow',   // an option!
                        textColor: 'black' // an option!
                    },
                ]
        });
    })
});