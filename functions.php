<?php

add_action( 'wp_enqueue_scripts', 'zblackbeard_enqueue_styles' );

function zblackbeard_enqueue_styles() {
	wp_enqueue_style( 'zblackbeard-style', get_template_directory_uri() . '/style.css', array('zerif_bootstrap_style') );
}

function zblackbeard_remove_style_child(){
	remove_action('wp_print_scripts','zerif_php_style');	
}

add_action( 'wp_enqueue_scripts', 'zblackbeard_remove_style_child', 100 );
