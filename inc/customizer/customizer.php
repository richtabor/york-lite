<?php
/**
 * Theme Customizer functionality
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function york_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'        => '.site-title a',
			'settings'        => array( 'blogname' ),
			'render_callback' => 'york_customize_partial_blogname',
		)
	);

	/**
	 * Add custom controls.
	 */
	include get_parent_theme_file_path( '/inc/customizer/class-york-range-control.php' );
	include get_parent_theme_file_path( '/inc/customizer/class-york-upgrade-control.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_panel(
		'york_theme_options', array(
			'title'       => esc_html__( 'Theme Options', 'york-lite' ),
			'description' => esc_html__( 'Customize various options throughout the theme with the settings within this panel.', 'york-lite' ),
			'priority'    => 30,
		)
	);

	/**
	 * Add the theme upgrade section.
	 *
	 * @see https://github.com/justintadlock/trt-customizer-pro
	 */

	$wp_customize->register_section_type( 'York_Upgrade_Control' );

	$wp_customize->add_section(
		new York_Upgrade_Control(
			$wp_customize, 'theme_upgrade', array(
				'type'     => 'upgrade-theme',
				'title'    => esc_html__( 'Upgrade to York Pro', 'york-lite' ),
				'pro_text' => esc_html__( 'Learn More', 'york-lite' ),
				'pro_url'  => 'https://themebeans.com/themes/york-pro',
				'priority' => 9999,
			)
		)
	);

	/**
	 * Add the site logo max-width option to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => '90',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new York_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => '90',
				'type'        => 'custom-range',
				'label'       => esc_html__( 'Logo Max Width', 'york-lite' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 9,
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 300,
					'step' => 2,
				),
			)
		)
	);

	// Heading color.
	$wp_customize->add_setting(
		'heading_color', array(
			'default'           => '#232323',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'heading_color', array(
				'label'   => esc_html__( 'Heading Color', 'york-lite' ),
				'section' => 'colors',
			)
		)
	);

	// Text color.
	$wp_customize->add_setting(
		'text_color', array(
			'default'           => '#232323',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'text_color', array(
				'label'   => esc_html__( 'Text Color', 'york-lite' ),
				'section' => 'colors',
			)
		)
	);

	// Let's only use the front-page.php file if the Portfolio Post Type is present.
	if ( post_type_exists( 'portfolio' ) ) {

		$wp_customize->add_setting(
			'overlay_color', array(
				'default'           => '#232323',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'overlay_color', array(
					'label'   => esc_html__( 'Portfolio Overlay', 'york-lite' ),
					'section' => 'colors',
				)
			)
		);

		$wp_customize->add_setting(
			'overlay_text_color', array(
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'overlay_text_color', array(
					'label'   => esc_html__( 'Portfolio Overlay Text', 'york-lite' ),
					'section' => 'colors',
				)
			)
		);
	}
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
