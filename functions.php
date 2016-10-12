<?php
/**
 *
 * York functions and definitions
 * 
 * @package York
 * @author  Richard Tabor <rich@themebeans.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 * 
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 */



/**
 * Set constant for version.
 */
define( 'YORK_VERSION', '1.0.2' );



/**
 * Check to see if development mode is active.
 * If set the 'true', then serve standard theme files,
 * instead of minified .css and .js files.
 */
define( 'YORK_DEBUG', false );



/**
 * York only works in WordPress 4.2 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.2', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'york_setup' ) ) :
function york_setup() {
	


	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on York, use a find and replace
	 * to change 'york' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'york', get_template_directory() . '/languages' );
	


	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	


	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	


	/**
	 * Filter York's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );



	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 140, 140, true );
	add_image_size( 'sml-thumbnail', 50, 50, true );
	add_image_size( 'page_post-feat', 540, 9999 );
	add_image_size( 'port-full', 9999, 9999, false  );
	add_image_size( 'project-thumbnail', 9999, 9999 );



	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'york' ),
        'footer' => esc_html__( 'Footer Menu', 'york' ),
	) );



	/*
	 * Switch default core yorkup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	

	/*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'image'
    ) );



	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css' ) );



    /*
     * Enable support for Customizer Selective Refresh.
     * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
     */
    add_theme_support( 'customize-selective-refresh-widgets' );



}
endif; // york_setup
add_action( 'after_setup_theme', 'york_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function york_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'york_content_width', 644 );
}
add_action( 'after_setup_theme', 'york_content_width', 0 );



/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function york_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Flyout', 'york' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears on the theme flyout sidebar.', 'york' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer', 'york' ),
        'id'            => 'footer',
        'description'   => esc_html__( 'Appears at the top of the site footer.', 'york' ),
        'before_widget' => '<aside id="%1$s" class="widget footer-widget %2$s clearfix">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h6 class="widget-title">',
        'after_title'   => '</h6>',
    ) );
}
add_action( 'widgets_init', 'york_widgets_init' );



/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function york_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'york_javascript_detection', 0 );



if ( ! function_exists( 'york_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function york_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'york-fonts', york_fonts_url(), array(), null );

	/**
	 * Check whether SCRIPT_DEBUG or YORK_DEBUG is set to true. 
	 * If so, we’ll load the unminified versions of the main theme stylesheet. If not, load the compressed and combined version.
	 * This is also similar to how WordPress core does it.
	 * 
	 * @link https://codex.wordpress.org/WP_DEBUG
	 */
	if ( SCRIPT_DEBUG || YORK_DEBUG || is_child_theme() ) {
        // Add the main stylesheet.
		wp_enqueue_style( 'york-style', get_stylesheet_uri() ); 
	} else {
        // Add the main minified stylesheet.
		wp_enqueue_style('york-minified-style', get_template_directory_uri(). '/style-min.css', false, YORK_VERSION, 'all'); 
	}

	if ( is_archive() && is_search() && is_taxonomy() && is_blog() && is_page_template('template-portfolio.php') ) {
		wp_enqueue_script( 'masonry');
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( SCRIPT_DEBUG || YORK_DEBUG ) {
        // Add the javascript files.
        wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/src/images-loaded.js', array( 'jquery' ), YORK_VERSION, true );
        wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/src/isotope.js', array( 'jquery' ), YORK_VERSION, true );
        wp_enqueue_script( 'infinitescroll', get_template_directory_uri() . '/js/src/infinitescroll.js', array( 'jquery' ), YORK_VERSION, true );
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/src/fitvids.js', array( 'jquery' ), YORK_VERSION, true );
        wp_enqueue_script( 'animsition', get_template_directory_uri() . '/js/src/animsition.js', array( 'jquery' ), YORK_VERSION, true );
        wp_enqueue_script( 'svg4everybody', get_template_directory_uri() . '/js/src/svg4everybody.js', array( 'jquery' ), YORK_VERSION, true );
        wp_enqueue_script( 'infinitescroll', get_template_directory_uri() . '/js/src/infinitescroll.js', array( 'jquery' ), YORK_VERSION, true );
		wp_enqueue_script( 'york-functions', get_template_directory_uri() . '/js/src/functions.js', array( 'jquery' ), YORK_VERSION, true );

        $functions_handle = 'york-functions';

	} else {
        // Add the main minified javascript.
		wp_enqueue_script( 'york-combined-scripts', get_template_directory_uri() . '/js/combined-min.js', array(), YORK_VERSION, true );
		wp_enqueue_script( 'york-minified-functions', get_template_directory_uri() . '/js/functions-min.js', array( 'jquery' ), YORK_VERSION, true );
        
        $functions_handle = 'york-minified-functions';
	}
}
add_action( 'wp_enqueue_scripts', 'york_scripts' );
endif;



if ( ! function_exists( 'york_fonts_url' ) ) :
/**
 * Register Google fonts for York.
 *
 * @return string Google fonts URL for the theme.
 */
function york_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = '';

    /* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== esc_html_x( 'on', 'Playfair Display font: on or off', 'york' ) ) {
        $fonts[] = 'Playfair Display';
    }

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;



if ( ! function_exists( 'york_protected_title_format' ) ) :
/**
 * Filter the text prepended to the post title for protected posts. 
 * Create your own york_protected_title_format() to override in a child theme.
 * 
 * @link https://developer.wordpress.org/reference/hooks/protected_title_format/
 */
function york_protected_title_format($title) { 
	return '%s'; 
}
add_filter('protected_title_format', 'york_protected_title_format');
endif;



if ( ! function_exists( 'york_protected_form' ) ) :
/**
 * Filter the HTML output for the protected post password form.
 * Create your own york_protected_form() to override in a child theme.
 * 
 * @link https://developer.wordpress.org/reference/hooks/the_password_form/
 * @link https://codex.wordpress.org/Using_Password_Protection 
 */
function york_protected_form() {
    global $post;
  
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );

    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <label for="' . $label . '">' . __( "Password:", 'york' ) . ' </label><input name="post_password" placeholder="' . __( "Enter password & press enter...", 'york' ) . '" type="password" placeholder=""/><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'york' ) . '" />
    </form>
    ';
  
    return $o;
}
add_filter( 'the_password_form', 'york_protected_form' );
endif;



