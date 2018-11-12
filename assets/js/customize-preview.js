/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title a' ).html( newval );
		} );
	} );

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( newval ) {
			$( 'body .custom-logo-link img' ).css( 'width', newval );
		} );
	} );

	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$( 'body .sidebar' ).css( 'background-color', newval );
		} );
	} );

	wp.customize( 'text_color', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'heading_color', function( value ) {
		value.bind( function( newval ) {
			$( 'h1, h2, h3, h4, h5, h6' ).css( 'color', newval );
			$( '.main-navigation a, .mobile-navigation--arrow' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'overlay_color', function( value ) {
		value.bind( function( newval ) {
			var style, el;
			style = '<style class="overlay_color">body .project .overlay { background: ' + newval + '!important; }</style>';

			el = $( '.overlay_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'overlay_text_color', function( value ) {
		value.bind( function( newval ) {
			var style, el;
			style = '<style class="overlay_text_color">body .project .overlay h3 { color: ' + newval + '!important; } body .lightbox-play svg { fill: ' + newval + '!important; } </style>';

			el = $( '.overlay_text_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

} )( jQuery );
