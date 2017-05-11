/**
 * Theme javascript functions file.
 *
 */
( function( a ) {
	"use strict";

	var  
    body        = a("body"),
	active      = ("js--active"),
	projects    = a('#projects'),
    loaded      = ('js--loaded');

    /**
     * Test if inline SVGs are supported.
     * @link https://github.com/Modernizr/Modernizr/
     */
    function supportsInlineSVG() {
        var div = document.createElement( 'div' );
        div.innerHTML = '<svg/>';
        return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
    }

    /* Masonry for portfolio template */ 
    function masonry() {

        var container = projects.imagesLoaded( function() {
            container.isotope({
                // options
                itemSelector: '.project',
                layoutMode: 'masonry',
                masonry: {
                    columnWidth: 50
                }
            });
        });

        // Infinite Scroll
        container.infinitescroll({

            navSelector  : "#page_nav",
            nextSelector : "#page_nav a",
            itemSelector : ".project",
            loading : {
                finishedMsg: 'No more pages to load.'
                }
            },

            // Trigger Masonry as a callback
            function( newElements ) {
                // hide new items while they are loading
                var newElems = a( newElements ).addClass("js--loading");

                // ensure that images load before adding to masonry layout
                newElems.imagesLoaded(function(){
                    // show elems now they're ready
                    
                    newElems.each(function(a) {

                        setTimeout(function() {
                            newElems.eq(a).addClass("js--loaded");
                            // newElems.animate({ opacity: 1 });
                        }, 150 * a);
                }),
                    
                container.isotope( 'appended', newElems, true );
            });
        });
    }

	/* fitVids */
	body.fitVids();

    function scrollingDiv() {
        var 
        $window = a(window),
        windowHeight    = a(window).height(),
        sidebarSection  = a(".sidebar--section"),
        scroll          = ("js--scroll");

        if($window.width() > 768) {
            sidebarSection.children().each(function(){
                if ( windowHeight < a(this).innerHeight() ) {
                    a(this).parent().addClass(scroll);
                } else {
                    a(this).parent().removeClass(scroll);
                }
            });
        }
    }

    function mobile_dropdowns() {
        var navigationHolder = a('.main-navigation');
        var dropdownOpener = a('.main-navigation .mobile-navigation--arrow, main-navigation h6, .main-navigation a.york-mobile-no-link');
        var animationSpeed = 200;

        if(dropdownOpener.length) {
            dropdownOpener.each(function() {
                a(this).on('tap click', function(e) {
                    var dropdownToOpen = a(this).nextAll('ul').first();

                    if(dropdownToOpen.length) {
                        e.preventDefault();
                        e.stopPropagation();

                        var openerParent = a(this).parent('li');
                        if(dropdownToOpen.is(':visible')) {
                            dropdownToOpen.slideUp(animationSpeed);
                            openerParent.removeClass('york-opened');
                        } else {
                            dropdownToOpen.slideDown(animationSpeed);
                            openerParent.addClass('york-opened');
                        }
                    }

                });
            });
        }
    }

	/* Document Ready */
	a(document).ready(function() {
        
        scrollingDiv();

        supportsInlineSVG();

        mobile_dropdowns();
        
        if ( true === supportsInlineSVG() ) {
            document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
        }

        /* Close the flyout when you click a menu item in the mobile menu */ 
        a( '#site-navigation .menu-item a' ).on( 'click', function() {
            body.removeClass( 'nav-open' );
        } );

        a(".animsition").animsition({
            inClass: 'fade-in-up-sm',
            outClass: 'fade-out-up-sm',
            inDuration: 800,
            outDuration: 700,
            linkElement: 'a:not([target="_blank"]):not([href^="#"]):not([href^="mailto"]):not(.lightbox-link):not(.comment-reply-link):not(.input-control submit):not(.ab-item)',
            loading: false,
            unSupportCss: [
            'animation-duration',
            '-webkit-animation-duration',
            '-o-animation-duration'
            ],
        });

        a('#respond #comment, #respond #email, #respond #author, #respond #submit').bind('focus blur', function () {
            a('.comment-form').toggleClass('js--focus');
            a('.comment-form-author').toggleClass('js--focus');
            a('.comment-form-email').toggleClass('js--focus');
            a('#respond .form-submit').toggleClass('js--focus');
        });

        a('#commentform textarea#comment').attr('placeholder', york_translation.york_comment );
        a('#commentform input#author').attr('placeholder', york_translation.york_author);
        a('#commentform input#email').attr('placeholder', york_translation.york_email);

	    /* Enable menu toggle for small screens */ 
        a( '.mobile-menu-toggle' ).on( 'click', function() {
            body.toggleClass( 'nav-open' );
        } );

        a( '#nav-close' ).on( 'click', function() {
            body.toggleClass( 'nav-open' );
        } );

         a('.subscribe-field').bind('focus blur', function () {
            a(this).closest('.mc4wp-subscribe-wrapper').toggleClass('js--focus');
        });

        a(".subscribe-field").hover( function () {
            a(this).closest('.mc4wp-subscribe-wrapper').toggleClass('js--hover');
        });
	});

    a(window).load(function() {
        if (body.is('.york-front-page, .tax-portfolio_category, .tax-portfolio_tag')) {
            masonry();
        }
    });

    /* Resize functions */ 
    a(window).resize(function(){
         scrollingDiv();
    });

} )( jQuery );