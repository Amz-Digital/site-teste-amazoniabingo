/*========================================================================

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Project: Casine - Casino and gambling HTML5 Template
Author: ingenious_team
Version: 1.00
Last change:    11/ 05 /2020
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

========================================================================*/
$(function () {
    "use strict";

    if (!localStorage.getItem('language')) {

        let language = navigator.language.slice(0,2);

        if (language != 'pt' && language != 'es' && language != 'en') {
            language = 'en';
        }

        changeLanguage(language);
    }

    function changeLanguage(language) {
        localStorage.setItem('language', language);

        // let site = 'http://127.0.0.1:5500/';
        let site = '';
        // let site = 'https://amazoniabingo.com/';

        if (language == 'pt') {
            language = '';
        } else {
            language = language + '/';
        }

        let page = window.location.pathname.split('/').pop();
        let params = window.location.search;
        let mainurl = site + language + page + params;
        console.log(mainurl)
        // if (location.pathname == '/es/index.html' || location.pathname == '/en/index.html'){
        //     window.location.replace('/index.html');
        // }else{
        //     window.location.replace(mainurl);
        // }

        switch (location.pathname){
            case '/es/index.html':
                window.location.replace('/index.html');
                break;
            case '/en/index.html':
                window.location.replace('/index.html');
                break;

            // ======================================
            case '/es/terms-of-privacy-policy.html':
                window.location.replace('/terms-of-privacy-policy.html');
                break;
            case '/en/terms-of-privacy-policy.html':
                window.location.replace('/terms-of-privacy-policy.html');
                break;

            // ======================================
            case '/es/responsible-game.html':
                window.location.replace('/responsible-game.html');
                break;
            case '/en/responsible-game.html':
                window.location.replace('/responsible-game.html');
                break;

            // ======================================
            case '/es/terms-of-cookies-policy.html':
                window.location.replace('/terms-of-cookies-policy.html');
                break;
            case '/en/terms-of-cookies-policy.html':
                window.location.replace('/terms-of-cookies-policy.html');
                break;
            
            // ======================================
            case '/es/terms-of-service.html':
                window.location.replace('/terms-of-service.html');
                break;
            case '/en/terms-of-service.html':
                window.location.replace('/terms-of-service.html');
                break;
                
            // ======================================
            default:
                window.location.replace(mainurl);
                break;
        }
   
    }

    $('.btn-change-language').click(function () {
        changeLanguage($(this).data('language'));
    });

    // for navbar background color when scrolling
    $(window).scroll(function () {
        var $scrolling = $(this).scrollTop();
        var bc2top = $("#back-top-btn");
        var stickytop = $(".sticky-top");
        if ($scrolling >= 550) {
            stickytop.addClass('navcss');
        } else {
            stickytop.removeClass('navcss');
        }
        if ($scrolling > 150) {
            bc2top.fadeIn(1000);
        } else {
            bc2top.fadeOut(1000);
        }
    });


    $('.full_nav .nav > li > .more-less').on('click', function () {
        $('.full_nav .nav').toggleClass("tog-nav");
        $('.full_nav .nav').toggleClass("fa-time");
    });

    //animation scroll js
    var nav = $('nav'),
        navOffset = nav.offset().top,
        $window = $(window);
    /* navOffset ends */
    
    var html_body = $('html, body');
    $('nav a').on('click', function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                html_body.animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
                return false;
            }
        }
    });
    // navbar js ends here

    // this is for back to top js
    var bc2top = $('#back-top-btn');
    bc2top.on('click', function () {
        html_body.animate({
            scrollTop: 0
        }, 1300);
    });


    // Closes responsive menu when a scroll link is clicked
    $('.nav-link').on('click', function () {
        $('.navbar-collapse').collapse('hide');
    });


    // game modal image
    $('#game-modal').on('show.bs.modal', function (event) {
        let imageSrc = $(event.relatedTarget).children().attr('src');
        $('#game-modal-image').attr('src', imageSrc);
    })


    /* -------------------------------------
        Running slick js				
    -------------------------------------- */
    $('.score-slick').slick({
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 1,
        autoplay: false,
        vertical: true,
        swipeToSlide: true,
        verticalSwiping: true,
        autoplaySpeed: 2000,
        arrows: false,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 6

                }
            },
            {
                breakpoint: 990,
                settings: {
                    slidesToShow: 6,

                }
            }
        ]
    });

    /* -------------------------------------
        Count-down js			
    -------------------------------------- */
    $('.count-down').countdown('2030/08/11', function (event) {
        $(this).html(event.strftime('%H'));
    });
    $('.count-down2').countdown('2030/08/01', function (event) {
        $(this).html(event.strftime('%M'));
    });

    $('.count-down3').countdown('2030/11/22', function (event) {
        $(this).html(event.strftime('%S'));
    });


    /* -------------------------------------
        youtube video js start here			
    -------------------------------------- */
    jQuery("a.bla-1").YouTubePopUp({
        autoplay: 0
    }); // Disable autoplay



    /* -------------------------------------
        Preloader				
    -------------------------------------- */
    $('.preloader').delay(1000).fadeOut(1000);
    
    
    $('#submit-contact').on('click', function(e){
        e.preventDefault();
        $('form#contact-form').submit();
    });
    
    $('#submit-subscription').on('click', function(e){
        e.preventDefault();
        $('form#subscribe-form').submit();
    });
    
    /**
     * 
     * Form Contact Submit
     */
    $('form#contact-form').submit(function (e) {
        
        e.preventDefault();
        
        var form = $(this);
        var url = $(form).attr('action');
        var data = $(form).serialize();
        var submitButton = $(form).find('#submit-contact');
        
        if( !$(form).find("input[name='name']").val() ) {
            return;
        } 
        
        if( !$(form).find("input[name='email']").val() ) {
            return;
        } 
                        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            beforeSend: function (xhr) {
                submitButton.prop('disabled', true);
                submitButton.find('span.spinner').toggleClass('invisible');
            },
            success: function (response) {
                                                                
                if (typeof response !== 'object' ) { 
                    console.log('Tipo : ' + typeof response);
                    console.log('vai transformar');
                    var response = JSON.parse(response);
                }       
                                
                if (response.success) {
                    
                    $("div#contact-success-message").show();
                    document.getElementById("contact-form").reset();
                                       
                } else {                       
                    
                    $("div#contact-danger-message").show();                   
                    
                }
                
            },
            complete: function (xhr) {
                submitButton.prop('disabled', false);
                submitButton.find('span.spinner').toggleClass('invisible');
            }
            
        }); 
        return false;
    }); 
    
    
    /**
     * 
     * Form Contact Submit
     */
    $('form#subscribe-form').submit(function (e) {
        
        e.preventDefault();
        
        var form = $(this);
        var url = $(form).attr('action');
        var data = $(form).serialize();
        var submitButton = $(form).find('#submit-contact');
                
        if( !$(form).find("input[name='email']").val() ) {
            return;
        } 
                        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            beforeSend: function (xhr) {
                submitButton.prop('disabled', true);
                submitButton.find('span.spinner').toggleClass('invisible');
            },
            success: function (response) {
                                                                
                if (typeof response !== 'object' ) { 
                    console.log('Tipo : ' + typeof response);
                    console.log('vai transformar');
                    var response = JSON.parse(response);
                }       
                                
                if (response.success) {
                    
                    $("div#subscribe-success-message").show();
                    document.getElementById("subscribe-form").reset();
                                       
                } else {                       
                    
                    $("div#subscribe-danger-message").show();                   
                    
                }
                
            },
            complete: function (xhr) {
                submitButton.prop('disabled', false);
                submitButton.find('span.spinner').toggleClass('invisible');
            }
            
        });
                
        return false;
    });
});