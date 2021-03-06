<section class="doc_tag_area">
    <ul class="nav nav-tabs doc_tag" id="myTab" role="tablist">
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
		        $atts = "href='#doc-{$post_title_slug}'";
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
            if ( $parent_docs ) {
                foreach ($parent_docs as $i => $doc) {
	                // Active Doc
	                if ( !empty($settings['active_doc']) ) {
		                $active = $doc->ID == $settings['active_doc'] ? ' active' : '';
	                } else {
		                $active = ( $i == 0 ) ? ' active' : '';
	                }
                    $post_title_slug = $doc->post_name;
                    $doc_name = explode( ' ', $doc->post_title );
                    $atts = "href='#doc-{$post_title_slug}'";
                    $atts .= " aria-controls='doc-{$post_title_slug}'";
                    ?>
                    <li class="nav-item">
                        <a <?php echo $atts; ?> id="<?php echo $post_title_slug; ?>-tab" class="nav-link<?php echo esc_attr($active) ?>" data-toggle="tab">
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
                }
            }
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
            <div class="tab-pane doc_tab_pane fade <?php echo $active; ?>" id="doc-<?php echo $doc_id ?>" role="tabpanel" aria-labelledby="<?php echo $doc_id ?>-tab">
                <div class="row">
                    <?php
                    if ( !empty($main_doc['sections']) ) :
                    foreach ( $main_doc['sections'] as $section ) :
                        ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="doc_tag_item">
                                <?php if ( !empty($section->post_title) ) : ?>
                                    <div class="doc_tag_title">
                                        <h4><?php echo wp_kses_post($section->post_title); ?></h4>
                                        <div class="line"></div>
                                    </div>
                                <?php endif; ?>
                                <?php
                                $doc_items = get_children( array(
                                    'post_parent'    => $section->ID,
                                    'post_type'      => 'docs',
                                    'post_status'    => 'publish',
                                    'orderby'        => 'menu_order',
                                    'order'          => 'ASC',
                                    'posts_per_page' => !empty($settings['ppp_doc_items']) ? $settings['ppp_doc_items'] : -1,
                                ));
                                if ( !empty($doc_items) ) : ?>
                                    <ul class="list-unstyled tag_list">
                                        <?php
                                        foreach ( $doc_items as $doc_item ) :
                                            ?>
                                            <li>
                                                <a href="<?php echo get_permalink($doc_item->ID) ?>">
                                                    <i class="icon_document_alt"></i> <?php echo wp_kses_post($doc_item->post_title) ?>
                                                </a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                    <?php
                                endif;
                                if ( !empty($settings['read_more']) ) : ?>
                                    <a href="<?php echo get_permalink($section->ID); ?>" class="learn_btn">
                                        <?php echo esc_html($settings['read_more']) ?><i class="<?php doclycore_arrow_left_right() ?>"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    endif;
                    ?>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</section>