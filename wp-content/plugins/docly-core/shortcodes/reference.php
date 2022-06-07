<?php
add_shortcode( 'reference', function( $atts, $content ) {
    ob_start();
    $atts = shortcode_atts( array(
        'number' => '1',
    ), $atts );
    wp_enqueue_script('tooltipster');
    ?>
    <a href="#note-name-<?php echo esc_attr($atts['number']) ?>" id="note-link-<?php echo esc_attr($atts['number']) ?>" class="footnotes-link tooltips" data-tooltip-content="#note-content-<?php echo esc_attr($atts['number']) ?>">[<?php echo $atts['number'] ?>]</a>
    <?php
    $html = ob_get_clean();
    return $html;
});