/**
 * Created by dimas on 15.11.2016.
 */

$('.month_select').on('change', function(){
    $('.countries-container').html('Загрузка....');
    $.ajax({
        type: 'get',
        url: '/adm/edit/relax/get-countries',
        data:{
            month: $(this).val(),
            type: $('.type_block.active').data('type')
        },
        dataType: 'json',
        success: function (data) {
            if (data.status == 'ok') {
                $('.countries-container').html(data.content);
            }
        }
    })
});

$('.type_block').on('click', function(){
    $('.countries-container').html('Загрузка....');
    $('.type_block').removeClass('active');
    $(this).addClass('active');
    $.ajax({
        type: 'get',
        url: '/adm/edit/relax/get-countries',
        data:{
            month: $('.month_select').val(),
            type: $('.type_block.active').data('type')
        },
        dataType: 'json',
        success: function (data) {
            if (data.status == 'ok') {
                $('.countries-container').html(data.content);
            }
        }
    })
});

$(document).on('submit', '.schedule_form', function (e) {
    e.preventDefault();
    $.ajax({
        type: 'post',
        url: '/adm/edit/relax/get-countries?' + $.param({month: $('.month_select').val(), type: $('.type_block.active').data('type')}),
        data:$(this).serialize(),
        dataType: 'json',
        success: function (data) {
            if (data.status == 'saved') {
                alert('Сохранено');
            }
        }
    })
});
$(document).ready(function(){
    $('.month_select').change();
});
