<?php
if ( $settings['title'] ) :
$rand = rand();
$id = 'toggle-'.$this->get_ID();
$is_collapsed = $settings['collapse_state'] == 'yes' ? 'true' : 'false';
$is_collapsed_class = $settings['collapse_state'] == 'yes' ? '' : 'collapsed';
$is_show = $settings['collapse_state'] == 'yes' ? 'show' : '';
    ?>
    <div class="card doc_accordion">
        <div class="card-header" id="heading-<?php echo esc_attr($rand); ?>">
            <h5 class="mb-0">
                <button class="btn btn-link <?php echo esc_attr($is_collapsed_class) ?>" data-toggle="collapse"
                        data-target="#<?php echo esc_attr($id) ?>" aria-expanded="<?php echo esc_attr($is_collapsed) ?>" aria-controls="<?php echo esc_attr($id) ?>">
                    <?php echo wp_kses_post($settings['title']) ?><i class="icon_plus"></i><i class="icon_minus-06"></i>
                </button>
            </h5>
        </div>
        <?php
        if ( !empty($settings['subtitle']) ) : ?>
            <div id="<?php echo esc_attr($id) ?>" class="collapse <?php echo esc_attr($is_show) ?>" aria-labelledby="heading-<?php echo esc_attr($rand); ?>">
                <div class="card-body toggle_body">
                    <?php echo wp_kses_post($settings['subtitle']) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
endif;