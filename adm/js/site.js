$(window).bind('load', function(){
    setTimeout( () => {
        $('.loader').fadeOut('slow');
    }, 1000);
    
    if(localStorage.menu == 1 || localStorage.menu == undefined){
        $('body').addClass('active');
    }else{
        $('body').removeClass('active');
    }
});
$(document).ready(function(e){
    $('.hide_row_js').parents('.row').remove();

    $('.popup-open').magnificPopup({
        type: 'inline'
    });
});

$(document).on('click', '.menu > div', function(e){
    if(localStorage.menu == 1 || localStorage.menu == undefined){
        localStorage.setItem('menu', 0);
    }else{
        localStorage.setItem('menu', 1);
    }
    // delete localStorage.menu;
    // console.log(localStorage.menu == undefined);
    $('body').toggleClass('active');
});

$(document).on('click', '.sub', function(e){
    $( this ).find('ul').slideToggle('slow');
});

$(document).on('click', '.cart_setting_style_item', function(e){
    $('.cart_setting_style_item').removeClass('active');
    $( this ).addClass('active');
});
