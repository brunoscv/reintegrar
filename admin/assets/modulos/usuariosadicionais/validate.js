//;
$(function() {
	$("#form_usuario").validate({
		ignore : [],
		errorElement : "em",
		onfocusout : function(element) {
			if ((!this.check(element) || !this.checkable(element) ) && (element.name in this.submitted || !this.optional(element))) {
				var currentObj = this;
				var currentElement = element;
				var delay = function() {
					currentObj.element(currentElement);
				};
				setTimeout(delay, 0);
			}
		},
		invalidHandler : function(form, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				validator.errorList[0].element.focus();
				var aba = $(validator.errorList[0].element).parents('div.tab-pane').attr('id');
				$("[href='#" + aba + "']").click();
			}
			return false;
		},
		rules : {
			nome : {
				required : true
			},
			clientes_id : {
				required: true
			},
			email : {
				email : true
			},
			usuario : {
				required : true,
				remote : {
					url : base_url + "usuarios/usuarioExiste",
					data:{id:$("#id").val()}
				}
			},
			senha : {
				required : true,
				minlength : 6
			},
			senha2 : {
				required : true,
				equalTo : '#senha'
			},
			"perfis[]":{
				required : true,
				min_length: 1,
			}
		},
		messages : {
			usuario:{
				remote: "Usuário já cadastrado"
			}
		}
	});
}); 