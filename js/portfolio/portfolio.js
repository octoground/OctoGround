$(document).ready(function (e) {
    new Skroll()
        .add(".anim8", {
            animation: "fadeInRight",
            delay: 80,
            duration: 500,
            easing: "cubic-bezier(0.37, 0.27, 0.24, 1.26)"
        })
        .init();
});
$(document).on('click', '.portfolio_navigation li', function (e) {
    let type = $(this).attr('data-type');

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/site/portfolio-ajax?type=' + type,
        success: function (data) {

            $('.portfolio_items').html(data.template);

            new Skroll()
                .add(".anim8", {
                    animation: "fadeInRight",
                    delay: 80,
                    duration: 500,
                    triggerTop: 0.1,
                    easing: "cubic-bezier(0.37, 0.27, 0.24, 1.26)"
                })
                .init();
        }
    });
});


$(document).on('click', '.blog_header li', function(e){
    let _this = $(this);
    let type = _this.find('a').attr('data-type');
    
    
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/blog/filter?id=' + type,
        success: function(data){
            $('.blog_body').html(data.content);

            new Skroll()
                .add(".anim8", {
                    animation: "fadeInRight",
                    delay: 80,
                    duration: 500,
                    triggerTop: 0.1,
                    easing: "cubic-bezier(0.37, 0.27, 0.24, 1.26)"
                })
                .init();
        }
    });
});