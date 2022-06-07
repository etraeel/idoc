<section class="docly-banner-support">
	<div class="banner-content text-center">
		<div class="banner-content-wrapper">
			<?php if (!empty($settings['title'])) :?>
			    <h1 class="banner-title wow fadeInUp"><?php echo wp_kses_post($settings['title'])?></h1>
			<?php endif; ?>
			<?php if (!empty($settings['subtitle'])) : ?>
				<p class="banner-description wow fadeInUp"><?php echo wp_kses_post($settings['subtitle'])?></p>
			<?php endif; ?>
            <form action="<?php echo esc_url(home_url('/')) ?>" role="search" method="get" class="focused-form banner_search_form">
                <div class="input-group">
                    <input type="search" class="form-control" name="s" id="searchInput" onkeyup="fetchResults()" placeholder="<?php echo esc_attr($settings['placeholder']) ?>">
                    <input type="hidden" name="post_type" value="docs" />
                    <div class="input-group-append">
                        <button type="submit"><i class="icon_search"></i></button>
                    </div>
                </div>

                <div id="docly-search-result" data-noresult="<?php esc_attr_e('No Results Found', 'docly-core'); ?>"></div>
                <?php include_once('keywords.php'); ?>
            </form>
			<!-- /.banner-search-form-wrapper -->
		</div>
		<!-- /.banner-content-wrapper -->
	</div>
	<!-- /.banner-content -->
	<?php if ( !empty($settings['peoples']) ) : ?>
		<ul class="people-image wow fadeIn" data-wow-delay="0.7s">
			<?php
			foreach ( $settings['peoples'] as $people ) :
				?>
				<li class="elementor-repeater-item-<?php echo esc_attr($people['_id']); ?>">
                    <?php echo wp_get_attachment_image($people['image']['id'], 'full', array('class' => 'wow zoomIn', 'data-wow-delay' => '0.4s')) ?>
                </li>
				<?php
			endforeach;
			?>
		</ul>
	<?php endif; ?>
	<?php if ( $settings['is_bg_objects'] == 'yes' ) : ?>
		<ul class="partical-animation wow fadeIn" data-wow-delay="0.9s">
			<?php if ( !empty($settings['plus_1']['url']) ) : ?>
                <li class="partical">
                    <img data-parallax='{"x": -180, "y": 80, "rotateY":2000}' src="<?php echo esc_url($settings['plus_1']['url']) ?>" alt="partical">
                </li>
            <?php endif; ?>
			<li class="partical"></li>
			<li class="partical"></li>
			<li class="partical"></li>
			<li class="partical"></li>
			<li class="partical"></li>
			<li class="partical"></li>
			<li class="partical"></li>
			<li class="partical"></li>
			<li class="partical"></li>
			<li class="partical"></li>
            <?php if ( !empty($settings['plus_2']['url']) ) : ?>
                <li class="partical">
                    <img src="<?php echo esc_url($settings['plus_2']['url']) ?>" data-parallax='{"x": -250, "y": -160, "rotateZ":200}' alt="partical">
                </li>
            <?php endif; ?>
		</ul>
	<?php endif; ?>
	<div class="bottom-shape">
		<img src="<?php echo plugins_url('images/shapes/banner-bottom-shape.png', __FILE__) ?>" alt="<?php esc_attr_e('banner bottom curve shape', 'docly-core') ?>">
	</div>
</section>