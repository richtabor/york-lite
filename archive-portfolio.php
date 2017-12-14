<?php
/**
 * The template for displaying portfolio archives
 *
 * Used to display archive-type pages for portfolio posts.
 * If you'd like to further customize these taxonomy views, you may create a
 * new template file for each specific one.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

get_header(); ?>

<div id="projects" class="projects clearfix">

	<div class="grid-sizer"></div>

	<?php
	if ( have_posts() ) :

		/* Start the Loop */
		while ( have_posts() ) :

			the_post();

			if ( has_post_thumbnail() ) :

				get_template_part( 'components/portfolio/portfolio-loop' );

			endif;

		endwhile;
		?>

		<div id="page_nav">
			<?php next_posts_link(); ?>
		</div>

	<?php
	else :
		get_template_part( 'components/post/content', 'none' );
	endif;
	?>

</div>

<?php
get_footer();
