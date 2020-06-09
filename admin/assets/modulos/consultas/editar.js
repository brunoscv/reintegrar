$(function() {
	$(document).ready(function() {

		$("#especialidades_id").change(function(event) {
  			var especialidades_id = $("#especialidades_id").val();
			$.ajax({
				url:  base_url + 'consultas/buscar_profissionais/',
				type: "POST",
				data: { 
					especialidades_id: especialidades_id
				},
				success: function(data) {
					$("#profissionais_id").html(data);
				},
				error: function(data){
					toastr.error("Ação não pode ser executada");
				}
			});		
		});
		
	// 	$("#profissionais_id").change(function(event) {
	// 		var profissionais_id = $(this).val();
	// 	  $.ajax({
	// 		  url:  base_url + 'consultas/buscar_horarios_disponiveis/',
	// 		  type: "POST",
	// 		  data: { 
	// 			  profissionais_id: profissionais_id
	// 		  },
	// 		  success: function(data) {
	// 			  $('#horarios_abertos').html("");
	// 			  var json_obj = data.horarios_disponiveis; //parse JSON
	// 			  if(data.sucesso == true) {
	// 				for (var i in json_obj) {
	// 					var template = $('#horarios-template').html();
	// 					Mustache.parse(template); // optional, speeds up future uses
	// 					var rendered = Mustache.render(template, json_obj[i]);
	// 					$('#horarios_abertos').append(rendered);
	// 				}
	// 				toastr.success("Ação Completada com Sucesso"); 
	// 			} else {
	// 				toastr.error("Ação não pode ser executada");  
	// 			}
	// 		  },
	// 		  error: function(data){
	// 			toastr.error("Ação não pode ser executada"); 
	// 		  }
	// 	  });		
	//   });

		$("#especialidades_id").change(function(event) {
			var especialidades_id = $("#especialidades_id").val();
			$.ajax({
				url:  base_url + 'consultas/buscar_planos/',
				type: "POST",
				data: { 
					especialidades_id: especialidades_id
				},
				success: function(data) {
					$("#planos_id").html(data);
				},
				error: function(data){
					toastr.error("Ação não pode ser executada"); 
				}
			});		
        });

        var maxGroup = 4;
        $("body").on('click', '#adicionar_horario', function(){
            if($('body').find('.fieldGroup').length < maxGroup){
                var consultas_id = $(this).attr("consultas_id");
                var dia_semana_id = 0;
                var horarios_id = 0;
                $.ajax({
                    url:  base_url + 'consultas/set_horario_consulta_vazio/' + consultas_id + '/' + dia_semana_id + '/' + horarios_id + '/',
                    type: "POST",
                    data: { 
                        consultas_id: consultas_id,
                        dia_semana_id: dia_semana_id,
                        horarios_id: horarios_id
                    },
                    success: function(data) {
                        if(data.sucesso == true) {
                            var template = $('#horarios-template').html();
                            Mustache.parse(template); // optional, speeds up future uses
                                var rendered = Mustache.render(template, data);
                                $('#horarios').append(rendered);
                           
                            console.log(data);
                            toastr.success("Horário Adicionado com Sucesso"); 
                        } else {
							console.log(data);
                            toastr.error("O Horário não pôde ser adicionado");  
                        }
                    },
                    error: function(data){
						console.log(data);
                        toastr.error("O Horário não pôde ser adicionado"); 
                    }
                });
            } else{
                toastr.error("Máximo "+maxGroup+" horários por consulta."); 
            }		
        });
        
        $("body").on('click', '.remover_horario', function(){
            event.preventDefault();
            if($('body').find('.fieldGroup').length <= 1){
            toastr.error("É preciso manter pelo menos um horário de consulta."); 
            } else {
                var id = $(this).attr("id");
                alert(id);
                $.ajax({
                    url:  base_url + 'consultas/delete_horario/' + id + '/',
                    type: "POST",
                    context: this,
                    data: { 
                        id: id
                    },
                    success: function(data) {
                        if(data.sucesso == true) {
                            $(this).parents(".fieldGroup").remove();
                            toastr.success("Horário excluido com Sucesso"); 
                        } else {
                            toastr.error("O Horário não pôde ser excluido");  
                        }
                    },
                    error: function(data){
                        toastr.error("O Horário não pôde ser excluido"); 
                    }
                });	
            }	
		});

	  	// $("#pacientes").selectpicker();
		// $("#especialidades_id").selectpicker();
		// $("#testes").selectpicker();
		
		//group add limit
		//var maxGroup = 3;
		//add more fields group
		// $(".adicionar_horario").click(function(){
		// 	if($('body').find('.fieldGroup').length < maxGroup){
		// 		var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroup").html()+'</div>';
		// 		$('body').find('.fieldGroup:last').after(fieldHTML);
		// 	}else{
		// 		toastr.error("Máximo "+maxGroup+" horários por consulta."); 
		// 	}
		// });
		//remove fields group
		// $("body").on("click",".remover_horario",function(){
		// 	if($('body').find('.fieldGroup').length <= 1){
		// 		toastr.error("É preciso cadstrar pelo menos um horário de consulta."); 
		// 	} else {
		// 		$(this).parents(".fieldGroup").remove();
		// 	}
		// });

	});
});