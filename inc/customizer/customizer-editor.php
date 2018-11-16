<?php
/**
 * Add customizer colors to the block editor.
 *
 * @package     @@pkg.name
 * @link        @@pkg.theme_uri
 * @author      @@pkg.author
 * @copyright   @@pkg.copyright
 * @license     @@pkg.license
 */

/**
 * Add customizer colors to the block editor.
 */
function york_editor_customizer_generated_values() {

	// Retrieve colors from the Customizer.
	$background_color = get_theme_mod( 'background_color', '#ffffff' );
	$text_color       = get_theme_mod( 'text_color', '#232323' );
	$heading_color    = get_theme_mod( 'heading_color', '#232323' );

	// Build styles.
	$css  = '';
	$css .= '.block-editor__container { background-color: #' . esc_attr( $background_color ) . '; }';
	$css .= '.editor-styles-wrapper.edit-post-visual-editor { color: ' . esc_attr( $text_color ) . '; }';
	$css .= '.wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3, .wp-block-heading h4, .wp-block-heading h5, .wp-block-heading h6 { color: ' . esc_attr( $heading_color ) . ' !important; }';
	$css .= '.editor-styles-wrapper.edit-post-visual-editor .editor-post-title__block .editor-post-title__input { color: ' . esc_attr( $heading_color ) . '; }';

	return wp_strip_all_tags( apply_filters( 'york_editor_customizer_generated_values', $css ) );
}

/**
 * Enqueue Customizer settings into the block editor.
 */
function york_editor_customizer_styles() {

	// Register Customizer styles within the editor to use for inline additions.
	wp_register_style( 'york-editor-customizer-styles', false, '@@pkg.version', 'all' );

	// Enqueue the Customizer style.
	wp_enqueue_style( 'york-editor-customizer-styles' );

	// Add custom colors to the editor.
	wp_add_inline_style( 'york-editor-customizer-styles', york_editor_customizer_generated_values() );
}
add_action( 'enqueue_block_editor_assets', 'york_editor_customizer_styles' );
