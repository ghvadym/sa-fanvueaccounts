(function ($) {
    $(document).ready(function () {
        const ajax = fvajax.ajaxurl;
        const nonce = fvajax.nonce;
        const burgerOpen = $('.header_burger_icon');
        const burgerClose = $('.header_close_icon');
        const header = $('#header');
        const isDesktop = $(window).width() > 1024;

        if (!isDesktop) {
            const footerTitle = $('.footer__title');
            if (footerTitle.length) {
                $(document).on('click', '.footer__title', function () {
                    $(this).toggleClass('show_menu');
                    $(this).next().slideToggle();
                });
            }
        }

        if (header.length) {
            if ($(document).scrollTop() > 30) {
                header.addClass('_scrolled');
            }
        }
        
        if ($(window).width() < 1250) {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 30) {
                    header.addClass('_scrolled');
                } else {
                    header.removeClass('_scrolled');
                }
            });
        }

        if (header.length && burgerOpen.length && burgerClose.length) {
            $(document).on('click', '.header_burger_icon, .header_close_icon', function () {
                $(header).toggleClass('active-menu');
                $('html').toggleClass('no-scroll');
            });
        }

        const articlesLoadBtn = $('#articles_load');
        if (articlesLoadBtn.length) {
            articlesLoadBtn.on('click', function (e) {
                let pageNumber = $(this).attr('data-page');
                pageNumber = parseInt(pageNumber) + 1;

                const termId = $(this).attr('data-cat');

                ajaxPosts(pageNumber, termId);
            });
        }

        function ajaxPosts(pageNumber = 1, termId = '')
        {
            let formData = new FormData();

            const posts = $('.articles');
            const wrap = $(posts).closest('.container');
            const loadMoreBtn = $('#articles_load');

            formData.append('action', 'load_posts');
            formData.append('nonce', nonce);
            formData.append('page', pageNumber);

            if (termId) {
                formData.append('term', termId);
            }

            jQuery.ajax({
                type       : 'POST',
                url        : ajax,
                data       : formData,
                dataType   : 'json',
                processData: false,
                contentType: false,
                beforeSend : function () {
                    $(wrap).addClass('_spinner');
                },
                success    : function (response) {
                    if (response.posts) {
                        if (response.append) {
                            $(posts).append(response.posts);
                        } else {
                            $(posts).html(response.posts);
                        }

                        if (response.end_posts) {
                            $(loadMoreBtn).hide();
                        }

                        $(loadMoreBtn).attr('data-page', pageNumber);
                    }

                    $(wrap).removeClass('_spinner');
                },
                error      : function (err) {
                    console.log('error', err);
                }
            });
        }

        const carouselSlider = $('.owl-carousel');
        if (carouselSlider.length) {
            let carouselSliderArgs = {
                loop              : true,
                responsiveClass   : true,
                nav               : true,
                dots              : false,
                margin            : 0,
                autoplay          : false,
                touchDrag         : true,
                mouseDrag         : true,
                autoplayTimeout   : 3000,
                smartSpeed        : 1000,
                center            : true,
                items             : 4,
                navText           : [
                    '<svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.39355 9.58711L0.445756 5.98011C0.304453 5.85127 0.192349 5.69823 0.11586 5.52976C0.0393717 5.36128 0 5.18068 0 4.99828C0 4.81589 0.0393713 4.63528 0.11586 4.46681C0.192349 4.29833 0.304453 4.1453 0.445756 4.01646L4.39354 0.409459C5.35382 -0.467918 7 0.15878 7 1.39825L7 8.61224C7 9.85171 5.35382 10.4645 4.39355 9.58711Z" fill="white"/></svg>',
                    '<svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.60646 0.412893L6.55424 4.01989C6.69555 4.14873 6.80765 4.30177 6.88414 4.47024C6.96063 4.63872 7 4.81932 7 5.00172C7 5.18411 6.96063 5.36472 6.88414 5.53319C6.80765 5.70167 6.69555 5.8547 6.55424 5.98354L2.60646 9.59054C1.64618 10.4679 9.00529e-07 9.84122 7.92171e-07 8.60175L0 1.38776C-1.08358e-07 0.148286 1.64618 -0.464485 2.60646 0.412893Z" fill="white"/></svg>'
                ],
                responsive        : {
                    0   : {
                        items: 1.5
                    },
                    768 : {
                        items: 2
                    },
                    1024: {
                        items: 3,
                    },
                    1025: {
                        autoplay          : true,
                        autoplayHoverPause: true,
                        mouseDrag         : true,
                        touchDrag         : true
                    }
                }
            };

            if ($('.offers__slider').length) {
                carouselSliderArgs['responsive']['0']['items'] = 1.3;
            }

            const carouselSliderOwl = $(carouselSlider).owlCarousel(carouselSliderArgs);

            jQuery(document.documentElement).keydown(function (event) {
                if (event.keyCode === 37) {
                    carouselSliderOwl.trigger('prev.owl.carousel', [400]);
                } else if (event.keyCode === 39) {
                    carouselSliderOwl.trigger('next.owl.carousel', [400]);
                }
            });
        }
    });
})(jQuery);