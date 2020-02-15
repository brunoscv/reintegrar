//;
$(function() {
	$("#form_<?php echo $modulo; ?>").validate({
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
			<?php 
				for($i=0; $i<count($camposForm); $i++):
				$campo = $camposForm[$i];
				$campo['validacao'] = explode("|",$campo['validacao']);
			?>
			<?php echo $campo['name']; ?>:{
				<?php for($j=0;$j<count($campo['validacao']);$j++): $validacao = $campo['validacao'][$j]; ?>
				<?php
					if( $validacao == "required" ){
						echo "required:true";
						echo ($j == count($campo['validacao'])-1) ? "" : ",";
					} elseif( $validacao == "cnpj_valid" ){
						echo "cnpj:true";
						echo ($j == count($campo['validacao'])-1) ? "" : ",";
					} elseif( $validacao == "cpf_valid" ){
						echo "cpf:true";
						echo ($j == count($campo['validacao'])-1) ? "" : ",";
					} elseif( $validacao == "email_valid" ){
						echo "email:true";
						echo ($j == count($campo['validacao'])-1) ? "" : ",";
					} elseif( $validacao == "date_valid" ){
						echo "date:true";
						echo ($j == count($campo['validacao'])-1) ? "" : ",";
					} elseif( $validacao == "datetime_valid" ){
						echo "datetime:true";
						echo ($j == count($campo['validacao'])-1) ? "" : ",";
					} elseif( preg_match("/min_length\[([0-9]+)\]/i", $validacao, $m) ){
						echo "min_length: ".$m[1];
						echo ($j == count($campo['validacao'])-1) ? "" : ",";
					} elseif( preg_match("/max_length\[([0-9]+)\]/i", $validacao, $m) ){
						echo "max_length: ".$m[1];
						echo ($j == count($campo['validacao'])-1) ? "" : ",";
					}
				?>	
			<?php endfor;?>
			}<?php echo ($i == count($camposForm)-1) ? "" : ","?>

		<?php endfor; ?>
		}
	});
}); 