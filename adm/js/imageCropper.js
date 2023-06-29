$(document).on('change', '.table_list', function(){
    var _this = $(this);
    $.ajax({
        type: 'post',
        url: '/adm/install/cropper/get-columns-table',
        data:{
            table_id: _this.val()
        },
        dataType: 'json',
        success:function(data){
            $('.column_list').html(data);
        }
    })
});

$(document).on('change', '.cropper-uploader-image', function(e){

}, cropImage);

function cropImage (e) {
    var $image = $($(this).data('image-crop')),
        $inputImage = $(this),
        cropperModal = $($(this).data('cropper-modal')),
        cropperImagePreviewHolder = $($(this).data('image-preview')),
        saveButton = $($(this).data('save-image')),
        imageHolder = $($(this).data('preview')),
        imageLinkHolder = $($(this).data('link-input')),
        imageWidth = $inputImage.data('width'),
        imageHeight = $inputImage.data('height');

        
    if (window.FileReader) {
        var fileReader = new FileReader(),
            files = this.files;
        if (!files.length) {
            return;
        }

        file = files[0];
        if (/^image\/\w+$/.test(file.type)) {
            fileReader.readAsDataURL(file);
            fileReader.onload = function () {
                $inputImage.val("");
                $image.cropper("destroy");
                $image.attr('src', this.result);
                cropperModal.modal();
            };
        } else {
            alert("Выберите файл изображения.");
        }
    } else {
        $inputImage.addClass("hide");
    }
//});

    cropperModal.on('shown.bs.modal', function () {
        $($image).cropper({
            aspectRatio: imageWidth / imageHeight, //параметр передан из страницы image.php
            preview: cropperImagePreviewHolder,
            //multiple: true,
            zoomable: true,
            checkImageOrigin: false, // for cross-site image
            done: function (data) {
                // Output the result data for cropping image.
            }
        });
    }).on('hidden.bs.modal', function () {
        $image.cropper('destroy');
    });

    saveButton.on('click', function () {

        var data = $image.cropper("getData"),
            val = "";
        try {
            val = JSON.stringify(data);
        } catch (e) {
//            console.log(data);
        }
//        console.log(data);

        var crop_x = data.x;
        var crop_y = data.y;
        var crop_w = data.width;
        var crop_h = data.height;

        var fd = new FormData();

        var lastImage = imageHolder.attr('src');

        fd.append('width', imageWidth);
        fd.append('height', imageHeight);

        fd.append('crop_x', crop_x);
        fd.append('crop_y', crop_y);
        fd.append('crop_w', crop_w);
        fd.append('crop_h', crop_h);
        fd.append('image_path', $inputImage.data('path'));
        fd.append('new_image', 1);
        fd.append('image_file', file);

        saveButton.html('Сохранение <div class="three-dots"></div>');
        $.ajax({
            type: 'POST',
            url: $inputImage.data('upload-url'),
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (data) {
                imageLinkHolder.val(data.link);
                imageHolder.attr('src', data.image);

                $inputImage.next().find('.edit_image_load_field').html("<img id='image-holder-" + imageHolder + "' src='" +  data.image + "'>");
                //saveButton.button('reset')
                cropperModal.modal('hide');
                saveButton.html('Обрезать');
                saveButton.off('click');
            },
            error: function (data) {
                imageHolder.attr('src', lastImage);
                alert(data.responseText);
                saveButton.html('Обрезать');
            }
        });
    });
}
