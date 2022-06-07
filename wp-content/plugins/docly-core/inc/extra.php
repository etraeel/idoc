<?php

add_image_size( 'docly_370x300', 370, 300, true); // Screenshot carousel style 6
add_image_size( 'docly_70x70', 70, 70, true); // Recent posts thumbnail
add_image_size( 'docly_16x16', 16, 16, true); // Forums list widget forum thumbnail image

/**
 * Elementor URL field output
 * @param $settings_key
 * @param bool $echo
 * @return string
 */
function docly_el_btn( $settings_key, $echo = true ) {
    if ( $echo == true ) {
        echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
        echo $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
        echo !empty($settings_key['url']) ? 'href="'.esc_url($settings_key['url']).'"' : '';
    } else {
        $output = $settings_key['is_external'] == true ? 'target="_blank"' : '';
        $output .= $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
        $output .= !empty($settings_key['url']) ? 'href="'.esc_url($settings_key['url']).'"' : '';
        return $output;
    }
}

// Icon Array
function docly_icon_array($k, $replace = 'icon', $separator = '-') {
    $v = array();
    foreach ( $k as $kv ) {
        $kv = str_replace($separator, ' ', $kv);
        $kv = str_replace($replace, '', $kv);
        $v[] = array_push($v, ucwords($kv));
    }
    foreach($v as $key => $value) if($key&1) unset($v[$key]);
    return array_combine($k, $v);
}


// Social Share
function docly_social_share() { ?>
    <div class="social_icon">
        <?php esc_html_e( 'share:', 'docly-core') ?>
        <ul class="list-unstyled">
            <li><a href="https://facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="social_facebook"></i></a></li>
            <li><a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>"><i class="social_twitter"></i></a></li>
            <li><a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink() ?>"><i class="social_pinterest"></i></a></li>
            <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>"><i class="social_linkedin"></i></a></li>
        </ul>
    </div>
    <?php
}

add_filter( 'gettext','docly_enter_title');
function docly_enter_title( $input ) {
    global $post_type;
    if( is_admin() && 'Enter title here' == $input && 'team' == $post_type )
        return 'Enter here the team member name';
    return $input;
}

// Category array
function docly_cat_array($term = 'category') {
    $cats = get_terms( array(
        'taxonomy' => $term,
        'hide_empty' => true
    ));
    $cat_array = array();
    $cat_array['all'] = esc_html__( 'All', 'docly-core');
    foreach ($cats as $cat) {
        $cat_array[$cat->slug] = $cat->name;
    }
    return $cat_array;
}

/**
 * Make slug text
 */
function docly_get_slug( $text ) {
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, '-');

	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;
}

/**
 * Limit latter
 * @param $string
 * @param $limit_length
 * @param string $suffix
 */
function docly_core_limit_latter($string, $limit_length, $suffix = '...' ) {
    if ( strlen($string) > $limit_length ) {
        echo strip_shortcodes(substr($string, 0, $limit_length) . $suffix);
    } else {
        echo strip_shortcodes(esc_html($string));
    }
}

/**
 * Social Links
 */
