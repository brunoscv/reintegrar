function loadAjax(url,result){
	 $.ajax({
	   type: 'get',
	   url: url,
	   beforeSend: function(){result.show("fast");result.html("<img src='img/loader.gif' />")},
	   success: function(msg){
		 result.html(msg);
	   }
	 });

	return false;
}

function ajaxForm(form,result){
	 $.ajax({
	   type: form.attr('method'),
	   url: form.attr('action'),
	   data: form.serialize(),
	   beforeSend: function(){result.show("fast");result.html("<img src='img/loader.gif' />")},
	   success: function(msg){
		 result.html(msg);
	   }
	 });

	return false;
}
