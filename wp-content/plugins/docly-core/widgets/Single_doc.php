<?php
namespace DoclyCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use WP_Query;
use WP_Post;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Single_doc extends Widget_Base {

    public function get_name() {
        return 'Docly_single_doc';
    }

    public function get_title() {
        return __( 'Single Doc', 'docly-core' );
    }

    public function get_icon() {
        return 'eicon-document-file';
    }

    public function get_categories() {
        return [ 'docly-elements' ];
    }

    protected function register_controls() {

        $repeater = new \Elementor\Repeater();

        // --- Filter Options
        $this->start_controls_section(
            'doc_opt', [
                'label' => __( 'Doc', 'docly-core' ),
            ]
        );

        $this->add_control(
            'doc', [
                'label' => esc_html__( 'Doc ID', 'docly-core' ),
                'description' => '<a href="https://is.gd/LdjMLz" target="_blank"> How to Find Your WordPress Page ID </a>',
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'ppp_sections', [
                'label' => esc_html__( 'Sections', 'docly-core' ),
                'description' => esc_html__( 'Number of section to show', 'docly-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 6
            ]
        );

        $this->add_control(
            'ppp_doc_items', [
                'label' => esc_html__( 'Articles', 'docly-core' ),
                'description' => esc_html__( 'Number of articles to show under every sections', 'docly-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 4
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'read_more', [
                'label' => esc_html__( 'Read More Text', 'docly-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'View All'
            ]
        );

        $this->end_controls_section();
        // end Document Setting Section
    }

    protected function render() {
        $settings = $this->get_settings();

        /**
         * Get the parent docs with query
         */
        if ( !empty($settings['doc']) ) :
            $sections = get_children( array(
                'post_parent'    => $settings['doc'],
                'post_type'      => 'docs',
                'post_status'    => 'publish',
                'orderby'        => 'menu_order',
                'order'          => $settings['order'],
                'posts_per_page' => !empty($settings['ppp_sections']) ? $settings['ppp_sections'] : -1,
            ));
            ?>
            <div class="container">
                <div class="row">
                    <?php
                    foreach ( $sections as $section ) :
                        $doc_items = get_children( array(
                            'post_parent'    => $section->ID,
                            'post_type'      => 'docs',
                            'post_status'    => 'publish',
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                            'posts_per_page' => !empty($settings['ppp_doc_items']) ? $settings['ppp_doc_items'] : -1,
                        ));
                        ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="categories_guide_item wow fadeInUp">
                                <?php
                                if ( has_post_thumbnail($section->ID) ) {
                                    echo get_the_post_thumbnail($section->ID, 'full');
                                }
                                ?>
                                <div class="doc_tag_title">
                                    <h4><?php echo wp_kses_post($section->post_title); ?></h4>
                                </div>
                                <ul class="list-unstyled tag_list">
                                    <?php
                                    foreach ( $doc_items as $doc_item ) : ?>
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
                                if ( !empty($settings['read_more']) ) : ?>
                                    <a href="<?php echo get_permalink($section->ID); ?>" class="doc_border_btn">
                                        <?php echo esc_html($settings['read_more']) ?><i class="<?php doclycore_arrow_left_right() ?>"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
                <div class="text-center">
                    <a href="<?php echo get_permalink($settings['doc']); ?>" class="doc_border_btn all_doc_btn wow fadeinUp">
                        <?php echo esc_html($settings['read_more']) ?><i class="<?php doclycore_arrow_left_right() ?>"></i>
                    </a>
                </div>
            </div>
            <?php
        endif;
    }
}