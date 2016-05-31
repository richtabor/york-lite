<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package York
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
} ?>

<div id="comments" class="comments-area">
    
    <div class="comments-wrap">
    
    <?php if ( have_comments() ) : ?>

        <h4 class="comments-title">
            <?php
                $comments_number = get_comments_number();
                if ( 1 === $comments_number ) {
                    /* translators: %s: post title */
                    printf( _x( 'One Response', 'comments title', 'york' ));
                } else {
                    printf(
                        /* translators: 1: number of comments, 2: post title */
                        _nx(
                            '%1$s Response',
                            '%1$s Response',
                            $comments_number,
                            'comments title',
                            'york'
                        ),
                        number_format_i18n( $comments_number ),
                        get_the_title()
                    );
                }
            ?>
        </h4>

    <?php else :
        printf( '<h4 class="comments-title">%1s</h4>', esc_html__( 'Leave a Comment', 'york' ) ); 
    endif;

    if ( have_comments() ) : ?>

        <ol class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 42,
                    'callback'    => 'york_comments',
                ) );
            ?>
        </ol><!-- .comment-list -->

    <?php endif; // Check for have_comments(). ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php esc_html__( 'Comments are closed.', 'york' ); ?></p>
    <?php endif; ?>

    <?php
        comment_form( array(
            'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after'  => '</h2>',
        ) );
    ?>

    </div><!-- .comments-wrap -->

</div><!-- .comments-area -->