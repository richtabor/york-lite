<?php
/**
 * The template part for displaying content
 *
 * @package York
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php 

    the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookyork">', esc_url( get_permalink() ) ), '</a></h2>' );

    york_entry_meta();

    york_post_thumbnail();

    if ( is_sticky() && is_home() && ! is_paged() ) {
        //printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'snazzy' ) );
    } ?>

    <div class="entry-content">
        <?php
            /* translators: %s: Name of current post */
            the_content( sprintf(
                wp_kses( __( 'Continue reading %s', 'snazzy' ), array( 'span' => array( 'class' => array() ) ) ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );

            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'snazzy' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'snazzy' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
            edit_post_link(
                sprintf(
                    /* translators: %s: Name of current post */
                    esc_html__( 'Edit %s', 'snazzy' ),
                    the_title( '<span class="screen-reader-text">', '</span>', false )
                ),
                '<span class="edit-link">',
                '</span>'
            );
        ?>
    </footer><!-- .entry-footer -->

</article><!-- #post-## -->