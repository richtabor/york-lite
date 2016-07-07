<?php
/**
 *The template for displaying posts in the standard post format.
 *
 * @package York
 */
 ?>

<div id="projects" class="projects clearfix">
   
    <?php
    // Check what post type this is.
    if ( is_post_type_archive('portfolio') ) {
        $post_type = 'portfolio';
    } else {
        $post_type = 'post';
    }
    
	// Pull pagination count setting from the Customizer.
	$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count');

	// Pull pagination from the reading settings.
	$paged = 1; 
	if ( get_query_var('paged') ) $paged = get_query_var('paged');
	if ( get_query_var('page') ) $paged = get_query_var('page'); 

	if ( is_tax() ) {

		global $query_string; query_posts("{$query_string}&posts_per_page=-1");

		if (have_posts()) : while (have_posts()) : the_post();		                 
		
			get_template_part( 'template-parts/portfolio-loop');
		
		endwhile; endif; wp_reset_postdata(); 

	} else {

		$args = array(
			'post_type'      => $post_type,
			'order'		     => 'ASC',
			'orderby'		 => 'menu_order',
			'paged' 		 => $paged,
			'posts_per_page' => $portfolio_posts_count,
			);
		
		$wp_query = new WP_Query( $args );
		
		if ($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
				
			get_template_part( 'template-parts/portfolio-loop');

		endwhile; endif; wp_reset_postdata();

	} //END else is_tax()  ?>

    <div id="page_nav">
        <?php next_posts_link(); ?>
    </div>

</div><!-- .projects -->