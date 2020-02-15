
$(function() {
    $(document).ready(function(e) {

        function formatar_data(data) {
            if(data.length == 10) {
                return (data.substr(6,4) + '-' + data.substr(3,2) + '-' + data.substr(0,2));
            } else if(data.length == 16) {
                return (data.substr(6,4) + '-' + data.substr(3,2) + '-' + data.substr(0,2) + ' ' + data.substr(11,2) + ':' + data.substr(14,2));
            }
        }

        $("body").on('click', '.mudarPresenca', function(event){
            event.preventDefault();
            var sessoes_id = $(this).attr("sessoes_id"); 
            var presenca = $(this).attr("presenca"); 
            var consultas_id = $(this).attr("consultas_id"); 
            var atendimentos_id = $(this).attr("atendimentos_id");
            var data_atendimento = formatar_data($('#data_atendimento_' + sessoes_id).val());
          
            bootbox.dialog({
                message: "Tem certeza que deseja <b>MODIFICAR</b> esse atendimento?",
                size: 'small',
                buttons: {
                    cancel: {
                        label: 'Não',
                        className: 'btn-danger',
                        callback: function(){
                            console.log('Custom cancel clicked');
                        }
                    },
                    confirm: {
                        label: 'Sim',
                        className: 'btn-success',
                        callback: function(){
                            if($('#data_atendimento_' + sessoes_id).val() == 0) {
                                $('#data_atendimento_'+ sessoes_id).addClass("focus-danger");
                                 $('#mensagem_'+ sessoes_id).html("O campo não pode ser vazio!");
                            } else {
                                $.ajax({
                                    url:  base_url + 'consultas/mudar_presenca_consulta/' + sessoes_id + '/' + presenca + '/' + data_atendimento,
                                    type: "POST",
                                    dataType: 'json',
                                    context: this,
                                    data: { 
                                        sessoes_id: sessoes_id,
                                        presenca: presenca,
                                        data_atendimento: data_atendimento,
                                    },
                                    beforeSend: function() {
                                    },
                                    success: function(data) {
                                        
                                        var json_obj = data.presenca; //parse JSON
                                        if(data.sucesso == true) {
                                            //console.log(data.presenca.presenca);
                                        window.location.href = "/sistema/admin/consultas/sessoes/" + consultas_id + '/' + atendimentos_id;
                                        //window.location.href = "/saudecasa/admin/consultas/sessoes/" + consultas_id + '/' + atendimentos_id;
                                        }
                                    },
                                    complete: function(data) {
                                        toastr.success("Ação Completada com Sucesso");                                   
                                        console.log(data);
                                    }
                                });	
                            }
                           
                        }
                    },
                }
            });
        });
    });
});