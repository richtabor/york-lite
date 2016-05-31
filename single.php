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

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<?php
        // Start the loop.
        while ( have_posts() ) : the_post();

            // Include the single post content template.
            get_template_part( 'template-parts/content', 'single' );

            the_post_navigation( array(
                'next_text' => '<div class="nav-arrow"></div><div class="nav-title"><span class="meta-nav" aria-hidden="true"></span> ' .
                    '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'york' ) . '</span> ' .
                    '<span class="post-title">%title</span></div>',
                'prev_text' => '<div class="nav-arrow"></div><div class="nav-title"><span class="meta-nav" aria-hidden="true"></span> ' .
                    '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'york' ) . '</span> ' .
                    '<span class="post-title">%title</span></div>',
            ) ); 
            
            if ( ! is_singular( 'attachment' ) ) {
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }
            }

        // End of the loop.
        endwhile; ?>

	</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>