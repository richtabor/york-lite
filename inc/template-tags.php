<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package York
 */



if ( ! function_exists( 'york_pagination' ) ) :
/**
 * Returns the pagination for index, search and archivial views.
 * 
 * Checks if the Jetpack infinite-scroll module is activated.  
 * If not, use the standard the_posts_pagination function. Create your own
 * snazzy_pagination() to override the the_posts_pagination function in a child theme.
 *
 * @see http://wptheming.com/2013/04/check-if-jetpack-modules-are-enabled/
 * @see https://codex.wordpress.org/Function_Reference/the_posts_pagination 
 */
function york_pagination() {

    if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) : else:

        // Previous/next page navigation.
        the_posts_pagination( array(
            'prev_text'          => esc_html__( 'Previous', 'york' ),
            'next_text'          => esc_html__( 'Next', 'york' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'york' ) . ' </span>',
        ) );

    
    endif;
}
endif;



if ( ! function_exists( 'york_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function york_post_thumbnail() {
    global $post;   

    if ( post_password_required() || is_attachment() ) {
        return;
    }

    if ( has_post_thumbnail() ) {
        echo '<div class="entry-media">';
    }

        $embed = get_post_meta($post->ID, '_bean_post_embed', true);

        /*
         * Check if this post is a video post format and an embed.
         * If so, we just want to display the iframe, not the post thumbnail below.
         */
        if ( has_post_format( 'video' ) AND $embed ) :
           
           echo balanceTags( $embed );  

        /*
         * Check if this post is an image post format and has a featured image.
         * If so, let's pull the image and a full version of it, and add a lightbox.
         */
        elseif ( has_post_format( 'image' ) AND has_post_thumbnail() ) :
            
            $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'page_post-feat');
            $src_lrg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'port-full');

            echo '<a href="'.esc_html($src_lrg[0]).'" class="lightbox-link" data-lity ><img src="'.esc_html($src[0]).'"></a>';

        else: 

            if ( ! has_post_thumbnail() ) {
                /*
                 * If there's no post thumbnail, we don't need to proceed.
                 */
                return;
            }

            york_video_lightbox(); 

            if ( is_singular() ) : ?>

                <div class="post-thumbnail">
                    <?php the_post_thumbnail( 'page_post-feat' ); ?>
                </div><!-- .post-thumbnail -->

            <?php else : ?>

                <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                    <?php the_post_thumbnail( 'page_post-feat', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                </a>

            <?php endif;

        endif;

    if ( has_post_thumbnail() ) {
        echo '</div>';
    }

    
}
endif;



if ( ! function_exists( 'york_video_lightbox' ) ) :
/**
 * Display a video lightbox.
 */
function york_video_lightbox() {   

    global $post;     
    
    /*
     * Check if this is a post, post type, and if this is a video post format. 
     */
    if ( 'post' == get_post_type() AND has_post_format( 'video' ) ) {
        
        /*
         * Now let's check if there is an embed url. If so, let's show the "play" icon 
         * and add an lightbox iframe to display the video.
         */
        $embed_url = get_post_meta($post->ID, '_bean_post_embed_url', true);

        if ( $embed_url ) :
            printf( '<a href="%s" class="lightbox-link lightbox-play" data-lity></a>', esc_url( $embed_url ) );
        endif; 
    } 
}
endif;



if ( ! function_exists( 'york_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * Create your own york_entry_meta() to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function york_entry_meta() {

    echo '<div class="post-meta">';

    if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
        york_entry_date();
    }

    if ( 'post' == get_post_type() ) {
        york_entry_taxonomies();
    }

    echo '</div>';
}
endif;



if ( ! function_exists( 'york_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own york_entry_date() to override in a child theme.
 */
function york_entry_date() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookyork">%3$s</a></span>',
        esc_html_x( 'Posted on', 'Used before publish date.', 'york' ),
        esc_url( get_permalink() ),
        $time_string
    );
}
endif;



