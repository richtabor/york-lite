<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package York
 */

if ( !function_exists('Bean_Customize_Variables') ) {

function Bean_Customize_Variables() {

		// Colors
		$theme_accent_color = get_theme_mod('theme_accent_color', '#52bad5');
        $background_color = get_theme_mod('york_background_color', '#ffffff'); 
        $sitetitle_color = get_theme_mod('york_sitetitle_color', '#000000');
        $sitetitlehover_color = get_theme_mod('york_sitetitlehover_color', '#52bad5');
        $navigationicon_color = get_theme_mod('york_navigationicon_color', '#000000');
        $navigationiconhover_color = get_theme_mod('york_navigationiconhover_color', '#000000');
        $footertext_color = get_theme_mod('york_footertext_color', '#000000');
        $footernav_a_color = get_theme_mod('york_footernav_a_color', '#909090');
        $footertexthover_color = get_theme_mod('york_footertexthover_color', '#52bad5');
        $footersocial_color = get_theme_mod('york_footersocial_color', '#000000');
        $sidebarsocial_color = get_theme_mod('york_sidebarsocial_color', '#000000');
        $cta_background_color = get_theme_mod('york_cta_background_color', '#1c1c1c');
        $cta_text_color = get_theme_mod('york_cta_text_color', '#ffffff');
        $cta_shape_color = get_theme_mod('york_cta_shape_color', '#ffffff');
        $overlay_color = get_theme_mod('york_overlay_color', '#000000');
        $overlay_text_color = get_theme_mod('york_overlay_text_color', '#ffffff');
        $cta_shape_color_rgb = york_hex2rgb( $cta_shape_color );
        $portfolio_social_color = get_theme_mod('york_portfolio_social_color', '#000000');

        // Convert main text hex color to rgba.
        $theme_accent_color_rgb = york_hex2rgb( $theme_accent_color );

        //If the rgba values are empty return early.
        if ( empty ( $theme_accent_color_rgb ) ) {
            return;
        }

        $rgb_10_opacity  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.075)', $theme_accent_color_rgb );
        $rgb_50_opacity  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.25)', $theme_accent_color_rgb );
        $rgb_15_opacity  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.15)', $cta_shape_color_rgb );

		$body_typography_color = get_theme_mod('body_typography_color', '#000');
		$header_typography_color = get_theme_mod('header_typography_color', '#000'); 
        $body_secondary_typography_color = get_theme_mod('body_secondary_typography_color', '#909090');
        
        $body_font_family = get_theme_mod('body_font_family', 'Karla'); 
		$body_font_size = get_theme_mod('body_font_size', '15');
		$body_line_height = get_theme_mod('body_line_height', '26');

		$pagetitle_font_family = get_theme_mod('pagetitle_font_family', 'Karla');
		$pagetitle_font_size = get_theme_mod('pagetitle_font_size', '26');
		$pagetitle_line_height = get_theme_mod('pagetitle_line_height', '26');
		?>

		<style>

			<?php
			$customizations = 
			'
        
            body .share-toggle + label {
                background:'.$portfolio_social_color.';
            }   

            body .share-menu-item svg {
                fill:'.$portfolio_social_color.';
            }   

            body .project .overlay {
                background:'.$overlay_color.';
            }

            body .project .overlay h3 {
                color:'.$overlay_text_color.';
            }

            body .lightbox-play svg {
                fill:'.$overlay_text_color.';
            }

            body .cta {
                background:'.$cta_background_color.' !important;
            }

            body .cta h2 {
                color:'.$cta_text_color.' !important;
            }

            body .cta h2 i {
                border-color:'.$rgb_15_opacity.' !important;   
            }

            body .cta svg {
                fill:'.$cta_shape_color.' !important;
            }

            body, 
            body .site {
                background-color:'.$background_color.' !important;
            }

            body .cta a:after {
                border-color: '.$background_color.';
            }

            body .cd-words-wrapper.selected b {
                color: '.$background_color.';
            }
            
            body h1.site-logo-link {
                color: '.$sitetitle_color.' ;
                border-color: '.$sitetitle_color.' ;
            }

            body h1.site-logo-link:hover,
            body h1.site-logo-link:focus {
                border-color: '.$sitetitlehover_color.' ;
            }
            
            body h1.site-logo-link a:hover {
                color: '.$sitetitlehover_color.'!important;
                border-color: '.$sitetitlehover_color.'!important;
            }

            body .mobile-menu-toggle span {
                background:'.$navigationicon_color.';
            }

            body .mobile-menu-toggle:hover span,
            body.nav-open .mobile-menu-toggle span {
                background-color:'.$navigationiconhover_color.';
            }

            body .site-footer {
                color:'.$footertext_color.';
            }

            body .site-footer .footer-navigation a {
                color:'.$footernav_a_color.';
            }

            body #colophon.site-footer span a:hover {
                color:'.$footertexthover_color.';
            }

            body .site-footer .social-navigation svg { 
                fill:'.$footersocial_color.'; 
            }

            body #content a:hover,
            body #content a:focus {
                color:'.$theme_accent_color.'!important;
                border-color:'.$theme_accent_color.'!important;
            }

            body .js--focus .input-control::before {
                background:'.$theme_accent_color.';
            }

            body .js--focus .input-control::after {
                border-color:'.$theme_accent_color.';
            }

            body button,
            body .button,
            body button[disabled]:hover,
            body button[disabled]:focus,
            body input[type="button"],
            body input[type="button"][disabled]:hover,
            body input[type="button"][disabled]:focus,
            body input[type="reset"],
            body input[type="reset"][disabled]:hover,
            body input[type="reset"][disabled]:focus,
            body input[type="submit"],
            body input[type="submit"][disabled]:hover,
            body input[type="submit"][disabled]:focus {
                background-color:'.$theme_accent_color.';
            }

            article .yorkup--highlight {
                background-image: linear-gradient(to bottom, '.$rgb_10_opacity.', '.$rgb_10_opacity.');
            }

            body.single-portfolio .navigation a:hover {
                color:'.$theme_accent_color.' !important;
                border-color:'.$theme_accent_color.' !important;
            }
            
            body,
            body.single,
            body.page,
            body.home,
            body.blog,
            body button,
            body input,
            body select,
            body textarea,
            p a:hover {
                color: '.$body_typography_color.'; 
            }

            body #content a:hover,
            body .main-navigation a:hover {
                color: '.$theme_accent_color.'; 
            }
            
            body blockquote {
                border-color: '.$body_typography_color.'; 
            }

            body .tagcloud > a,
            body .tagcloud > a:hover,
            body .post-meta a:hover,
            body .project-meta a:hover {
                color: '.$body_typography_color.'!important; 
            }

            body .post-meta a, 
            body .post-meta span, 
            body .post-meta span:before,
            body .project-meta p, 
            body .project-taxonomy,
            body .project-taxonomy a,
            body .project-meta p:before,
            body .widget_bean_tweets a.twitter-time-stamp  {
                color: '.$body_secondary_typography_color.'!important; 
            }

            body blockquote cite,
            body blockquote small {
                color: '.$body_secondary_typography_color.';
            }

            body h1,
            body h2,
            body h3,
            body h4,
            body h5,
            body .project-caption,
            body .main-navigation a {
                color: '.$header_typography_color.'; 
            }

            body.single .navigation a {
                color: '.$header_typography_color.' !important; 
            }

            body .cd-words-wrapper::after,
            body .cd-words-wrapper.selected {
                background-color: '.$header_typography_color.'; 
            }

            body .sidebar .social-navigation svg { 
                fill:'.$sidebarsocial_color.'; 
            }

			a:hover,
			a:focus,
			body .site-footer a:hover, 
			body .header .project-filter a:hover,
			body .header .main-navigation a:hover,
			body .header .project-filter a.active, 
			.logo_text:hover,
			.current-menu-item a, 
			.page-links a span:not(.page-links-title):hover,
			.page-links span:not(.page-links-title) { color:'.$theme_accent_color.'; }

			.cats,
			h1 a:hover, 
			.logo a h1:hover,
			.tagcloud a:hover,
			.entry-meta a:hover,
			.header-alt a:hover,
			.post-after a:hover,
			.bean-tabs > li.active > a,
			.bean-panel-title > a:hover,
			.archives-list ul li a:hover,
			.bean-tabs > li.active > a:hover,
			.bean-tabs > li.active > a:focus,
			.bean-pricing-table .pricing-column li.info:hover { 
				color:'.$theme_accent_color.'!important; 
			}

			body button:hover,
			body button:focus,
			body .button:hover,
			body .button:focus,
			body input[type="button"]:hover,
			body input[type="button"]:focus,
			body input[type="reset"]:hover,
			body input[type="reset"]:focus,
			body input[type="submit"]:hover,
			body input[type="submit"]:focus {
				border-color:'.$theme_accent_color.'; 
			}

            body input[type="text"]:focus,
            body input[type="email"]:focus,
            body input[type="url"]:focus,
            body input[type="password"]:focus,
            body input[type="search"]:focus,
            body textarea:focus {
                border-color:'.$theme_accent_color.'; 
            }

			button:hover,
			button:focus,
			.button:hover,
			.button:focus,
			input[type="button"]:hover,
			input[type="button"]:focus,
			input[type="reset"]:hover,
			input[type="reset"]:focus,
			input[type="submit"]:hover,
			input[type="submit"]:focus,
			.bean-btn,
			.tagcloud a,
			nav a h1:hover, 
			div.jp-play-bar,
			div.jp-volume-bar-value,
			.bean-direction-nav a:hover,
			.bean-pricing-table .table-mast,
			.entry-categories a:hover, 
			.bean-contact-form .bar:before { 
				background-color:'.$theme_accent_color.'; 
			}

			.bean-btn { border: 1px solid '.$theme_accent_color.'!important; }
			.bean-quote { background-color:'.$theme_accent_color.'!important; }
			';  

			$css_filter_style = get_theme_mod( 'css_filter' );
			if( $css_filter_style != '' ) {
				switch ( $css_filter_style ) {
					case 'none':
					break;
					case 'grayscale':
					echo '.project .project-inner { filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale"); filter:gray; -webkit-filter:grayscale(100%);-moz-filter: grayscale(100%);-o-filter: grayscale(100%);}';
					break;
					case 'sepia':
					echo '.project .project-inner { -webkit-filter: sepia(30%); }';
					break;    
				}
			}


			/**
			 * Combine the values from above and minifiy them.
			 */
			$customizer_final_output =  $customizations ;

			$final_output = preg_replace('#/\*.*?\*/#s', '', $customizer_final_output);
			$final_output = preg_replace('/\s*([{}|:;,])\s+/', '$1', $final_output);
			$final_output = preg_replace('/\s\s+(.*)/', '$1', $final_output);
			echo $final_output;
			?>
		</style>

<?php } 
add_action( 'wp_head', 'Bean_Customize_Variables', 1 );
}