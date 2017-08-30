<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<header class="page-header">
		<?php if ( have_posts() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'york-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e( 'Nothing Found', 'york-lite' ); ?></h1>
		<?php endif; ?>
	</header><!-- .page-header -->

		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'components/post/content', 'excerpt' );

			endwhile; // End of the loop.

			the_posts_pagination( array(
				'prev_text' => york_get_svg( array( 'icon' => 'left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'york-lite' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'york-lite' ) . '</span>' . york_get_svg( array( 'icon' => 'right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'york-lite' ) . ' </span>',
			) );

		else : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'york-lite' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>

<?php get_footer();
