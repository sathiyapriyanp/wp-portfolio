<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>


<section>

	<div class="container h-screen flex justify-center flex-col">
		<header class="page-header alignwide">
			<h2 class="text-6xl ">404</h2>
			<h1 class="page-title text-2xl"><?php esc_html_e( 'Nothing here', 'text-domain' ); ?></h1>
		</header><!-- .page-header -->

		<div class="error-404 not-found default-max-width ">
			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'text-domain' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .page-content -->
		</div><!-- .error-404 -->
	</div>
	
</section>

<?php
get_footer();	