if ( ! function_exists( 'york_entry_taxonomies' ) ) :
/**
 * Print HTML with category and tags for current post.
 *
 * Create your own york_entry_taxonomies() to override in a child theme.
 */
function york_entry_taxonomies() {
    $categories_list = get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'york' ) );
    if ( $categories_list && york_categorized_blog() ) {
        printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
            esc_html_x( 'Categories', 'Used before category names.', 'york' ),
            $categories_list
        );
    }

    $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'york' ) );
    if ( $tags_list ) {
        printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
            esc_html_x( 'Tags', 'Used before tag names.', 'york' ),
            $tags_list
        );
    }
}
endif;



if ( ! function_exists( 'york_social_navigation' ) ) :
/**
 * Output the social menu.
 *
 * Checks if the social navigation is added.
 *
 */
function york_social_navigation() {

    if ( has_nav_menu( 'social' ) ) : ?>
        <nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'york' ); ?>">
            <?php
            // Let's get the SVG URL. We switch it via JS, depending on the URL.
            $svg = '<svg viewBox="0 0 64 64"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href=""></use></svg>';

            wp_nav_menu( array(
                'theme_location' => 'social',
                'menu_class'     => 'social-links-menu',
                'depth'          => '1',
                'link_before'    => '<div>'. $svg .'</div><span class="screen-reader-text">',
                'link_after'     => '</span>',
                ) );
            ?>
        </nav><!-- .social-navigation -->
    <?php endif; 
}
endif;



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



if ( ! function_exists( 'york_project_featured_img' ) ) :
/**
 * Return the porfolio featured image.
 * 
 * Checks if a featured image is uploaded and creates a background image CSS rule
 * Create your own york_project_featured_img() to override in a child theme.
 *
 * @see https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
 * @see https://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
 * @see https://codex.wordpress.org/Function_Reference/has_post_thumbnail 
 */
function york_project_featured_img( $post_id ) {
	   global $post;

        $feat_image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'port-grid');

		$feat_image = 'background-image: url(' . esc_html($feat_image[0]) . ');'; 
        $feat_image = '<div class="thumb thumb--first" style="'. $feat_image .'"></div>'; 
		return $feat_image;
}
endif;



if ( ! function_exists( 'york_project_featured_img_hover' ) ) :
/**
 * Return the porfolio featured hover image.
 * 
 * Checks if a featured image is uploaded and creates a background image CSS rule
 * Create your own york_project_featured_img_hover() to override in a child theme.
 *
 * @see https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
 * @see https://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
 * @see https://codex.wordpress.org/Function_Reference/has_post_thumbnail 
 */
function york_project_featured_img_hover( $post_id ) {
    global $post;

    if (class_exists('MultiPostThumbnails')) : 

        if (MultiPostThumbnails::has_post_thumbnail('portfolio', 'secondary-image')) {

            $feat_image = MultiPostThumbnails::get_post_thumbnail_url( get_post_type(),'secondary-image', $post_id );
            $feat_image = 'background-image: url(' . esc_html($feat_image) . ');'; 
            $feat_image = '<div class="thumb thumb--second" style="'. $feat_image .'"></div>'; 

            return $feat_image;

        }

    endif;
}
endif;



if ( ! function_exists( 'york_project_background_colors' ) ) :
/**
 * Return the hero background image.
 * 
 * Checks if a color is selected on the page meta. If so, it overrides the Customizer setting.
 * Create your own york_project_background_colors() to override in a child theme.
 *
 * @see https://codex.wordpress.org/Function_Reference/wp_get_attachment_url
 * @see https://codex.wordpress.org/Function_Reference/get_post_thumbnail_id
 * @see https://codex.wordpress.org/Function_Reference/has_post_thumbnail 
 */
