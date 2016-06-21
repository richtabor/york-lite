<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package York
 */

get_header(); ?>

<div id="projects" class="projects clearfix">

    <?php if ( have_posts() ) :

        // Start the loop.
        while ( have_posts() ) : the_post(); 
                
            if ( has_post_thumbnail() ) :
                
                get_template_part( 'template-parts/portfolio-loop');

            endif;

        // End the loop.
        endwhile;

    // If no content, include the "No posts found" template.
    else :
        get_template_part( 'template-parts/content', 'none' );
    endif;
    ?>

    <div id="page_nav">
        <?php next_posts_link(); ?>
    </div>
        
</div><!-- .projects -->

<?php get_footer();