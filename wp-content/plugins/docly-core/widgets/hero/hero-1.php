<section class="doc_banner_area_one">
    <?php
    if ( !empty($settings['is_wave']) == 'yes' ) : ?>
        <img class="dark" src="<?php echo plugins_url('images/wave_one.svg', __FILE__); ?>" alt="<?php esc_attr_e( 'Wave', 'docly-core' ); ?>">
        <img class="dark_two" src="<?php echo plugins_url('images/wave_two.svg', __FILE__); ?>" alt="<?php esc_attr_e( 'Wave', 'docly-core' ); ?>">
        <?php
    endif;

    docly_el_image($settings['star_1'], 'Star illustration', 'p_absolute star_one');
    docly_el_image($settings['star_2'], 'Star illustration', 'p_absolute star_two');
    docly_el_image($settings['star_3'], 'Star illustration', 'p_absolute star_three');
    docly_el_image($settings['f_img1'], 'Man illustration', 'p_absolute one wow fadeInLeft');
    docly_el_image($settings['f_img2'], 'Man illustration', 'p_absolute two wow fadeInRight');
    docly_el_image($settings['f_img3'], 'Flower illustration', 'p_absolute three wow fadeInUp');
    docly_el_image($settings['f_img4'], 'Girl illustration', 'p_absolute four wow fadeInRight');
    docly_el_image($settings['f_img5'], 'File illustration', 'p_absolute five wow fadeIn');
    docly_el_image($settings['f_img6'], 'File illustration', 'p_absolute bl_left');
    docly_el_image($settings['f_img7'], 'File illustration', 'p_absolute bl_right');
    ?>

    <div class="container">
        <div class="doc_banner_text">
            <?php if ( !empty($settings['title']) ) : ?>
                <h2 class="wow fadeInUp" data-wow-delay="0.3s">
                    <?php echo wp_kses_post($settings['title']); ?>
                </h2>
            <?php endif; ?>
            <?php if (!empty($settings['subtitle'])) : ?>
                <p class="wow fadeInUp" data-wow-delay="0.5s"><?php echo wp_kses_post($settings['subtitle'])?></p>
            <?php endif; ?>
            <form action="<?php echo esc_url(home_url('/')) ?>" role="search" method="get" class="banner_search_form focused-form">
                <div class="input-group">
                    <input type="search" name="s" id="searchInput" onkeyup="fetchResults()" class="form-control" placeholder="<?php echo esc_attr($settings['placeholder']) ?>" autocomplete="off">
                    <input type="hidden" name="post_type" value="docs" />
                    <div class="input-group-append">
                        <button type="submit"><i class="icon_search"></i></button>
                    </div>
                </div>
                <div id="docly-search-result" data-noresult="<?php esc_attr_e('No Results Found', 'docly-core'); ?>"></div>
                <?php include_once('keywords.php'); ?>
            </form>
        </div>
    </div>
</section>