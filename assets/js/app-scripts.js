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

        /* ---------- */

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

        /* ---------- */

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

        /* ---------- */

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

        /* ---------- */

        const pushNotificationsBtn = $('.close_btn');
        if (pushNotificationsBtn.length) {
            $(document).on('click', '.close_btn', function () {
                const wrap = $(this).closest('.push_notification');
                const id = $(wrap).attr('id');

                if (!localStorage.getItem(id)) {
                    localStorage.setItem(id, '1');
                }

                if (wrap.length) {
                    $(wrap).removeClass('show_up');
                }
            });
        }

        /* ---------- */

        const pushNotifications = window.aingSettings.pushNotifications;
        const notifications = [
            'notification-square',
            'notification-wide'
        ];

        $(notifications).each(function (index, item) {
            if (!pushNotifications.hasOwnProperty('display') || pushNotifications.display === '0') {
                return false;
            }

            if (pushNotifications.display === 'each_page') {
                localStorage.removeItem(item);
            } else {
                if (localStorage.getItem(item)) {
                    return;
                }
            }

            const notification = $('#'+item);
            if (notification.length) {
                const delay = $(notification).data('delay');

                if (delay) {
                    setTimeout(function () {
                        $(notification).addClass('show_up');
                    }, delay );
                } else {
                    $(notification).addClass('show_up');
                }
            }
        });

        /* ---------- */

        const clickUnder = window.aingSettings.clickUnder;
        if (clickUnder && clickUnder.hasOwnProperty('activation') && clickUnder.hasOwnProperty('adv_url') && clickUnder.activation !== '0' && clickUnder.adv_url) {
            sessionStorage.setItem('click_under_clicked', '0');

            $(document).on('click', 'a, .close_btn', function (e) {
                const clickUnderStatusKey = 'click_under_status';
                const clicked = sessionStorage.getItem('click_under_clicked') === '1';

                if (clickUnder.activation === 'once' && localStorage.getItem(clickUnderStatusKey)) {
                    return;
                }

                if (clickUnder.activation === 'once_a_session' && sessionStorage.getItem(clickUnderStatusKey)) {
                    return;
                }

                if ((clickUnder.activation === 'each_1_click' || clickUnder.activation === 'each_2_click' || clickUnder.activation === 'each_3_click') && (!clickUnder.hasOwnProperty('allowed') || clickUnder.allowed === '0' || clicked)) {
                    return;
                }

                if (clickUnder.activation === 'by_time' && (!clickUnder.hasOwnProperty('allowed') || clickUnder.allowed === '0' || clicked)) {
                    return;
                }

                e.preventDefault();
                clickUnderOpenLink(clickUnder.adv_url);

                if (clickUnder.activation === 'once') {
                    localStorage.setItem(clickUnderStatusKey, '1');
                } else {
                    localStorage.removeItem(clickUnderStatusKey);
                }

                if (clickUnder.activation === 'once_a_session') {
                    sessionStorage.setItem(clickUnderStatusKey, '1');
                } else {
                    sessionStorage.removeItem(clickUnderStatusKey);
                }
            });
        }

        function clickUnderOpenLink(url)
        {
            if (!url) {
                return false;
            }

            window.open(url, '_blank');
            window.focus();
            sessionStorage.setItem('click_under_clicked', '1');
        }
    });
})(jQuery);