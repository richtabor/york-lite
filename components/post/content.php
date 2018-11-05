<?php
/**
 * Template part for displaying the singular post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php
		if ( is_sticky() ) :
			echo wp_kses( york_get_svg( array( 'icon' => 'sticky' ) ), york_svg_allowed_html() );
		endif;

		if ( 'post' === get_post_type() ) {
			york_entry_categories();
		}

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) {
			york_posted_on();
		}
		?>

	</header>

	<?php york_post_thumbnail(); ?>

	<div class="entry-content">

		<?php
		the_content(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'york-lite' ),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'york-lite' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>

		<?php york_entry_footer(); ?>

	</div>

</article>
