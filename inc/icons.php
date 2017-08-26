<?php
/**
 * SVG icons related functions and filters
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Add SVG definitions to the footer.
 */
function york_include_svg_icons() {
	require_once get_theme_file_path( '/assets/images/sprite.svg' );
}
add_action( 'wp_footer', 'york_include_svg_icons', 9999 );

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function york_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'york-lite' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an SVG icon filename.', 'york-lite' );
	}

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'desc'        => '',
		'aria_hidden' => true, // Hide from screen readers.
		'fallback'    => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = '';

	if ( true === $args['aria_hidden'] ) {
		$aria_hidden = ' aria-hidden="true"';
	}

	// Set ARIA.
	$aria_labelledby = '';

	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="title desc"';
	}

	// Begin SVG markup.
	$svg = '<svg class="icon icon--' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// If there is a title, display it.
	if ( $args['title'] ) {
		$svg .= '<title>' . esc_html( $args['title'] ) . '</title>';
	}

	// If there is a description, display it.
	if ( $args['desc'] ) {
		$svg .= '<desc>' . esc_html( $args['desc'] ) . '</desc>';
	}

	// Use absolute path in the Customizer so that icons show up in there.
	if ( is_customize_preview() ) {
		$svg .= '<use xlink:href="' . get_theme_file_uri( '/assets/images/sprite.svg#icon-' . esc_html( $args['icon'] ) ) . '"></use>';
	} else {
		$svg .= '<use xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use>';
	}

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon--' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= '</svg>';

	return $svg;
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function york_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Get supported social icons.
	$social_icons = york_social_links_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . york_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
			}
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'york_nav_menu_social_icons', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function york_social_links_icons() {

	$social_links_icons = array(
		'500px.com'        => '500px',
		'bandsintown.com'  => 'bandsintown',
		'behance.net'      => 'behance',
		'chownow.com'      => 'chownow',
		'codepen.io'       => 'codepen',
		'dribbble.com'     => 'dribbble',
		'dropbox.com'      => 'dropbox',
		'facebook.com'     => 'facebook',
		'flickr.com'       => 'flickr',
		'foursquare.com'   => 'foursquare',
		'plus.google.com'  => 'google',
		'github.com'       => 'github',
		'instagram.com'    => 'instagram',
		'itunes'           => 'itunes',
		'itunes.apple.com' => 'itunes',
		'linkedin.com'     => 'linkedin',
		'mailto:'          => 'email',
		'medium.com'       => 'medium',
		'meetup.com'       => 'meetup',
		'pinterest.com'    => 'pinterest',
		'reddit.com'       => 'reddit',
		'smugmug.net'      => 'smugmug',
		'snapchat.com'     => 'snapchat-ghost',
		'soundcloud.com'   => 'soundcloud',
		'spotify.com'      => 'spotify',
		'stumbleupon.com'  => 'stumbleupon',
		'tumblr.com'       => 'tumblr',
		'twitch.tv'        => 'twitch',
		'twitter.com'      => 'twitter',
		'vimeo.com'        => 'vimeo',
		'vine.co'          => 'vine',
		'vevo.com'         => 'vevo',
		'vsco.co'          => 'vsco',
		'wordpress.org'    => 'wordpress',
		'wordpress.com'    => 'wordpress',
		'yelp.com'         => 'yelp',
		'youtube.com'      => 'youtube',
	);

	return apply_filters( 'york_social_links_icons', $social_links_icons );
}

/**
 * Adds data attributes to the body, based on Customizer entries.
 */
function york_svg_allowed_html() {

	$array = array(
		'svg' => array(
			'class' => array(),
			'aria-hidden' => array(),
			'role' => array(),
		),
		'use' => array(
			'xlink:href' => array(),
		),
	);

	return apply_filters( 'york_svg_allowed_html', $array );

}
