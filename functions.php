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
define( 'YORK_VERSION', '1.1.0' );



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
	add_image_size( 'port-grid', 500, 9999 );



	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'york' ),
        'social' => esc_html__( 'Social Menu', 'york' ),
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
        'video', 'image'
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
		'name'          => esc_html__( 'Theme Sidebar', 'york' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears at the theme flyout sidebar.', 'york' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
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



/**
 * Enqueue scripts and styles.
 */
function york_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'york-fonts', york_fonts_url(), array(), null );

	/**
	 * Check whether WP_DEBUG or SCRIPT_DEBUG or YORK_DEBUG is set to true. 
	 * If so, we’ll load the unminified versions of the main theme stylesheet. If not, load the compressed and combined version.
	 * This is also similar to how WordPress core does it. 
	 * 
	 * @link https://codex.wordpress.org/WP_DEBUG
	 */
	if ( WP_DEBUG || SCRIPT_DEBUG || YORK_DEBUG || is_child_theme() ) {
		// Add the main stylesheet.
		wp_enqueue_style( 'york-style', get_stylesheet_uri() );
	} else {
		// Add the main minified stylesheet.
		wp_enqueue_style('york-minified-style', get_template_directory_uri(). '/style-min.css', false, '1.0', 'all');
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/**
	 * Now let's check the same for the scripts.
	 */
	if ( WP_DEBUG || SCRIPT_DEBUG || YORK_DEBUG ) {

		// Load the NProgress progress bar loader javascript.
		wp_enqueue_script( 'nprogress', get_template_directory_uri() . '/js/src/nprogress.js', array( 'jquery' ), YORK_VERSION, true );

		// Load the FitVids responsive video javascript.
		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/src/fitvids.js', array( 'jquery' ), YORK_VERSION, true );

		// Load the Photoswipe script for singular portfolio lightboxes.
		wp_enqueue_script( 'photoswipe', get_template_directory_uri() . '/js/src/photoswipe.js', array( 'jquery' ), YORK_VERSION, true );

		// Load the default UI for the Photoswipe script.
		wp_enqueue_script( 'photoswipe-ui', get_template_directory_uri() . '/js/src/photoswipe-ui-default.js', array( 'jquery' ), YORK_VERSION, true );

		// Load the FitVids responsive video javascript.
		wp_enqueue_script( 'lity', get_template_directory_uri() . '/js/src/lity.js', array( 'jquery' ), YORK_VERSION, true );

        // Load the SVG script.
        wp_enqueue_script( 'svg4everybody', get_template_directory_uri() . '/js/src/svg4everybody.js', array( 'jquery' ), YORK_VERSION, true );

		// Load the custom theme javascript functions.
		wp_enqueue_script( 'york-functions', get_template_directory_uri() . '/js/src/functions.js', array( 'jquery' ), YORK_VERSION, true );

        // Set the localization script handle variable for the non-minified funtions.js file.
        $functions_handle = 'york-functions';

	} else {
		// Load the combined javascript library.
		wp_enqueue_script( 'york-combined-scripts', get_template_directory_uri() . '/js/combined-min.js', array(), '20130115', true );
		
		// Load the minified javascript functions.
		wp_enqueue_script( 'york-minified-functions', get_template_directory_uri() . '/js/functions-min.js', array( 'jquery' ), YORK_VERSION, true );

        // Set the localization script handle variable for the minified funtions-min.js file.
        $functions_handle = 'york-minified-functions';
	}

    wp_localize_script( $functions_handle, 'site' , array(
        'theme_path' => get_template_directory_uri(),
        'ajaxurl'    => admin_url('admin-ajax.php')
    ) );

    
}
add_action( 'wp_enqueue_scripts', 'york_scripts' );



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

	/* translators: If there are characters in your language that are not supported by Source Code Pro, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Inconsolata font: on or off', 'york' ) ) {
		$fonts[] = 'Inconsolata';
	}

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



if ( ! function_exists( 'york_load_ajax_content' ) ) :
/**
 * Return the post content to the AJAX call. 
 * Create your own york_load_ajax_content() to override in a child theme. 
 */
function york_load_ajax_content () {

    $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => '1',
        'p' => $_POST['post_id']
    );

    $wp_query = new WP_Query( $args );

    // Start the loop.
    while($wp_query->have_posts()) : $wp_query->the_post();

      //Retrieve the post content.
      get_template_part( 'template-parts/portfolio-single' );

    // End the loop.
    endwhile;   

    wp_reset_query(); wp_reset_postdata();
         
    exit;
}
add_action ( 'wp_ajax_nopriv_load-content', 'york_load_ajax_content' );
add_action ( 'wp_ajax_load-content', 'york_load_ajax_content' );
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



if ( ! function_exists( 'york_comments' ) ) :
/**
 * Define custom callback function for comment output.  
 * Based strongly on the output from Twenty Sixteen. 
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
 * @link https://wordpress.org/themes/twentysixteen/
 *
 * Create your own york_comments() to override in a child theme.
 */
function york_comments($comment, $args, $depth) {
    
    global $post;

    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>

    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    
    <?php if ( 'div' != $args['style'] ) : ?>
        <article id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    
        <footer class="comment-meta">
            
            <div class="comment-author vcard">
                <div class="avatar-wrapper">
                    <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </div>
                
                <div class="comment-metadata">
                    <?php printf( __( '<b class="fn">%s</b> <span class="says">says:</span>', 'york' ), get_comment_author_link() ); ?>
                
                    <span class="comment-date">
                        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                        <?php /* translators: 1: date, 2: time */
                            printf( __('%1$s at %2$s', 'york'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link(__('Edit', 'york'),'','');
                        ?>
                        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

                        <?php if ( $comment->comment_approved == '0' ) : ?>
                            <span class="comment-awaiting-moderation"><?php esc_html_e( 'Awaiting moderation', 'york' ); ?></span>
                        <?php endif; ?>
                    </span>
                </div>

            </div>

        </footer>

        <div class="comment-content">
            <?php comment_text(); ?>
        </div>

    <?php if ( 'div' != $args['style'] ) : ?>
        </article>
    <?php endif;
}
endif;



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


/**
 * Theme Welcome Screen
 * @todo Add this welcome screen section.
 */
// if ( is_admin() ) {
// 	require get_template_directory() . '/inc/welcome/welcome-screen.php';
// }