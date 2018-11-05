<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

get_header(); ?>

	<header class="page-header">
		<?php if ( have_posts() ) : ?>
			<?php /* translators: 1: search query */ ?>
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'york-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'york-lite' ); ?></h1>
		<?php endif; ?>
	</header>

	<div class="hfeed">

		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'components/post/content', 'excerpt' );

			endwhile; // End of the loop.

			the_posts_pagination(
				array(
					'prev_text'          => york_get_svg( array( 'icon' => 'left' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'york-lite' ) . '</span>',
					'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'york-lite' ) . '</span>' . york_get_svg( array( 'icon' => 'right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'york-lite' ) . ' </span>',
				)
			);

		else :
		?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'york-lite' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>
	</div>

<?php
get_footer();
