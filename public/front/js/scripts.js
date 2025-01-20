(function ($) {
    "use strict";

    // Sticky Menu
    function stickMenu() {
        if ($.isFunction($.fn.scrollToFixed)) {
            $(".stick").scrollToFixed({
                preFixed: function () {
                    $(".menu-top")
                        .css({
                            overflow: "hidden",
                        })
                        .animate(
                            {
                                height: 83,
                            },
                            400
                        );
                },
                postFixed: function () {
                    $(".menu-top").animate(
                        {
                            height: 0,
                        },
                        400,
                        function () {
                            $(this).css("overflow", "hidden");
                        }
                    );
                },
            });
        }
    }

    // Mobile Menu
    function mobileMenu() {
        $(".menu-toggle-icon").on("click", function () {
            $(this).toggleClass("act");
            $(".mobi-menu").toggleClass("act", $(this).hasClass("act"));
        });

        $(".mobi-menu .menu-item-has-children").append(
            '<span class="sub-menu-toggle"></span>'
        );

        $(document).on("click", ".sub-menu-toggle", function () {
            $(this).parent("li").toggleClass("open-submenu");
        });
    }

    // Lazy Loading
    function lazyLoad() {
        if ($.isFunction($.fn.Lazy)) {
            $(".lazy").Lazy({
                scrollDirection: "vertical",
                effect: "fadeIn",
                visibleOnly: true,
            });
        }
    }

    // Back to Top
    function backToTop() {
        if ($("body").width() > 450) {
            $(window).on("scroll", function () {
                $(".back-to-top").toggle($(this).scrollTop() > 100);
            });

            $(document).on("click", ".back-to-top", function () {
                $("html, body").animate(
                    {
                        scrollTop: 0,
                    },
                    700
                );
                return false;
            });
        }
    }

    // Search Form Toggle
    function searchForm() {
        $(".searh-toggle").on("click", function () {
            $("header .search-form").toggleClass("open-search");
        });
    }

    // Scroll Progress Bar
    function scrollBar() {
        $(window).on("scroll", function () {
            const scrollPercent =
                (100 * $(this).scrollTop()) /
                ($(document).height() - $(this).height());
            $(".top-scroll-bar").css("width", scrollPercent + "%");
        });
    }

    // Sticky Sidebar
    function theiaSticky() {
        if ($.isFunction($.fn.theiaStickySidebar)) {
            $(".sticky-sidebar").theiaStickySidebar({
                additionalMarginTop: 70,
            });
        }
    }

    // Owl Carousel
    function owlCarouselInit() {
        if ($.isFunction($.fn.owlCarousel)) {
            $(".full-slide .owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                autoplay: false,
                autoHeight: true,
                dots: false,
                nav: true,
                navText: [
                    '<i class="icon-left-open-big"></i>',
                    '<i class="icon-right-open-big"></i>',
                ],
                navContainer: ".full-slider__nav",
            });

            $(
                ".slide-tmp-1, .widget-twitter, .widget-latest-tpl-6"
            ).owlCarousel({
                items: 1,
                smartSpeed: 450,
                loop: true,
                nav: true,
                navText: [
                    '<i class="icon-left-open-big"></i>',
                    '<i class="icon-right-open-big"></i>',
                ],
                dots: false,
            });
        }
    }

    // Document Ready
    $(document).ready(function () {
        lazyLoad();
        backToTop();
        mobileMenu();
        stickMenu();
        searchForm();
        scrollBar();
        theiaSticky();
        owlCarouselInit();
    });
})(jQuery);
