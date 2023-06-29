function sendImg(form_data, url, _this) {
    $.ajax({
        type: 'POST',
        url: url,
        data: form_data,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {

            var dom =
                '<li class="gallery">'
                + '<input type="hidden" value="' + data.filename + '" name="' + $(_this).attr('data-table') + '[]"/>'
                + '<img class="imgMain" src="' + data.preview + '"/>'
                + '<div class="deleteImage" onclick="deleteImage(this); return false;">'
                + '<img src="/adm/images/delete_button.png" alt="">'
                + '</div>'
                + '</li>';

            $(_this).parent().before(dom);
        },
        error: function (data) {
            toastr.error(data.responseText);
        }
    });



}

function readURL(input) {
    if (input.files && input.files[0]) {
        var url = $(input).attr('data-upload-url');
        var form_data = new FormData();
        var file = input.files;



        $.each(file, function (i, v) {
            form_data.append('image_files', v);

            sendImg(form_data, url, input);
        });

    }
}


$(document).on('change', '.gallery-uploader', function (e) {
    readURL(this);
});