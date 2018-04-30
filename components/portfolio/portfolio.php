<?php
/**
 * The template for displaying the portfolio grid.
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

?>

<div id="projects" class="projects clearfix">

	<div class="grid-sizer"></div>

	<?php
	$args = apply_filters(
		'york_portfolio_args', array(
			'post_type' => 'portfolio',
		)
	);

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) :

		/* Start the Loop */
		while ( $wp_query->have_posts() ) :

			$wp_query->the_post();

			if ( has_post_thumbnail() ) :

				get_template_part( 'components/portfolio/portfolio-loop' );

			endif;

		endwhile;

	endif;

	wp_reset_postdata();
	?>

	<div id="page_nav">
		<?php next_posts_link(); ?>
	</div>

</div>
