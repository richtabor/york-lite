<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package @@pkg.name
 * @version @@pkg.version
 * @author  @@pkg.author
 * @license @@pkg.license
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div class="comments-area--wrapper">

	<div id="comments" class="comments-area">

		<div class="comments-area__inner">
			
			<?php
			if ( have_comments() ) : ?>
				<h5 class="comments-title">
					<?php
					$comments_number = get_comments_number();
					if ( '1' === $comments_number ) {
						esc_html_e( 'One Comment', 'york-lite' );
					} else {
						printf(
							esc_html(
								/* translators: 1: number of comments */
								_nx(
									'%s Comment',
									'%s Comments',
									$comments_number,
									'number of comments',
									'york-lite'
								)
							),
							esc_html( number_format_i18n( $comments_number ) )
						);
					}
					?>
				</h5>
			
			<?php else : ?>
			
				<h5 class="comments-title">
					<?php esc_html_e( 'Leave a Comment', 'york-lite' ); ?>
				</h5>

			<?php endif; ?>

			<?php comment_form(); ?>
			
			<?php if ( have_comments() ) : ?>
			
				<div id="comments-list" class="comments">

					<ol class="commentlist block comment-list">
						<?php
							wp_list_comments( array(
								'avatar_size' => 100,
								'style'       => 'ol',
								'short_ping'  => true,
							) );
						?>
					</ol><!-- .comment-list -->

					<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
						<nav id="comment-nav-below" class="navigation comment-navigation">
							<h2 class="screen-reader-text"><?php esc_html_e( 'Comment Navigation', 'york-lite' ); ?></h2>
							<div class="nav-links">
								<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'york-lite' ) ); ?></div>
								<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'york-lite' ) ); ?></div>
							</div><!-- .nav-links -->
						</nav><!-- #comment-nav-below -->
					<?php
					endif; // Check for comment navigation. ?>

				</div><!-- END #comments-list.comments -->

			<?php endif; ?>
			
			<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'york-lite' ); ?></p>
			<?php
			endif; ?>

		</div>

	</div>

</div>
