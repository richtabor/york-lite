<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package York
 */



if ( ! function_exists( 'york_site_logo' ) ) :
/**
 * Output an <img> tag of the site logo.
 *
 * Checks if jetpack_the_site_logo is available. If so, use  jetpack_the_site_logo();.
 * If not, there's a fallback of site_logo in the Theme Customizer.
 *
 */
function york_site_logo() {

	if ( function_exists( 'jetpack_the_site_logo' ) ) : 
		if ( jetpack_has_site_logo() ) { jetpack_the_site_logo(); } 
		else { ?> <h1 class="site-logo-link"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1><?php }
	else : 
		if( get_theme_mod( 'site_logo' )) { ?> 
		  	<a class="site-logo-link" href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><img style="<?php york_retina_logo(); ?>" src="<?php echo esc_url( get_theme_mod( 'site_logo' ) );?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="site-logo"></a>
		<?php
		} else { ?>
		  	<h1 class="site-logo-link"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php }
	endif; 
}
endif;



if ( ! function_exists( 'york_retina_logo' ) ) :
/**
* Output the width of the uploaded image, at 1/2 the original size.
*
* Create your own york_retina_logo() to override in a child theme.
*
*/
function york_retina_logo() {
    
    $data = get_theme_mod( 'site_logo_width' ); 
    $width = 'width:'.$data.'px;';
    echo $width;
}
endif;



if ( ! function_exists( 'york_gallery' ) ) :
/**
 * Return the portfolio and post galleries.
 * 
 * Checks if there are images uploaded to the post or portfolio post and outputs them.
 * Create your own york_gallery() to override in a child theme.
 */
function york_gallery($postid, $imagesize = '', $layout = '', $orderby = '', $single = false ) {
	$thumb_ID = get_post_thumbnail_id( $postid );
	$image_ids_raw = get_post_meta($postid, '_bean_image_ids', true);

	//Post meta
	$embed = get_post_meta($postid, '_bean_portfolio_embed_code', true);
	$embed2 = get_post_meta($postid, '_bean_portfolio_embed_code_2', true);
	$embed3 = get_post_meta($postid, '_bean_portfolio_embed_code_3', true);
	$embed4 = get_post_meta($postid, '_bean_portfolio_embed_code_4', true);
	$video_shortcodes = get_post_meta($postid, '_bean_portfolio_video_shortcodes', true);

	wp_reset_postdata();

	if( $image_ids_raw != '' )
	{
		$image_ids = explode(',', $image_ids_raw);
		$post_parent = null;
	} else {
		$image_ids = '';
		$post_parent = $postid;
	}

	$i = 1;

	//Pull in the image assets
	$args = array(
		'exclude' => $thumb_ID,
		'include' => $image_ids,
		'numberposts' => -1,
		'orderby' => 'post__in',
		'order' => 'ASC',
		'post_type' => 'attachment',
		'post_parent' => $post_parent,
		'post_mime_type' => 'image',
		'post_status' => null,
		);
	$attachments = get_posts($args); ?>
        
    <div class="project-assets">

		<div itemscope itemtype="http://schema.org/ImageGallery">
			
			<?php
			if( !empty($attachments) ) { 	
				
                if ( !post_password_required() ) {
					
                    foreach( $attachments as $attachment ) {

						$caption = $attachment->post_excerpt;
						$caption = ($caption) ? "$caption" : '';
						$alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;		    			
						$src = wp_get_attachment_image_src( $attachment->ID, $imagesize ); 
						?>

						<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
							
							<?php
                            echo '<img src="'.$src[0].'"/>';

							if ($caption) { echo '<div class="project-caption">'. htmlspecialchars($caption) .'</div>'; } ?>
					
						</figure>

						<?php
				    }
			    }
            }     

    echo '</div>';

} // END function york_gallery
endif;



if ( ! function_exists( 'york_entry_taxonomies' ) ) :
/**
 * Print HTML with category and tags for current post.
 * Create your own york_entry_taxonomies() to override in a child theme.
 */
function york_entry_taxonomies() {
    
    global $post;

    $portfolio_cats = get_post_meta($post->ID, '_bean_portfolio_cats', true);
    $portfolio_tags = get_post_meta($post->ID, '_bean_portfolio_tags', true); 

    if ($portfolio_cats == 'on') :

        if ( 'portfolio' == get_post_type() ) :

            $terms = get_the_terms( $post->ID, 'portfolio_category' );
            if ( $terms && ! is_wp_error( $terms ) ) :
                the_terms($post->ID, 'portfolio_category','', '', '');
            endif;

        else :

            $categories_list = get_the_category_list( esc_html_x( '', 'Used between list items, there is a space after the comma.', 'york-pro' ) );

            if ( $categories_list && york_categorized_blog() ) {
                printf( '<span class="screen-reader-text">%1$s</span>%2$s',
                    esc_html_x( 'Categories', 'Used before category names.', 'york-pro' ),
                    $categories_list
                );
            } 

        endif;

    endif;

    if ($portfolio_tags == 'on') :

        if ( 'portfolio' == get_post_type() ) :

            the_terms($post->ID, 'portfolio_tag','', '', '');

        else :

            $tags_list = get_the_tag_list( '', esc_html_x( '', 'Used between list items, there is a space after the comma.', 'york-pro' ) );

            if ( $tags_list ) {
                printf( '<span class="screen-reader-text">%1$s </span>%2$s',
                    esc_html_x( 'Tags', 'Used before tag names.', 'york-pro' ),
                    $tags_list
                );
            }

        endif;    

    endif; 
}
endif;



/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function york_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'york_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'york_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so york_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so york_categorized_blog should return false.
        return false;
    }
}



/**
 * Flush out the transients used in { @see york_categorized_blog() }.
 */
function york_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'york_categories' );
}
add_action( 'edit_category', 'york_category_transient_flusher' );
add_action( 'save_post',     'york_category_transient_flusher' );