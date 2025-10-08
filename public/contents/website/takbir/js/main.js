(function ($) {
"use strict";


    $('.slider-active').owlCarousel({
        loop: true,
        nav: true,
        autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
    $('.slider-logo').owlCarousel({
        loop: true,
        nav: true,
        autoplay:true,
    autoplayTimeout:1000,
    autoplayHoverPause:true,
        navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 5
            },
            1000: {
                items: 5
            }
        }
    })



})(jQuery);	