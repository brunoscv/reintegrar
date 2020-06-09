function loadSelecionados(name){

    selecionados = new Array();
    var inputs = $("input[name^="+name+"]");

    inputs.each(function(){
        selecionados.push($(this).val());
    });

    return selecionados;
    
};

(function($) {
	
	$("[data-modal]").each(function(){
		$(this).modal({
			show: false
		});
	})
	
	$("body").on("click","[data-dialog='smaster-many']", function(e) {
		e.preventDefault();
		var template  = $(this).data('template') ? $(this).data('template') : "<tr><td>{%label%}</td><td>{%button%}</td></tr>";
		var value = $(this).data('value');
		var label = $(this).data('label');
		var values = $(this).data('values');
		var update = "#"+$(this).data('update');
		
		var button = '<a href="javascript:;" class="the-action label label-important pull-right">'
						+'<i class="icon-white icon-trash"></i></a>'
						+'<input type="hidden" name="'+values+'[]" value="'+value+'" />';
		
		template = template.replace("{%label%}", label);
		template = template.replace("{%button%}", button);
		template = $(template);
		
		template.find("a.data-item").on('click',function(e){
			e.preventDefault();
			template.remove();
		});
		$(update).append( template );
		
		$(this).hide();
	});
	
	$("body").on("click","[data-dialog]", function(e) {
		e.preventDefault();
		
		var d 	 = new Date();
		var name = d.getTime();
		var root = this;
		
		var dialog = $(this).data('dialog') ? $(this).data('dialog') : "";
		var width  = $(this).data('width') ? $(this).data('width') : 550;
		var height = $(this).data('height') ? $(this).data('height') : 500;
		var title  = $(this).data('title') ? $(this).data('title') : "" ;
		var widget = $(this).data("widget") ? "#"+$(this).data("widget") : "#dialog"; //nome do elemento dialog;
		widget += name; //FIX para evitar conflito entre dialogs
		var params 	  = $(this).data("params") ? JSON.parse($(this).data("params").replace(/\'/g, '"')) : null; //nome do elemento dialog;
		var update 	  = $(this).data("update") ? "#"+$(this).data("update") : widget; //onde a requisicao vai atualizar;
		var fragment  = $(this).data("fragment") ? "#"+$(this).data("fragment") : ""; //de onde a requisicao vai atualizar;
		
		//many config
		var template  = $(this).data('template') ? $(this).data('template') : "<tr><td>{%label%}</td><td>{%button%}</td></tr>";
		//end many
		
		if( $(widget).length < 1 ){
			var divModal = $("<div>").addClass("modal fade").prop("role","dialog").attr("id",widget.replace("#",""));
			var div = $("<div>").addClass("modal-dialog modal-lg").html("<div class=\"modal-content\"><div class=\"modal-body\"></div></div>");
			div = divModal.append(div);
			$("body").append(div);
		}
		var modalContainer = ( $(widget).find(".modal-body").length > 0 ) ? $(widget).find(".modal-body") : $(widget) ;
		console.log(modalContainer);

		$(widget).modal({
			show: true,
			modal: true
		});
		$(widget).modal("show");
		
		var selected = loadSelecionados('supervisao');
		$.ajax({
			url:this.href,
			type:"get",
			data:params,
			beforeSend:function(){
				$(modalContainer).html("carregando...");
			},
			success:function(data){
				//data = $(data).find('data-container="all"');
				data = $(data);
				$(modalContainer).html(data);
				
				var formSearch =  $(data).find("[data-container='search']");
				var mainContainer =  $(data).find("[data-container='main']");
				mainContainer.on("update",function(){
					if( dialog == "one" ){
						$($(mainContainer).find("a[data-item]")).each(function(index, dom){
							if( $(dom).data("value") == $($(root).data("value")).val() ){
								$(dom).hide();	
							} else {
								$(dom).show();
							}
						});
					} else if( dialog == "many"){
						$($(mainContainer).find("a[data-item]")).each(function(index, dom){
							$(dom).show();
							var exists = $("input[name^="+$(root).data("value")+"][value='"+$(dom).data("value")+"']");
							if( exists.length > 0 ){
								$(dom).hide();
							}	
						});
					}
				});
				mainContainer.trigger('update');
				
				
				$(mainContainer).on('click','a[data-item]', function(e){
					e.preventDefault();
					if( dialog == "one" ){
						$($(root).data("label")).val(($(this).data('label')));
						$($(root).data("value")).val(($(this).data('value')));
						$(widget).modal("hide");
					}
					if( dialog == "many" ){
						
						var button = '<a href="javascript:;" data-remove class="label label-important pull-right">'
						+'<i class="icon-white icon-trash"></i></a>'
						+'<input type="hidden" name="'+$(root).data("value")+'[]" value="'+$(this).data("value")+'" />';
						 
						var templateHtml = template.replace("{%label%}", $(this).data('label'));
						templateHtml = templateHtml.replace("{%button%}", button);
						templateHtml = $(templateHtml);
						templateHtml.find("a[data-remove]").on('click',function(e){
							e.preventDefault();
							templateHtml.remove();
						});
						
						$(update).append( templateHtml );
						$(this).hide();
					}
					mainContainer.trigger('update');
				});
				
				$(mainContainer).on('click','a[data-close]', function(e){
					$(widget).modal("hide");	
				});
				
				$(mainContainer).on('click','a[href]', function(e){
					e.preventDefault();
					$.ajax({
						url:$(this).attr("href"),
						type:"get",
						data:$(this).attr("params"),
						beforeSend:function(){
							$(mainContainer).html('carregando...');
						},
						success:function(data){
							var dataTemp 	= data.replace(/script/gi, 'fixjavascript');
							$(dataTemp).find("fixjavascript").each(function(index, dom){
								 if (!$(this).attr('src')) {
								 	eval($(this).text());
								 } else {
									$.getScript($(this).attr('src')); 	
								 }
							});
							

							var content =  $(data).find("[data-container='main']").html();
							$(mainContainer).html( content );
							
							mainContainer.trigger('update');

						}
					});
				});
				
			
				$(mainContainer).on('submit','form', function(e){
					e.preventDefault();
					$.ajax({
						url:this.action,
						type:this.method,
						data:$(this).serialize() + "&submit=1",
						beforeSend:function(){
							$(mainContainer).html('carregando...');
						},
						success:function(data){
							var dataTemp 	= data.replace(/script/gi, 'fixjavascript');
							$(dataTemp).find("fixjavascript").each(function(index, dom){
								 if (!$(this).attr('src')) {
								 	eval($(this).text());
								 } else {
									$.getScript($(this).attr('src')); 	
								 }
							});
							
							if( dialog == "form" ){
								var content =  $(data).find(fragment).html();
								$(update).html( content );
								$(widget).modal('hide');
							} else {
								var content =  $(data).find("[data-container='main']").html();
								$(mainContainer).html( content );
							}
						}
					});
				});
				
				
				$(formSearch).on('submit','form',function(e){
					e.preventDefault();
					$.ajax({
						url:this.action,
						type:this.method,
						data:$(this).serialize(),
						beforeSend:function(){
							$(mainContainer).html('carregando...');
						},
						success:function(data){
							var dataTemp 	= data.replace(/script/gi, 'fixjavascript');
							$(dataTemp).find("fixjavascript").each(function(index, dom){
								 if (!$(this).attr('src')) {
								 	eval($(this).text());
								 } else {
									$.getScript($(this).attr('src')); 	
								 }
							});
							  
							var content =  $(data).find("[data-container='main']").html();
							$(mainContainer).html( content );
							
							mainContainer.trigger('update');
						}
					});
				});
				
				//$(widget).dialog("option", {"title": title});	
			}
		});
	});
	
	
	$("body").on("click",".the-dialog", function(e) {
		e.preventDefault();
		
		var width  = $(this).data('width') ? $(this).data('width') : 550;
		var height = $(this).data('height') ? $(this).data('height') : 500;
		var title  = $(this).data('title') ? $(this).data('title') : "" ;
		var widget = $(this).data("widget") ? "#"+$(this).data("widget") : "#dialog"; //nome do elemento dialog;
		var params = $(this).data("params") ? JSON.parse($(this).data("params").replace(/\'/g, '"')) : null; //nome do elemento dialog;
		var update = $(this).data("update") ? "#"+$(this).data("update") : widget; //onde a requisicao vai atualizar;
		
		autoajax = true;
		//alert($(this).data("autoajax"));
		var autoajax = $(this).data("autoajax") == false ? false : true; //onde a requisicao vai atualizar;
		// if( $(this).data("autoajax") != "" ){
			// alert($(this).data("autoajax"));
			// alert($(this).data("autoajax").toString());
// 			
		// }
		
		if( $(widget).length < 1 ){
			var div = $("<div>").attr("id","widget");
			$("body").append(div);
		}
		
		$(widget).dialog({
			autoOpen: true,
			modal: true,
			width: width,
			height: height
		});		 	
		
		$(widget).html("");
		$(widget).dialog("option", {"title": "Carregando...", "width":width, "height":height}).dialog("open");
		
		$.ajax({
			url:this.href,
			type:"get",
			dataType:"html",
			data:params,
			beforeSend:function(){
				$(widget).html("carregando...");
			},
			success:function(data){
				$(widget).html(data);
				
				if(autoajax === true){
					$("form",widget).bind('submit',function(e){
						e.preventDefault();
						if( $(this).valid() ){
							loader = new AjaxLoader(this);
							$.ajax({
								url:this.action,
								type:this.method,
								data:$(this).serialize() + "&submit=1",
								beforeSend:function(){
									loader.show();
								},
								success:function(data){
									loader.remove();
									if( update != widget ){
										$(widget).dialog('close');	
									}
									
									$(update).html(data);
								}
							});
							
						}
					});
				}
				
				$(widget).dialog("option", {"title": title});	
			},
			error:function(arguments,e){
               console.log(arguments);
               console.log("Ajax fail: "+ e);
			}
		});
	});
})(jQuery);