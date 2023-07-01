var phone = $('html').width() < 900;
var iOS = navigator.userAgent.match(/iPhone|iPad|iPod/i);

if (phone || iOS) {
    $(document).on('click', '.portfolio_items .item', function (e) {
        e.preventDefault();
    });
    $(document).on('click', '.portfolio_items.grid .btn', function (e) {
        let url = $(this).parents('.item').attr('href');
        window.open(url, '_blank').focus();
    });
}