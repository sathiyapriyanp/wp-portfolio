<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @since Boilerplate 1.0
 */

 defined( 'ABSPATH' )  OR die;

 /**
  * All template related functions goes on this file
  */
 require_once get_template_directory() . "/inc/function-templates.php";

 require_once get_template_directory() . "/inc/class-bluelogic-theme-setup.php";

 require_once get_template_directory() . "/inc/class-bluelogic-breadcrumbs.php";
 
 require_once get_template_directory() . "/inc/class-bluelogic-settings-maker.php";




function bluelogic_init(){

    // including the file which we register all post types
    require_once get_template_directory() . "/inc/post-type-register.php";
}

 add_action( 'init', 'bluelogic_init' );



// ✅ Enqueue Swiper and main.js
// ✅ Enqueue Swiper, AOS, and main.js
function bluelogic_enqueue_assets() {

    // ----- Swiper CSS -----
    wp_enqueue_style(
        'swiper-css',
        'https://unpkg.com/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );

    // ----- AOS CSS -----
    wp_enqueue_style(
        'aos-css',
        'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css',
        array(),
        '2.3.4'
    );

    // ----- Main Theme CSS -----
    wp_enqueue_style(
        'main-css',
        get_template_directory_uri() . '/assets/css/main.css',
        array('swiper-css', 'aos-css'),
        filemtime(get_template_directory() . '/assets/css/main.css')
    );

    // ----- Swiper JS -----
    wp_enqueue_script(
        'swiper-js',
        'https://unpkg.com/swiper@11/swiper-bundle.min.js',
        array('jquery'),
        '11.0.0',
        true
    );

    // ----- AOS JS -----
    wp_enqueue_script(
        'aos-js',
        'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js',
        array(),
        '2.3.4',
        true
    );

    // ----- Main JS -----
    wp_enqueue_script(
        'main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery', 'swiper-js', 'aos-js'), // dependencies
     '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'bluelogic_enqueue_assets');


 ?>