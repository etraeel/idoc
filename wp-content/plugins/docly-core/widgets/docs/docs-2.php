<section class="h_doc_documentation_area">
    <ul class="nav nav-tabs documentation_tab" id="myTabs" role="tablist">
        <?php
        if ( $settings['is_custom_order'] == 'yes' && !empty($settings['docs']) ) {
	        $custom_docs = !empty($settings['docs']) ? $settings['docs'] : '';
	        //echo '<pre>'.print_r($custom_docs, 1).'</pre>';
	        $i = 0;
	        foreach ( $custom_docs as $doc_item ) {
		        $doc_id = $doc_item['doc'];
		        // Active Doc
		        if ( !empty($settings['active_doc']) ) {
			        $active = $doc_id == $settings['active_doc'] ? ' active' : '';
		        } else {
			        $active = ( $i == 0 ) ? ' active' : '';
		        }
		        $post_title_slug = get_post_field('post_name', $doc_id);
		        $doc_name = explode( ' ', get_the_title($doc_id) );
		        $atts = "href='#doc2-{$post_title_slug}'";
		        $atts .= " aria-controls='doc-{$post_title_slug}'";
		        ?>
                <li class="nav-item">
                    <a <?php echo $atts; ?> id="<?php echo $post_title_slug; ?>-tab" class="nav-link<?php echo esc_attr($active) ?>" data-toggle="tab">
				        <?php
				        if ( $settings['is_tab_title_first_word'] == 'yes' ) {
					        echo wp_kses_post($doc_name[0]);
				        } else {
					        echo get_the_title($doc_id);
				        }
				        ?>
                    </a>
                </li>
		        <?php
		        ++$i;
	        }
        } else {
            if ( $parent_docs ) :
            foreach ($parent_docs as $i => $doc) :
	            // Active Doc
	            if ( !empty($settings['active_doc']) ) {
		            $active = $doc->ID == $settings['active_doc'] ? ' active' : '';
	            } else {
		            $active = ( $i == 0 ) ? ' active' : '';
	            }
                $doc_name = explode( ' ', $doc->post_title );
                $href = "href='#doc2-{$doc->post_name}'";
                $aria_controls = " aria-controls='doc-{$doc->post_name}'";
                ?>
                <li class="nav-item">
                    <a <?php echo $href.$aria_controls; ?> id="doc2-<?php echo $doc->post_name; ?>-tab" class="nav-link <?php echo esc_attr($active) ?>" data-toggle="tab">
                        <?php
                        if ( $settings['is_tab_title_first_word'] == 'yes' ) {
                            echo wp_kses_post($doc_name[0]);
                        } else {
                            echo wp_kses_post($doc->post_title);
                        }
                        ?>
                    </a>
                </li>
                <?php
            endforeach;
            endif;
        }
        ?>
    </ul>
    <div class="tab-content">
        <?php
        foreach ( $docs as $i => $main_doc ) :
	        // Active Doc
	        if ( !empty($settings['active_doc']) ) {
		        $active = $main_doc['doc']->ID == $settings['active_doc'] ? 'show active' : '';
	        } else {
		        $active = ($i == 0) ? 'show active' : '';
	        }
            $doc_id = $main_doc['doc']->post_name;
            ?>
            <div class="tab-pane documentation_tab_pane <?php echo esc_attr($active); ?>" id="doc2-<?php echo $doc_id ?>" role="tabpanel" aria-labelledby="doc2-<?php echo $doc_id ?>-tab">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="documentation_text">

                            <?php if ( has_post_thumbnail($main_doc['doc']->ID) ) : ?>
                                <?php echo get_the_post_thumbnail( $main_doc['doc']->ID, 'full', array( 'class' => 'doc-logo' )); ?>
                            <?php endif; ?>

                            <?php if ( !empty($main_doc['doc']->post_title) ) : ?>
                                <h4> <?php echo wp_kses_post($main_doc['doc']->post_title); ?> </h4>
                            <?php endif; ?>
                            <?php
                            if( strlen(trim($main_doc['doc']->post_excerpt)) != 0 ) {
                                echo wpautop( wp_trim_words($main_doc['doc']->post_excerpt, $settings['main_doc_excerpt'], '') );
                            } else{
                                echo wpautop( wp_trim_words($main_doc['doc']->post_content, $settings['main_doc_excerpt'], '') );
                            }
                            ?>
                            <a href="<?php echo get_permalink( $main_doc['doc']->ID ); ?>" class="learn_btn">
                                <?php echo esc_html($settings['read_more']); ?> <i class="<?php doclycore_arrow_left_right() ?>"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <?php
                            foreach ($main_doc['sections'] as $section) :
                                ?>
                                <div class="col-sm-6">
                                    <div class="media documentation_item">
                                        <div class="icon">
                                            <?php
                                            if ( has_post_thumbnail($section->ID) ) {
                                                echo get_the_post_thumbnail($section->ID, 'full');
                                            } else {
                                                $default_icon = plugins_url('images/folder.png', __FILE__);
                                                echo "<img src='$default_icon' alt='{$section->post_title}'>";
                                            }
                                            ?>
                                        </div>
                                        <div class="media-body">
                                            <a href="<?php echo get_permalink($section->ID); ?>">
                                                <h5> <?php echo wp_kses_post($section->post_title); ?> </h5>
                                            </a>
                                            <p>
                                            <?php
                                            if( strlen(trim($section->post_excerpt)) != 0 ) {
                                                echo wp_trim_words($section->post_excerpt, $settings['doc_sec_excerpt'], '');
                                            } else {
                                                echo wp_trim_words($section->post_content, $settings['doc_sec_excerpt'], '');
                                            }
                                            ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        endforeach;
        ?>
        </div>
</section>