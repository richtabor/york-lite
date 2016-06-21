/**
 * Theme javascript functions file.
 *
 */
( function( a ) {
	"use strict";

	var  
        body        = a("body"),
		active        = ("js--active"),
		projects =   a('#projects'),
        preload = ('js--preload'),
        loaded = ('js--loaded');

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

            errorCallback : function(selector, msg) {
                a('.cta').addClass(active);
                a('.cta-spacer').addClass(active);
            },

            // selector for the paged navigation (it will be hidden)
            navSelector  : "#page_nav",
            // selector for the NEXT link (to page 2)
            nextSelector : "#page_nav a",
            // selector for all items you'll retrieve
            itemSelector : ".project",
            // animation: false,
            // bufferPx : 1000,   
            // finished message
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

    function i() {
        projects.find(".project").each(function(b) {
            var c = a(this),
            d = Math.floor(300 * Math.random() + 101) * b;
            setTimeout(function() {
                c.addClass(active)
            }, d)
        })
    }

    function lineDraw() {
         if (body.hasClass('error404')) {    
          var path = document.querySelector('.animation-404 path');
          var length = path.getTotalLength();
          // Clear any previous transition
          path.style.transition = path.style.WebkitTransition ='none';
          // Set up the starting positions
          path.style.strokeDasharray = length + ' ' + length;
          path.style.strokeDashoffset = length;
          // Trigger a layout so styles are calculated & the browser 
          // picks up the starting position before animating
          path.getBoundingClientRect();
          // Define our transition
          path.style.transition = path.style.WebkitTransition =
            'stroke-dashoffset 6s ease-in-out';
          // Go!
          path.style.strokeDashoffset = '0';
          //0 is the image fully animated, 988.01 is the starting point.
        }
    };

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

	/* Document Ready */
	a(document).ready(function() {
        i();
        scrollingDiv();

        a(".animsition").animsition({
            inClass: 'fade-in-up-sm',
            outClass: 'fade-out-up-sm',
            inDuration: 800,
            outDuration: 600,
            linkElement: 'a:not([target="_blank"]):not(.lightbox-link):not(.input-control submit)',
            loading: false,
            unSupportCss: [
            'animation-duration',
            '-webkit-animation-duration',
            '-o-animation-duration'
            ],
        });

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
        if (body.is('.page-template-template-portfolio-php, .search, .blog, .archive')) {
            masonry();
        }
        lineDraw();
    });

    /* Resize functions */ 
    a(window).resize(function(){
         scrollingDiv();
    });

} )( jQuery );