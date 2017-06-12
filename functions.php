<?php

add_action( 'wp_enqueue_scripts', 'zblackbeard_enqueue_styles' );

function zblackbeard_enqueue_styles() {
	wp_enqueue_style( 'zblackbeard-style', get_template_directory_uri() . '/style.css', array('zerif_bootstrap_style') );
}

function zblackbeard_remove_style_child(){
	remove_action('wp_print_scripts','zerif_php_style');	
}

add_action( 'wp_enqueue_scripts', 'zblackbeard_remove_style_child', 100 );

/**
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function zblackbeard_theme_setup() {
    load_child_theme_textdomain( 'zblackbeard', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'zblackbeard_theme_setup' );

/**
 * Notice in Customize to announce the theme is not maintained anymore
 */
function zblackbeard_customize_register( $wp_customize ) {

	require_once get_stylesheet_directory() . '/class-ti-notify.php';

	$wp_customize->register_section_type( 'Ti_Notify' );

	$wp_customize->add_section(
		new Ti_Notify(
			$wp_customize,
			'ti-notify',
			array(
				'text'     => sprintf( __( 'This child theme is not maintained anymore, consider using the parent theme %1$s or check-out our latest free one-page theme: %2$s.','zblackbeard' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=zerif-lite' ) . '">%s</a>', 'Zerif Lite' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=hestia' ) . '">%s</a>', 'Hestia' ) ),
				'priority' => 0,
			)
		)
	);

	$wp_customize->add_setting( 'zblackbeard-notify', array(
	    'sanitize_callback' => 'esc_html',
    ));

	$wp_customize->add_control( 'zblackbeard-notify', array(
		'label'    => __( 'Notification', 'zblackbeard' ),
		'section'  => 'ti-notify',
		'priority' => 1,
	) );
}

add_action( 'customize_register', 'zblackbeard_customize_register' );

/**
 * Notice in admin dashboard to announce the theme is not maintained anymore
 */
function zblackbeard_admin_notice() {

	global $pagenow;

	if ( is_admin() && ( 'themes.php' == $pagenow ) && isset( $_GET['activated'] ) ) {
		echo '<div class="updated notice is-dismissible"><p>';
		printf( __( 'This child theme is not maintained anymore, consider using the parent theme %1$s or check-out our latest free one-page theme: %2$s.','zblackbeard' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=zerif-lite' ) . '">%s</a>', 'Zerif Lite' ), sprintf( '<a href="' . admin_url( 'theme-install.php?theme=hestia' ) . '">%s</a>', 'Hestia' ) );
		echo '</p></div>';
	}
}

add_action( 'admin_notices', 'zblackbeard_admin_notice', 99 );
