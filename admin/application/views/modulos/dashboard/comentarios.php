
<!-- Cards Header -->
<style type="text/css">
.table th, .table td {
    padding: 0.2em 0;
    vertical-align: middle;
}
.table-responsive {
    /* display: block; */
    overflow-x: hidden;
    /* width: 100%; */
    -webkit-overflow-scrolling: touch;
}
.timeline-one-side .timeline-content {
    max-width: 100%;
}
.ql-container.ql-snow {
    border: none;
}

.ql-toolbar.ql-snow {
    border: 1px solid #dee2e6;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    padding: 8px;
}
</style>
<div class="header bg-gradient-template pb-6">
	<div class="container-fluid">
		<div class="header-body">
			<div class="row align-items-center py-4">
				<div class="col-lg-6 col-7">
					<nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
						<ol class="breadcrumb breadcrumb-links breadcrumb-dark"><!-- 
							<li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li> -->
							<li class="breadcrumb-item"><a href="<?= base_url().'dashboard'?>"><i class="fas fa-home"></i> Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Anotações de Consultas</li>
						</ol>
					</nav>
				</div>
				<!-- <div class="col-lg-6 col-5 text-right">
					<a href="#" class="btn btn-sm btn-neutral">New</a>
					<a href="#" class="btn btn-sm btn-neutral">Filters</a>
				</div> -->
			</div>
		</div>
	</div>
</div>
<!-- Cards Header -->
 <!-- Page content -->
 <div class="container-fluid mt--6">
     
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Comentários da Consulta #922</h3>
                </div>
                <div class="card-body" style="overflow-y: scroll; height: 25em;">
                    <div id="comentarios_mustache" class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                        <?php foreach ($listaComentarios as $item) { ?>
                            <div class="timeline-block">
                                <span class="timeline-step badge-success">
                                    <i class="ni ni-bell-55"></i>
                                </span>
                                <div class="timeline-content">
                                    <small class="text-muted font-weight-bold"><?= "Publicado em: " . $item->data_comentario . ""; ?></small>
                                    <h5 class=" mt-3 mb-0"><?= $item->nome ?></h5>
                                    <p class=" text-sm mt-1 mb-0"><?= $item->comentario; ?></p>
                                    <div class="mt-3">
                                        <span class="badge badge-pill badge-success">Entregue</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
		   </div>
		</div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Comentários da Consulta #922</h3>
                </div>
                <div class="card-body">
                    <form id="form_comentarios">
                        <div class="form-group">
                            <input name="comentario" type="hidden" required>
                            <div id="input-comentario"></div>
                        </div>
                        <div class="form-actions">
                            <div class="col-sm-12">
                                <button type="submit" id="btn_comentar" class="btn btn-success" consulta_id="<?= $consulta_id ?>" style="float:right">Enviar Comentário</button>
                                <a href="<?php echo site_url("dashboard"); ?>" class="btn mr-1" style="float:right">
                                    Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
		   </div>
		</div>
	</div>

<!-- Script Template Mustache -->
<script id="comentarios-template" type="x-tmpl-mustache">
    <div class="timeline-block">
        <span class="timeline-step badge-success">
            <i class="ni ni-bell-55"></i>
        </span>
        <div class="timeline-content">
            <small class="text-muted font-weight-bold">Publicado em: {{data_comentario}}</small>
            <h5 class=" mt-3 mb-0">{{nome}}</h5>
            <p class=" text-sm mt-1 mb-0">{{{comentario}}}</p>
            <div class="mt-3">
                <span class="badge badge-pill badge-success">Entregue</span>
            </div>
        </div>
    </div>
</script>
<!-- Script Template Mustache -->
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/modulos/dashboard/js.js"></script> -->
<script>
    var base_url = "<?= base_url(); ?>";
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block']
    ];
    var quill = new Quill('#input-comentario', {
        modules: {
        toolbar: toolbarOptions
        },
        theme: 'snow',
    });

	$(document).ready(function() {

        $("#form_comentarios").on('submit', function(e) {
            e.preventDefault();
            var form = $("#form_comentarios");
            var consulta_id = $("#btn_comentar").attr("consulta_id");
            var about = document.querySelector('input[name=comentario]');
            about.value = quill.root.innerHTML.trim();

           /*  console.log(about.value);
            console.log(consulta_id); */
            $.ajax({
                url:  base_url + 'dashboard/salvar_comentarios/' + consulta_id,
                type: 'post',
                // context: this,
                dataType: "json",
                data: form.serialize(),
                beforeSend:function(){
                    $('#btn_comentar').html("<span style='padding:.625rem 1.25rem'>Enviar Comentário <i class='fas fa-circle-notch fa-spin'></i></span>"); 
                },
                success: function (res) {
                    console.log(res);
                    $('#btn_comentar').html("Enviar Comentário");
                    var element = document.getElementsByClassName("ql-editor");
                    element[0].innerHTML = "";
                    $("#comentarios_mustache").html("");
                    
                    var json_obj = res.listaComentarios; //parse JSON
                    for (var i in json_obj) { 
                        var template = $('#comentarios-template').html();
                        //Mustache.parse(template); // optional, speeds up future uses
                        var rendered = Mustache.render(template, json_obj[i]);
                        $('#comentarios_mustache').append(rendered);
                    }
                    toastr.success("Comentário enviado com sucesso!"); 
                }
            });
        });
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });
</script>