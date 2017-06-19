<?php
/**
 * The file for displaying the portfolio meta.
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

// Log the view counts.
york_set_post_views( get_the_ID() );

/*
 * Set variables for the content below.
 */
$portfolio_cats = get_post_meta( $post->ID, '_bean_portfolio_cats', true );
$portfolio_tags = get_post_meta( $post->ID, '_bean_portfolio_tags', true ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

	<div class="hero">

		<header class="entry-header">
		
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<?php if ( 'on' === $portfolio_cats or 'on' === $portfolio_tags ) { ?> 

				<div class="project-taxonomy">
					<p><?php york_entry_taxonomies(); ?></p>
				</div>

			<?php } ?>

		</header>

		<div class="project-description entry-content">
			<?php the_content(); ?>
		</div>
	
		<?php get_template_part( 'components/portfolio/portfolio-meta' ); ?>
		
	</div>

	<?php york_gallery( $post->ID, 'york-portfolio-full' ); ?>

</article>
