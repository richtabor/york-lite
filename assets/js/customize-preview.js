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

	wp.customize( 'text_color', function( value ) {
		value.bind( function( newval ) {
			$( 'body, body th, body input, body mark, body button, body select, body textarea, body .comment-meta, body comment-author, body .comment-meta a, body .comment-author a, body .comment-meta a:hover, body .comment-author a:hover, body .page-links a, body .pagination a, body .pagination span, body .add-a-menu, body .main-navigation ul ul li a:hover, body .page-links a, body .main-navigation a:not(.add-a-menu), body .wp-caption-text, body.single .navigation a, body .entry-content a:hover, body  .entry-content a:focus ' ).css( 'color', newval );

			$( 'body .social-navigation li svg' ).css( 'fill', newval );

			var style, el;
			style = '<style class="text_color">body .mobile-navigation--arrow:after { border-color: ' + newval + '; } .hamburger-inner, .hamburger-inner::before, .hamburger-inner::after { background-color: ' + newval + '; } </style>';

			el = $( '.text_color' );

			if ( el.length ) {
				el.replaceWith( style );
			} else {
				$( 'head' ).append( style );
			}
		} );
	} );

	wp.customize( 'text_color', function( value ) {
		value.bind( function( newval ) {

		} );
	} );

} )( jQuery );
