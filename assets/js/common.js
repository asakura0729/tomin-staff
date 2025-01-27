$(function () {

    const firstView = function (scrolltop) {
        let windowHeight = 200;
        $('[data-disp="firstview"]').each(function () {
            if (scrolltop < windowHeight) {
                return $(this).addClass("is-firstview");
            } else {
                return $(this).removeClass("is-firstview");
            }
        });
    }

    const animation = function (scrolltop) {
        $('[data-animation]').each(function () {
            let $this = $(this);
            let elemPos = $this.offset().top;
            let windowHeight = $(window).height();
            if (scrolltop > elemPos - windowHeight + 200 && scrolltop < elemPos + windowHeight + 200) {
                if ($this.data("animation") == "parent") {
                    $this.find('[data-animation="child"]').each(function () {
                        $(this).addClass('is-trans-active');
                    });
                } else {
                    $(this).addClass('is-trans-active');
                }
            }
        });
    }

    const print = function () {
        $('[data-print]').click(function () {
            return window.print();
        });
    }

    let scrolltop = $(window).scrollTop();
    firstView(scrolltop);
    animation(scrolltop);
    print();

    let timer = false;
    $(window).scroll(function () {
        scrolltop = $(window).scrollTop();
        if (timer !== false) {
            clearTimeout(timer);
        }
        timer = setTimeout(function () {
            animation(scrolltop);
            firstView(scrolltop);
        }, 200);
    });
});