if ( ! function_exists( 'york_getPostViews' ) ) :
/**
 * Loop by post view count.
 * Create your own york_getPostViews() to override in a child theme.
 */
function york_getPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);

	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	return '0';
 	}

 	return $count;
}
endif;



if ( ! function_exists( 'york_setPostViews' ) ) :
/**
 * Output the view count.
 * Create your own york_setPostViews() to override in a child theme.
 */
function york_setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
endif;



/**
 * Convert HEX to RGB.
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 * HEX code, empty array otherwise.
 */
function york_hex2rgb( $color ) {
    $color = trim( $color, '#' );

    if ( strlen( $color ) == 3 ) {
        $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
        $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
        $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
    } else if ( strlen( $color ) == 6 ) {
        $r = hexdec( substr( $color, 0, 2 ) );
        $g = hexdec( substr( $color, 2, 2 ) );
        $b = hexdec( substr( $color, 4, 2 ) );
    } else {
        return array();
    }

    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}



/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function york_widget_tag_cloud_args( $args ) {
    $args['largest'] = .8;
    $args['smallest'] = .8;
    $args['unit'] = 'em';
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'york_widget_tag_cloud_args' );



if ( ! function_exists( 'york_pingback_header' ) ) :
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function york_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
    }
}
add_action( 'wp_head', 'york_pingback_header' );
endif;



/**
 * Admin specific functions.
 */
require get_template_directory() . '/inc/admin.php';



/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/customizer-css.php';
require get_template_directory() . '/inc/customizer/sanitization.php';



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';



/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Add Widgets.
 */
require get_template_directory() . '/inc/widgets/widget-flickr.php';
require get_template_directory() . '/inc/widgets/widget-video.php';
require get_template_directory() . '/inc/widgets/widget-portfolio-menu.php';
require get_template_directory() . '/inc/widgets/widget-profile.php';
require get_template_directory() . '/inc/widgets/widget-clients.php';



/**
 * Theme Welcome Screen
 * @todo Add this welcome screen section.
 */
// if ( is_admin() ) {
// 	require get_template_directory() . '/inc/welcome/welcome-screen.php';
// }