<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

if ( ! function_exists( 'york_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the author and comments.
	 * Create your own york_entry_meta() to override in a child theme.
	 */
	function york_entry_meta() {

		echo '<div class="entry-meta">';

		if ( 'post' === get_post_type() ) {

			printf( _x( '<span class="days-ago">%s ago </span>', '%s = human-readable time difference', '@@textdomain' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );

			printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s</span> %2$s <a class="url fn n" href="%3$s">%4$s </a></span></span> ',
				esc_html_x( 'Author', 'Used before post author name.', '@@textdomain' ),
				esc_html( 'By', '@@textdomain' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		echo '</div>';

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
				printf( '<span class="cat-links">%1$s</span><br>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'york_entry_date' ) ) :
	/**
	 * Print HTML with date information for current post.
	 * Create your own york_entry_meta() to override in a child theme.
	 */
	function york_entry_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			esc_html_x( 'Posted on', 'Used before publish date.', '@@textdomain' ),
			esc_url( get_permalink() ),
			$time_string
		);
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

			<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Menu', '@@textdomain' ); ?>">
				
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>' . york_get_svg( array( 'icon' => 'chain' ) ),
					) );
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
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		} else { ?>
			<h1 class="site-logo-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php }
	}

	add_filter( 'get_custom_logo' , function( $html ) {
		if ( empty( $html ) ) {
			$html = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home" class="custom-logo-link"><img src="' . get_theme_file_uri( '/assets/images/logo.png' ) . '"></a>';
		}
		return $html;
	});

endif;

if ( ! function_exists( 'york_gallery' ) ) :
	/**
	 * Return the portfolio and post galleries.
	 *
	 * Checks if there are images uploaded to the post or portfolio post and outputs them.
	 * Create your own york_gallery() to override in a child theme.
	 *
	 * @param  string $postid The post id.
	 * @param  array  $imagesize The size of the thumbnails.
	 */
	function york_gallery( $postid, $imagesize ) {

		$thumb_id 			= get_post_thumbnail_id( $postid );
		$image_ids_raw  	= get_post_meta( $postid, '_bean_image_ids', true );

		wp_reset_postdata();

		if ( '' !== $image_ids_raw ) {
			$image_ids = explode( ',' , $image_ids_raw );
			$post_parent = null;
		} else {
			$image_ids = '';
			$post_parent = $postid;
		}

		$i = 1;

		$args = array(
			'exclude' 		 => $thumb_id,
			'include' 		 => $image_ids,
			'orderby' 		 => 'post__in',
			'order' 		 => 'ASC',
			'post_type' 	 => 'attachment',
			'post_parent' 	 => $post_parent,
			'post_mime_type' => 'image',
			'post_status' 	 => null,
			);

		$attachments = get_posts( $args ); ?>
			
		<div class="project-assets">

			<div itemscope itemtype="http://schema.org/ImageGallery">
				
				<?php
				if ( ! empty( $attachments ) ) {

					if ( ! post_password_required() ) {

						foreach ( $attachments as $attachment ) {

							$alt = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							$src = wp_get_attachment_image_src( $attachment->ID, $imagesize ); ?>

							<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
								<?php echo '<img src="'.esc_url( $src[0] ).'"/>'; ?>
							</figure>

							<?php
						}
					}
				} ?>

			</div>
		</div>	
	<?php
	}
endif;

if ( ! function_exists( 'york_entry_taxonomies' ) ) :
	/**
	 * Print HTML with category and tags for current post.
	 * Create your own york_entry_taxonomies() to override in a child theme.
	 */
	function york_entry_taxonomies() {

		global $post;

		$portfolio_cats = get_post_meta( $post->ID, '_bean_portfolio_cats', true );
		$portfolio_tags = get_post_meta( $post->ID, '_bean_portfolio_tags', true );

		if ( 'on' === $portfolio_cats ) :
			$terms = get_the_terms( $post->ID, 'portfolio_category' );

			if ( $terms && ! is_wp_error( $terms ) ) :
				the_terms( $post->ID, 'portfolio_category','', '', '' );
			endif;
		endif;

		if ( 'on' === $portfolio_tags ) :
			the_terms( $post->ID, 'portfolio_tag','', '', '' );
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

		if ( '' !== get_the_post_thumbnail() ) {

			echo '<div class="entry-media">';

			if ( is_singular() ) :
				the_post_thumbnail( 'page_post-feat' );
			else : ?>
				<a class="post-thumbnail" href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
					<?php the_post_thumbnail( 'page_post-feat', array( 'alt' => the_title_attribute( 'echo=0' ) ) );  ?>
				</a>
				<?php
			endif;

			echo '</div>';
		}
	}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function york_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'york_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

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
add_action( 'save_post',     'york_category_transient_flusher' );


if ( ! function_exists( 'york_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function york_entry_footer() {
		// Hide category and tag text for pages.
		if ( is_singular() && 'post' == get_post_type() ) {

			$tags_list = get_the_tag_list( '', ', ' );

			if ( ! $tags_list ) {
				return;
			}

			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', '@@textdomain' ) . '</span>', $tags_list ); // WPCS: XSS OK.
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
			$indent = str_repeat( "\t", $depth );
			$output .= "\n" . $indent  .'<ul class="sub_menu">' . "\n";
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			$output .= "$indent</ul>\n";
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			$sub = '';
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // Code indent.

			if ( $depth >= 0 && $args->has_children ) :
				$sub = ' has_sub';
			endif;

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

			$anchor = '';
			if ( '' !== $item->anchor ) {
				$anchor = '#'.esc_attr( $item->anchor );
			}

			$active = '';
			if ( '' === $item->anchor && ( ( 0 === $item->current && $depth ) || ( 0 === $item->current_item_ancestor && $depth ) ) ) :
				$active = 'york-active-item';
			endif;

			$output .= $indent . '<li id="mobile-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub .'">';

			$current_a = '';

			// Attributes.
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn ) .'"' : '';
			$attributes .= ' href="'   . esc_attr( $item->url ) .$anchor.'"';

			if ( ( 0 === $item->current && $depth ) || ( 0 === $item->current_item_ancestor && $depth ) ) :
				$current_a .= ' current ';
			endif;
			if ( esc_attr( $item->url ) === '#' ) {
				$current_a .= ' york-mobile-no-link';
			}

			$attributes .= ' class="'. $current_a . '"';
			$item_output = $args->before;
			if ( '' === $item->hide ) {
				if ( '' === $item->nolink ) {
					$item_output .= '<a'. $attributes .'>';
				} else {
					$item_output .= '<h6>';
				}
				$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
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
