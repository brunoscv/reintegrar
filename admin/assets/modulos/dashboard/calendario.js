$(function() {
	$(document).ready(function() {
		$("body").on('click','.calendar .day_ext',function(event) {
			var day_listing = $(this).attr("id");
			//alert(day_listing);
			var html = $(this).html();
			
			$.ajax({
				url:  base_url + 'dashboard/get_consultas_calendario/' + day_listing,
				type: 'POST',
				context: this,
				dataType:"json",
				data: {id: day_listing},
				
				beforeSend:function(){
	            	//$("#consultas_abertas").html("<i class='fa fa-2x fa-spin fa-spinner align-center'></i>");
	            },
	            complete:function(data){
	            	//$(this).html("<i class='fa fa-check'></i>");
	              console.log(data);      
	            },
	            success: function (data) {
	        		$('#consultas_abertas').html("");
					var json_obj = data.listaItemConsulta; //parse JSON
	               
	                if(data.sucesso == true) {
			        	for (var i in json_obj) {
	                   		var template = $('#calendario-template').html();
		        			Mustache.parse(template); // optional, speeds up future uses
	                        var rendered = Mustache.render(template, json_obj[i]);
	                        $('#consultas_abertas').append(rendered);

	                    }
		          		toastr.success("Ação Completada com Sucesso");    
	                } else {
		               	toastr.error("Ação não pode ser executada");
	                }
				    console.log(json_obj[i]);    
	            }
			});
		});
	});
});