<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function docly_child_theme_setup() {
    load_child_theme_textdomain( 'docly-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'docly_child_theme_setup' );


// BEGIN ENQUEUE PARENT ACTION
if ( !function_exists( 'docly_child_thm_parent_css' ) ):
    function docly_child_thm_parent_css() {
	    $parenthandle = 'docly-root'; // This is 'docly-root' for the Docly theme.
	    $theme = wp_get_theme();
	    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css',
		    array(),  // if the parent theme code has a dependency, copy it to here
		    $theme->parent()->get('Version')
	    );
	    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
		    array( $parenthandle ),
		    $theme->get('Version') // this only works if you have Version in the style header
	    );
    }
endif;
add_action( 'wp_enqueue_scripts', 'docly_child_thm_parent_css', 100 );

// END ENQUEUE PARENT ACTION
