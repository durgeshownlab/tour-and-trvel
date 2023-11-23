(function ($) {

    "use strict";

    $(document).ready(function () {

        /*-----------------------------------------------------------------------------------*/
        /* Nice Select
         /*-----------------------------------------------------------------------------------*/
        $('select').niceSelect();
        $('select#rate-it').niceSelect('destroy');

        $("input.datepicker").datepicker({
            dateFormat: 'MM',
            onClose: function (dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Tooltip
         /*-----------------------------------------------------------------------------------*/
        $('[data-toggle="tooltip"]').on({
            mouseenter: function () {
                $(this).append("<span></span>");
                $(this).children('span').text($(this).data('title'));
                var span_width = $(this).children('span').width();
                $(this).find('span').css('margin-left', -((span_width / 2) + 14));
            },
            mouseleave: function () {
                $(this).find('span').remove();
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Adjust tour type icon space
         /*-----------------------------------------------------------------------------------*/
        function adjust_type_icon() {
            var $object = $('.home-mood-destination .overlay');
            $object.each(function () {
                $(this).css('padding-top', 0);

                var $padding = ((($(this).height() - $(this).children('img').height()) / 2) - $(this).children('span').height());

                $(this).css('padding-top', $padding);
            });
        }

        /*-----------------------------------------------------------------------------------*/
        /* Mean-menu for the main menu (mobile responsive menu)
         /*-----------------------------------------------------------------------------------*/
        jQuery('nav.main-menu-wrap').meanmenu({
            meanScreenWidth: 768
        });

        /*-----------------------------------------------------------------------------------*/
        /* Sticky Header
         /*-----------------------------------------------------------------------------------*/
        var resizeTimer;

        function inspiry_sticky_header() {

            if (!$(document).find('header.sticky-header').length) {
                var stickyHeader = $('.header header'),
                    headerClone = stickyHeader.before(stickyHeader.clone().addClass('sticky-header'));
            }

            $(window).on('scroll', function () {
                if (window.innerWidth >= 767) {
                    var fromTop = $(window).scrollTop();
                    $('body').toggleClass('sticky-body', (fromTop > 148));
                } else {
                    $(document).find('header.sticky-header').remove();
                }
            });
        }

        if ('enable' === localize.inspiry_sticky_header) {

            inspiry_sticky_header();

            $(window).on('resize', function (e) {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function () {
                    inspiry_sticky_header();
                }, 250);
            });
        }


        /*-----------------------------------------------------------------------------------*/
        /* Homepage Slider
         /*-----------------------------------------------------------------------------------*/
        $('.flexslider').flexslider({
            animation: "fade",
            controlNav: false,
            start: function (slider) {
                slider.removeClass('loading');
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Featured Packages Carousel
         /*-----------------------------------------------------------------------------------*/
        $('#featured-packages').owlCarousel({
            loop: true,
            margin: 30,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                    dots: true
                },
                992: {
                    items: 2,
                    nav: false,
                    dots: true
                },
                1200: {
                    items: 3,
                    nav: true,
                    loop: true,
                    dots: true
                }
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Destination Hover Over
         /*-----------------------------------------------------------------------------------*/
        $('.overlay .location').each(function () {
            var detailHeight = $(this).children('.detail').height();
            $(this).css('bottom', -( detailHeight + 10 ));
        });

        /*-----------------------------------------------------------------------------------*/
        /* Branch Offices - last and second last child bottom space fix
         /*-----------------------------------------------------------------------------------*/
        var offices_length = $('.branch-office .row').children('.bch-office').length,
            office_styles = {
                'border-bottom': 0,
                'padding-bottom': 0,
                'margin-bottom': '2rem'
            };

        if (offices_length % 2 == 0) {

            $('.branch-office').find('.office-contact').eq(offices_length - 1).css(office_styles);
            $('.branch-office').find('.office-contact').eq(offices_length - 2).css(office_styles);

        } else {
            $('.branch-office').find('.office-contact').eq(offices_length - 1).css(office_styles);
        }

        /*-----------------------------------------------------------------------------------*/
        /* Contact Social Icons Hover Over
         /*-----------------------------------------------------------------------------------*/
        $('.social-profile li, .social-buttons li').on({
            mouseenter: function () {
                $(this).stop(true).animate({
                    'margin-top': '-4px'
                }, 200);
            },
            mouseleave: function () {
                $(this).stop(true).animate({
                    'margin-top': 0
                }, 200);
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Scroll to Top
         /*-----------------------------------------------------------------------------------*/
        var scrollAnchor = $('#scroll-top');
        $(window).on('scroll', function () {
            if ($(window).width() > 980) {
                if ($(this).scrollTop() > 250) {
                    scrollAnchor.fadeIn('fast');
                    return;
                }
            }
            scrollAnchor.fadeOut('fast');
        });

        scrollAnchor.on('click', function (event) {
            event.preventDefault();
            $('html, body').animate({scrollTop: 0}, 'slow');
        });

        /*----------------------------------------------------------------------------------*/
        /* Contact Form AJAX validation and submission
         /* Validation Plugin : http://bassistance.de/jquery-plugins/jquery-plugin-validation/
         /* Form Ajax Plugin : http://www.malsup.com/jquery/form/
         /*---------------------------------------------------------------------------------- */
        if (jQuery().validate && jQuery().ajaxSubmit) {

            var submitButton = $('#submit-button'),
                ajaxLoader = $('#ajax-loader'),
                messageContainer = $('#message-container'),
                errorContainer = $("#error-container");

            var formOptions = {
                beforeSubmit: function () {
                    submitButton.attr('disabled', 'disabled');
                    ajaxLoader.fadeIn('fast');
                    messageContainer.fadeOut('fast');
                    errorContainer.fadeOut('fast');
                },
                success: function (ajax_response, statusText, xhr, $form) {
                    var response = $.parseJSON(ajax_response);
                    ajaxLoader.fadeOut('fast');
                    submitButton.removeAttr('disabled');
                    if (response.success) {
                        $form.resetForm();
                        messageContainer.html(response.message).fadeIn('fast');
                    } else {
                        errorContainer.html(response.message).fadeIn('fast');
                    }
                }
            };

            $('#contact-form').each(function () {
                $(this).validate({
                    errorLabelContainer: errorContainer,
                    submitHandler: function (form) {
                        $(form).ajaxSubmit(formOptions);
                    }
                });
            });
        }

        /*-----------------------------------------------------------------------------------*/
        /* Google Map
         /*-----------------------------------------------------------------------------------*/
        if (typeof google === 'object' && typeof google.maps === 'object') {
            // initiating the google map if google map api is loaded (must be after window load)

            // Get the HTML DOM element that will contain the map
            var mapElement = document.getElementById(localize.map_container);

            if (mapElement !== null) {
                init();
            }
        }

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: parseInt(localize.map_zoom),

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(parseFloat(localize.map_lat), parseFloat(localize.map_lon)),

                // How you would like to style the map.
                styles: [
                    {
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                        "stylers": [{"color": "#444444"}]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [{"color": "#f2f2f2"}]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [{"visibility": "off"}]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{"saturation": -100}, {"lightness": 45}]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [{"visibility": "simplified"}]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [{"visibility": "off"}]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [{"visibility": "off"}]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{"color": "#46bcec"}, {"visibility": "on"}]
                    }]
            };

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(localize.map_lat), parseFloat(localize.map_lon)),
                map: map,
                // title: 'Inspiry!',
                icon: localize.map_icon
            });
        }

        /*-----------------------------------------------------------------------------------*/
        /* Bar Rating
         /*-----------------------------------------------------------------------------------*/
        $('#rate-it').barrating({
            theme: 'fontawesome-stars'
        });


        /*-----------------------------------------------------------------------------------*/
        /* Isotope
         /*-----------------------------------------------------------------------------------*/
        if (jQuery().isotope) {

            $('#items-list').isotope({
                itemSelector: '.item'
            });

            //Add the class selected to the item that is clicked, and remove from the others
            var $optionSets = $('#filters'),
                $optionLinks = $optionSets.find('a');

            $optionLinks.on('click', function () {
                var $this = $(this);
                // don't proceed if already selected
                if ($this.hasClass('active')) {
                    return false;
                }
                $optionSets.find('.active').removeClass('active');
                $this.addClass('active');

                //When an item is clicked, sort the items.
                var selector = $(this).attr('data-filter');
                $('#items-list').isotope({filter: selector});

                return false;
            });
        }

        /*-----------------------------------------------------------------------------------*/
        /* Main Menu
         /*-----------------------------------------------------------------------------------*/
        $('.main-menu li').on({
            mouseenter: function () {
                $(this).children('.sub-menu').stop(true, true).slideDown('fast');
            },
            mouseleave: function () {
                $(this).children('.sub-menu').stop(true, true).delay(100).slideUp('fast');
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Hide empty fields from GET form
         /*-----------------------------------------------------------------------------------*/
        $.fn.fliter_form = function () {

            $(this).on('submit', function () {
                $(this).find(":input,select").filter(function () {
                    return !this.value;
                }).attr("disabled", "disabled");
                return true; // ensure form still submits
            });

            // Un-disable form fields when page loads, in case user click back after submission
            $(this).find(":input,select").prop("disabled", false);
        };

        $('#tours-search').fliter_form();

        /*-----------------------------------------------------------------------------------*/
        /* Magnific Popup
         /*-----------------------------------------------------------------------------------*/
        $('.inspiry-popup').magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true
            },
            removalDelay: 500,
            zoom: {
                enabled: true
            }
        });

        $('.lightbox').magnificPopup({
            type: 'image',
            removalDelay: 500,
            zoom: {
                enabled: true
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Tour Content Tabs
         /*-----------------------------------------------------------------------------------*/
        $('ul.tour-tabs li').on('click', function () {
            const liTab = $(this);
            if (!liTab.hasClass('active')) {
                var tab_id = liTab.attr('data-tab');

                $('ul.tour-tabs li').removeClass('active');
                $('.post-content > div').fadeOut(0).removeClass('active');

                liTab.addClass('active');
                $('#' + tab_id).stop(true, true).fadeIn().addClass('active');

                if ((tab_id == 'tour-location') && !liTab.hasClass('map_initiated')) {
                    setTimeout(function () {
                        init();
                        liTab.addClass('map_initiated');
                    }, 100);
                }
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Travel Destinations equal height
         /*-----------------------------------------------------------------------------------*/
        function popular_destination_height() {
            var destinations = $('.travel-destinations .travel-destination');
            var min_height = 500;

            destinations.find('.img-responsive').css('height', '100%');
            $.each(destinations, function (e) {

                var height = $(this).height();
                if (height < min_height) {
                    min_height = height;
                }
            });
            destinations.find('.img-responsive').css('height', min_height);
        }



        /*-----------------------------------------------------------------------------------*/
        /* Related Products Carousel
         /*-----------------------------------------------------------------------------------*/
        $('#product-carousel-wc,#product-carousel-up-sell').owlCarousel({
            //autoplayHoverPause: true,
            margin: 30,
            loop: false,
            dots: false,
            smartSpeed: 500,
            nav: false,
            mouseDrag: true,
            items: 2,
            autoplay: false,
            responsive: {
                0: {
                    items: 1,
                },
                500: {
                    items: 2,
                },
                900: {
                    items: 4,

                }
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Tours reviews hash scroll
         /*-----------------------------------------------------------------------------------*/
        $('#reviews-hash').on('click', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $("div.tour-review").offset().top
            }, 1000)
        });

        /*-----------------------------------------------------------------------------------*/
        /* Home - Testimonials bottom margin adjustment
         /*-----------------------------------------------------------------------------------*/
        function adjust_testimonials_margin() {
            var testimonials = $('.home-testimonials').find('.col-sm-6');
            testimonials.children('.testimonial').removeClass('no-margin-bottom');
            if ($(window).width() > 767) {
                if ((testimonials.length % 2) == 0) {
                    testimonials.last().prev().children('.testimonial').addClass('no-margin-bottom');
                    testimonials.last().children('.testimonial').addClass('no-margin-bottom');
                } else {
                    testimonials.last().children('.testimonial').addClass('no-margin-bottom');
                }
            } else {
                testimonials.last().children('.testimonial').addClass('no-margin-bottom');
            }
        }

        /*-----------------------------------------------------------------------------------*/
        /* Home - Destinations redirection on click as whole
         /*-----------------------------------------------------------------------------------*/
        const destinations = $('.travel-destinations').find('.travel-destination');
        destinations.each(function () {
            $(this).find('.overlay').on('click', function () {
                const hash = $(this).find('a').attr('href');
                window.location.replace(hash);
            });
        });

        /*-----------------------------------------------------------------------------------*/
        /* Tour Detail - Gallery zoom icon adjustment
         /*-----------------------------------------------------------------------------------*/
        function adjustGalleryIcon() {
            const overlay = $('.tour-gallery .gallery-images li .overlay');
            overlay.each(function (e) {
                var icon = $(this).children('img');
                var marginTop = ( ($(this).height() / 2) - (icon.height() / 2) );
                icon.css('margin-top', marginTop);
            });
        }

        const tourTab = $('.tour-tabs li');
        tourTab.on('click', adjustGalleryIcon);

        /*-----------------------------------------------------------------------------------*/
        /* Mini cart display
         /*-----------------------------------------------------------------------------------*/
        $('li.shopping-cart').on('click', function (e) {
            $('.mini-cart-wrap').stop(true, true).slideToggle('fast');
            e.preventDefault();
        });

        $(document).on('click', function (e) {
            if (!$(e.target).is('li.shopping-cart')
                && !$(e.target).parents('.shopping-cart').length
                && !$(e.target).is(".mini-cart-wrap")
                && !$(e.target).parents('.mini-cart-wrap').length
                && $('.mini-cart-wrap').is(':visible')) {
                $('.mini-cart-wrap').slideUp('fast');
            }
        });

        /*-----------------------------------------------------------------------------------*/
        /* Tour meta icons (hover effect) label position fix
         /*-----------------------------------------------------------------------------------*/
        $('.tour-meta-icon span').each(function () {
            $(this).css('margin-left', -($(this).width() / 2 + 2));
        });

        /*-----------------------------------------------------------------------------------*/
        /* Tour Types/Moods columns adjustment on homepage
         /*-----------------------------------------------------------------------------------*/
        function adjust_tour_types_columns() {
            const tour_types_wrap = $('.home-mood-destination');
            const tour_types = tour_types_wrap.children('.row').children('div');
            if (tour_types.length < 6 || $(window).width() < 992) {
                tour_types_wrap.addClass('fix-columns');
            } else {
                tour_types_wrap.removeClass('fix-columns');
            }
        }
        /*-----------------------------------------------------------------------------------*/
        /* Related posts and next-prev links height adjustment on blog single
         /*-----------------------------------------------------------------------------------*/
        $.fn.postNavHeight = function (settings) {
            if ($(window).width() > 767) {
                const aPost = this.children(settings.child).first();
                const bPost = this.children(settings.child).last();
                const aPostHeight = aPost.height();
                const bPostHeight = bPost.height();

                if (aPostHeight !== bPostHeight) {
                    if (aPostHeight > bPostHeight) {
                        bPost.height(aPostHeight);
                    } else {
                        aPost.height(bPostHeight);
                    }
                }
            }
        };

        $('.single .in-navigation').postNavHeight({'child': '.post-nav'});
        $('.single .in-category').postNavHeight({'child': '.related-post'});

        /*-----------------------------------------------------------------------------------*/
        /* Search form Trapezoid enable/disable based on the window width
         /*-----------------------------------------------------------------------------------*/
        const sliderWrap = $('#search-form-wrapper');
        const searchTrapezoid = sliderWrap.hasClass('search-form-trapezoid');

        function search_form_trapezoid_display() {
            if (sliderWrap.length > 0 && searchTrapezoid) {
                if ($(window).width() < 1256) {
                    sliderWrap.removeClass('search-form-trapezoid');
                } else {
                    sliderWrap.addClass('search-form-trapezoid');
                }
            }
        }

        function initFunctions() {
            adjust_type_icon();
            popular_destination_height();
            adjust_testimonials_margin();
            adjustGalleryIcon();
            adjust_tour_types_columns();
            search_form_trapezoid_display();
        }

        $(window).on('load', function () {
            initFunctions();

            // Set masonry layout mode to blog posts
            var $grid = $('.blog-posts .row');
            $grid.isotope({layoutMode: 'masonry'});
        });

        $(window).on('resize', function () {
            initFunctions();
        });
    });
})(jQuery);