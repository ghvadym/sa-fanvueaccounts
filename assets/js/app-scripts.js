(function ($) {
    $(document).ready(function () {
        const ajax = fvajax.ajaxurl;
        const nonce = fvajax.nonce;
        const burgerOpen = $('.header_burger_icon');
        const burgerClose = $('.header_close_icon');
        const header = $('#header');
        const searchForm = $('#search_form');
        const isDesktop = $(window).width() > 1024;

        if ($(window).width() < 1320) {
            const morePostsSlider = new Swiper('.articles_slider', {
                slidesPerView: 'auto'
            });
        }

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
                const search = $('.search__input');
                let pageNumber = $(this).attr('data-page');
                pageNumber = parseInt(pageNumber) + 1;

                if (search.length) {
                    ajaxPosts($(search).val(), pageNumber);
                } else {
                    ajaxPosts('', pageNumber);
                }
            });
        }

        if (searchForm.length) {
            $(document).on('submit', '#search_form', function (e) {
                e.preventDefault();
                const searchInput = $(this).find('.search__input');
                $('#articles_load').attr('data-page', 1);

                ajaxPosts($(searchInput).val());
            });
        }

        function ajaxPosts(search = '', pageNumber = 1)
        {
            let formData = new FormData();

            const posts = $('.articles');
            const wrap = $(posts).closest('.container');
            const loadMoreBtn = $('#articles_load');

            formData.append('action', 'load_posts');
            formData.append('nonce', nonce);
            formData.append('search', search);
            formData.append('page', pageNumber);

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

                        if (response.count === 0 || response.end_posts) {
                            $(loadMoreBtn).hide();
                        } else {
                            $(loadMoreBtn).show();
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

        const singleSlider = new Swiper('.socials__slider', {
            slidesPerView       : 5,
            centeredSlidesBounds: true,
            centeredSlides      : true,
            loop                : true,
            speed               : 1000,
            grabCursor          : true,
            keyboard            : true,
            allowTouchMove      : true,
            longSwipes          : false,
            simulateTouch       : true,
            slideToClickedSlide : true,
            autoplay            : {
                delay            : 3000,
                pauseOnMouseEnter: true
            },
            mousewheel          : {
                forceToAxis: true
            },
            navigation          : {
                nextEl: '.single__button_next',
                prevEl: '.single__button_prev'
            },
            breakpoints         : {
                0   : {
                    autoplay     : false,
                    slidesPerView: 1.5,
                    speed        : 500
                },
                768 : {
                    slidesPerView: 3
                },
                1024: {
                    slidesPerView: 5
                },
                1025: {
                    loop      : true,
                    speed     : 1000,
                    mousewheel: {
                        forceToAxis: true
                    },
                    autoplay  : {
                        delay            : 3000,
                        pauseOnMouseEnter: true
                    }
                }
            }
        });

        const offersSlider = new Swiper('.offers__slider', {
            slidesPerView       : 5,
            centeredSlides      : true,
            loop                : true,
            centeredSlidesBounds: true,
            speed               : 1000,
            grabCursor          : true,
            keyboard            : true,
            allowTouchMove      : true,
            longSwipes          : false,
            simulateTouch       : true,
            slideToClickedSlide : true,
            autoplay            : {
                delay            : 3000,
                pauseOnMouseEnter: true
            },
            mousewheel          : {
                forceToAxis: true
            },
            navigation          : {
                nextEl: '.offers__button_next',
                prevEl: '.offers__button_prev'
            },
            breakpoints         : {
                0   : {
                    autoplay     : false,
                    slidesPerView: 1.3,
                    speed        : 500
                },
                768 : {
                    slidesPerView: 3
                },
                1024: {
                    slidesPerView: 5
                },
                1025: {
                    loop      : true,
                    speed     : 1000,
                    mousewheel: {
                        forceToAxis: true
                    },
                    autoplay  : {
                        delay            : 3000,
                        pauseOnMouseEnter: true
                    }
                }
            }
        });
    });
})(jQuery);