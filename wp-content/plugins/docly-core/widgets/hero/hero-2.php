<section class="doc_banner_area_two">

    <?php
    if (!empty($settings['plus_1']['url']) ) :
        if (!empty($settings['plus_1']['id']) ) {
            echo wp_get_attachment_image($settings['plus_1']['id'], 'full', false, array('class' => 'b_plus one', 'data-parallax' => '{"x": 250, "y": 160, "rotateZ":500}' ));
        } else {
            ?>
            <img class="b_plus one" data-parallax='{"x": 250, "y": 160, "rotateZ":500}' src="<?php echo esc_url($settings['plus_1']['url']) ?>" alt="<?php esc_attr_e('file illustration', 'docly-core'); ?>">
            <?php
        }
    endif;
    ?>

    <?php
    if (!empty($settings['plus_2']['url']) ) :
        if (!empty($settings['plus_2']['id']) ) {
            echo wp_get_attachment_image($settings['plus_2']['id'], 'full', false, array('class' => 'b_plus two', 'data-parallax' => '{"x": 250, "y": 160, "rotateZ":500}' ));
        } else {
            ?>
            <img class="b_plus two" data-parallax='{"x": 250, "y": 160, "rotateZ":500}' src="<?php echo esc_url($settings['plus_2']['url']) ?>" alt="<?php esc_attr_e('file illustration', 'docly-core'); ?>">
            <?php
        }
    endif;
    ?>

    <div class="b_round r_one" data-parallax='{"x": 0, "y": 100, "rotateZ":0}'></div>
    <div class="b_round r_two" data-parallax='{"x": -10, "y": 80, "rotateY":0}'></div>
    <div class="b_round r_three"></div>
    <div class="b_round r_four"></div>

    <?php
    docly_el_image($settings['light_f_img1'], 'file illustration', 'p_absolute flower wow fadeInUp');
    docly_el_image($settings['light_f_img2'], 'file illustration', 'p_absolute flower wow fadeInUp');
    docly_el_image($settings['light_f_img3'], 'file illustration', 'p_absolute table_img wow fadeInLeft');
    docly_el_image($settings['light_f_img4'], 'file illustration', 'p_absolute bord wow fadeInRight');
    docly_el_image($settings['light_f_img5'], 'girl illustration', 'p_absolute girl wow fadeInRight');
    ?>

    <div class="container">
        <div class="doc_banner_text_two text-center">
            <?php if (!empty($settings['title'])) :?>
                <h2><?php echo wp_kses_post($settings['title'])?></h2>
            <?php endif; ?>

            <?php if (!empty($settings['subtitle'])) : ?>
                <p><?php echo wp_kses_post($settings['subtitle'])?></p>
            <?php endif; ?>

            <form action="<?php echo esc_url(home_url('/')) ?>" role="search" method="get" class="banner_search_form focused-form">
                <div class="input-group">
                    <input type="search" class="form-control" name="s" id="searchInput" onkeyup="fetchResults()" placeholder="<?php echo esc_attr($settings['placeholder']) ?>">
                    <input type="hidden" name="post_type" value="docs" />
                    <div class="input-group-append">
                        <button type="submit" class="search_btn"> <?php echo esc_html($settings['submit_btn_label']) ?> </button>
                    </div>
                </div>
                <div id="docly-search-result" data-noresult="<?php esc_attr_e('No Results Found', 'docly-core'); ?>"></div>
	            <?php include_once('keywords.php'); ?>
            </form>
        </div>
    </div>
</section>