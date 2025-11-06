<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */


get_header();

$banner_type = get_field("banner_type");
$banner_type = empty($banner_type) ? "default" : $banner_type;
get_template_part("templates-parts/banner",$banner_type);

get_breadcrumbs();

?>
<main class="mb-10 prose !max-w-full" id="main-content">
	<section>
		<div class="container">
			<?php the_content() ?>
		</div>
	</section>
</main>
<?php
get_footer();

// get_header();

// /* Start the Loop */
// while ( have_posts() ) :
// 	the_post();

// 	the_title( '<h1 class="entry-title">', '</h1>' );
// 	bluelogic_one_post_thumbnail();

// 	the_content();

// 	// If comments are open or there is at least one comment, load up the comment template.
// 	if ( comments_open() || get_comments_number() ) {
// 		comments_template();
// 	}
// endwhile; // End of the loop.

// get_footer();
