/*----------------------------------------------
Index Of Script
------------------------------------------------
 1 Page Loader
 2 Back To Top
 3 Tooltip
 4 Hide Menu
 5 Accordion
 6 Header
 7 About Menu
 8 Magnific Popup
 9 Countdown
10 Progress Bar
11 widget
12 counter
13 Wow Animation
14 Owl Carousel
15 Contact From
16 On Scroll
17 Cookie
------------------------------------------------
Index Of Script
----------------------------------------------*/



    "use strict";
    $(document).ready(function() {



        /*------------------------
        Page Loader
        --------------------------*/
        jQuery("#load").fadeOut();
        jQuery("#loading").delay(0).fadeOut("slow");



        /*------------------------
        Back To Top
        --------------------------*/
        $('#back-to-top').fadeOut();
        $(window).on("scroll", function() {
            if ($(this).scrollTop() > 250) {
                $('#back-to-top').fadeIn(1400);
            } else {
                $('#back-to-top').fadeOut(400);
            }
        });
        // scroll body to 0px on click
        $('#top').on('click', function() {
            $('top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });

        /*------------------------
        Hide Menu
        --------------------------*/
        $(".navbar a").on("click", function(event) {
            if (!$(event.target).closest(".nav-item.dropdown").length) {
                $(".navbar-collapse").collapse('hide');
            }
        });



        /*------------------------
        Accordion
        --------------------------*/
        $('.iq-accordion .iq-ad-block .ad-details').hide();
        $('.iq-accordion .iq-ad-block:first').addClass('ad-active').children().slideDown('slow');
        $('.iq-accordion .iq-ad-block').on("click", function() {
            if ($(this).children('div').is(':hidden')) {
                $('.iq-accordion .iq-ad-block').removeClass('ad-active').children('div').slideUp('slow');
                $(this).toggleClass('ad-active').children('div').slideDown('slow');
            }
        });



        /*------------------------
        Header
        --------------------------*/
        $('.navbar-nav li a').on('click', function(e) {
            var anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $(anchor.attr('href')).offset().top - 0
            }, 500);
            e.preventDefault();
        });
        $('.about-manu li a').on('click', function(e) {
            var anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $(anchor.attr('href')).offset().top - 170
            }, 500);
            e.preventDefault();
        });
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 100) {
                $('header').addClass('menu-sticky');
            } else {
                $('header').removeClass('menu-sticky');
            }
        });



        /*------------------------
        About menu
        --------------------------*/
        $(window).on('scroll', function() {
            var window_top = $(window).scrollTop();
            var footer_top = $("footer").offset().top - 200;
            var div_top = $('.breadcrumbs').outerHeight();
            var div_height = $(".about-manu").height();
            if (window_top + div_height > footer_top)
                $('.about-manu').removeClass('menu-sticky');
            else if (window_top > div_top) {
                $('.about-manu').addClass('menu-sticky');
            } else {
                $('.about-manu').removeClass('menu-sticky');
            }
        });



        /*------------------------
        Magnific Popup
        --------------------------*/
        $('.popup-gallery').magnificPopup({
            delegate: 'a.popup-img',
            tLoading: 'Loading image #%curr%...',
            type: 'image',
            mainClass: 'mfp-img-mobile',
            gallery: {
                navigateByImgClick: true,
                enabled: true,
                preload: [0, 1]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
        $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            type: 'iframe',
            disableOn: 700,
            mainClass: 'mfp-fade',
            preloader: false,
            removalDelay: 160,
            fixedContentPos: false
        });



        /*------------------------
        Countdown
        --------------------------*/
        $('#countdown').countdown({
            date: '10/01/2019 23:59:59',
            day: 'Day',
            days: 'Days'
        });


    /*--------------------------
    bootstrap menu index-12
    ---------------------------*/

    $(window).on('scroll', function(e) {
        if($('#how-it-works').length && $('#great-screenshots').length){
            if ($(this).scrollTop() >= ($('#how-it-works').offset().top - 2000)) {
                $('#great-screenshots ul li').children('a[aria-selected=true]').addClass('active');
                e.preventDefault();
            }
        }
    });


        /*------------------------
        Wow Animation
        --------------------------*/
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        wow.init();



        /*------------------------
        Owl Carousel
        --------------------------*/
        $('.owl-carousel').each(function() {
            var $carousel = $(this);
            $carousel.owlCarousel({
                items: $carousel.data("items"),
                loop: $carousel.data("loop"),
                margin: $carousel.data("margin"),
                nav: $carousel.data("nav"),
                dots: $carousel.data("dots"),
                autoplay: $carousel.data("autoplay"),
                autoplayTimeout: $carousel.data("autoplay-timeout"),
                navText: ['<i class="fa fa-angle-left fa-2x"></i>', '<i class="fa fa-angle-right fa-2x"></i>'],
                responsiveClass: true,
                responsive: {
                    // breakpoint from 0 up
                    0: {
                        items: $carousel.data("items-mobile-sm")
                    },
                    // breakpoint from 480 up
                    480: {
                        items: $carousel.data("items-mobile")
                    },
                    // breakpoint from 786 up
                    786: {
                        items: $carousel.data("items-tab")
                    },
                    // breakpoint from 1023 up
                    1023: {
                        items: $carousel.data("items-laptop")
                    },
                    1199: {
                        items: $carousel.data("items")
                    }
                }
            });
        });





});
       // Scroll to specific values
// scrollTo is the same
window.scroll({
  top: 0,
  left: 0,
  behavior: 'smooth'
});

// Scroll certain amounts from current position
window.scrollBy({
  top: 0, // could be negative value
  left: 0,
  behavior: 'smooth'
});

// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 500, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });

  function saveFrontend()
  {
      $('#frontendForm').submit();
  }


  /**
   * subscribe
   */

   function subscribe(e)
   {
       alert();
       var url = $('#subscription_url').val();
       var email = $('#email').val();
       var name = $('#name').val();
       var phone = $('#phone_number').val();
       var input = $('.subscription-email').val();

       if( $(".subscription-email").val().length == 0) {
           $('#invalid-email').text('Email field is required');
        }else if($(".subscription-name").val().length == 0){
            $('#invalid-name').text('Name field is required');
        }else if($(".subscription-phone").val().length == 0){
            $('#invalid-phone').text('Phone field is required');
        }
        else {
            /**
             * Has Value
             */
            $('#loader-spinner').removeClass('d-none');

            if (url == null) {
                location.reload()
                } else {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: { 
                            email: email,
                            name: name,
                            phone: phone,
                         },
                        success: function (result) {
                            $('#loader-spinner').addClass('d-none');
                            $('#invalid-email').addClass('d-none');
                            $('#invalid-name').addClass('d-none');
                            $('#invalid-phone').addClass('d-none');
                            $('.subscribe-btn').addClass('not-allowed');
                            $('.subscribe-btn').text(result);
                        }
                    });
                }

            /**
             * Has Value::END
             */
        }


   }













