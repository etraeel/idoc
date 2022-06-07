<?php
namespace DoclyCore\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;

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
class Accordion extends Widget_Base {

    public function get_name() {
        return 'docly_accordion';
    }

    public function get_title() {
        return esc_html__( 'Accordion', 'docly-core' );
    }

    public function get_icon() {
        return 'eicon-history';
    }

    public function get_keywords() {
        return [ 'toggle' ];
    }

    public function get_categories() {
        return [ 'docly-elements' ];
    }

    protected function register_controls() {

        /** ============ Title Section ============ **/
        $this->start_controls_section(
            'style_sec',
            [
                'label' => esc_html__( 'Accordion', 'docly-core' ),
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'toggle' => esc_html__( 'Toggle', 'docly-core'),
                    'accordion' => esc_html__( 'Accordion', 'docly-core'),
                ],
                'default' => 'toggle',
            ]
        );

        $this->add_control(
            'collapse_state', [
                'label' => esc_html__( 'Collapse State', 'docly-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Expanded', 'docly-core' ),
                'label_off' => esc_html__( 'Collapsed', 'docly-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title Text', 'docly-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Content Text', 'docly-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab
         */
        $this->start_controls_section(
            'title_style_sec', [
                'label' => esc_html__( 'Style Title', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => esc_html__( 'Text Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_text h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color_title', [
                'label' => esc_html__( 'Background Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_text h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'label' => esc_html__( 'Typography', 'docly-core' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .doc_banner_text h2',
            ]
        );

        $this->end_controls_section();

        /**
         * Content Styling
         */
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => esc_html__( 'Style Content', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => esc_html__( 'Text Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_text p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color_subtitle', [
                'label' => esc_html__( 'Background Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_text p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => esc_html__( 'Subtitle Typography', 'docly-core' ),
                'name' => 'typography_subtitle',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .doc_banner_text p',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        if ( $settings['type'] == 'toggle' ) {
            include('accordion/_toggle.php');
        }

        if ( $settings['type'] == 'accordion' ) {
            include('accordion/_accordion.php');
        }
    }
}