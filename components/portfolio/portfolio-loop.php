<?php
/**
 * The template for displaying the portfolio loop.
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/**
 * Check if there's a secondary thumbnail uploaded. If so, we'll
 * add the '.project--has-second' class to the article.
 */
$size_class = get_post_meta( $post->ID, '_bean_portfolio_grid_size', true );

printf( '<article class="project %1s" >', esc_attr( $size_class ) );

	echo '<div class="project-inner">';

		echo '<div class="overlay">';

			echo '<div class="center">';

				the_title( '<h3 class="entry-title">', '</h3>' );

			echo '</div>';

		echo '</div>'; ?>

		<?php

		/*
		 * Let's check if there's an external url included on the back end.
		 * If there is, that will be assigned as the $portfolio_url variable, if not,
		 * the post permalink will be assigned.
		 */
		$external_url         = get_post_meta( $post->ID, '_bean_portfolio_external_url', true );
		$portfolio_url        = ( $external_url ) === true ? $external_url : get_the_permalink();
		$portfolio_url_class  = ( $external_url ) === true ? 'class=project-link project-link_external' : '';
		$portfolio_url_target = ( $external_url ) === true ? '_blank' : '_self';

		printf(
			'<a href="%1s" data-id="%2$s" %3$s target="%4$s" class="project-link"></a>',
			esc_url( $portfolio_url ),
			esc_html( get_the_ID() ),
			esc_html( $portfolio_url_class ),
			esc_html( $portfolio_url_target )
		);

		the_post_thumbnail( 'york-featured-image' );
		?>

		</figure>

	</div>

</article>
