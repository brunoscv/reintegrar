//;
$(function() {
	$("#form_item_consulta").validate({
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
			id:{
					
			},
			horarios_id:{
				required:true	
			},
			dia_semana_id:{
				required:true	
			},
			status:{
					
			},
			periodo_consulta_id:{
					
			},
			consultas_id:{
					
			},
			createdAT:{
					
			},
			updatedAt:{
					
			}
		}
	});
}); 