function doclycore_social_links() {
    $opt = get_option( 'docly_opt' );
    ?>
    <?php if( !empty($opt['facebook'])) { ?>
        <li> <a href="<?php echo esc_url($opt['facebook']); ?>"><i class="social_facebook" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if( !empty($opt['twitter'])) { ?>
        <li> <a href="<?php echo esc_url($opt['twitter']); ?>"><i class="social_twitter" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if( !empty($opt['instagram'])) { ?>
        <li> <a href="<?php echo esc_url($opt['instagram']); ?>"><i class="social_instagram" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if( !empty($opt['linkedin'])) { ?>
        <li> <a href="<?php echo esc_url($opt['linkedin']); ?>"><i class="social_linkedin" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if( !empty($opt['youtube'])) { ?>
        <li> <a href="<?php echo esc_url($opt['youtube']); ?>"><i class="social_youtube" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if( !empty($opt['github'])) { ?>
        <li> <a href="<?php echo esc_url($opt['github']); ?>"><i class="social_github" aria-hidden="true"></i></a> </li>
    <?php } ?>

    <?php if( !empty($opt['dribbble'])) { ?>
        <li> <a href="<?php echo esc_url($opt['dribbble']); ?>"><i class="social_dribbble" aria-hidden="true"></i></a> </li>
    <?php }
}

/**
 * Day link to archive page
 **/
function doclycore_day_link() {
    $archive_year   = get_the_time( 'Y' );
    $archive_month  = get_the_time( 'm' );
    $archive_day    = get_the_time( 'd' );
    echo get_day_link( $archive_year, $archive_month, $archive_day);
}

/**
 * Post Share Options
 */
function doclycore_social_share() {
	$opt = get_option('docly_opt' );
	$is_social_share = isset($opt['is_social_share']) ? $opt['is_social_share'] : '';
	if ( $is_social_share == '1' ) :
		?>
        <div class="blog_social text-center">
			<?php if ( !empty($opt['share_title']) ) : ?>
                <h5><?php echo wp_kses_post($opt['share_title']) ?></h5>
			<?php endif; ?>
            <ul class="list-unstyled f_social_icon">
                <li><a href="https://facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="social_facebook"></i></a></li>
                <li><a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>" target="_blank"><i class="social_twitter"></i></a></li>
                <li><a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink() ?>" target="_blank"><i class="social_pinterest"></i></a></li>
                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>" target="_blank"><i class="social_linkedin"></i></a></li>
            </ul>
        </div>
	<?php
	endif;
}


// Arrow icon left right position
function doclycore_arrow_left_right() {
    $arrow_icon = is_rtl() ? 'arrow_left' : 'arrow_right';
    echo esc_attr($arrow_icon);
}


/**
 * Get Default Image Elementor
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
function docly_el_image( $settings_key = '', $alt = '', $class = '' ) {
	$opt = get_option('docy_opt' );
	if ( !empty($settings_key['id']) ) {
		echo wp_get_attachment_image($settings_key['id'], 'full', '', array( 'class' => $class ));
	}
    elseif ( !empty($settings_key['url']) && empty($settings_key['id']) ) {
		$class = !empty($class) ? "class='$class'" : '';
		echo "<img src='{$settings_key['url']}' $class alt='$alt'>";
	}
}

/**
 * Docs array
 */
function docly_get_docs() {
	$docs  = get_pages(
		array(
			'post_type' => 'docs',
			'parent' => 0,
		));
	$docs_array = [];
	foreach ( $docs as $doc ) {
		$docs_array[$doc->ID] = $doc->post_title;
	}

	return $docs_array;
}

/**
 * Elementor Title tags
 */
function docly_el_title_tags() {
	return [
		'h1'  => __( 'H1', 'docy-core' ),
		'h2' => __( 'H2', 'docy-core' ),
		'h3' => __( 'H3', 'docy-core' ),
		'h4' => __( 'H4', 'docy-core' ),
		'h5' => __( 'H5', 'docy-core' ),
		'h6' => __( 'H6', 'docy-core' ),
		'div' => __( 'Div', 'docy-core' ),
		'span' => __( 'Span', 'docy-core' ),
		'p' => __( 'Paragraph', 'docy-core' ),
	];
}

// ----

add_action('init', function () {
	$body_classes = get_body_class();
    if ( in_array('dr_n', $body_classes) || in_array('dr_nn', $body_classes) ) {
        add_action('wp_footer', function () {
            ?>
            <div class="modal" id="docly-reg-warn" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="alert alert-danger mb-0" role="alert">
                            <div class="modal-header pl-0">
                                <h4 class="modal-title alert-heading">Warning</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <p class="mt-4">
                                You haven't registered the theme yet. Please register the theme and use it legally. <br>
                                If you didn't purchase the theme, please buy a valid license from <a href='https://is.gd/QOzJp5' target="_blank">here</a>. Otherwise, your website will be destroyed automatically anytime.
                            </p>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                jQuery( document ).ready(function() {
                    jQuery('#docly-reg-warn').modal('show');
                })
            </script>
            <?php
        });
    }
});


/**
 * Author List
 * @param string $args
 * @return string|void
 */
function docly_list_authors( $args = '' ) {
    global $wpdb;

    $defaults = array(
        'orderby'       => 'name',
        'order'         => 'ASC',
        'number'        => '',
        'optioncount'   => false,
        'exclude_admin' => true,
        'show_fullname' => false,
        'hide_empty'    => true,
        'feed'          => '',
        'feed_image'    => '',
        'feed_type'     => '',
        'echo'          => true,
        'style'         => 'list',
        'html'          => true,
        'exclude'       => '',
        'include'       => '',
    );

    $args = wp_parse_args( $args, $defaults );

    $return = '';

    $query_args           = wp_array_slice_assoc( $args, array( 'orderby', 'order', 'number', 'exclude', 'include' ) );
    $query_args['fields'] = 'ids';
    $authors              = get_users( $query_args );

    $author_count = array();
    foreach ( (array) $wpdb->get_results( "SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE " . get_private_posts_cap_sql( 'post' ) . ' GROUP BY post_author' ) as $row ) {
        $author_count[ $row->post_author ] = $row->count;
    }
    foreach ( $authors as $author_id ) {
        $posts = isset( $author_count[ $author_id ] ) ? $author_count[ $author_id ] : 0;

        if ( ! $posts && $args['hide_empty'] ) {
            continue;
        }

        $author = get_userdata( $author_id );

        if ( $args['exclude_admin'] && 'admin' === $author->display_name ) {
            continue;
        }

        if ( $args['show_fullname'] && $author->first_name && $author->last_name ) {
            $name = "$author->first_name $author->last_name";
        } else {
            $name = $author->display_name;
        }

        if ( ! $args['html'] ) {
            $return .= $name . ', ';

            continue; // No need to go further to process HTML.
        }


        $link = sprintf(
            '<a href="%1$s" title="%2$s" class="col-lg-4"> <div class="d-flex p-4 bs-sm h:bs-md justify-content-between rounded mb-4">',
            esc_url( get_author_posts_url( $author->ID, $author->user_nicename ) ),
            /* translators: %s: Author's display name. */
            esc_attr( sprintf( __( 'Posts by %s', 'docly-core' ), $author->display_name ) )
        );

        /** Author with Description **/
        $link .= "<div class='author-name-desc mr-3'>";

            $link .= "<h4 class='mb-1 h:bc'> $name ";

            if ( $args['optioncount'] ) {
                $link .= '<small class="black-500"> (' . $posts . ') </small>';
            }

            $link .= "</h4>";

            $link .= "<p class='black-500 mb-0'>$author->description</p>";

        $link .= "</div>";

        /** Author Avatar **/
        $link .= "<div class='d-flex'>";
            $link .= get_avatar($author->ID, 70, '', '', array('class' => 'rounded-circle'));
        $link .= "</div>";


        $link .= "</div> </a>";

        $return .= $link;
    }

    $return = rtrim( $return, ', ' );

    if ( $args['echo'] ) {
        echo $return;
    } else {
        return $return;
    }
}