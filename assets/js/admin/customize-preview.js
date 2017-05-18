/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
 
( function( $ ) {

	//LIVE HTML
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-logo-link a' ).html( newval );
		} );
	} );
	
	wp.customize( 'site_logo_width', function( value ) {
        value.bind( function( newval ) {
            $('.custom-logo-link img').css('width', newval );
        } );
    } );

    wp.customize( 'york_background_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="background-color">body.logged-in, body .site { background: ' + newval + '!important; }</style>';

            el =  $( '.background-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_sitetitle_color', function( value ) {
        value.bind( function( newval ) {
            $('body h1.site-logo-link').css('color', newval );
        } );
    } );

    wp.customize( 'header_typography_color', function( value ) {
        value.bind( function( newval ) {
            $('body h1, body h2, body h3, body h4, body h5, body .main-navigation a').css('color', newval );

            var style, el;
            style = '<style class="header-typography-color"> body .cd-words-wrapper::after, body .cd-words-wrapper.selected { background-color: ' + newval + '!important; }</style>';

            el =  $( '.header-typography-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_sidebarsocial_color', function( value ) {
        value.bind( function( newval ) {
            $('body .sidebar .social-navigation svg').css('fill', newval );
        } );
    } );

    wp.customize( 'york_sitetitlehover_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="site-logo-link-a-hover">body h1.site-logo-link a:hover { color: ' + newval + '!important; }</style>';

            el =  $( '.site-logo-link-a-hover' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_navigationicon_color', function( value ) {
        value.bind( function( newval ) {
            $('body .button--close span, body .mobile-menu-toggle span').css('background', newval );
        } );
    } );

    wp.customize( 'york_navigationiconhover_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="mobile-menu-toggle-a-hover">body .button--close:hover span, body .mobile-menu-toggle:hover span { background-color: ' + newval + '; }</style>';

            el =  $( '.mobile-menu-toggle-a-hover' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_footertext_color', function( value ) {
        value.bind( function( newval ) {
            $('body .site-footer').css('color', newval );
        } );
    } );

    wp.customize( 'york_footernav_a_color', function( value ) {
        value.bind( function( newval ) {
            $('body .site-footer .footer-navigation a').css('color', newval );
        } );
    } );

    wp.customize( 'york_footertexthover_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="site-footer-a-hover">body #colophon.site-footer span a:hover, body .site-footer .footer-navigation a:hover { color: ' + newval + '; }</style>';

            el =  $( '.site-footer-a-hover' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_footersocial_color', function( value ) {
        value.bind( function( newval ) {
            $('body .site-footer .social-navigation svg').css('fill', newval );
        } );
    } );

    wp.customize( 'portfolio_single_navigation', function( value ) {
        value.bind( function( newval ) {
            if ( true === newval ) {
                $( '.project-navigation' ).removeClass( 'hidden' );
            } else {
                $( '.project-navigation' ).addClass( 'hidden' );
            }
        } );
    } );

    wp.customize( 'york_overlay_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="project-overlay-color">body .project .overlay { background: ' + newval + '!important; }</style>';

            el =  $( '.project-overlay-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_overlay_text_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="project-overlay-text-color">body .project .overlay h3 { color: ' + newval + '!important; } body .lightbox-play svg { fill: ' + newval + '!important; } </style>';

            el =  $( '.project-overlay-text-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

} )( jQuery );