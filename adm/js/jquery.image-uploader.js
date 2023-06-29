function readURL1(input) {
    if (input.files && input.files[0]) {
        var url = $(input).attr('data-upload-url');
        var form_data = new FormData();
        var file = input.files[0];
    

        console.log('dadasdasdasd');
        form_data.append('image_files', file);
        $.ajax({
            type: 'POST',
            url: url,
            data: form_data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (data) {  
                $(input).next().find('.edit_image_load_field').html('<img src="' + data.preview + '" alt="" class="blah"></img>'); 
                $(input).prev().find('input').val(data.filename); 
            },
            error: function (data) {
                toastr.error(data.responseText);
            }
        });
    }
}

$(document).on('change', '.imgInp', function(e){
    
    readURL1(this);
});