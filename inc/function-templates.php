<?php
 defined( 'ABSPATH' )  OR die;
 
if ( ! function_exists( 'bluelogic_one_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since Boilerplate 1.0
	 *
	 * @return void
	 */
	function bluelogic_one_post_thumbnail() {
		if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
			return;
		}
		?>

		<?php if ( is_singular() ) : ?>

			<figure class="post-thumbnail">
				<?php
				// Lazy-loading attributes should be skipped for thumbnails since they are immediately in the viewport.
				the_post_thumbnail( 'post-thumbnail', array( 'loading' => false ) );
				?>
				<?php if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) : ?>
					<figcaption class="wp-caption-text"><?php echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figcaption>
				<?php endif; ?>
			</figure><!-- .post-thumbnail -->

		<?php else : ?>

			<figure class="post-thumbnail">
				<a class="post-thumbnail-inner alignwide" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( 'post-thumbnail' ); ?>
				</a>
				<?php if ( wp_get_attachment_caption( get_post_thumbnail_id() ) ) : ?>
					<figcaption class="wp-caption-text"><?php echo wp_kses_post( wp_get_attachment_caption( get_post_thumbnail_id() ) ); ?></figcaption>
				<?php endif; ?>
			</figure><!-- .post-thumbnail -->

		<?php endif; ?>
		<?php
	}
}

