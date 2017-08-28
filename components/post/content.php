<?php
/**
 * Template part for displaying the singular post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		
		<?php
		if ( is_sticky() ) :
			echo wp_kses(
				york_get_svg(
					array(
						'icon' => 'sticky',
					)
				),
			york_svg_allowed_html() );
		endif;

		york_entry_categories();

		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<?php york_posted_on(); ?>

	</header>

	<?php york_post_thumbnail(); ?>

	<div class="post-content">

		<?php if ( is_single() && has_excerpt() ) : ?>
			<?php printf( '<h2 class="entry-excerpt">%1s</h2>', esc_html( get_the_excerpt() ) ); ?>
		<?php endif; ?>
		
		<div class="entry-content">
			<?php
				the_content( '' );

				wp_link_pages( array(
					'before'      => '<div class="page-links">' . __( 'Pages:', 'york-lite' ),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				) );
			?>

		</div>

		<?php if ( is_singular( 'post' ) ) :  ?>
			<?php get_template_part( 'components/post/biography' ); ?>
		<?php endif; ?>

	</div>

</article>
