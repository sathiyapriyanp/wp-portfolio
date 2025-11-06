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

 ?>