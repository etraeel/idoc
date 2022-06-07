<?php
add_shortcode( 'authors', function( $atts, $content ) {
    ob_start();
    $atts = shortcode_atts( array(
        'number' => '1',
    ), $atts );

    echo "<div class='authors row'>";
        docly_list_authors(array(
            'optioncount' => true,
            'hide_empty' => false,
            'order'         => 'DESC',
        ));
    echo "</div>";

    $html = ob_get_clean();
    return $html;
});