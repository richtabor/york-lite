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

		// if ( $window.width() > 768 ) {
			sidebarSection.children().each( function() {
				if ( windowHeight < $( this ).outerHeight() ) {
					$( this ).parent().addClass( scroll );
				} else {
					$( this ).parent().removeClass( scroll );
				}
			});
		// }
	}

	function mobile_dropdowns() {
		var navigationHolder = $( '.main-navigation' );
		var dropdownOpener   = $( '.main-navigation .mobile-navigation--arrow, main-navigation h6, .main-navigation a.york-mobile-no-link' );
		var animationSpeed   = 200;

		if ( dropdownOpener.length ) {
			dropdownOpener.each( function() {
				$( this ).on( 'tap click', function(e) {
					var dropdownToOpen = $( this ).nextAll( 'ul' ).first();

					if ( dropdownToOpen.length ) {
						e.preventDefault();
						e.stopPropagation();

						var openerParent = $( this ).parent( 'li' );
						if ( dropdownToOpen.is( ':visible' ) ) {
							dropdownToOpen.slideUp( animationSpeed );
							openerParent.removeClass( 'york-opened' );
						} else {
							dropdownToOpen.slideDown( animationSpeed );
							openerParent.addClass( 'york-opened' );
						}
					}
				});
			});
		}
	}

	/* Document Ready */
	$( document ).ready(function() {

		scrollingDiv();

		mobile_dropdowns();

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

		/* Enable menu toggle for small screens */
		$( '.mobile-menu-toggle' ).on( 'click', function() {
			if ( body.hasClass( open ) ) {
				body.removeClass( open );
				setTimeout(function() {
					body.removeClass( finished );
				}, 300);
			} else {
				body.addClass( open );
				setTimeout(function() {
					body.removeClass( finished );
				}, 600);
			}
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
