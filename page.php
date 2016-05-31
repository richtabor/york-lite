<?php
/**
 * The template for displaying all pages, single posts and attachments
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package York
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'page' );

		// End of the loop.
		endwhile; 

        // Include the post more loop.
        if( get_theme_mod( 'portfolio_loop_pages' ) == true ) {
            get_template_part( 'template-parts/portfolio-more' );
        } ?>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>