if ( ! function_exists( 'bluelogic_one_entry_meta_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 * Footer entry meta is displayed differently in archives and single posts.
	 *
	 *
	 * @return void
	 */
	function bluelogic_one_entry_meta_footer() {

		// Early exit if not a post.
		if ( 'post' !== get_post_type() ) {
			return;
		}

        $continue_reading = sprintf(
            /* translators: %s: Post title. Only visible to screen readers. */
            esc_html__( 'Continue reading %s', 'boilerplate-text-domain' ),
            the_title( '<span class="screen-reader-text">', '</span>', false )
        );

		// Hide meta information on pages.
		if ( ! is_single() ) {

			if ( is_sticky() ) {
				echo '<p>' . esc_html_x( 'Featured post', 'Label for sticky posts', 'boilerplate-text-domain' ) . '</p>';
			}

			$post_format = get_post_format();
			if ( 'aside' === $post_format || 'status' === $post_format ) {
				echo '<p><a href="' . esc_url( get_permalink() ) . '">' . $continue_reading . '</a></p>'; // phpcs:ignore WordPress.Security.EscapeOutput
			}

			// Posted on.
			bluelogic_one_posted_on();

			// Edit post link.
			edit_post_link(
				sprintf(
					/* translators: %s: Post title. Only visible to screen readers. */
					esc_html__( 'Edit %s', 'boilerplate-text-domain' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				),
				'<span class="edit-link">',
				'</span><br>'
			);

			if ( has_category() || has_tag() ) {

				echo '<div class="post-taxonomies">';

				$categories_list = get_the_category_list( wp_get_list_item_separator() );
				if ( $categories_list ) {
					printf(
						/* translators: %s: List of categories. */
						'<span class="cat-links">' . esc_html__( 'Categorized as %s', 'boilerplate-text-domain' ) . ' </span>',
						$categories_list // phpcs:ignore WordPress.Security.EscapeOutput
					);
				}

				$tags_list = get_the_tag_list( '', wp_get_list_item_separator() );
				if ( $tags_list ) {
					printf(
						/* translators: %s: List of tags. */
						'<span class="tags-links">' . esc_html__( 'Tagged %s', 'boilerplate-text-domain' ) . '</span>',
						$tags_list // phpcs:ignore WordPress.Security.EscapeOutput
					);
				}
				echo '</div>';
			}
		} else {

			echo '<div class="posted-by">';
			// Posted on.
			bluelogic_one_posted_on();
			// Posted by.
			bluelogic_one_posted_by();
			// Edit post link.
			edit_post_link(
				sprintf(
					/* translators: %s: Post title. Only visible to screen readers. */
					esc_html__( 'Edit %s', 'boilerplate-text-domain' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				),
				'<span class="edit-link">',
				'</span>'
			);
			echo '</div>';

			if ( has_category() || has_tag() ) {

				echo '<div class="post-taxonomies">';

				$categories_list = get_the_category_list( wp_get_list_item_separator() );
				if ( $categories_list ) {
					printf(
						/* translators: %s: List of categories. */
						'<span class="cat-links">' . esc_html__( 'Categorized as %s', 'boilerplate-text-domain' ) . ' </span>',
						$categories_list // phpcs:ignore WordPress.Security.EscapeOutput
					);
				}

				$tags_list = get_the_tag_list( '', wp_get_list_item_separator() );
				if ( $tags_list ) {
					printf(
						/* translators: %s: List of tags. */
						'<span class="tags-links">' . esc_html__( 'Tagged %s', 'boilerplate-text-domain' ) . '</span>',
						$tags_list // phpcs:ignore WordPress.Security.EscapeOutput
					);
				}
				echo '</div>';
			}
		}
	}
}

if ( ! function_exists( 'bluelogic_one_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 *
	 * @return void
	 */
	function bluelogic_one_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);
		echo '<span class="posted-on">';
		printf(
			/* translators: %s: Publish date. */
			esc_html__( 'Published %s', 'boilerplate-text-domain' ),
			$time_string // phpcs:ignore WordPress.Security.EscapeOutput
		);
		echo '</span>';
	}
}

if ( ! function_exists( 'bluelogic_one_posted_by' ) ) {
	/**
	 * Prints HTML with meta information about theme author.
	 *
	 *
	 * @return void
	 */
	function bluelogic_one_posted_by() {
		if ( ! get_the_author_meta( 'description' ) && post_type_supports( get_post_type(), 'author' ) ) {
			echo '<span class="byline">';
			printf(
				/* translators: %s: Author name. */
				esc_html__( 'By %s', 'boilerplate-text-domain' ),
				'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">' . esc_html( get_the_author() ) . '</a>'
			);
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'bluelogic_the_posts_navigation' ) ) {
	/**
	 * Print the next and previous posts navigation.
	 *
	 *
	 * @return void
	 */
	function bluelogic_the_posts_navigation() {
		the_posts_pagination(
			array(
				'before_page_number' => "",
				'mid_size'           => 0,
				'prev_text'          => '<i data-lucide="arrow-left"></i>',
				'next_text'          => '<i data-lucide="arrow-right"></i>',
			)
		);
	}
}



if( ! function_exists( 'bluelogic_get_image' ) ){
	function bluelogic_get_image( $image_id, $alt = null, $attributes = ""){

		if( empty( $image_id ) || $image_id == 0 ) return "";

		$image_url = wp_get_attachment_image_url( $image_id , "full"); 
		$image_url_md = wp_get_attachment_image_url( $image_id , "medium"); 
	
		ob_start();
		?>	
			<img src="<?= $image_url_md ?>" data-src="<?= $image_url ?>" alt="<?= $alt ?>" <?=  $attributes ?> />
		<?php
		return ob_get_clean();
	}
}


if( ! function_exists( 'bluelogic_get_bg_image' ) ){

	function bluelogic_get_bg_image( $image_id, $extra_css = ""){


		if( is_numeric( $image_id ) ){
			$image_url_md = wp_get_attachment_image_url( $image_id , "medium"); 
			$image_url = wp_get_attachment_image_url( $image_id , "full"); 

		}else{
			$image_url = $image_id;
		}

		$data_background = empty( $image_id ) ? "" : "data-background='$image_url'";
		$background = empty( $image_id ) ? "" : "background-image:url($image_url_md)";
		
		return "style='$background;$extra_css' $data_background " ;

	}
}

if( ! function_exists( 'bluelogic_temp_file' ) ){
	function bluelogic_temp_file( $name, $dir_number = "" ){
		if( empty( $name ) ) return "#";
		$dir_number = empty( $dir_number ) ? "" : "-".$dir_number;
		return get_template_directory_uri() . "/assets/temp" . $dir_number . "/" . $name;
	}
}

if( ! function_exists( 'bluelogic_element' ) ){
	function bluelogic_element( $element, String $data ,$attributes = "", $echo = true ){

		if( empty($data ) ) return "";

		if( is_array( $attributes ) ) {
			$attributes = array_map( function($v ,$k){
				return "$k='$v'";
			},$attributes );
			$attributes = implode( ' ', $attributes );
		}

		$html = "<$element $attributes>$data</$element>";
		if( $echo ){
			echo $html;
		}else{
			return $html;

		}
	}
}

function get_button($props, $element = "a"){
	$at = wp_parse_args($props,[
		"element" => $element,
		"text" => "",
		"link" => "",
		"class" => "btn btn-primary",
		"attr_string" => ""
	]);
	return "<{$at['element']} href='{$at['text']}' class='{$at["class"]}' {$at['attr_string']} >{$at['text']}</{$at['element']}>";
}

function get_breadcrumbs(){
	?>
	<div class="container breadcrumb-container mb-10">
		<?php
			new Bluelogic_breadcrumbs([]);
		?>
	</div>
	<?php
	
}