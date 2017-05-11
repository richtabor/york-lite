<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

get_header();

// Start the loop.
while ( have_posts() ) : the_post();

	if ( has_post_thumbnail() ) {
		echo '<div class="entry-media">';
			the_post_thumbnail( 'page-feat' );
		echo '</div>';
	} ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="entry-content">
			
			<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', '@@textdomain' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', '@@textdomain' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			?>

		</div>

	</article>

	<?php

	/*
	 * If comments are open or we have at least one comment, load up the comment template.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/comments_open/
	 * @link https://codex.wordpress.org/Template_Tags/get_comments_number/
	 * @link https://developer.wordpress.org/reference/functions/comments_template/
	 */
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile;

get_footer();
