<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

if ( ! function_exists( 'york_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the author and comments.
	 * Based on the function from Twenty Seventeen.
	 */
	function york_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			__( 'by %s', 'york-lite' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		$allowed_html = array(
			'time' => array(
				'class'    => array(),
				'datetime' => array(),
			),
			'span' => array(
				'class' => array(),
			),
			'a'    => array(
				'class' => array(),
				'href'  => array(),
			),
		);

		// Finally, let's write all of this to the page.
		echo '<div class="entry-meta"><span class="posted-on">' . wp_kses( york_time_link(), $allowed_html ) . '</span><span class="byline"> ' . wp_kses( $byline, $allowed_html ) . '</span></div>';

	}
endif;

if ( ! function_exists( 'york_time_link' ) ) :
	/**
	 * Gets a nicely formatted string for the published date.
	 * Based on the function from Twenty Seventeen.
	 */
	function york_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			get_the_date( DATE_W3C ),
			get_the_date(),
			get_the_modified_date( DATE_W3C ),
			get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'york-lite' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}
endif;

if ( ! function_exists( 'york_entry_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function york_entry_categories() {
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( '&nbsp;&middot;&nbsp;' );
			if ( $categories_list && york_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'york_social_navigation' ) ) :
	/**
	 * Output the social menu.
	 * Checks if the social navigation is added.
	 */
	function york_social_navigation() {
		/*
		 * Check if a social menu is added.
		 */
		if ( has_nav_menu( 'social' ) ) : ?>

			<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'york-lite' ); ?>">

				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>' . york_get_svg( array( 'icon' => 'chain' ) ),
						)
					);
				?>

			</nav><!-- .social-navigation -->

		<?php
		endif;
	}
endif;

if ( ! function_exists( 'york_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 *
	 * Checks if jetpack_the_site_logo is available. If so, use  jetpack_the_site_logo();.
	 * If not, there's a fallback of site_logo in the Theme Customizer.
	 */
	function york_site_logo() {

		if ( has_custom_logo() ) {

			echo '<div class="site-logo" itemscope itemtype="http://schema.org/Organization">';
				the_custom_logo();
			echo '</div>';
			?>

		<?php } else { ?>
			<h1 class="site-title" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
}
	}

endif;

if ( ! function_exists( 'york_portfolio_categories' ) ) :
	/**
	 * Print HTML with category for current post.
	 * Create your own york_portfolio_categories() to override in a child theme.
	 */
	function york_portfolio_categories() {

		global $post;

		$terms = get_the_terms( $post->ID, 'portfolio_category' );

		if ( $terms && ! is_wp_error( $terms ) ) :

			echo '<div class="entry-categories">';

				the_terms( $post->ID, 'portfolio_category', '', '', '' );

			echo '</div>';
		endif;
	}
endif;

if ( ! function_exists( 'york_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function york_post_thumbnail() {

		global $post;

		if ( post_password_required() || is_attachment() ) {
			return;
		}

		// If Gutenberg exists, do not use the featured image.
		if ( is_singular() && function_exists( 'register_block_type' ) ) {
			return;
		}

		if ( '' !== get_the_post_thumbnail() ) {
		?>
			<div class="entry-media">

				<?php
				if ( is_singular() ) :
					the_post_thumbnail( 'york-featured-image' );
				else :
				?>
					<a class="post-thumbnail" href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
						<figure class="post-thumbnail__inner">
							<?php the_post_thumbnail( 'york-featured-image' ); ?>
						</figure>
					</a>
					<?php
				endif;
				?>

			</div>

			<?php
		}
	}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function york_categorized_blog() {
	// Create an array of all the categories that are attached to posts.
	if ( false === ( $all_the_cool_cats = get_transient( 'york_categories' ) ) ) {
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'york_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so york_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so york_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in { @see york_categorized_blog() }.
 */
function york_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'york_categories' );
}
add_action( 'edit_category', 'york_category_transient_flusher' );
add_action( 'save_post', 'york_category_transient_flusher' );


if ( ! function_exists( 'york_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function york_entry_footer() {
		// Hide category and tag text for pages.
		if ( is_singular() && 'post' === get_post_type() ) {

			$tags_list = get_the_tag_list( '', ', ' );

			if ( ! $tags_list ) {
				return;
			}

			if ( $tags_list ) {
				/* Translators: tags */
				printf( '<div class="tags-links">' . esc_html__( 'Tagged: %s', 'york-lite' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! class_exists( 'YorkClassMobileNavigationWalker' ) ) :
	/**
	 * Determine whether blog/site has more than one category.
	 *
	 * @return bool True of there is more than one category, false otherwise.
	 */
	class YorkClassMobileNavigationWalker extends Walker_Nav_Menu {


		function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "\n" . $indent . '<ul class="sub_menu">' . "\n";
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent  = str_repeat( "\t", $depth );
			$output .= "$indent</ul>\n";
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$sub    = '';
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // Code indent.

			if ( $depth >= 0 && $args->has_children ) :
				$sub = ' has_sub';
			endif;

			$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

			$anchor = '';
			if ( '' !== $item->anchor ) {
				$anchor = '#' . esc_attr( $item->anchor );
			}

			$active = '';
			if ( '' === $item->anchor && ( ( 0 === $item->current && $depth ) || ( 0 === $item->current_item_ancestor && $depth ) ) ) :
				$active = 'york-active-item';
			endif;

			$output .= $indent . '<li id="mobile-menu-item-' . $item->ID . '" class="' . $class_names . ' ' . $active . $sub . '">';

			$current_a = '';

			// Attributes.
			$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= ' href="' . esc_attr( $item->url ) . $anchor . '"';

			if ( ( 0 === $item->current && $depth ) || ( 0 === $item->current_item_ancestor && $depth ) ) :
				$current_a .= ' current ';
			endif;
			if ( esc_attr( $item->url ) === '#' ) {
				$current_a .= ' york-mobile-no-link';
			}

			$attributes .= ' class="' . $current_a . '"';
			$item_output = $args->before;
			if ( '' === $item->hide ) {
				if ( '' === $item->nolink ) {
					$item_output .= '<a' . $attributes . '>';
				} else {
					$item_output .= '<h6>';
				}
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
				if ( '' === $item->nolink ) {
					$item_output .= '</a>';
				} else {
					$item_output .= '</h6>';
				}

				if ( $args->has_children ) {
					$item_output .= '<span class="mobile-navigation--arrow"></span>';
				}
			}
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
endif;

