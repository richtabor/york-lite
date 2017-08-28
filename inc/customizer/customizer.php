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

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'york_customize_partial_blogname',
	) );

	/**
	 * Add custom controls.
	 */
	include get_parent_theme_file_path( '/inc/customizer/class-york-range-control.php' );
	include get_parent_theme_file_path( '/inc/customizer/class-york-upgrade-control.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_panel( 'york_theme_options', array(
		'title' 	=> esc_html__( 'Theme Options', 'york-lite' ),
		'description' 	=> esc_html__( 'Customize various options throughout the theme with the settings within this panel.', 'york-lite' ),
		'priority' 	=> 30,
	) );

	/**
	 * Add the theme upgrade section.
	 *
	 * @see https://github.com/justintadlock/trt-customizer-pro
	 */

	$wp_customize->register_section_type( 'York_Upgrade_Control' );

	$wp_customize->add_section( new York_Upgrade_Control( $wp_customize, 'theme_upgrade', array(
		'type'                  => 'upgrade-theme',
		'title'    		=> esc_html__( 'Upgrade to York Pro', 'york-lite' ),
		'pro_text' 		=> esc_html__( 'Go Pro', 'york-lite' ),
		'pro_url'  		=> 'https://themebeans.com/checkout?edd_action=add_to_cart%26download_id=105665',
		'priority' 		=> 9999,
	) ) );

	/**
	 * Add the site logo max-width option to the Site Identity section.
	 */
	$wp_customize->add_setting( 'custom_logo_max_width', array(
		'default'               => '90',
		'transport'             => 'postMessage',
		'sanitize_callback'     => 'absint',
	) );

	$wp_customize->add_control( new York_Range_Control( $wp_customize, 'custom_logo_max_width', array(
		'default'               => '90',
		'type'                  => 'custom-range',
		'label'                 => esc_html__( 'Logo Max Width', 'york-lite' ),
		'description'           => 'px',
		'section'               => 'title_tagline',
		'priority'              => 9,
		'input_attrs'           => array(
			'min'               => 0,
			'max'               => 300,
			'step'              => 2,
		),
	) ) );

	/**
	 * Colors.
	 */
	$wp_customize->add_setting( 'york_background_color', array(
		'default'               => '#ffffff',
		'sanitize_callback'     => 'sanitize_hex_color',
		'transport'             => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_background_color', array(
		'label'                 => esc_html__( 'Background', 'york-lite' ),
		'section'               => 'colors',
	) ) );

	$wp_customize->add_setting( 'body_typography_color', array(
		'default'               => '#000000',
		'sanitize_callback'     => 'sanitize_hex_color',
		'transport'             => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_typography_color', array(
		'label'             => esc_html__( 'Text Color', 'york-lite' ),
		'section'               => 'colors',
	) ) );

	$wp_customize->add_setting( 'body_secondary_typography_color', array(
		'default'               => '#909090',
		'sanitize_callback'     => 'sanitize_hex_color',
		'transport'             => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_secondary_typography_color', array(
		'label'             => esc_html__( 'Secondary Text Color', 'york-lite' ),
		'section'               => 'colors',
	) ) );

	$wp_customize->add_setting( 'header_typography_color', array(
		'default'               => '#000000',
		'sanitize_callback'     => 'sanitize_hex_color',
		'transport'             => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_typography_color', array(
		'label'             => esc_html__( 'Header Color', 'york-lite' ),
		'section'               => 'colors',
	) ) );

	$wp_customize->add_setting( 'accent_color', array(
		'default'               => '#ff5c5c',
		'sanitize_callback'     => 'sanitize_hex_color',
		'transport'             => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'             => esc_html__( 'Accent Color', 'york-lite' ),
		'section'               => 'colors',
	) ) );

	$wp_customize->add_setting( 'overlay_color', array(
		'default'               => '#ffffff',
		'sanitize_callback'     => 'sanitize_hex_color',
		'transport'             => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_color', array(
		'label'                 => esc_html__( 'Overlay', 'york-lite' ),
		'section'               => 'york_portfolio',
	) ) );

	$wp_customize->add_setting( 'overlay_text_color', array(
		'default'               => '#000000',
		'sanitize_callback'     => 'sanitize_hex_color',
		'transport'             => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_text_color', array(
		'label'                 => esc_html__( 'Overlay Text', 'york-lite' ),
		'section'               => 'york_portfolio',
	) ) );

	/**
	 * Theme Customizer Sections.
	 * For more information on Theme Customizer settings and default sections:
	 *
	 * @see https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
	 */

	/**
	 * Add the header section.
	 */
	$wp_customize->add_section( 'york_header', array(
		'title'                 => esc_html__( 'Header', 'york-lite' ),
		'panel'                 => 'york_theme_options',
	) );

		$wp_customize->add_setting( 'york_sitetitle_color', array(
			'default'               => '#000000',
			'sanitize_callback'     => 'sanitize_hex_color',
			'transport'             => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_sitetitle_color', array(
			'label'                 => esc_html__( 'Site Title', 'york-lite' ),
			'section'               => 'york_header',
		) ) );

		$wp_customize->add_setting( 'york_sitetitlehover_color', array(
			'default'               => '#ff5c5c',
			'sanitize_callback'     => 'sanitize_hex_color',
			'transport'             => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_sitetitlehover_color', array(
			'label'                 => esc_html__( 'Site Title Hover', 'york-lite' ),
			'section'               => 'york_header',
		) ) );

		$wp_customize->add_setting( 'york_navigationicon_color', array(
			'default'               => '#000000',
			'sanitize_callback'     => 'sanitize_hex_color',
			'transport'             => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_navigationicon_color', array(
			'label'                 => esc_html__( 'Navigation Icon', 'york-lite' ),
			'section'               => 'york_header',
		) ) );

		$wp_customize->add_setting( 'york_navigationiconhover_color', array(
			'default'               => '#ff5c5c',
			'sanitize_callback'     => 'sanitize_hex_color',
			'transport'             => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_navigationiconhover_color', array(
			'label'                 => esc_html__( 'Navigation Icon Hover', 'york-lite' ),
			'section'               => 'york_header',
		) ) );

		$wp_customize->add_setting( 'york_sidebarsocial_color', array(
			'default'               => '#000000',
			'sanitize_callback'     => 'sanitize_hex_color',
			'transport'             => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'york_sidebarsocial_color', array(
			'label'                 => esc_html__( 'Social Icons', 'york-lite' ),
			'section'               => 'york_header',
		) ) );

	/**
	 * Add the footer section.
	 */
	$wp_customize->add_section( 'york_footer', array(
		'title' 				=> esc_html__( 'Footer', 'york-lite' ),
		'panel'       				=> 'york_theme_options',
	) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
			'label'                 => esc_html__( 'Footer Text', 'york-lite' ),
			'section'               => 'york_footer',
		) ) );

		$wp_customize->add_setting( 'footer_nav_color', array(
			'default'               => '#909090',
			'sanitize_callback'     => 'sanitize_hex_color',
			'transport'             => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_nav_color', array(
			'label'                 => esc_html__( 'Footer Link', 'york-lite' ),
			'section'               => 'york_footer',
		) ) );

		$wp_customize->add_setting( 'footer_text_hover_color', array(
			'default'               => '#ff5c5c',
			'sanitize_callback'     => 'sanitize_hex_color',
			'transport'             => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_hover_color', array(
			'label'                 => esc_html__( 'Footer Link Hover', 'york-lite' ),
			'section'               => 'york_footer',
		) ) );

		$wp_customize->add_setting( 'footer_social_color', array(
			'default'               => '#000000',
			'sanitize_callback'     => 'sanitize_hex_color',
			'transport'             => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_social_color', array(
			'label'                 => esc_html__( 'Social Icons', 'york-lite' ),
			'section'               => 'york_footer',
		) ) );

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
	wp_enqueue_script( 'york-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'york_customize_preview_js' );

/**
 * Register scripts and styles for the controls.
 */
function york_customize_panel_scripts() {
	wp_enqueue_script( 'york-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array( 'customize-controls' ), '@@pkg.version', true );
	wp_enqueue_style( 'york-customize-controls', get_theme_file_uri( '/assets/css/customize-controls.css' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'york_customize_panel_scripts' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @see york_customize_register()
 *
 * @return void
 */
function york_customize_partial_blogname() {
	bloginfo( 'name' );
}
