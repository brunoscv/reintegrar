$(function () {
    var files = $('#files');
    var url = '//jquery-file-upload.appspot.com/';

    $(document).bind('dragover', function (e) {
        var dropZone = $('#dropzone'),
            timeout = window.dropZoneTimeout;
        if (timeout) {
            clearTimeout(timeout);
        } else {
            dropZone.addClass('in');
        }
        var hoveredDropZone = $(e.target).closest(dropZone);
        dropZone.toggleClass('hover', hoveredDropZone.length);
        window.dropZoneTimeout = setTimeout(function () {
            window.dropZoneTimeout = null;
            dropZone.removeClass('in hover');
        }, 100);
    });

    $('#file_upload').fileupload({
        url: url,
        dropZone: '#dropZone',
        dataType: 'json',
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf)$/i,
        maxFileSize: 999000,
        autoUpload: false,
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true,
        singleFileUploads: false,
        parallelUploads: true
    }).on('fileuploadadd', function (e, data) {
            data.context = $('<div/>').appendTo('#files');
            $.each(data.files, function (index, file) {
                $('#error').html("");
                var template = $('#upload-file-template').html();
                Mustache.parse(template); // optional, speeds up future uses
                var rendered = Mustache.render(template, file);
                $('table .files').append(rendered);

                data.submit();
                console.log(file);
            });
            
            
        }).on('fileuploadprogressall', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
            $('#progress .progress-bar .progress_value').html(progress + '%');

            console.log(data);
            
        
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        }); 
    });
    
    
    var atual_fs, next_fs, prev_fs;
    //Método para pular etapas do formulário de cadastro
    $(".next").click(function(event) {
        atual_fs = $(this).parent().parent().parent();
        next_fs = $(this).parent().parent().parent().next();
        
        $("#progress_form li").eq($("fieldset").index(next_fs)).addClass('ativo');
        atual_fs.hide();
        next_fs.show();
        
    });
    
    $(".prev").click(function(event) {
        atual_fs = $(this).parent().parent().parent();
        prev_fs = $(this).parent().parent().parent().prev();
        
        $("#progress_form li").eq($("fieldset").index(atual_fs)).removeClass('ativo');
        atual_fs.hide();
        prev_fs.show();
        
    });
    
    $("#ambientes").selectpicker();
});