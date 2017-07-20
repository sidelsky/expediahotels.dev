<?php

/**
 * Update HOME & SITE URLs
 *
 */

// update_option('siteurl','http://hoteledit.dev');
// update_option('home','http://hoteledit.dev');

/**
 * Child stylesheet
 *
 */

function valenti_child_style() {
    if ( ! is_admin() ) {
		wp_enqueue_style( 'valenti-child-stylesheet',  get_stylesheet_directory_uri() . '/style.css' , array( 'cb-main-stylesheet' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'valenti_child_style' );

/**
 * Child l18n
 *
 */
function valenti_child_textdomain() {
    load_child_theme_textdomain( 'cubell', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'valenti_child_textdomain' );

/**
 * Allow the use of SVG
 *
 */
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
