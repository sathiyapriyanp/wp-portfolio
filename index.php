<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

get_header(); 

$_post = get_queried_object();


?>
<section id="main-content">
    <div class="container mb-20">
    <?php
        if ( have_posts() ) {

            // Load posts loop.
            while ( have_posts() ) {
                the_post();

                the_content();
            }

            // Previous/next page navigation.
            bluelogic_the_posts_navigation();

        } else {

            ?>
                <h1 class="page-title">
                    <?php
                    printf(
                        /* translators: %s: Search term. */
                        esc_html__( 'Results for "%s"', 'text-domain' ),
                        '<span class="page-description search-term">' . esc_html( get_search_query() ) . '</span>'
                    );
                    ?>
                </h1>
            <?php
            

        }
        ?>
    </div>
</section>
<?php

get_footer();
