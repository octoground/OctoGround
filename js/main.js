autosize($('textarea'));
/**
 * cursor 
 */
const cursorBee = document.querySelector(".cursor-bee");
const cursorEye = document.querySelector(".cursor-eye");
let scale = 1;

function mousemoveHandler(e) {
    const target = e.target;
    const tl = gsap.timeline({
        defaults: {
            x: e.clientX,
            y: e.clientY,
            ease: "power2.out"
        }
    });


    if (target.closest(".cursor-hover")) {
        tl.to(
            cursorEye,
            {
                opacity: 1
            }
        );
    } else {
        tl.to(
            cursorEye, {
            opacity: 0,
        }
        );
    }
}

function mouseleaveHandler() {
    gsap.to(cursorEye, {
        opacity: 0
    });
}

if (!$('.cursor').hasClass('stop')) {
    document.addEventListener("mousemove", mousemoveHandler);
    document.addEventListener("mouseleave", mouseleaveHandler);
}


/**
 * end cursor
 */


/**
 *  Ловим label, если input не пустой
 */

$(document).on('blur', 'form .input', function (e) {
    let val = $(this).val();

    if (val.length > 0) {
        $(this).addClass('active');
    } else {
        $(this).removeClass('active');
    }
});
/**
 * 
 */

window.addEventListener('resize', resize);
// window.addEventListener('load', resize);

// function resize() {
//     let vh = document.querySelector('.main');
//     vh.innerHTML = vh.offsetHeight;

//     let perc = document.querySelector('.service');
//     perc.innerHTML = perc.offsetHeight
// }