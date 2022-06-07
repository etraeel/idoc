<?php
namespace DoclyCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use WP_Query;

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
class Faq extends Widget_Base {

    public function get_name() {
        return 'Docly_faq';
    }

    public function get_title() {
        return esc_html__( 'FAQ Tabs', 'docly-hero' );
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return [ 'docly-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'style_sec',
            [
                'label' => esc_html__( 'FAQs', 'docly-core' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'FAQ Style', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'Horizontal Tabs', 'docly-core'),
                    '2' => esc_html__( 'Vertical Tabs', 'docly-core'),
                ],
                'default' => '1',
            ]
        );

        $this->add_control(
            'nav_title',
            [
                'label' => esc_html__( 'Navigation Title', 'docly-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Quick Navigation',
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $this->end_controls_section();


        // ---------------------------------- Filter Options ------------------------
        $this->start_controls_section(
            'filter', [
                'label' => esc_html__( 'Filter Options', 'docly-core' ),
            ]
        );

        $this->add_control(
            'order_cat', [
                'label' => esc_html__( 'Category Order', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'orderby_cat', [
                'label' => esc_html__( 'Category Order by', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'name' => 'Name',
                    'slug' => 'Slug',
                    'count' => 'Count',
                    'none' => 'None',
                ],
                'default' => 'name'
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order Posts', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'name' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'separator' => 'before',
                'default' => 'ASC'
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        $cats = get_terms( array (
            'taxonomy' => 'faq_cat',
            'hide_empty' => true,
            'orderby' => $settings['orderby_cat'] ?? 'name',
            'order' => $settings['order_cat'] ?? 'ASC',
        ));

        include( "faqs/faq-{$settings['style']}.php" );
    }

}