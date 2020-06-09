function valid_name(name){
    var pat = /\b([a-df-z]|jr)\b/gi;
    var res = name.match(pat);
    return res == null;
}

function valid_datetime(dt){
    var isValidDate = false;
    var arr1 = dt.split('/');
    var year=0;var month=0;var day=0;var hour=0;var minute=0;var sec=0;
    
    if(dt.length == 0)
        return true;

    if(arr1.length == 3)
    {
        var arr2 = arr1[2].split(' ');
        if(arr2.length == 2)
        {
            var arr3 = arr2[1].split(':');
            try{
                year = parseInt(arr2[0],10);
                month = parseInt(arr1[1],10);
                day = parseInt(arr1[0],10);
                hour = parseInt(arr3[0],10);
                minute = parseInt(arr3[1],10);
                sec = parseInt(arr3[2],10);
                //sec = 0;
                var isValidTime=false;
                if(hour >=0 && hour <=23 && minute >=0 && minute<=59 && sec >=0 && sec<=59)
                    isValidTime=true;
                else if(hour ==24 && minute ==0 && sec==0)
                    isValidTime=true;

                if(isValidTime)
                {
                    var isLeapYear = false;
                    if(year % 4 == 0)
                         isLeapYear = true;

                    if((month==4 || month==6|| month==9|| month==11) && (day>=0 && day <= 30))
                            isValidDate=true;
                    else if((month!=2) && (day>=0 && day <= 31))
                            isValidDate=true;

                    if(!isValidDate){
                        if(isLeapYear)
                        {
                            if(month==2 && (day>=0 && day <= 29))
                                isValidDate=true;
                        }
                        else
                        {
                            if(month==2 && (day>=0 && day <= 28))
                                isValidDate=true;
                        }
                    }
                }
            }
            catch(er){isValidDate = false;}
        }

    }
    return isValidDate;
}

function valid_cpf(cpfBruto){
    var numeros, digitos, soma, i, resultado, digitos_iguais, cpf;
    cpf = cpfBruto.replace("-","");
    cpf = cpf.replace(".","");
    cpf = cpf.replace(".","");
    digitos_iguais = 1;
    if (cpf.length == 0)
        return true;
    if (cpf.length < 11 && cpf.length > 0)
        return false;
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1)){
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais){
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
            soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;
        return true;
    }
    else
        return false;
}

function valid_cnpj(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g,'');

    if(cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // LINHA 10 - Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false; // LINHA 21

    // Valida DVs LINHA 23 -
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false; // LINHA 49

    return true; // LINHA 51
}

function valid_date(data) {

    if(!data) return true;

    //alert(data);
    var ExpReg=new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
    if (data.search(ExpReg)==-1){
        return false;
    }else{
        var data_array = data.split('/');
        var day = data_array[0];
        var month = data_array[1];
        var year = data_array[2];

        var date = new Date();
        var blnRet = false;
        var blnDay;
        var blnMonth;
        var blnYear;

        date.setFullYear(year, month -1, day);

        blnDay   = (date.getDate()      == day);
        blnMonth = (date.getMonth()     == month -1);
        blnYear  = (date.getFullYear()  == year);

        if (blnDay && blnMonth && blnYear)
            blnRet = true;

        return blnRet;
    }
}

jQuery.validator.addMethod( "proibe_abreviado", valid_name, "Não utilize nomes abreviados" );
jQuery.validator.addMethod( "date", valid_date, "Use uma data valida" );
jQuery.validator.addMethod( "datetime", valid_datetime, "Use uma data e hora valida" );	
jQuery.validator.addMethod( "cpf", valid_cpf, "Use um cpf valido" );
jQuery.validator.addMethod( "cnpj", valid_cnpj, "Use um cnpj valido" );