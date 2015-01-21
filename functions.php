<?php

// add any new or customised functions here

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('zerif_bootstrap_style') );

	// Loads our main stylesheet.
	wp_enqueue_style( 'zerif-child-style', get_stylesheet_uri(), array('zerif_style'), 'v1' );

}

function remove_style_child(){
	remove_action('wp_print_scripts','zerif_php_style');	
}

add_action( 'wp_enqueue_scripts', 'remove_style_child', 100 );