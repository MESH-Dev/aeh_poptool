<?php

//Use this file for wp menus, sidebars, image sizes, loadup scripts.



//enqueue scripts and styles *use production assets. Dev assets are located in  /css and /js
function loadup_scripts() {
    wp_enqueue_script( 'gsap', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js', array('jquery'), '1.0.0', true );
   //  wp_enqueue_script( 'flip', '//rawgit.com/GoogleChrome/flipjs/master/dist/flip.js', array('jquery'), '1.0.0', true );
    //wp_enqueue_script( 'map-js', get_template_directory_uri().'/js/map.js', array('jquery'), '1.0.0', true );
     wp_enqueue_script( 'google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDXR8bORut0sXyoust5FWnhi-9TA8TWktw', array('jquery'), '1.0.0', true );
    wp_enqueue_script( 'mixitup', 'https://cdnjs.cloudflare.com/ajax/libs/mixitup/2.1.11/jquery.mixitup.js', array('jquery'), '1.0.0', true );
    if(is_page_template(‘/templates/template-map.php’)){
      wp_enqueue_script( 'theme-js', get_template_directory_uri().'/js/main.js', array('jquery'), '1.0.0', true );
   }
	wp_enqueue_script( 'theme-js', get_template_directory_uri().'/js/mesh.js', array('jquery'), '1.0.0', true );

    //wp_enqueue_script( 'theme-js', get_template_directory_uri().'/js/mesh.js', array('jquery'), '1.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'loadup_scripts' );

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');
add_image_size('background-fullscreen', 1800, 1200, true);
add_image_size('short-banner', 1800, 800, true);

add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');



//Register WP Menus
register_nav_menus(
    array(
        'main_nav' => 'Header and breadcrumb trail heirarchy',
        'social_nav' => 'Social menu used throughout'
    )
);

// Register Widget Area for the Sidebar
register_sidebar( array(
    'name' => __( 'Primary Widget Area', 'Sidebar' ),
    'id' => 'primary-widget-area',
    'description' => __( 'The primary widget area', 'Sidebar' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );









?>
