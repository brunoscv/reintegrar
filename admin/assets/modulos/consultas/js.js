$(function() {
    $(document).ready(function() {
        $("body").on('click', '.mudarStatus', function(event){
            event.preventDefault();
            var consultas_id = $(this).attr("consultas_id"); 
            var status = $(this).attr("status"); 
            bootbox.dialog({
                message: "Tem certeza que deseja <b>MODIFICAR</b> essa consulta?",
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
                            $.ajax({
                                url:  base_url + 'consultas/mudar_status_consulta/' + consultas_id + '/' + status,
                                type: "POST",
                                dataType: 'json',
                                data: { 
                                    consultas_id: consultas_id,
                                    status: status,
                                },
                                success: function(data) {
                                    
                                    var json_obj = data.status; //parse JSON
                                    if(data.sucesso == true) {
                                        console.log(data.status.status);
                                       //window.location.href = "/clinica/consultas";
                                       window.location.href = "/sistema/consultas";
                                    }
                                },
                                complete: function(data) {
                                    toastr.success("Ação Completada com Sucesso");                                   
                                    console.log(data);
                                }
                            });	
                        }
                    },
                }
            });
        });
    })
});