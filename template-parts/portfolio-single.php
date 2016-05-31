<?php
/**
 * The file for displaying the portfolio meta.
 *  
 * @subpackage York
 */
 ?>

 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

    <div class="project-description">

        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php the_content(); ?>
        </div>

        <?php get_template_part( 'template-parts/portfolio-meta'); ?>
        
        </div>

    <?php    
    //Load the gallery media element, located in inc/template-tags.php
    york_gallery($post->ID, 'port-full', 'portfolio-single' , '' , true); ?>

</article>