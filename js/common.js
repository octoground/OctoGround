var $first_block_height = $('html').width() < 650 || $('.main.flex').height() < 500  ? 30 : $('.main').height();

$(document).ready(function (e) {
    if ($('.alert').hasClass('active')) {
        setTimeout(function () {
            $('.alert').css('bottom', '50px');
        }, 300);
        setTimeout(function () {
            $('.alert').css('bottom', '-300px');
        }, 5000);
    }
    if ($('html').width() < 650 && $(document).scrollTop() > 50) {
        $('.menu').addClass('scroll');
    }
});

$(document).on('click', '.side_btn_toggle, .side_sub', function (e) {
    $('.side').toggleClass('active');
    $('.side_sub').toggleClass('active');
});
/** 
 * hover на странице портфолио 
 */
$(document).on('mouseover', '.portfolio_items.grid  a', function(e){
    let height = $( this ).find('div > div').height() + 20;
    $( this ).find('img').css('height', 'calc(400px -  ' + height + 'px)');
}).on('mouseout', '.portfolio_items.grid  a', function () {
    $( this ).find('img').css('height', '400px');
});
/**
* форма "связаться с нами"
*/
const swiper = new Swiper('.swiper', {
    speed: 400,
    spaceBetween: 100,
    loop: true,
    scrollbar: {
        el: '.swiper-scrollbar',

    },
});
if ($('html').width() < 650) {
    $(document).on('click', '.connect', function (e) {
        setTimeout(function () {
            $.magnificPopup.open({
                removalDelay: 500, //delay removal by X to allow out-animation
                fixedContentPos: true,
                fixedBgPos: true,
                items: {
                    src: '#connect' //ID OF INLINE ELEMENT
                },
                mainClass: 'mfp-move-horizontal'
            });
        }, 400);
    });
} else {
    $('.connect').magnificPopup({
        removalDelay: 500, //delay removal by X to allow out-animation
        fixedContentPos: true,
        fixedBgPos: true,
        callbacks: {

            beforeOpen: function () {
                this.st.mainClass = this.st.el.attr('data-effect');
                $('#appform-type').val(this.st.el.attr('data-type'));
            }
        },
        midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
    });
}






/**
 * страница контакты
 */
const lerp = (a, b, n) => (1 - n) * a + n * b;

class Cursor {
    constructor() {
        // config
        this.target = { x: 0.5, y: 0.5 }; // mouse position
        this.cursor = { x: 0.5, y: 0.5 }; // cursor position
        this.speed = 0.2;
        this.init();
    }
    bindAll() {
        ["onMouseMove", "render"].forEach((fn) => (this[fn] = this[fn].bind(this)));
    }
    onMouseMove(e) {
        //get normalized mouse coordinates [0, 1]
        this.target.x = e.clientX / window.innerWidth;
        this.target.y = e.clientY / window.innerHeight;
        // trigger loop if no loop is active
        if (!this.raf) this.raf = requestAnimationFrame(this.render);
    }
    render() {
        //calculate lerped values
        this.cursor.x = lerp(this.cursor.x, this.target.x, this.speed);
        this.cursor.y = lerp(this.cursor.y, this.target.y, this.speed);
        document.documentElement.style.setProperty("--cursor-x", this.cursor.x);
        document.documentElement.style.setProperty("--cursor-y", this.cursor.y);
        //cancel loop if mouse stops moving
        const delta = Math.sqrt(
            Math.pow(this.target.x - this.cursor.x, 2) +
            Math.pow(this.target.y - this.cursor.y, 2)
        );
        if (delta < 0.001) {
            cancelAnimationFrame(this.raf);
            this.raf = null;
            return;
        }
        //or continue looping if mouse is moving
        this.raf = requestAnimationFrame(this.render);
    }
    init() {
        this.bindAll();
        window.addEventListener("mousemove", this.onMouseMove);
        this.raf = requestAnimationFrame(this.render);
    }
}

new Cursor();

$(document).on('click', '.teem_info', function (e) {
    $('.teem_info').removeClass('active');
    $('#cursor').css('opacity', '0');
});

$(document).on('click', '.anchor', function (e) {
    let el = $(this).attr('href');

    $('html,body').stop().animate({ scrollTop: $(el).offset().top - 10 }, 1000);
    e.preventDefault();
});
$(document).on('click', '.teem_member', function (e) {
    let _this = $(this);
    let id = _this.attr('data-user-id');
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: {
            'id': id
        },
        url: '/site/about',
        success: function (data) {
            $('.teem_info > div').eq(0).html(data.content);
        }
    });
    $('.teem_info').addClass('active');
    $('#cursor').css('opacity', '1');
    setTimeout(() => {
        $('.teem_info .left').addClass('active');
        new Skroll()
            .add(".el", {
                delay: 250,
                duration: 500,
                wait: 500,
                animation: "fadeInUp",
            })
            .init();
    }, 200);
});




/**
 * 
 * menu
 */
window.onscroll = function (ev) {
    if ($('.menu').hasClass('stop')) {
        return false;
    }
    if (window.scrollY > $first_block_height) {
        $('.menu').addClass('scroll');
    }
    else {
        $('.menu').removeClass('scroll');
    }
};


