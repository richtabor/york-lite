<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package York
 */
 
get_header(); ?>
	
	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">
		
			<section class="error-404 not-found">

				<header class="page-header">
					<h1><?php esc_html_e( '404', 'york' ); ?></h1>
				</header><!-- .page-header -->
				
				<div class="page-content">
					<p><a href="<?php echo esc_url( home_url('/') ); ?>" class="button"><?php esc_html_e( 'Go Home', 'york' ); ?></a>
	 			</div><!-- .page-content -->

	 		</section><!-- .error-404 -->

		</main><!-- .site-main -->
	
	</div><!-- .content-area -->
	
<?php get_footer();