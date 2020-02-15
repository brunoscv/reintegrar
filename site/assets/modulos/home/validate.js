//;
$(function() {
	$("#form_perfil").validate({
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
			descricao : {
				required : true
			},
			'menus[]': {
				required : true,
				minlength: 1
			}
		},
		messages: {
            'menus[]': {
                required: "Selecione pelo menos um menu",
                minlength: "Selecione pelo menos um menu"
            }
        }
	});
}); 