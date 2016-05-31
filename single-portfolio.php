<?php
/**
 * The template for displaying all pages, single posts and attachments
 *
 * This is a new template file that WordPress introduced in
 * version 4.3. Note that it uses conditional logic to display
 * different content based on the post type.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package York
 */

get_header(); 

//Log the view counts.
york_setPostViews( get_the_ID() ); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

        	// Include the single post and single portfolio content template.	
        	get_template_part( 'template-parts/portfolio-single' );

            // Include Photoswipe on single portfolio pages.  
            get_template_part( 'template-parts/photoswipe');
			
		// End of the loop.
		endwhile;
		
		// Include the post more loop.
        if( get_theme_mod( 'portfolio_loop' ) == true) {

            get_template_part( 'template-parts/portfolio-more' );
       
        } ?>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>