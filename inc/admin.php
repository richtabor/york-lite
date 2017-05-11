<?php
/**
 * Custom admin functions for this theme.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Pro upgrade functions.
 * Warning: Don't just remove or delete these lines below.
 * You will get errors.
 */
require get_parent_theme_file_path( '/inc/upgrade/upgrade-setup.php' );
require get_parent_theme_file_path( '/inc/upgrade/upgrade.php' );

if ( ! function_exists( 'york_admin_footer_version' ) ) :
	/**
	 * Theme changelog in footer admin.
	 *
	 * @param string $html WordPress version.
	 */
	function york_admin_footer_version( $html ) {

		$version = '@@pkg.version';
		$theme   = '@@textdomain';

		$html   .= ' | <a href="http://demo.themebeans.com/wp-content/themes/' . esc_attr( $theme ) . '/changelog.txt" target="_blank">York ' . esc_html( $version ) . '</a>';
		return $html;

	}

	add_filter( 'update_footer', 'york_admin_footer_version', 12 );

endif;

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function york_enqueue_admin_style() {

	wp_enqueue_style( 'ava-admin-style', get_theme_file_uri( '/assets/css/admin-style.css' ), false, '@@pkg.version', 'all' );
	wp_enqueue_style( 'wp-color-picker' );

}
add_action( 'admin_enqueue_scripts', 'york_enqueue_admin_style' );

/**
 * Enqueue a script in the WordPress admin, for edit.php, post.php and post-new.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function york_enqueue_admin_script( $hook ) {

	global $pagenow, $wp_customize;

	if ( 'edit.php' !== $hook ) {
		wp_enqueue_script( 'york-meta', get_theme_file_uri( '/assets/js/admin/meta.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'wp-color-picker' );
	}

	if ( 'widgets.php' === $pagenow || isset( $wp_customize ) ) {
		wp_enqueue_media();
		wp_enqueue_script( 'widget-image-upload', get_theme_file_uri( '/assets/js/admin/admin.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'jquery-ui-core' );
	}

}
add_action( 'admin_enqueue_scripts', 'york_enqueue_admin_script' );

/**
 * TinyMCE callback function to insert 'styleselect' into the $buttons array
 *
 * @param string $buttons TinyMCE buttons.
 */
function york_mce_formats_button( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

add_filter( 'mce_buttons_2', 'york_mce_formats_button' );

/**
 * TinyMCE Callback function to filter the MCE settings
 *
 * @param array $init_array TinyMCE buttons.
 */
function york_mce_before_init_insert_formats( $init_array ) {

	$style_formats = array(

		array(
			'title' => esc_html__( 'Highlight', '@@textdomain' ),
			'inline' => 'span',
			'classes' => 'yorkup--highlight',
			'wrapper' => false,
		),
		array(
			'title' => esc_html__( 'Button', '@@textdomain' ),
			'inline' => 'span',
			'classes' => 'button',
			'wrapper' => false,
		),
	);

	$init_array['style_formats'] = wp_json_encode( $style_formats );

	return $init_array;
}

add_filter( 'tiny_mce_before_init', 'york_mce_before_init_insert_formats' );
