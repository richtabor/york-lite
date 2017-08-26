/**
 * Theme javascript functions file.
 *
 */
( function( $ ) {
	"use strict";

	var  
	body		= $( 'body' ),
	projects	= $( '#projects'),
	active	 	= ( 'js--active' ),
	loaded		= ( 'js--loaded' );

	/**
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	/* Portfolio Masonry */ 
	function masonry() {

		var container = projects.imagesLoaded( function() {
			container.isotope({
				itemSelector: '.project',
				layoutMode: 'masonry',
				masonry: {
					columnWidth: 50
				}
			});
		});

		// Infinite Scroll.
		container.infinitescroll({

			navSelector  : "#page_nav",
			nextSelector : "#page_nav a",
			itemSelector : ".project",
			},

			// Trigger Masonry as a callback.
			function( newElements ) {

			// Hide new items while they are loading.
			var newElems = $( newElements ).addClass( 'js--loading' );

			// Ensure that images load before adding to masonry layout.
			newElems.imagesLoaded( function(){

				// Show elems now they're ready.
				newElems.each( function(a) {

				setTimeout( function() {
					newElems.eq(a).addClass( 'js--loaded' );
				}, 150 * a);
			}),
				
			container.isotope( 'appended', newElems, true );
			});
		});
	}

	function scrollingDiv() {
		var 
		$window 	= $(window),
		windowHeight	= $(window).height(),
		sidebarSection  = $( '.sidebar--section' ),
		scroll		= ( 'js--scroll' );

		if ( $window.width() > 768 ) {
			sidebarSection.children().each(function(){
				if ( windowHeight < $(this).innerHeight() ) {
					$(this).parent().addClass(scroll);
				} else {
					$(this).parent().removeClass(scroll);
				}
			});
		}
	}

	function mobile_dropdowns() {
		var navigationHolder = $( '.main-navigation' );
		var dropdownOpener = $( '.main-navigation .mobile-navigation--arrow, main-navigation h6, .main-navigation a.york-mobile-no-link' );
		var animationSpeed = 200;

		if(dropdownOpener.length) {
			dropdownOpener.each(function() {
			$(this).on('tap click', function(e) {
				var dropdownToOpen = $(this).nextAll('ul').first();

				if(dropdownToOpen.length) {
				e.preventDefault();
				e.stopPropagation();

				var openerParent = $(this).parent('li');
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
	$( document ).ready(function() {
		
		scrollingDiv();

		supportsInlineSVG();

		body.fitVids();

		mobile_dropdowns();
		
		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

		/* Close the flyout when you click a menu item in the mobile menu */ 
		$( '#site-navigation .menu-item a' ).on( 'click', function() {
			body.removeClass( 'nav-open' );
		} );

		$( '.animsition' ).animsition({
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

		/* Comments */ 
		$( '#respond #comment, #respond #email, #respond #author, #respond #submit' ).bind( 'focus blur', function () {
			$( '.comment-form' ).toggleClass( 'js--focus' );
			$( '.comment-form-author' ).toggleClass( 'js--focus' );
			$( '.comment-form-email' ).toggleClass( 'js--focus' );
			$( '#respond .form-submit' ).toggleClass( 'js--focus' );
		});

		$( '#commentform textarea#comment').attr('placeholder', york_translation.york_comment );
		$( '#commentform input#author').attr('placeholder', york_translation.york_author);
		$( '#commentform input#email').attr('placeholder', york_translation.york_email);

		/* Enable menu toggle for small screens */ 
		$( '.mobile-menu-toggle' ).on( 'click', function() {
			body.toggleClass( 'nav-open' );
		} );

		$( '#nav-close' ).on( 'click', function() {
			body.toggleClass( 'nav-open' );
		} );

		$( '.subscribe-field' ).bind('focus blur', function () {
			$(this).closest('.mc4wp-subscribe-wrapper').toggleClass( 'js--focus' );
		});

		$( '.subscribe-field' ).hover( function () {
			$(this).closest('.mc4wp-subscribe-wrapper').toggleClass( 'js--hover' );
		});
	});

	$(window).load(function() {
		if ( body.is( '.york-front-page, .tax-portfolio_category, .tax-portfolio_tag' ) ) {
			masonry();
		}
	});

	$(window).resize(function(){
		scrollingDiv();
	});

} )( jQuery );
