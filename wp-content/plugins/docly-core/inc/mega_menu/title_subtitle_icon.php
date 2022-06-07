<?php
add_shortcode( 'mega_menu_with_title_icon', function($atts, $content) {
    ob_start();

        echo do_shortcode($content);

    $html = ob_get_clean();
    return $html;
});