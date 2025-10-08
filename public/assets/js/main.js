(function ($) {
    $(document).ready(function () {
        // code goes here
        $(".category-select-box select.category-select").niceSelect();

        // Background image area start here ***
        $("[data-background]").each(function () {
            $(this).css({
                "background-image":
                    "url(" + $(this).attr("data-background") + ")",
                "background-size": "cover",
                "background-position": "center center",
                "background-repeat": "no-repeat",
            });
        });

        // Background image area end here ***

        // home banner course slider start

        var swiper = new Swiper(".home-banner-slider", {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            spaceBetween: 30,
            speed: 800,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        // home banner course slider end

        // home popup video start
        $(".popup-youtube").magnificPopup({
            disableOn: 700,
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,

            fixedContentPos: false,
        });
        // home popup video ends

        // hsc slider start here
        var swiper = new Swiper(".hsc-slider", {
            autoHeight: true,
            slidesPerView: 1,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            spaceBetween: 20,
            speed: 800,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 3.3,
                },
            },
        });
        // hsc slider ends

        // skill tab slider start here

        var swiper = new Swiper(".skill-tab-slider", {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 4.1,
                },
                1200: {
                    slidesPerView: 4.3,
                },
                1366: {
                    slidesPerView: 5.1,
                },
                1440: {
                    slidesPerView: 5.3,
                },
            },
        });
        // skill tab slider ends

        // linked-course slider start here
        var swiper = new Swiper(".linked-course-slider", {
            autoHeight: true,
            slidesPerView: 1,
            spaceBetween: 20,
            speed: 800,
            loop: false,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 3.5,
                },
                1200: {
                    slidesPerView: 4,
                },
                1366: {
                    slidesPerView: 4.1,
                },
                1440: {
                    slidesPerView: 4.3,
                },
            },
        });
        // linked-course slider ends

        // linked-course slider start here
        var swiper = new Swiper(".job-preparation-slider", {
            autoHeight: true,
            slidesPerView: 1,
            spaceBetween: 20,
            speed: 800,
            loop: false,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
                1366: {
                    slidesPerView: 4,
                },
                1440: {
                    slidesPerView: 4,
                },
            },
        });
        // linked-course slider ends
    });
})(jQuery);
