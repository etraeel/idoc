<?php
// Require widget files
require plugin_dir_path(__FILE__) . 'Recent_posts.php';
require plugin_dir_path(__FILE__) . 'Subscribe.php';
require plugin_dir_path(__FILE__) . 'Docs.php';
require plugin_dir_path(__FILE__) . 'Forums_widget.php';

// Register Widgets
add_action( 'widgets_init', function() {
    register_widget( 'DoclyCore\WpWidgets\Recent_Posts');
    register_widget( 'DoclyCore\WpWidgets\Subscribe');
    register_widget( 'DoclyCore\WpWidgets\Docs');
    if ( class_exists('bbPress') ) {
	    register_widget( 'DoclyCore\WpWidgets\Forums_Widget' );
	    unregister_widget( 'BBP_Forums_Widget' );
    }
});
