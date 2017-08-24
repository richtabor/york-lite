<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

if ( ! defined( 'YORK_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set the 'true', then serve standard theme files,
	 * instead of minified .css and .js files.
	 */
	define( 'YORK_DEBUG', true );
endif;

if ( ! function_exists( 'york_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function york_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on York, use a find and replace
		 * to change '@@textdomain' to the name of your theme in all the template files
		 */
		load_theme_textdomain( '@@textdomain', get_parent_theme_file_path( '/languages' ) );

		/*
		 * Add default posts and comments RSS feed links to head.
		 */
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
		add_image_size( 'york-portfolio-full', 9999, 9999, false );
		add_image_size( 'york-portfolio-thumbnail', 9999, 9999 );

		/*
		 * This theme uses wp_nav_menu() in the following locations.
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', '@@textdomain' ),
			'footer'  => esc_html__( 'Footer Menu', '@@textdomain' ),
			'social'  => esc_html__( 'Social Menu', '@@textdomain' ),
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
			'video',
			'image',
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'assets/css/editor-style.css', york_fonts_url() ) );

		/*
		 * Enable support for Customizer Selective Refresh.
		 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for the WordPress default Theme Logo
		 * See: https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-width' => true,
		) );

		/*
		 * Define starter content for the theme.
		 * See: https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
		 */
		$starter_content = array(
			'posts' => array(
				'home',
				'about',
				'contact',
				'blog',
			),

			'attachments' => array(
				'logo' => array(
					'post_title' => _x( 'Logo', 'Theme starter content', '@@textdomain' ),
					'file' => 'inc/customizer/images/logo.png',
				),
			),

			'options' => array(
				'show_on_front' => 'page',
				'page_on_front' => '{{home}}',
				'blogdescription' => _x( 'A WordPress theme by ThemeBeans', 'Theme starter content', '@@textdomain' ),
				'page_for_posts' => '{{blog}}',
			),

			'theme_mods' => array(
				'site_logo' => '{{image-logo}}',
			),

			'nav_menus' => array(

				'primary' => array(
					'name' => esc_html__( 'Primary', '@@textdomain' ),
					'items' => array(
						'page_home',
						'page_about',
					),
				),

				'footer' => array(
					'name' => esc_html__( 'Footer', '@@textdomain' ),
					'items' => array(
						'page_home',
						'page_about',
						'page_contact',
					),
				),

				'social' => array(
					'name' => esc_html__( 'Social Menu', '@@textdomain' ),
					'items' => array(
						'link_twitter',
						'link_instagram',
						'link_facebook',
					),
				),
			),
		);

		/**
		 * Filters @@pkg.name array of starter content.
		 *
		 * @since @@pkg.name 1.0
		 *
		 * @param array $starter_content Array of starter content.
		 */
		$starter_content = apply_filters( 'york_starter_content', $starter_content );

		add_theme_support( 'starter-content', $starter_content );

	}
endif;
add_action( 'after_setup_theme', 'york_setup' );

/**
 * Checks to see if we're on the homepage or not.
 */
function york_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function york_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'york_front_page_template' );

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
		'name'          => esc_html__( 'Flyout', '@@textdomain' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears on the theme flyout sidebar.', '@@textdomain' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', '@@textdomain' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Appears at the top of the site footer.', '@@textdomain' ),
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
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js');})(document.documentElement);</script>\n";
}
add_action( 'wp_enqueue_scripts', 'york_javascript_detection', 0 );

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
			wp_enqueue_style( 'york-style', get_stylesheet_uri() );
		} else {
			wp_enqueue_style( 'york-style', get_theme_file_uri( '/style.min.css' ), false, '@@pkg.version', 'all' );
		}

		// Load the standard WordPress comments reply javascript.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/**
		 * Now let's check the same for the scripts.
		 */
		if ( SCRIPT_DEBUG || YORK_DEBUG ) {

			// Vendor scripts.
			wp_enqueue_script( 'isotope', get_theme_file_uri( '/assets/js/vendors/isotope.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'infinitescroll', get_theme_file_uri( '/assets/js/vendors/infinitescroll.js' ) , array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'fitvids', get_theme_file_uri( '/assets/js/vendors/fitvids.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'animsition', get_theme_file_uri( '/assets/js/vendors/animsition.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'infinitescroll', get_theme_file_uri( '/assets/js/vendors/infinitescroll.js' ), array( 'jquery' ), '@@pkg.version', true );

			// Custom scripts.
			wp_enqueue_script( 'york-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery', 'masonry', 'imagesloaded' ), '@@pkg.version', true );

			$translation_handle = 'york-global'; // Variable for wp_localize_script.

		} else {
			wp_enqueue_script( 'york-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'york-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery', 'masonry', 'imagesloaded' ), '@@pkg.version', true );

			$translation_handle = 'york-custom-min'; // Variable for wp_localize_script for minified javascript.
		}

		// Translations in the custom functions.
		$translation_array = array(
			'york_comment' => esc_html__( 'Write a comment . . .', '@@textdomain' ),
			'york_author'  => esc_html__( 'Name', '@@textdomain' ),
			'york_email'   => esc_html__( 'email@address.com', '@@textdomain' ),
		);

		wp_localize_script( $translation_handle, 'york_translation', $translation_array );

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
		if ( 'off' !== esc_html_x( 'on', 'Playfair Display font: on or off', '@@textdomain' ) ) {
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

if ( ! function_exists( 'york_resource_hints' ) ) :
	/**
	 * Add preconnect for Google Fonts.
	 *
	 * @param  array  $urls           URLs to print for resource hints.
	 * @param  string $relation_type  The relation type the URLs are printed.
	 * @return array  $urls           URLs to print for resource hints.
	 */
	function york_resource_hints( $urls, $relation_type ) {
		if ( wp_style_is( 'york-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		}

		return $urls;
	}

	add_filter( 'wp_resource_hints', 'york_resource_hints', 10, 2 );

endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function york_body_classes( $classes ) {
	global $post;

	// Adds a class to the body.
	$classes[] = 'clearfix';

	// Adds a class of post-thumbnail to pages with post thumbnails for hero areas.
	if ( is_customize_preview() ) {
		$classes[] = 'is-customize-preview';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'york-front-page';
	}

	/*
	 * If comments are open or we have at least one comment, load up the comment template.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/comments_open/
	 * @link https://codex.wordpress.org/Template_Tags/get_comments_number/
	 */
	if ( comments_open() || get_comments_number() ) :
		$classes[] = 'is-page-with-comments';
	endif;

	return $classes;
}
add_filter( 'body_class', 'york_body_classes' );

if ( ! function_exists( 'york_protected_title_format' ) ) :
	/**
	 * Filter the text prepended to the post title for protected posts.
	 * Create your own york_protected_title_format() to override in a child theme.
	 *
	 * @param  array $title The post's title.
	 * @link https://developer.wordpress.org/reference/hooks/protected_title_format/
	 */
	function york_protected_title_format( $title ) {
		return '%s';
	}

	add_filter( 'protected_title_format', 'york_protected_title_format' );

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
		<label for="' . esc_attr__( $label ) . '">' . __( 'Password:', '@@textdomain' ) . ' </label><input name="post_password" placeholder="' . esc_html__( 'Enter password & press enter&hellip;', '@@textdomain' ) . '" type="password" placeholder=""/><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', '@@textdomain' ) . '" />
		</form>
		';

		return $o;
	}

	add_filter( 'the_password_form', 'york_protected_form' );

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

	if ( 3 === strlen( $color ) ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( 6 === strlen( $color ) ) {
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

if ( ! function_exists( 'york_comments' ) ) :
	/**
	 * Define custom callback for comment output.
	 * Based strongly on the output from Twenty Sixteen.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
	 * @link https://wordpress.org/themes/twentysixteen/
	 *
	 * Create your own york_comments() to override in a child theme.
	 */
	function york_comments( $comment, $args, $depth ) {

		$allowed_html_array = array(
			'a' => array(
				'href' => array(),
				'title' => array(),
			),
			'br' => array(),
			'cite' => array(),
			'em' => array(),
			'strong' => array(),
		);

		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">

				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, $size = '76' ); ?>
					<?php printf( wp_kses( __( '<cite class="fn">%s</cite> ', '@@textdomain' ), $allowed_html_array ), get_comment_author_link() ) ?></span>
				</div>

				<p class="comment-meta commentmetadata subtext">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( esc_html__(' %1$s at %2$s', '@@textdomain'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link( esc_html__( 'Edit', '@@textdomain'),' &middot; ','' ); ?><?php comment_reply_link( array_merge( $args, array('before' => ' &middot; ', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
				</p>

				<div class="comment-body">
					<?php if ( $comment->comment_approved === '0' ) : ?>
						<span class="moderation"><?php esc_html_e('Awaiting Moderation', '@@textdomain') ?></span>
					<?php endif; ?>
				<?php comment_text() ?>
				</div>

			</div>
		</li>
	<?php
	}
endif;

/**
 * York only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_parent_theme_file_path( '/inc/back-compat.php' );
}

/**
 * Admin specific functions.
 */
require get_theme_file_path( '/inc/admin.php' );

/**
 * Post meta.
 */
if ( is_admin() ) {
	require get_theme_file_path( '/inc/meta/meta.php' );
	require get_theme_file_path( '/inc/meta/meta-portfolio.php' );
}

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/sanitization.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_theme_file_path( '/inc/jetpack.php' );

/**
 * Load TGM.
 */
require get_theme_file_path( '/inc/plugins.php' );

/**
 * SVG icons functions and filters.
 */
require get_theme_file_path( '/inc/icons.php' );
