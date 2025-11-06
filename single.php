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

/* Start the Loop */
while ( have_posts() ) :
	the_post();

	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header alignwide">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<?php bluelogic_one_post_thumbnail(); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'boilerplate-text-domain' ) . '">',
					'after'    => '</nav>',
					/* translators: %: Page number. */
					'pagelink' => esc_html__( 'Page %', 'boilerplate-text-domain' ),
				)
			);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer default-max-width">
			<?php bluelogic_one_entry_meta_footer(); ?>
		</footer><!-- .entry-footer -->

		<?php if ( ! is_singular( 'attachment' ) ) : ?>
			<?php if ( (bool) get_the_author_meta( 'description' ) && post_type_supports( get_post_type(), 'author' ) ) : ?>
				<div class="author-bio <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), '85' ); ?>
					<div class="author-bio-content">
						<h2 class="author-title">
						<?php
						printf(
							/* translators: %s: Author name. */
							esc_html__( 'By %s', 'boilerplate-text-domain' ),
							get_the_author()
						);
						?>
						</h2>
						<p class="author-description"> <?php the_author_meta( 'description' ); ?></p><!-- .author-description -->
						<?php
						printf(
							'<a class="author-link" href="%1$s" rel="author">%2$s</a>',
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							sprintf(
								/* translators: %s: Author name. */
								esc_html__( 'View all of %s\'s posts.', 'boilerplate-text-domain' ),
								get_the_author()
							)
						);
						?>
					</div><!-- .author-bio-content -->
				</div><!-- .author-bio -->
				<?php
			endif;
		endif; ?>

	</article><!-- #post-<?php the_ID(); ?> -->
	<?php

	if ( is_attachment() ) {
		// Parent post navigation.
		the_post_navigation(
			array(
				/* translators: %s: Parent post link. */
				'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'boilerplate-text-domain' ), '%title' ),
			)
		);
	}

	// If comments are open or there is at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

	// Previous/next post navigation.

	$_next_label     = esc_html__( 'Next post', 'boilerplate-text-domain' );
	$_previous_label = esc_html__( 'Previous post', 'boilerplate-text-domain' );

	the_post_navigation(
		array(
			'next_text' => '<p class="meta-nav">' . $_next_label  . '</p><p class="post-title">%title</p>',
			'prev_text' => '<p class="meta-nav">' .  $_previous_label . '</p><p class="post-title">%title</p>',
		)
	);
endwhile; // End of the loop.

get_footer();
