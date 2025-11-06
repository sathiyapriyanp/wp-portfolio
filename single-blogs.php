<?php
/**
 * The template for displaying all single posts
 *
 * @link 
 *
 * @package WordPress
 * @subpackage -
 * @since 1.0
 */

get_header();



get_breadcrumbs();

?>
<main class="mb-10 prose !max-w-full" id="main-content">
	<section>
		<div class="container">
			<div class="max-w-5xl">
				<?php the_content() ?>
			</div>
		</div>
	</section>
	<section class="blog-comments">
		<?php
		// If comments are open or there is at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</section>
</main>
<?php
get_footer();
?>