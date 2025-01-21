$(function() {

    const firstView = function(scrolltop) {
        let windowHeight = 200;
        $('[data-disp="firstview"]').each(function() {
            if (scrolltop < windowHeight) {
                return $(this).addClass("is-firstview");
            } else {
                return $(this).removeClass("is-firstview");
            }
        });
    }

    const modal = function() {
        $('#modal').on("show.bs.modal", function(e) {
            console.log("modal");
            let link = $(e.relatedTarget);
            console.log(link.attr("data-modal-title"));
            $(this).find('#modal-title').text(link.attr("data-modal-title"));
            $(this).find('#modal-body').html('<img src="' + link.attr("data-modal-id") + '" class="img-fluid">');
            $(this).find('#modal-body').html(link.attr("data-modal-text"));
        });
    }

    const megaMenu = function(targetId) {
        const megamenu = '[data-megamenu]';
        const megamenuOpen = '[data-megamenu-open]';
        const isDisp = 'is-disp';
        $(targetId).find(megamenuOpen).on('mouseover', function() {
            $(targetId).find(megamenu).addClass(isDisp);
        });
        $(targetId).on('mouseleave', function() {
            $(targetId).find(megamenu).removeClass(isDisp);
        });
    }

    const animation = function(scrolltop) {
        $('[data-animation]').each(function() {
            let $this = $(this);
            let elemPos = $this.offset().top;
            let windowHeight = $(window).height();
            if (scrolltop > elemPos - windowHeight + 200 && scrolltop < elemPos + windowHeight + 200) {
                if ($this.data("animation") == "parent") {
                    $this.find('[data-animation="child"]').each(function() {
                        $(this).addClass('is-trans-active');
                    });
                } else {
                    $(this).addClass('is-trans-active');
                }
            }
        });
    }

    const home = function(scrolltop) {
        if ($('#category-home').length) {
            let count = 0;
            let windowHeight = $(window).height() / 2;
            $('[data-scrollpos]').each(function() {
                let offsetTop = $(this).offset().top;
                console.log(offsetTop);
                if (scrolltop < offsetTop - windowHeight) {
                    return false;
                }
                count += 1;
            });
            $('#gnav').find('.nav-item').removeClass('is-active');
            $('#gnav').find('.nav-item').eq(count).addClass('is-active');
        }
    }

    const print = function() {
        $('[data-print]').click(function() {
            return window.print();
        });
    }

    let target = $('[data-keyvisual]');
    target.imagesLoaded(function() {
        $('.keyvisual-cover').addClass('is-active');
    });

    let scrolltop = $(window).scrollTop();
    firstView(scrolltop);
    animation(scrolltop);
    megaMenu('#gnav-plan');
    modal();
    print();
    if ($('#category-home').length) {
        home(scrolltop);
    }

    let timer = false;
    $(window).scroll(function() {
        scrolltop = $(window).scrollTop();
        if (timer !== false) {
            clearTimeout(timer);
        }
        timer = setTimeout(function() {
            animation(scrolltop);
            firstView(scrolltop);
            if ($('#category-home').length) {
                home(scrolltop);
            }
        }, 200);
    });
});