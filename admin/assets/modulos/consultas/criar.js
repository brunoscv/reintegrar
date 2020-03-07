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
					$("#profissionais_id").html(data).selectpicker('refresh');
					// $("#model_select").html(data).selectpicker('refresh');
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
					$("#planos_id").html(data).selectpicker('refresh');
				},
				error: function(data){
					toastr.error("Ação não pode ser executada"); 
				}
			});		
		});

	  	// $("#pacientes").selectpicker();
		// $("#especialidades_id").selectpicker();
		// $("#testes").selectpicker();
		
		//group add limit
		var maxGroup = 4;
    
		//add more fields group
		$(".adicionar_horario").click(function(){
			if($('body').find('.fieldGroup').length <= maxGroup){
				var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroup").html()+'</div>';
				$('body').find('.fieldGroup:last').after(fieldHTML);
			}else{
				toastr.error("Máximo "+maxGroup+" horários por consulta."); 
			}
		});
		
		//remove fields group
		$("body").on("click",".remover_horario",function(){
			if($('body').find('.fieldGroup').length <= 1){
				toastr.error("É preciso cadstrar pelo menos um horário de consulta."); 
			} else {
				$(this).parents(".fieldGroup").remove();
			}
		});

	});
});