    window.paceOptions = {
	    document: true, // disabled
	    eventLag: true,
	    restartOnPushState: true,
	    restartOnRequestAfter: true,
	    ajax: {
	        trackMethods: [ 'POST','GET']
	    }
	};
	// $(function(){
	// 	$(".select2").select2();
	// })

	function loadCidades(estado_id, element){
	$.ajax({
		url: base_url + 'rest/loadCidades',
		type:'GET',
		data:'estado_id='+estado_id,
		beforeSend:function(){
			$(element).select2("destroy");
			var option = $('<option>').text("Carregando...");
			$(element).html(option);
			//$(element).select2();
		},
		success:function(result){
			console.log(result);
			var options = jsonToOptions(result.data);
			//$(element).select2("destroy");
			$(element).html("");
			$(element).select2({
				data:result.data
			});
			//$(element).html(options);
			//$(element).select2();
		},
		error:function(){
			alert("Ocorreu um erro ao carregar as cidades");
		}
	});
	return false;
}

function jsonToOptions(json){
	var ul = $('<ul>');
	for(i in json){
		$(ul).append( $('<option>').text( json[i].text ).attr("value", json[i].id) );
	}
	return ul.html();
}

function preencheForm(data, form){
	form = $(form);
	for(name in data){
		$('[name='+name+']',form).val(data[name]);
	}
}

function calculaIdade(dataNascimento){
	var d = new Date,
        ano_atual = d.getFullYear(),
        mes_atual = d.getMonth() + 1,
        dia_atual = d.getDate();

        var dataN = dataNascimento.split("/");
        ano_aniversario = dataN[2],
        mes_aniversario = dataN[1],
        dia_aniversario = dataN[0],

        idade = ano_atual - ano_aniversario;

    if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
        idade--;
    }

    return idade < 0 ? 0 : idade;
}

jQuery.extend(jQuery.validator.messages, {
    required: "Este campo é obrigatório.",
    remote: "Please fix this field.",
    email: "Use um e-mail válido.",
    url: "Use uma URL válida.",
    date: "Use uma data válida.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Digite somente números.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Digite o mesmo valor.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Digite no máximo {0} caracteres."),
    minlength: jQuery.validator.format("Digite pelo menos {0} caracteres."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Digite um número entre {0} e {1}."),
    max: jQuery.validator.format("Utilize um número menor ou igual a {0}."),
    min: jQuery.validator.format("Utilize um número maior ou igual a {0}.")
});