function york_project_background_colors( ) {
    global $post;

    //Post meta variables
    $color = get_post_meta($post->ID, '_bean_portfolio_color', true); 
    $color = ( $color )  ? 'style=background:' . esc_html($color) . ';' : '';

    $color_hover = get_post_meta($post->ID, '_bean_portfolio_color_hover', true); 
    $color_hover = ( $color_hover ) ? 'style=background:' . esc_html($color_hover) . ';' : '';

    echo '<div class="project--color project--color-std" '. esc_html($color) .' ></div>';   
    echo '<div class="project--color project--color-hover" '. esc_html($color_hover) .' ></div>';   

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
        <?php 
        if ( !post_password_required() ) {
            if($embed) {
                echo '<figure class="video-frame">';
                    echo stripslashes(htmlspecialchars_decode($embed));
                echo '</figure>';
            }

            if($embed2) {
                echo '<figure class="video-frame">';
                    echo stripslashes(htmlspecialchars_decode($embed2));
                echo '</figure>';
            }

            if($embed3) {
                echo '<figure class="video-frame">';
                    echo stripslashes(htmlspecialchars_decode($embed3));
                echo '</figure>';
            }

            if($embed4) {
                echo '<figure class="video-frame">';
                    echo stripslashes(htmlspecialchars_decode($embed4));
                echo '</figure>';
            }

            if($video_shortcodes) { 
                echo '<figure class="video-frame">';
                    echo do_shortcode(''.$video_shortcodes.'');
                echo '</figure>';
            }
        } ?>

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
                            if ( is_singular('portfolio') ) { 
                                echo '<a href="'.$src[0].'" class="lightbox-link" title="'. htmlspecialchars($caption) .'" alt="'.$alt.'" itemprop="contentUrl" data-size="'.$src[1].'x'.$src[2].'">';
    							    echo '<img src="'.$src[0].'"/>';
    							echo '</a>';
                            } else {
                                echo '<img src="'.$src[0].'"/>';
							}

							if ($caption) { echo '<div class="project-caption">'. htmlspecialchars($caption) .'</div>'; } ?>
                            
					
						</figure>

						<?php
				    }
			    }
            }     

    echo '</div>';

} // END function york_gallery
endif;



if ( ! function_exists( 'york_site_map' ) ) :
/**
 * Prints HTML containing the site map.
 * This function is currently pulled by content-page.php, which checks if 
 * the Site Map template (template-site-map.php) is in use.
 * Create your own york_site_map() to override in a child theme.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_list_pages
 */

function york_site_map() {
	if ( is_singular() && 'page' == get_post_type() ) {
		
		printf('<ul class="site-archive">');
			printf( esc_html(wp_list_pages('title_li=') ) );
		printf('</ul>');

	}
}
endif;



if ( ! function_exists( 'york_site_archive' ) ) :
/**
 * Prints HTML containing the site archives by month, year and category.
 * This function is currently pulled by content-page.php, which checks if 
 * the Archive template (template-archive.php) is in use.
 * Create your own york_site_archive() to override in a child theme.
 *
 * @link https://codex.wordpress.org/Function_Reference/wp_get_archives
 * @link https://codex.wordpress.org/Function_Reference/wp_list_categories 
 */

function york_site_archive() {
	if ( is_singular() && 'page' == get_post_type() ) {
		
		printf('<div class="site-archive">');
			printf( '<h6>%s</h6>', esc_html( 'Monthly', 'york' ) );
			printf( '<ul>%s</ul>', wp_get_archives( array( 'type' => 'monthly', 'limit' => 10 ) ) );
			printf( '<h6>%s</h6>', esc_html( 'Yearly', 'york' ) );
			printf( '<ul>%s</ul>', wp_get_archives( array( 'type' => 'yearly', 'limit' => 10 ) ) );
			printf( '<h6>%s</h6>', esc_html( 'Categories', 'york' ) );
			printf( '<ul>%s</ul>', wp_list_categories( 'title_li=' )
			);
		printf('</div>');

	}
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