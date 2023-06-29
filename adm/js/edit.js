$(document).on('click', '.edit_update_not_exit', function(e){
    let _this = $( this );
    let dataForm = $('form').serialize();
    let row_id = _this.attr('data-row-id');
    let table_id = _this.attr('data-table-id');
    let page = _this.attr('data-page');
    let parent_row = _this.attr('data-parent-row-id');
    let parent_table = _this.attr('data-parent-table-id');
    let is_row = _this.attr('data-is-row');


    if(page == 'create' || page == 'double'){
        row_id = row_id ? row_id : null;
    }

    $.ajax({
        type: 'POST',
        url: '/adm/edit/main/'+ page +'?id=' + row_id + '&table=' + table_id + '&parent_table=' + parent_table + '&parent_row=' + parent_row + '&is_row=' + is_row,
        dataType: 'json',
        data: dataForm,
        success: function(data){
            if(page == 'create' || page == 'double'){
                _this.attr('data-row-id', data.id);
            }  
        },
        complete: function(){
            toastr.success('Запись успешно сохранена');
        }
    });
});

$(document).on('click', '.edit_row_delete', function(e){
    e.preventDefault();
    e.stopPropagation();



    let _this = $( this );
    let test = confirm('Действительно хотите удалить запись?');
    let url = _this.attr('href');
    let len = _this.parents('table').find('tr').length;
 
    if(test){
        $.ajax({
            type: 'POST',
            url: url,
            success: function(data){
                if(len <= 3){
                    _this.parents('table').replaceWith(data); 
                    $('.summary').remove(); 
                }else{
                    _this.parents('tr').remove();
                }    

                if ($('.edit_row_linked').length == 1) {            
                    let table = $( '.edit_btn_group_add' ).attr('data-table');
                    let linked = $( '.edit_btn_group_add' ).attr('data-linked');
                    let row = $( '.edit_btn_group_add' ).attr('data-row');
            
                    addRow(table, linked, row, true);
                }else{
                    _this.parents('.edit_row_linked').remove();        
                }
                                   
            }
        });
    }
    
});

//добавление нового поля в связной таблице
$(document).on('click', '.edit_btn_group_add', function(e){
    let table = $( this ).attr('data-table');
    let linked = $( this ).attr('data-linked');
    let row = $( this ).attr('data-row');

    addRow(table, linked, row, false);
});

/**
 * last - если последняя строка, то подменяем фом=рму на пустую
 */
function addRow(table, linked, row, last) {
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/adm/edit/tools/add-row?table=' + table + '&linked=' + linked + '&row=' + row,
        success: function(data){
            if (last) {
                $('.edit_row_linked').replaceWith(data.content);
            } else {
                $('.row.edit_row').last().after(data.content);
            }
           
            $('#linkedform #dynamicmodel-' + data.field).val(row);
        }
    });    
}

//удаление картинки из галлереи
$(document).on('click', '.deleteImage', function(e){
    let str = $( this ).prev().prev().attr('name').slice(0,-2);
    let val = $( this ).prev().prev().val();

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/adm/edit/tools/delete-img-gallery',
        data: {
            str: str,
            val: val
        },
        success: function(data){
            
        }
    });
});
function deleteImage(_this){
    $(_this).parent().remove();
}

//удаление поля из связной таблицы
$(document).on('click', '.linked_content_delete', function(e){
    let count = $('.linked_content').length;
    
    if(count > 1){
        $( this ).parents('.edit_row').remove();
    }
});

$(document).on('submit', '#mainform', function(e){
    // e.stopPropagation();
    // e.preventDefault();
    let data = $('#linkedform').serialize();
    let row = $('.edit_btn_group_add').attr('data-row'); //id родительской записи
    let linked = $('.edit_btn_group_add').attr('data-linked'); //родительская таблица
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/adm/edit/tools/linked-save?row=' + row + '&linked=' + linked,
        data: data,
       
        success: function(data){
 
        }
       
      
    });
    return true;
});