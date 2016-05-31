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

    wp.customize( 'body_secondary_typography_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="secondary-typography-color">body .post-meta a, body .post-meta span, body .post-meta span:before, body .project-meta p, body .project-meta p:before, body .widget_bean_tweets a.twitter-time-stamp { color: ' + newval + '!important; }</style>';

            el =  $( '.secondary-typography-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'body_typography_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="body-typography-color">body,body button,body input,body select,body textarea, p a:hover,body #content a:hover, body .widget-area a:hover, body #modal-content a:hover,body .tagcloud > a, body .tagcloud > a:hover, body .post-meta a:hover, body .project-meta a:hover { color: ' + newval + '!important; } body blockquote { border-color: ' + newval + '!important; }</style>';

            el =  $( '.body-typography-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_background_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="background-color">body.logged-in, body .site-header, body .site-footer { background: ' + newval + '!important; }</style>';

            el =  $( '.background-color' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_project_modal', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="project-modal">body .modal-content--show { background: ' + newval + '; }</style>';

            el =  $( '.project-modal' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_background_color', function( value ) {
        value.bind( function( newval ) {
            $('').css('background', newval );
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

    wp.customize( 'york_project_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="project--color-std-js">body .project--color-std, body .projects .pagination a.next { background: ' + newval + '; }</style>';

            el =  $( '.project--color-std-js' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_projecthover_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="project--color-a-hover">body .project--color-hover, body .projects .pagination a.next:hover { background-color: ' + newval + '; }</style>';

            el =  $( '.project--color-a-hover' );

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

    wp.customize( 'york_footertexthover_color', function( value ) {
        value.bind( function( newval ) {
            var style, el;
            style = '<style class="site-footer-a-hover">body #colophon.site-footer span:not(.badge--hire-me) a:hover { color: ' + newval + '; }</style>';

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

    wp.customize( 'york_badge_color', function( value ) {
        value.bind( function( newval ) {
            $('body .badge--hire-me a').css('border-color', newval );
            $('body .badge--hire-me a').css('color', newval );

            var style, el;
            style = '<style class="badge--hire-me-a-hover">body .badge--hire-me a:hover { background-color: ' + newval + '; }</style>';

            el =  $( '.badge--hire-me-a-hover' );

            if ( el.length ) {
                el.replaceWith( style ); // style element already exists, so replace it
            } else {
                $( 'head' ).append( style ); // style element doesn't exist so add it
            }
        } );
    } );

    wp.customize( 'york_hireme_badge_shake', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.badge--hire-me a' ).addClass( 'animation--shake' );
            } else {
                $( '.badge--hire-me a' ).removeClass( 'animation--shake' );
            }
        } );
    } );

    wp.customize( 'powered_by_york', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.site-theme' ).removeClass( 'hidden' );
            } else {
                $( '.site-theme' ).addClass( 'hidden' );
            }
        } );
    } );

    wp.customize( 'powered_by_wordpress', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.powered-by' ).removeClass( 'hidden' );
            } else {
                $( '.powered-by' ).addClass( 'hidden' );
            }
        } );
    } );

    wp.customize( 'york_hireme_badge', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.badge--hire-me' ).removeClass( 'hidden' );
            } else {
                $( '.badge--hire-me' ).addClass( 'hidden' );
            }
        } );
    } );

    wp.customize( 'york_hireme_badge_text', function( value ) {
        value.bind( function( newval ) {
            $( '.badge--hire-me a' ).html( newval );
        } );
    } );

    wp.customize( 'york_hireme_badge_url', function( value ) {
        value.bind( function( newval ) {
            $( '.badge--hire-me a' ).attr( 'href', newval );
        } );
    } );

    wp.customize( 'nav_social_icons', function( value ) {
        value.bind( function( to ) {
            if ( true === to ) {
                $( '.sidebar .sidebar-social' ).removeClass( 'hidden' );
            } else {
                $( '.sidebar .sidebar-social' ).addClass( 'hidden' );
            }
        } );
    } );

	wp.customize( 'contact_button', function( value ) {
		value.bind( function( newval ) {
			$( '.bean-contact-form .button' ).html( newval );
		} );
	} );

	wp.customize( 'portfolio_cta_button', function( value ) {
		value.bind( function( newval ) {
			$( '.project-form .button' ).html( newval );
		} );
	} );

	wp.customize( 'portfolio_cta_email', function( value ) { } );

	wp.customize( 'contact_email', function( value ) { } );

} )( jQuery );