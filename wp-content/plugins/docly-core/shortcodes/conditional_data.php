<?php
add_shortcode( 'conditional_data', function( $atts, $content ) {
	ob_start();

	$class = sanitize_title($atts['dependency']);
	$atts = shortcode_atts( array(
		'dependency' => '',
	), $atts );

	$dependency = !empty($atts['dependency']) ? sanitize_title($atts['dependency']) : '';

	if ( !empty($content) ) :
		?>
		<span class="<?php echo esc_attr($dependency) ?>">
			<?php echo wp_kses_post($content) ?>
		</span>
		<?php
	endif;

	$html = ob_get_clean();
	return $html;
});