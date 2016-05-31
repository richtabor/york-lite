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
                'default'               => '#969696',
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

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'theme_accent_color', array(
                'default'               => '#00bac7',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_accent_color', array(
                'label'             => esc_html__( 'Accent Color', 'york' ),
                'section'               => 'york_pro_colors',
            ) ) );



    /**
     * Add the header section.
     */
    $wp_customize->add_section( 'york_pro_header', array(
        'title'                 => esc_html__( 'Header', 'york' ),
        'panel'                 => 'york_theme_options',
    ) );

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
                'default'               => '#00bac7',
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
                'default'               => '#000000',
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

            // Add the portfolio loop selector setting and control.
            $wp_customize->add_setting( 'york_portfolio_modal', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_checkbox',
            ) );

            $wp_customize->add_control( 'york_portfolio_modal', array(
                'type'              => 'checkbox',
                'label'                 => esc_html__( 'Single Portfolio Modal', 'york' ),
                'description'           => esc_html__( 'Acrtive the portfolio modal, instead of linking to individual portfolio posts.', 'york' ),
                'section'           => 'york_pro_portfolio',
            ) );

			// Add the portfolio loop selector setting and control.
			$wp_customize->add_setting( 'portfolio_loop', array(
				'default'           	=> FALSE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'portfolio_loop', array(
				'type' 				=> 'checkbox',
				'label'       			=> esc_html__( 'Single Portfolio Loop', 'york' ),
				'description' 			=> esc_html__( 'Activate the portfolio loop on all portfolio posts, which contains a masonry grid of all posts.', 'york' ),
				'section' 			=> 'york_pro_portfolio',
			) );

			// Add the portfolio loop selector setting and control.
			$wp_customize->add_setting( 'portfolio_loop_pages', array(
				'default'           	=> FALSE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'portfolio_loop_pages', array(
				'type' 				=> 'checkbox',
				'label'       			=> esc_html__( 'Single Page Loop', 'york' ),
				'description' 			=> esc_html__( 'Activate the portfolio loop on all standard WordPress pages, which contains a masonry grid of all posts.', 'york' ),
				'section' 			=> 'york_pro_portfolio',
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
            $wp_customize->add_setting( 'york_project_color', array(
                'default'               => '#f6f6f6',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_project_color', array(
                'label'                 => esc_html__( 'Project', 'york' ),
                'section'               => 'york_pro_portfolio',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_projecthover_color', array(
                'default'               => '#f6f6f6',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_projecthover_color', array(
                'label'                 => esc_html__( 'Project Hover', 'york' ),
                'section'               => 'york_pro_portfolio',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_project_modal', array(
                'default'               => '#ffffff',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_project_modal', array(
                'label'                 => esc_html__( 'Project Modal', 'york' ),
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
			$wp_customize->add_setting( 'powered_by_wordpress', array(
				'default'           	=> FALSE,
				'sanitize_callback' 	=> 'bean_sanitize_checkbox',
			) );

			$wp_customize->add_control( 'powered_by_wordpress', array(
				'type' 				=> 'checkbox',
				'label'       		=> esc_html__( 'A WordPress run site. Nice.', 'york' ),
				'section' 			=> 'york_theme_options_footer',
			) );

            // Add the hire me badge selector setting and control.
            $wp_customize->add_setting( 'york_hireme_badge', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_checkbox',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_hireme_badge', array(
                'type'              => 'checkbox',
                'label'             => esc_html__( 'Footer "Hire Me" Badge', 'york' ),
                'section'           => 'york_theme_options_footer',
            ) );

            // Add the hire me badge text selector setting and control.
            $wp_customize->add_setting( 'york_hireme_badge_text', array(
                'sanitize_callback'     => 'bean_sanitize_nohtml',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_hireme_badge_text', array(
                'type'                  => 'text',
                'label'                 => esc_html__( 'Text', 'york' ),
                'description'           => esc_html__( 'Text:', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) );

            // Add the hire me badge URL selector setting and control.
            $wp_customize->add_setting( 'york_hireme_badge_url', array(
                'default'               => '',
                'sanitize_callback'     => 'esc_url_raw',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_hireme_badge_url', array(
                'type'              => 'text',
                'label'                 => esc_html__( 'URL', 'york' ),
                'description'           => esc_html__( 'URL:', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) );

            // Add the powered by WordPress setting and control.
            $wp_customize->add_setting( 'york_hireme_badge_shake', array(
                'default'               => FALSE,
                'sanitize_callback'     => 'bean_sanitize_checkbox',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( 'york_hireme_badge_shake', array(
                'type'              => 'checkbox',
                'label'             => esc_html__( 'Shake Animation', 'york' ),
                'section'           => 'york_theme_options_footer',
            ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_footertext_color', array(
                'default'               => '#969696',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footertext_color', array(
                'label'                 => esc_html__( 'Footer Text', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) ) );

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_footertexthover_color', array(
                'default'               => '#00bac7',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footertexthover_color', array(
                'label'                 => esc_html__( 'Footer Text Hover', 'york' ),
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

            //PRO: Add main accent color setting and control.
            $wp_customize->add_setting( 'york_badge_color', array(
                'default'               => '#00bac7',
                'sanitize_callback'     => 'sanitize_hex_color',
                'transport'             => 'postMessage',
            ) );

            $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_badge_color', array(
                'label'                 => esc_html__( 'Hire Me Badge', 'york' ),
                'section'               => 'york_theme_options_footer',
            ) ) );


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
	$wp_customize->get_setting( 'powered_by_wordpress' )->transport  	= 'postMessage';
	
}

add_action( 'customize_register', 'bean_customize_register', 11 );



/**
 * Customizer Custom Callbacks
 *
 * Only displays the current skin customizer options, if neccessary.
 *
 * @return void
 */
function plate_york_hireme_badge_callback( $control ) {
     if ( $control->manager->get_setting('york_hireme_badge')->value() == true ) {
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