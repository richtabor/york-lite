<?php
/**
 * The template for displaying the portfolio loop.
 *
 * @package York
 */

/**
 * Check to see if a featured image is uploaded. 
 * There's no point showing an article link, if there's no image. 
 */
if ( has_post_thumbnail() ) :

	/**
	 * Let's check if there's a secondary thumbnail uploaded. If so, we'll 
	 * add the '.project--has-second' class to the article.
	 */

    $secondThumb = MultiPostThumbnails::has_post_thumbnail('portfolio', 'secondary-image');
    $secondThumb = ( $secondThumb ) == true ? 'project--has-second' : '';

	printf( '<article class="project %1$s">', esc_html( $secondThumb ) );  

        echo '<div class="intrinsic">';
    		
            the_title( '<h3 class="entry-title--hidden">', '</h3>' );
            
            /*
    		 * Let's check if there's an external url included on the back end.
    		 * If there is, that will be assigned as the $portfolio_url variable, if not,
    		 * the post permalink will be assigned. 
    		 */

    		$external_url = get_post_meta($post->ID, '_bean_portfolio_external_url', true);  
    		$portfolio_url = ( $external_url ) == true ? $external_url : get_the_permalink();
            $portfolio_url_class = ( $external_url ) == true ? 'class=project--link_external' : '';
            $portfolio_url_target = ( $external_url ) == true ? '_blank' : '_self';

            /*
             * Let's print the post link, featured image and secondary featured image.
             * If there is one uploaded, we'll add it to be displayed upon image hover.
             */

    		printf( '<a href="%1s" data-id="%2$s" %3$s target="%4$s">%5$s%6$s</a>', 
                esc_url( $portfolio_url ), 
                esc_html( get_the_ID() ), 
                esc_html( $portfolio_url_class ), 
                esc_html( $portfolio_url_target ), 
                york_project_featured_img( get_the_ID() ),
                york_project_featured_img_hover( get_the_ID() )
            );

            echo esc_html( york_project_background_colors() );
        
        echo '</div>';

    echo '</article>';

endif;