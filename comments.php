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

	<div id="comments" class="comments comments-area">

		<div class="comments-area__inner">

			<?php
			if ( have_comments() ) : ?>
				<h3 class="comments-title">
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
				</h3>

				<ol class="comment-list">
					<?php
						wp_list_comments( array(
							'avatar_size' => 100,
							'style'       => 'ol',
							'short_ping'  => true,
						) );
					?>
				</ol>

				<?php the_comments_pagination( array(
					'prev_text' => york_get_svg( array( 'icon' => 'left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'york-lite' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'york-lite' ) . '</span>' . york_get_svg( array( 'icon' => 'right' ) ),
				) );

			endif; // Check for have_comments().

			comment_form();

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'york-lite' ); ?></p>
			<?php
			endif; ?>

		</div>

	</div>

</div>
