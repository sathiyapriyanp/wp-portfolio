<?php
/* We need to use this file to register all post types
 * find icons here https://developer.wordpress.org/resource/dashicons/
 */



$labels = array(
    'name'               => 'Blogs',
    'singular_name'      => 'Blog',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Blogs',
    'edit_item'          => 'Edit Blogs',
    'new_item'           => 'New Blogs',
    'view_item'          => 'View Blogs',
    'search_items'       => 'Search Blogs',
    'not_found'          => 'No Blog found',
    'not_found_in_trash' => 'No Blog found in Trash',
    'parent_item_colon'  => 'Parent Blog:',
    'menu_name'          => 'Blogs'
);

$args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'blogs' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'rest_controller_class' => 'WP_REST_Posts_Controller',
    'show_in_rest' => true,
    'menu_icon' => 'dashicons-welcome-write-blog',
    // 'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'rest' ,'author')
);
register_post_type( 'blogs', $args );

