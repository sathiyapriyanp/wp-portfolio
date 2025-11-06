<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_unique_id/
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package WordPress
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
$bluelogic_unique_id = wp_unique_id( 'search-form-' );

$bluelogic_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
?>
<div class="w-full md:min-w-96">
	<form role="search" <?php echo $bluelogic_aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php echo fcf_render_input_html([
			"name" => "s",
			"value" =>  get_search_query(),
			"placeholder" => "Search.."

		] );
		echo fcf_render_input_html([
			"element" => "submit",
			"label" => "Search", 
			"name" => "s",

		] );
		?>
	</form>
</div>
