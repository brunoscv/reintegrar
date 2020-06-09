<div class="panel panel-default" data-container="search">
	<div class="panel-heading clearfix">
		<h4 class="panel-title"><i class="fa fa-picture-o"></i>Imagens da página principal</h4>
	</div>
	<div class="panel-body">
		<form class="form-inline" style="margin-top:10px;" action="<?php echo current_url(); ?>" method="post">
			<div class="form-action">
				<div class="col-sm-10 col-offset-2">
					<script src="<?php echo base_url(); ?>assets/uploader/SimpleAjaxUploader.min.js"></script>
					<style type='text/css'>
						.progress-bar-outer { border: 3px solid #01A7E0; border-radius: 4px; font-size: 0px; display: none;
							height: 32px; width: 100%; padding: 4px; box-sizing: border-box; margin: 20px 0; }
						.progress-bar { background-color: #01A7E0; height: 100%; width: 0%; border-radius: 2px; }
				        .progress-bar-inner { width: 100%; height: 100%;
				            background-image: url('<?php echo base_url(); ?>assets/uploader/loading-background.gif'); opacity: .25; }
						.container-uploaded-files { margin: 20px 0; font-size: 0px; padding: 0; }
						.container-uploaded-files .container-thumb { font-size: 0px; text-align: center; margin: 4px 0;
							width: 100%; margin-right: 2%; height: 100px; display: inline-block; padding: 0 4px; 
							line-height: 100px; overflow: hidden; position: relative; background-color: #ccc;
						}
						.container-uploaded-files .container-thumb.principal {
							background-color: #ade9ff;
						}
						.container-uploaded-files .container-thumb .img-thumb {
							max-height: 100%; max-width: 100%; display: inline; cursor: pointer;
						}
						.thumb-remove-btn { display: inline-block; position: absolute; right: 0px; top: 0px;
							font-size: 14px; width: 20px; height: 20px; line-height: 20px; text-align: center;
							color: #666; background-color: #ccc;
						}
						.thumb-remove-btn:hover { color: #666; }
					</style>
					<input type="submit" class="btn btn-secondary" id='selectFileBtn' value="Selecione os arquivos de imagem"/>
					<div class='progress-bar-outer'>
						<div class='progress-bar' id='progressBar'>
				            <div class='progress-bar-inner'></div>
				        </div>
					</div>
					<ul class='container-uploaded-files'>
						<?php $files_counter = 0; foreach($listaFotosHome as $item): ?>
							<li class="container-thumb<?php if ($item->principal) echo ' principal'; ?>">
								<a href="javascript:;" class="thumb-remove-btn" onclick="$(this).parent().remove();"><span class="fa fa-times"></span></a>
								<img class="img-thumb" onclick="select('<?php echo $item->arquivo ?>', $(this).parent())" src="<?php echo base_url() . 'uploads/' . $item->arquivo; ?>"/>
								<input type="hidden" name="imagens[<?php echo $files_counter++; ?>]" value="<?php echo $item->arquivo; ?>"/>
							</li>
						<?php endforeach; ?>
					</ul>
					<input id="principal" type="hidden" name="imagemPrincipal" value="">
				    <script type='text/javascript'>
				    	var files_counter = <?php echo $files_counter; ?>;
						function select(arquivo, container){
							document.getElementById('principal').value = arquivo;
							$('.container-thumb').removeClass('principal');
							$(container).addClass('principal');
						}
				    	$(function() {
				    		var uploader = new ss.SimpleUpload({
				    			button: $('#selectFileBtn')[0],
				    			url: '<?php echo base_url(); ?>assets/uploader/upload.php',
				    			name: 'myUpload',
				    			responseType: 'json',
				    			multiple: true,
				    			//maxSize: 1024,
				    			allowedExtensions: ['gif', 'png', 'jpeg', 'jpg'],
				    			accept: '.gif, .png, .jpeg, .jpg',
				    			onSubmit: function(filename, extension) {
				    				$('.progress-bar-outer').show();
				    				this.setAbortBtn($('#abortBtn')[0]);
				    				this.setProgressBar($('#progressBar')[0]);
				    			},
				    			onSizeError: function(filename, size) {
				    				alert('O selecionado arquivo é muito grande.');
				    			},
				    			onExtError: function(filename, extension) {
				    				alert('Escolha uma extensão válida.')
				    			},
				    			onAbort: function(filename) {
				    				$('.progress-bar-outer').hide();
				    				$('#progressBar').width(0);
				    			},
				    			onComplete: function(filename, response) {
				    				$('.container-uploaded-files').append('\
										<li class="container-thumb">\
											<a href="javascript:;" class="thumb-remove-btn" onclick="$(this).parent().remove();"><span class="fa fa-times"></span></a>\
											<img class="img-thumb" onclick="select(' + response.path + ', $(this).parent())" src="<?php echo base_url(); ?>uploads/temp/' + response.path + '"/>\
											<input type="hidden" name="imagens[' + (files_counter++) + ']" value="' + response.path + '"/>\
										</li>\
				    				');
									<?php if (!$files_counter) { $files_counter++; ?>
										select(response.path, $('.container-thumb')[0]);
									<?php } ?>
				    				$('.progress-bar-outer').hide();
				    				$('#progressBar').width(0);
				    			}
				    		});
				    	});
				    </script>
				</div>
			</div>
			<div class="form-actions">
				<div class="col-sm-10 col-offset-2">
					<input type="submit" name="enviar" class="btn btn-primary" value="Salvar" />
				</div>
			</div>
		</form>
	</div>
</div>