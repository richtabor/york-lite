/**
 * Theme javascript functions file.
 *
 */
( function( $ ) {
	"use strict";

	var
	body		= $( 'body' ),
	projects	= $( '#projects' ),
	active	 	= ( 'js--active' ),
	loaded		= ( 'js--loaded' ),
	focus	 	= ( 'js--focus' ),
	open	 	= ( 'nav-open' ),
	finished	= ( 'nav-finished' );

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
			container.masonry({
				itemSelector: '.project',
				transitionDuration: '.75s',
			});
		});
	}

	function scrollingDiv() {
		var
		$window 	= $( window ),
		windowHeight	= $( window ).height(),
		sidebarSection  = $( '.sidebar--section' ),
		scroll		= ( 'js--scroll' );

		if ( $window.width() > 768 ) {
			sidebarSection.children().each( function() {
				if ( windowHeight < $( this ).innerHeight() ) {
					$( this ).parent().addClass( scroll );
				} else {
					$( this ).parent().removeClass( scroll );
				}
			});
		}
	}

	/* Document Ready */
	$( document ).ready(function() {

		scrollingDiv();

		supportsInlineSVG();

		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

		if ( body.is( '.york-front-page, .tax-portfolio_category, .tax-portfolio_tag' ) ) {
			masonry();
		}

		/* Close the flyout when you click a menu item in the mobile menu */
		$( '#site-navigation .menu-item a' ).on( 'click', function() {
			body.removeClass( open );
		} );

		/* Comments */
		$( '#respond #comment, #respond #email, #respond #author, #respond #submit' ).bind( 'focus blur', function () {
			$( '.comment-form' ).toggleClass( focus );
			$( '.comment-form-author' ).toggleClass( focus );
			$( '.comment-form-email' ).toggleClass( focus );
			$( '#respond .form-submit' ).toggleClass( focus );
		});

		$( '#commentform textarea#comment' ).attr( 'placeholder', york_translation.york_comment );
		$( '#commentform input#author' ).attr( 'placeholder', york_translation.york_author );
		$( '#commentform input#email' ).attr( 'placeholder', york_translation.york_email );

		/* Enable menu toggle for small screens */
		$( '.mobile-menu-toggle' ).on( 'click', function() {
			body.toggleClass( open );

			setTimeout(function() {
	        		body.toggleClass( finished );
	        	}, 400);
		} );

		$( '#nav-close' ).on( 'click', function() {
			body.toggleClass( open );
		} );

		$( '.subscribe-field' ).bind('focus blur', function () {
			$( this ).closest( '.mc4wp-subscribe-wrapper' ).toggleClass( focus );
		});

		$( '.subscribe-field' ).hover( function () {
			$( this ).closest( '.mc4wp-subscribe-wrapper' ).toggleClass( 'js--hover' );
		});
	});

	$( window ).resize(function(){
		scrollingDiv();
	});

} )( jQuery );
