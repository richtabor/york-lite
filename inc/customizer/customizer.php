<?php
/**
 * Theme Customizer functionality
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function york_customize_register( $wp_customize ) {

	/**
	 * Remove unnecessary controls.
	 */
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_control( 'site_logo_header_text' );
	$wp_customize->remove_control( 'background_color' );

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( '/inc/customizer/custom-controls/content.php' );
	require get_parent_theme_file_path( '/inc/customizer/custom-controls/range.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_panel( 'york_theme_options', array(
		'title' 						=> esc_html__( 'Theme Options', '@@textdomain' ),
		'description' 					=> esc_html__( 'Customize various options throughout the theme with the settings within this panel.', '@@textdomain' ),
		'priority' 					    => 30,
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
		'title'                 => esc_html__( 'Colors', '@@textdomain' ),
		'panel'                 => 'york_theme_options',
	) );

			$wp_customize->add_setting( 'york_background_color', array(
				'default'               => '#ffffff',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_background_color', array(
				'label'                 => esc_html__( 'Background', '@@textdomain' ),
				'section'               => 'york_pro_colors',
			) ) );

			$wp_customize->add_setting( 'body_typography_color', array(
				'default'               => '#000000',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_typography_color', array(
				'label'             => esc_html__( 'Text Color', '@@textdomain' ),
				'section'               => 'york_pro_colors',
			) ) );

			$wp_customize->add_setting( 'body_secondary_typography_color', array(
				'default'               => '#909090',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_secondary_typography_color', array(
				'label'             => esc_html__( 'Secondary Text Color', '@@textdomain' ),
				'section'               => 'york_pro_colors',
			) ) );

			$wp_customize->add_setting( 'header_typography_color', array(
				'default'               => '#000000',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_typography_color', array(
				'label'             => esc_html__( 'Header Color', '@@textdomain' ),
				'section'               => 'york_pro_colors',
			) ) );

			$wp_customize->add_setting( 'theme_accent_color', array(
				'default'               => '#ff5c5c',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_accent_color', array(
				'label'             => esc_html__( 'Accent Color', '@@textdomain' ),
				'section'               => 'york_pro_colors',
			) ) );

	/**
	 * Add the header section.
	 */
	$wp_customize->add_section( 'york_pro_header', array(
		'title'                 => esc_html__( 'Header', '@@textdomain' ),
		'panel'                 => 'york_theme_options',
	) );

			$wp_customize->add_setting( 'york_sitetitle_color', array(
				'default'               => '#000000',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_sitetitle_color', array(
				'label'                 => esc_html__( 'Site Title', '@@textdomain' ),
				'section'               => 'york_pro_header',
			) ) );

			$wp_customize->add_setting( 'york_sitetitlehover_color', array(
				'default'               => '#ff5c5c',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_sitetitlehover_color', array(
				'label'                 => esc_html__( 'Site Title Hover', '@@textdomain' ),
				'section'               => 'york_pro_header',
			) ) );

			$wp_customize->add_setting( 'york_navigationicon_color', array(
				'default'               => '#000000',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_navigationicon_color', array(
				'label'                 => esc_html__( 'Navigation Icon', '@@textdomain' ),
				'section'               => 'york_pro_header',
			) ) );

			$wp_customize->add_setting( 'york_navigationiconhover_color', array(
				'default'               => '#ff5c5c',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_navigationiconhover_color', array(
				'label'                 => esc_html__( 'Navigation Icon Hover', '@@textdomain' ),
				'section'               => 'york_pro_header',
			) ) );

			$wp_customize->add_setting( 'york_sidebarsocial_color', array(
				'default'               => '#000000',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_sidebarsocial_color', array(
				'label'                 => esc_html__( 'Social Icons', '@@textdomain' ),
				'section'               => 'york_pro_header',
			) ) );

	/**
	 * Add the portfolio section.
	 */
	$wp_customize->add_section( 'york_pro_portfolio', array(
		'title' 						=> esc_html__( 'Portfolio', '@@textdomain' ),
		'panel'       					=> 'york_theme_options',
	) );

			$wp_customize->add_setting( 'portfolio_single_navigation', array(
				'default'               => true,
				'sanitize_callback'     => 'york_sanitize_number_intval',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( 'portfolio_single_navigation', array(
				'type'                  => 'checkbox',
				'label'                 => esc_html__( 'Portfolio Navigation', '@@textdomain' ),
				'description'           => esc_html__( 'Enable the "Next" project post-to-post navigation element on single portfolio pages.', '@@textdomain' ),
				'section'               => 'york_pro_portfolio',
			) );

			$wp_customize->add_setting( 'portfolio_posts_count', array(
				'default'           	=> '-1',
				'sanitize_callback' 	=> 'york_sanitize_number_intval',
			) );

			$wp_customize->add_control( 'portfolio_posts_count', array(
				'type' 				    => 'number',
				'label' 				=> esc_html__( 'Portfolio Count', '@@textdomain' ),
				'description' 			=> esc_html__( 'Set the number of posts to display on the portfolio template. Use "-1" to load them all.', '@@textdomain' ),
				'section'				=> 'york_pro_portfolio',
			) );

			$wp_customize->add_setting( 'york_overlay_color', array(
				'default'               => '#ffffff',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_overlay_color', array(
				'label'                 => esc_html__( 'Overlay', '@@textdomain' ),
				'section'               => 'york_pro_portfolio',
			) ) );

			$wp_customize->add_setting( 'york_overlay_text_color', array(
				'default'               => '#000000',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_overlay_text_color', array(
				'label'                 => esc_html__( 'Overlay Text', '@@textdomain' ),
				'section'               => 'york_pro_portfolio',
			) ) );

	/**
	 * Add the footer section.
	 */
	$wp_customize->add_section( 'york_theme_options_footer', array(
		'title' 						=> esc_html__( 'Footer', '@@textdomain' ),
		'panel'       					=> 'york_theme_options',
	) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footertext_color', array(
				'label'                 => esc_html__( 'Footer Text', '@@textdomain' ),
				'section'               => 'york_theme_options_footer',
			) ) );

			$wp_customize->add_setting( 'york_footernav_a_color', array(
				'default'               => '#909090',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footernav_a_color', array(
				'label'                 => esc_html__( 'Footer Link', '@@textdomain' ),
				'section'               => 'york_theme_options_footer',
			) ) );

			$wp_customize->add_setting( 'york_footertexthover_color', array(
				'default'               => '#ff5c5c',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footertexthover_color', array(
				'label'                 => esc_html__( 'Footer Link Hover', '@@textdomain' ),
				'section'               => 'york_theme_options_footer',
			) ) );

			$wp_customize->add_setting( 'york_footersocial_color', array(
				'default'               => '#000000',
				'sanitize_callback'     => 'sanitize_hex_color',
				'transport'             => 'postMessage',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_footersocial_color', array(
				'label'                 => esc_html__( 'Social Icons', '@@textdomain' ),
				'section'               => 'york_theme_options_footer',
			) ) );

	$wp_customize->add_setting( 'site_logo_width', array(
		'default'               => '90',
		'transport'             => 'postMessage',
		'sanitize_callback'     => 'york_sanitize_nohtml',
	) );

	$wp_customize->add_control( 'site_logo_width', array(
		'type'              => 'text',
		'label'                 => esc_html__( 'Logo Retina Width', '@@textdomain' ),
		'description'           => esc_html__( 'This value should be equal to half of the logo image width (in px). For example, enter "50" for a logo that is 100px wide.', '@@textdomain' ),
		'section'               => 'title_tagline',
		'priority' 				=> 9,
	) );

	/**
	 * Set transports for the Customizer.
	 */

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
}

add_action( 'customize_register', 'york_customize_register', 11 );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function york_customize_preview_js() {
	wp_enqueue_script( 'york-customize-preview', get_theme_file_uri( '/assets/js/admin/customize-preview.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'york_customize_preview_js' );
