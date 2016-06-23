<?php
/**
 * York Customizer functionality
 *
 * @package York
 */


/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function bean_customize_register( $wp_customize ) {

	

	/**
	 * Remove unnecessary controls.
	 */
	$wp_customize->remove_section( 'colors');
	$wp_customize->remove_section( 'background_image');
    $wp_customize->remove_control( 'site_logo_header_text');
	$wp_customize->remove_control('background_color');



    /**
     * Add custom controls.
     */
    require get_template_directory() . '/inc/customizer/custom-controls/content.php';
    require get_template_directory() . '/inc/customizer/custom-controls/range.php';

    

	/**
	 * Top-Level Customizer sections and panels.
	 */

	// Add the Theme Options top-level panel.
	$wp_customize->add_panel( 'york_theme_options', array(
		'title' 						=> esc_html__( 'Settings', 'york' ),
		'description' 					=> esc_html__( 'Customize various options throughout the theme with the settings within this panel.', 'york' ),
		'priority' 					=> 1,
	) );



	/**
	 * Theme Customizer Sections.
	 * For more information on Theme Customizer settings and default sections:
	 *
 	 * @see https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */



    /**
     * Add the colors section.
     */
    $wp_customize->add_section( 'york_pro_colors', array(
        'title'                 => esc_html__( 'Colors', 'york' ),
        'panel'                 => 'york_theme_options',
    ) );

            // Upsell content.
            $wp_customize->add_setting( 'york_pro_colors_content', array(
                'default'               => '',
                'sanitize_callback'     => 'bean_sanitize_nohtml',
            ) );

            $wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'york_pro_colors_content', array(
                'type'              => 'content',
                'label'                 => esc_html__( 'Customize Colors', 'york' ),
                 'description'          => sprintf( __( '<a target="_blank" href="%1$s" class="button button-primary">Upgrade to York Pro - $59</a>', 'york' ), esc_url( PRO_UPGRADE_URL ) ),
                'section'               => 'york_pro_colors',
                'input_attrs'           => array( 'content' => __( '<p>Upgrade to York Pro to customize the theme color pallete to your liking.</p>', 'york' ) 
                ),
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'theme_accent_color', array(
                'default'               => '#52bad5',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_accent_color', array(
                'label'             => esc_html__( 'Accent Color', 'york' ),
                'section'               => 'york_pro_colors',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_background_color', array(
                'default'               => '#ffffff',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_background_color', array(
                'label'                 => esc_html__( 'Background', 'york' ),
                'section'               => 'york_pro_colors',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'body_typography_color', array(
                'default'               => '#000',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_typography_color', array(
                'label'             => esc_html__( 'Text Color', 'york' ),
                'section'               => 'york_pro_colors',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'body_secondary_typography_color', array(
                'default'               => '#909090',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_secondary_typography_color', array(
                'label'             => esc_html__( 'Secondary Text Color', 'york' ),
                'section'               => 'york_pro_colors',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'header_typography_color', array(
                'default'               => '#000',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_typography_color', array(
                'label'             => esc_html__( 'Header Color', 'york' ),
                'section'               => 'york_pro_colors',
            ) ) );



    /**
     * Add the header section.
     */
    $wp_customize->add_section( 'york_pro_header', array(
        'title'                 => esc_html__( 'Header', 'york' ),
        'panel'                 => 'york_theme_options',
    ) );

            // Upsell content.
            $wp_customize->add_setting( 'york_pro_header_content', array(
                'default'               => '',
                'sanitize_callback'     => 'bean_sanitize_nohtml',
            ) );

            $wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'york_pro_header_content', array(
                'type'              => 'content',
                'label'                 => esc_html__( 'Extend the Header', 'york' ),
                 'description'          => sprintf( __( '<a target="_blank" href="%1$s" class="button button-primary">Upgrade to York Pro - $59</a>', 'york' ), esc_url( PRO_UPGRADE_URL ) ),
                'section'               => 'york_pro_header',
                'input_attrs'           => array( 'content' => __( '<p>Upgrade to York Pro to add social navigational icons to your sidebar flyout and customize various colors throughout the header element.</p>', 'york' ) 
                ),
            ) ) );

            // Add the hire me badge selector setting and control.
            $wp_customize->add_setting( 'nav_social_icons', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_checkbox',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'nav_social_icons', array(
                'type'              => 'checkbox',
                'label'             => esc_html__( 'Navigation Social Icons', 'york' ),
                'description'       => esc_html__( 'Display the social icons below the site navigation in the sidebar flyout.', 'york' ),
                'section'           => 'york_pro_header',
            ) );

             //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_sitetitle_color', array(
                'default'               => '#000000',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_sitetitle_color', array(
                'label'                 => esc_html__( 'Site Title', 'york' ),
                'section'               => 'york_pro_header',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_sitetitlehover_color', array(
                'default'               => '#52bad5',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_sitetitlehover_color', array(
                'label'                 => esc_html__( 'Site Title Hover', 'york' ),
                'section'               => 'york_pro_header',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_navigationicon_color', array(
                'default'               => '#000000',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_navigationicon_color', array(
                'label'                 => esc_html__( 'Navigation Icon', 'york' ),
                'section'               => 'york_pro_header',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_navigationiconhover_color', array(
                'default'               => '#52bad5',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_navigationiconhover_color', array(
                'label'                 => esc_html__( 'Navigation Icon Hover', 'york' ),
                'section'               => 'york_pro_header',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_sidebarsocial_color', array(
                'default'               => '#000000',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_sidebarsocial_color', array(
                'label'                 => esc_html__( 'Social Icons', 'york' ),
                'section'               => 'york_pro_header',
            ) ) );



	/**
	 * Add the portfolio section.
	 */
	$wp_customize->add_section( 'york_pro_portfolio', array(
		'title' 						=> esc_html__( 'Portfolio', 'york' ),
		'panel'       					=> 'york_theme_options',
	) );

            // Upsell content.
            $wp_customize->add_setting( 'york_pro_portfolio_content', array(
                'default'               => '',
                'sanitize_callback'     => 'bean_sanitize_nohtml',
            ) );

            $wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'york_pro_portfolio_content', array(
                'type'              => 'content',
                'label'                 => esc_html__( 'Enhance your Portfolio', 'york' ),
                 'description'          => sprintf( __( '<a target="_blank" href="%1$s" class="button button-primary">Upgrade to York Pro - $59</a>', 'york' ), esc_url( PRO_UPGRADE_URL ) ),
                'section'               => 'york_pro_portfolio',
                'input_attrs'           => array( 'content' => __( '<p>Upgrade to York Pro to unlock the beautiful and swipeable lightbox image gallery, optimized lazy loading, post-to-post navigation, portfolio sharing and more!</p>', 'york' ) 
                ),
            ) ) );

            // Add the portfolio lightbox selector setting and control.
            $wp_customize->add_setting( 'york_portfolio_lightbox', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_checkbox',
            ) );

            $wp_customize->add_control( 'york_portfolio_lightbox', array(
                'type'              => 'checkbox',
                'label'                 => esc_html__( 'PhotoSwipe Lightbox', 'york' ),
                'description'           => esc_html__( 'Add a JavaScript image gallery to single views for mobile and desktop viewports, with touch gestures, zooming and optimized asset delivery.', 'york' ),
                'section'           => 'york_pro_portfolio',
            ) );

            // Add the portfolio lazy-loading selector setting and control.
            $wp_customize->add_setting( 'york_portfolio_lazyload', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_checkbox',
            ) );

            $wp_customize->add_control( 'york_portfolio_lazyload', array(
                'type'              => 'checkbox',
                'label'                 => esc_html__( 'Portfolio Lazy Loading', 'york' ),
                'description'           => esc_html__( 'Boosts performance by delaying the loading of images outside of the visible viewport.', 'york' ),
                'section'           => 'york_pro_portfolio',
            ) );

            // Add the portfolio social sharing selector setting and control.
            $wp_customize->add_setting( 'york_social_sharing', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_checkbox',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_social_sharing', array(
                'type'              => 'checkbox',
                'label'                 => esc_html__( 'Portfolio Sharing', 'york' ),
                'description'           => esc_html__( 'Add a social flyout menu on the singular portfolio views.', 'york' ),
                'section'           => 'york_pro_portfolio',
            ) );

            // Add the portfolio post count selector setting and control.
            $wp_customize->add_setting( 'portfolio_single_navigation', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_number_intval',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'portfolio_single_navigation', array(
                'type'                  => 'checkbox',
                'label'                 => esc_html__( 'Portfolio Navigation', 'york' ),
                'description'           => esc_html__( 'Enable the "Next" project post-to-post navigation element on single portfolio pages.', 'york' ),
                'section'               => 'york_pro_portfolio',
            ) );

			// Add the portfolio post count selector setting and control.
			$wp_customize->add_setting( 'portfolio_posts_count', array(
				'default'           	=> '',
				'sanitize_callback' 	=> 'bean_sanitize_number_intval',
			) );

			$wp_customize->add_control( 'portfolio_posts_count', array(
				'type' 				=> 'number',
				'label' 				=> esc_html__( 'Portfolio Count', 'york' ),
				'description' 			=> esc_html__( 'Set the number of posts to display on the portfolio template. Use "-1" to load them all.', 'york' ),
				'section'				=> 'york_pro_portfolio',
			) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_overlay_color', array(
                'default'               => '#ffffff',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_overlay_color', array(
                'label'                 => esc_html__( 'Overlay', 'york' ),
                'section'               => 'york_pro_portfolio',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_overlay_text_color', array(
                'default'               => '#000000',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_overlay_text_color', array(
                'label'                 => esc_html__( 'Overlay Text', 'york' ),
                'section'               => 'york_pro_portfolio',
            ) ) );

            // PRO: Add logo css filter setting and control.
            $wp_customize->add_setting( 'css_filter', array( 
                'default'           => 'none', 
                'sanitize_callback'     => '',
            ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_portfolio_social_color', array(
                'default'               => '#000000',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_portfolio_social_color', array(
                'label'                 => esc_html__( 'Social Share Color', 'york' ),
                'section'               => 'york_pro_portfolio',
            ) ) );

            // PRO: Add logo css filter setting and control.
            $wp_customize->add_setting( 'css_filter', array( 
                'default'           => 'none', 
                'sanitize_callback'     => '',
            ) );
            
            $wp_customize->add_control( 'css_filter', array(
                'type'              => 'select',
                'label'                 => esc_html__( 'CSS3 Filter', 'york' ),
                'description'           => esc_html__( 'Enable the CSS filtering effect on posts. Please note that this only works in modern browsers and does not function when using Blurring.', 'york' ),
                'section'           => 'york_pro_portfolio',
                'choices'           => array(
                        'none'      => esc_html__( 'None', 'york' ),
                        'grayscale'     => esc_html__( 'Black and White', 'york' ),
                        'sepia'     => esc_html__( 'Sepia', 'york' ),
             ), ) );



	/**
	 * Add the contact section.
	 */
	$wp_customize->add_section( 'york_theme_options_contact', array(
		'title' 						=> esc_html__( 'Contact', 'york' ),
		'panel'       					=> 'york_theme_options',
	) );

			// Add the contact email address selector setting and control.
			$wp_customize->add_setting( 'contact_email', array(
				'default'           	=> '',
			) );

			$wp_customize->add_control( 'contact_email', array(
				'type' 				=> 'email',
				'label' 				=> esc_html__( 'Email Address', 'york' ),
				'description' 			=> esc_html__( 'Enter the email address you would like the contact form to send to.', 'york' ),
				'section'				=> 'york_theme_options_contact',
			) );

			// Add the contact email address selector setting and control.
			$wp_customize->add_setting( 'contact_button', array(
				'default'           	=> '',
				 'sanitize_callback' 	=> 'bean_sanitize_nohtml',
			) );

			$wp_customize->add_control( 'contact_button', array(
				'type' 				=> 'text',
				'label' 				=> esc_html__( 'Contact Button', 'york' ),
				'description' 			=> esc_html__( 'Enter the text of the contact form button.', 'york' ),
				'section'				=> 'york_theme_options_contact',
			) );



	/**
	 * Add the footer section.
	 */
	$wp_customize->add_section( 'york_theme_options_footer', array(
		'title' 						=> esc_html__( 'Footer', 'york' ),
		'panel'       					=> 'york_theme_options',
	) );

            // Upsell content.
            $wp_customize->add_setting( 'york_theme_options_footer_content', array(
                'default'               => '',
                'sanitize_callback'     => 'bean_sanitize_nohtml',
            ) );

            $wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'york_theme_options_footer_content', array(
                'type'              => 'content',
                'label'                 => esc_html__( 'Add a Call to Action', 'york' ),
                 'description'          => sprintf( __( '<a target="_blank" href="%1$s" class="button button-primary">Upgrade to York Pro - $59</a>', 'york' ), esc_url( PRO_UPGRADE_URL ) ),
                'section'               => 'york_theme_options_footer',
                'input_attrs'           => array( 'content' => __( '<p>Upgrade to York Pro to disable the "Powered by York" footer option and add a stunning global call to action on every page or post.<br><br>Check out the various call to action options below included in York Pro - they\'re amazing!</p>', 'york' ) 
                ),
            ) ) );

			// Add the powered by York setting and control.
			$wp_customize->add_setting( 'powered_by_york', array(
				'default'           	=> TRUE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'powered_by_york', array(
				'type' 				=> 'checkbox',
				'label'       			=> esc_html__( 'Powered by York', 'york' ),
				'section' 			=> 'york_theme_options_footer',
			) );

			// Add the powered by WordPress setting and control.
			$wp_customize->add_setting( 'york_footer_cta', array(
				'default'           	=> FALSE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'york_footer_cta', array(
				'type' 				=> 'checkbox',
				'label'       		=> esc_html__( 'Footer Call to Action', 'york' ),
                'description'       => esc_html__( 'Enable the footer call to action to display on all non-masonry pages. Add your text, link and select your settings from the options below.', 'york' ),
				'section' 			=> 'york_theme_options_footer',
			) );

            // Add the contact email address selector setting and control.
            $wp_customize->add_setting( 'york_footer_cta_text1', array(
                'default'               => '',
                'sanitize_callback'    => 'bean_sanitize_nohtml',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_footer_cta_text1', array(
                'type'              => 'text',
                'label'                 => esc_html__( 'Text', 'york' ),
                'description'           => esc_html__( 'Text:', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) );

            // Add the contact email address selector setting and control.
            $wp_customize->add_setting( 'york_footer_cta_text2', array(
                'default'               => '',
                 'sanitize_callback'    => 'bean_sanitize_html',
                 'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_footer_cta_text2', array(
                'type'                  => 'text',
                'section'               => 'york_theme_options_footer',
            ) );

            // Add the contact email address selector setting and control.
            $wp_customize->add_setting( 'york_footer_cta_link', array(
                'default'               => '',
                 'sanitize_callback'    => 'bean_sanitize_html',
                 'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_footer_cta_link', array(
                'type'                  => 'url',
                'label'                 => esc_html__( 'Link', 'york' ),
                'description'           => esc_html__( 'Link:', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) );

            // Add the powered by WordPress setting and control.
            $wp_customize->add_setting( 'york_footer_cta_link_target', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_checkbox',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_footer_cta_link_target', array(
                'type'              => 'checkbox',
                'label'             => esc_html__( 'Open link in a new window', 'york' ),
                'section'           => 'york_theme_options_footer',
            ) );

            // Add the powered by WordPress setting and control.
            $wp_customize->add_setting( 'york_footer_cta_shapes', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_checkbox',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_footer_cta_shapes', array(
                'type'              => 'checkbox',
                'label'             => esc_html__( 'Add shapes background', 'york' ),
                'section'           => 'york_theme_options_footer',
            ) );


            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_cta_background_color', array(
                'default'               => '#1c1c1c',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_cta_background_color', array(
                'label'                 => esc_html__( 'Background', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_cta_text_color', array(
                'default'               => '#ffffff',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_cta_text_color', array(
                'label'                 => esc_html__( 'Text', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_cta_shape_color', array(
                'default'               => '#ffffff',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_cta_shape_color', array(
                'label'                 => esc_html__( 'Shapes', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_footertext_color', array(
                'default'               => '#000000',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footertext_color', array(
                'label'                 => esc_html__( 'Footer Text', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_footernav_a_color', array(
                'default'               => '#909090',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footernav_a_color', array(
                'label'                 => esc_html__( 'Footer Link', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_footertexthover_color', array(
                'default'               => '#52bad5',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footertexthover_color', array(
                'label'                 => esc_html__( 'Footer Link Hover', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_footersocial_color', array(
                'default'               => '#000000',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footersocial_color', array(
                'label'                 => esc_html__( 'Social Icons', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) ) );



    /**
     * Add the 404 section.
     */
    $wp_customize->add_section( 'york_theme_options_404', array(
        'title'                         => esc_html__( '404', 'york' ),
        'panel'                         => 'york_theme_options',
    ) );


        // Upsell content.
        $wp_customize->add_setting( 'york_theme_options_404_content', array(
            'default'               => '',
            'sanitize_callback'     => 'bean_sanitize_nohtml',
        ) );

        $wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'york_theme_options_404_content', array(
            'type'              => 'content',
            'label'                 => esc_html__( 'Create a stunning 404 page', 'york' ),
             'description'          => sprintf( __( '<a target="_blank" href="%1$s" class="button button-primary">Upgrade to York Pro - $59</a>', 'york' ), esc_url( PRO_UPGRADE_URL ) ),
            'section'               => 'york_theme_options_404',
            'input_attrs'           => array( 'content' => __( '<p>Want to add a gorgeous background image to your site\'s 404 template? Simply upgrade to York Pro to unlock it today!</p>', 'york' ) 
            ),
        ) ) );

        // Add sharing default image uploader setting and control.
        $wp_customize->add_setting( 'york_404_bg', array(
            'sanitize_callback'     => 'bean_sanitize_image',
            'default'               => '',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'york_404_bg', array(
              'label'                   => esc_html__( '404 Background', 'york' ),
              'description'             => esc_html__( 'Upload a custom background image to use on the error 404 page.', 'york' ),
              'section'                 => 'york_theme_options_404',
              'settings'                => 'york_404_bg',
        ) ) );








    /**
     * Add the typography section.
     */
    $wp_customize->add_panel( 'york_pro_typography', array(
        'priority'                      => 30,
        'title'                         => esc_html__( 'Typography', 'york-pro' ),
        'description'                   => esc_html__( 'Customize various typographic options throughout the theme with the settings within this panel.', 'york-pro' ),
        'priority'                      => 30, //After the WP default "Site Identity" section.
    ) );

        /**
         * Add the $fonts variables for typography choices.
         */
        $fonts = array(
            'default' => 'Playfair Display',
        );

        /**
         * Add the body typography section.
         */
        $wp_customize->add_section( 'york_pro_typography_body', array(
                'title'                 => esc_html__( 'Body', 'york-pro' ),
                'panel'                 => 'york_pro_typography',
        ) );

            // Upsell content.
            $wp_customize->add_setting( 'york_pro_typography_body_content', array(
                'default'               => '',
                'sanitize_callback'     => 'bean_sanitize_nohtml',
            ) );

            $wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'york_pro_typography_body_content', array(
                'type'              => 'content',
                'label'                 => esc_html__( 'Customize Body Fonts', 'york' ),
                 'description'          => sprintf( __( '<a target="_blank" href="%1$s" class="button button-primary">Upgrade to York Pro - $59</a>', 'york' ), esc_url( PRO_UPGRADE_URL ) ),
                'section'               => 'york_pro_typography_body',
                'input_attrs'           => array( 'content' => __( '<p>Upgrade to York Pro to add any Google font to your portfolio and customize the sizes, line heights and other typographic elements.</p>', 'york' ) 
                ),
            ) ) );

            // Add the body font fanily setting and control.
            $wp_customize->add_setting( 'body_font_family', array(
                'default'               => 'default',
                'sanitize_callback'     => '',
            ) );

            $wp_customize->add_control( 'body_font_family', array(
                    'type'          => 'select',
                    'label'             => esc_html__( 'Font Family', 'york-pro' ),
                    'description' => esc_html__( 'Customize the default font styles of the theme. These settings will be overridden by the options set in the Headers typography panel.', 'york-pro' ),
                    'section'       => 'york_pro_typography_body',
                    'choices'       => $fonts
            ) );

            // Add the body size setting and control.
            $wp_customize->add_setting( 'body_font_size', array(
                'default' => 19,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'body_font_size', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_body',
                'label'       => esc_html__( 'Font Size', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 10,
                    'max'   => 30,
                    'step'  => 1,
                ),
            ) );

            // Add the line height setting and control.
            $wp_customize->add_setting( 'body_line_height', array(
                'default' => 1.8,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'body_line_height', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_body',
                'label'       => esc_html__( 'Line Height', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 1.3,
                    'max'   => 3,
                    'step'  => .1,
                ),
            ) );

            // Add the letter spacing setting and control.
            $wp_customize->add_setting( 'body_letter_spacing', array(
                'default' => 0,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'body_letter_spacing', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_body',
                'label'       => esc_html__( 'Letter Spacing', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 0,
                    'max'   => 10,
                    'step'  => 1,
                ),
            ) );

            // Add the word spacing setting and control.
            $wp_customize->add_setting( 'body_word_spacing', array(
                'default' => 0,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'body_word_spacing', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_body',
                'label'       => esc_html__( 'Word Spacing', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 0,
                    'max'   => 10,
                    'step'  => 1,
                ),
            ) );



        /**
         * Add the page titles typography section.
         */
        $wp_customize->add_section( 'york_pro_typography_pagetitles', array(
                'title'                 => esc_html__( 'Headers', 'york-pro' ),
                'panel'                 => 'york_pro_typography',
        ) );

            // Upsell content.
            $wp_customize->add_setting( 'york_pro_typography_pagetitles_content', array(
                'default'               => '',
                'sanitize_callback'     => 'bean_sanitize_nohtml',
            ) );

            $wp_customize->add_control( new Bean_Content_Control( $wp_customize, 'york_pro_typography_pagetitles_content', array(
                'type'              => 'content',
                'label'                 => esc_html__( 'Customize Header Fonts', 'york' ),
                 'description'          => sprintf( __( '<a target="_blank" href="%1$s" class="button button-primary">Upgrade to York Pro - $59</a>', 'york' ), esc_url( PRO_UPGRADE_URL ) ),
                'section'               => 'york_pro_typography_pagetitles',
                'input_attrs'           => array( 'content' => __( '<p>Upgrade to York Pro to add any Google font to your portfolio and customize the sizes, line heights and other typographic elements.</p>', 'york' ) 
                ),
            ) ) );

            // Add the header font fanily setting and control.
            $wp_customize->add_setting( 'pagetitle_font_family', array(
                'default'               => 'default',
                'sanitize_callback'     => '',
            ) );

            $wp_customize->add_control( 'pagetitle_font_family', array(
                    'type'          => 'select',
                    'label'         => esc_html__( 'Font Family', 'york-pro' ),
                    'description'   => esc_html__( 'Customize the default font styles of the theme hero entry titles. These settings will override the options set in the Body typography panel.', 'york-pro' ),
                    'section'       => 'york_pro_typography_pagetitles',
                    'choices'       => $fonts
            ) );



            // Add the header size setting and control.
            $wp_customize->add_setting( 'mobile_pagetitle_font_size', array(
                'default' => 40,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'mobile_pagetitle_font_size', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_pagetitles',
                'label'       => esc_html__( 'Small Font Size', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 16,
                    'max'   => 60,
                    'step'  => 1,
                ),
            ) );

            // Add the header line height setting and control.
            $wp_customize->add_setting( 'mobile_pagetitle_line_height', array(
                'default' => 1.4,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'mobile_pagetitle_line_height', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_pagetitles',
                'label'       => esc_html__( 'Small Line Height', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 1,
                    'max'   => 3,
                    'step'  => .1,
                ),
            ) );

            // Add the header size setting and control.
            $wp_customize->add_setting( 'pagetitle_font_size', array(
                'default' => 4.75,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'pagetitle_font_size', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_pagetitles',
                'label'       => esc_html__( 'Font Size', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 1,
                    'max'   => 10,
                    'step'  => .5,
                ),
            ) );

            // Add the header line height setting and control.
            $wp_customize->add_setting( 'pagetitle_line_height', array(
                'default' => 1.4,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'pagetitle_line_height', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_pagetitles',
                'label'       => esc_html__( 'Line Height', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 1.4,
                    'max'   => 3,
                    'step'  => .1,
                ),
            ) );

            // Add the header size setting and control.
            $wp_customize->add_setting( 'bigdesktop_font_size', array(
                'default' => 90,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'bigdesktop_font_size', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_pagetitles',
                'label'       => esc_html__( 'Large Font Size', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 20,
                    'max'   => 120,
                    'step'  => 1,
                ),
            ) );

            // Add the header line height setting and control.
            $wp_customize->add_setting( 'bigdesktop_pagetitle_line_height', array(
                'default' => 1.4,
                'transport' => 'postMessage',
            ) );

            $wp_customize->add_control( 'bigdesktop_pagetitle_line_height', array(
                'type'        => 'range',
                'section'     => 'york_pro_typography_pagetitles',
                'label'       => esc_html__( 'Large Line Height', 'york-pro' ),
                'input_attrs' => array(
                    'min'   => 1.4,
                    'max'   => 3,
                    'step'  => .1,
                ),
            ) );





    /**
     * JetPack Site Logo feaure support
     * Check to see if JetPack Site Logo module is added. 
     * For more information on the JetPack site logo:
     *
     * @see http://jetpack.me/support/site-logo/
     */
    if ( !function_exists( 'jetpack_the_site_logo' ) ) { 

        // Add sharing default image uploader setting and control.
        $wp_customize->add_setting( 'site_logo', array(
            'sanitize_callback'     => 'bean_sanitize_image',
            'default'               => '',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
              'label'                   => esc_html__( 'Logo', 'york' ),
              'section'                 => 'title_tagline',
              'settings'                => 'site_logo',
        ) ) );

        // Add the retina height setting and control.
        $wp_customize->add_setting( 'site_logo_width', array(
            'default'               => '',
            'sanitize_callback'     => 'bean_sanitize_nohtml',
        ) );

        $wp_customize->add_control( 'site_logo_width', array(
            'type'              => 'text',
            'label'                 => esc_html__( 'Logo Retina Width', 'york' ),
            'description'           => esc_html__( 'This value should be equal to half of the logo image width (in px). For example, enter "50" for a logo that is 100px wide.', 'york' ),
            'section'               => 'title_tagline',
        ) );

    } else {
        
        // Add the retina logo  setting and control.
        $wp_customize->add_setting( 'retina_logo', array(
            'default'               => FALSE,
            'sanitize_callback'     => 'bean_sanitize_checkbox',
        ) );

        $wp_customize->add_control( 'retina_logo', array(
            'type'              => 'checkbox',
            'label'                 => esc_html__( 'Enable retina logo', 'york' ),
            'description'           => esc_html__( '', 'york' ),
            'section'           => 'title_tagline',
        ) );
    }

	
	/**
	 * Set transports for the Customizer.
	 */
	
	$wp_customize->get_setting( 'blogname' )->transport            		= 'postMessage';
	$wp_customize->get_setting( 'site_logo' )->transport 		   		= 'refresh';
	$wp_customize->get_setting( 'contact_button' )->transport  	  		= 'postMessage';	
	$wp_customize->get_setting( 'contact_email' )->transport  	   		= 'postMessage';	
	$wp_customize->get_setting( 'powered_by_york' )->transport  	   	= 'postMessage';
	
}

add_action( 'customize_register', 'bean_customize_register', 11 );



/**
 * Customizer Custom Callbacks
 *
 * Only displays the current skin customizer options, if neccessary.
 *
 * @return void
 */
function york_footer_cta_callback( $control ) {
     if ( $control->manager->get_setting('york_footer_cta')->value() == true ) {
        return true;
     } else {
        return false;
     }
}



/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function bean_customize_preview_js() {
	wp_enqueue_script( 'bean-customize-preview', get_template_directory_uri() . '/inc/customizer/js/customize-preview.js', array( 'customize-preview' ), '20150903', true );
}
add_action( 'customize_preview_init', 'bean_customize_preview_js' );