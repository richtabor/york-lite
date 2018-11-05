<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package @@pkg.name
 * @author  @@pkg.author
 * @license @@pkg.license
 */

?>

<section class="no-results not-found">

	<header class="page-header">
		<h1 class="page-title"><?php echo esc_html__( 'Nothing Found', 'york-lite' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php /* translators: link to publish a new post */ ?>
			<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'york-lite' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<p><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'york-lite' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>
	</div>

</section>
