<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 */

get_header();

get_template_part("templates-parts/banner","with-form",[
	"title" =>  $wp_query->found_posts ? 'Results for <i>' . esc_html( get_search_query() ) . "</i>" : 'No results found for <i>' . esc_html( get_search_query() ) . "</i>" ,
	'excerpt' => _n(
		'We found '. $wp_query->found_posts .' result for your search.',
		'We found '. $wp_query->found_posts .' results for your search.',
		(int) $wp_query->found_posts,
		'ncoop'
	),
	"form_file_path" => "searchform"
]);
?>
<div class="container mb-10" id="main-content" >
	<?php

	if ( have_posts() ) {
		// Start the Loop.
		while ( have_posts() ) {
			the_post();

			/*
			* Include the Post-Format-specific template for the content.
			* If you want to override this in a child theme, then include a file
			* called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
			
			?>
			<article id="post-<?php the_ID(); ?>"  class="border rounded-xl p-4 border-secondary border-solid mb-6" >
			<?php
				the_title( sprintf( '<h2 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' );
				bluelogic_one_post_thumbnail();
			?>		


				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div><!-- .entry-content -->

				<footer class="entry-footer default-max-width">
					<a href="<?=  esc_url( get_permalink() )  ?>" class="mt-10 inline-block" > View page <i data-lucide="arrow-right">	</i> </a>
					<?php bluelogic_one_entry_meta_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-${ID} -->
			<?php
		} // End the loop.

		// Previous/next page navigation.
		bluelogic_the_posts_navigation();

		// If no content, include the "No posts found" template.
	} else {
	
	}
	?>
</div>
<?php

get_footer();

