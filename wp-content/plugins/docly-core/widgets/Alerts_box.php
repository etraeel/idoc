<?php
namespace DoclyCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Alert widget.
 */
class Alerts_box extends Widget_Base {
    public function get_name() {
        return 'docly_alerts_box';
    }

    public function get_title() {
        return __( 'Docly Alert', 'docly-core' );
    }

    public function get_icon() {
        return 'eicon-alert';
    }

    public function get_keywords() {
        return [ 'alert', 'notice', 'message' ];
    }

    public function get_categories() {
        return [ 'docly-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_alert',
            [
                'label' => __( 'Alert/Note', 'docly-core' ),
            ]
        );

        $this->add_control(
            'display_type',
            [
                'label' => __( 'Display Type', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'alert',
                'options' => [
                    'alert' => __( 'Alert Box', 'docly-core' ),
                    'note' => __( 'Note', 'docly-core' ),
                    'explanation' => __( 'Explanation', 'docly-core' ),
                ],
            ]
        );

        $this->add_control(
            'alert_type',
            [
                'label' => __( 'Type', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'message',
                'options' => [
                    'message' => __( 'Message', 'docly-core' ),
                    'warning' => __( 'Warning', 'docly-core' ),
                    'info' => __( 'Info', 'docly-core' ),
                    'success' => __( 'Success', 'docly-core' ),
                    'danger' => __( 'Danger', 'docly-core' ),
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'alert_title',
            [
                'label' => __( 'Title', 'docly-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Notice Message! Your message here'
            ]
        );

        $this->add_control(
            'alert_description',
            [
                'label' => __( 'Description', 'docly-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_dismiss',
            [
                'label' => __( 'Dismiss Button', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => __( 'Show', 'docly-core' ),
                    'hide' => __( 'Hide', 'docly-core' ),
                ],
                'condition' => [
                    'display_type' => ['alert']
                ]
            ]
        );

        // Icon 01
        $this->add_control(
            'icon_type',
            [
                'label' => __( 'Icon Type', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fontawesome' => esc_html__( 'Font-Awesome', 'docly-core' ),
                    'eicon' => esc_html__( 'Elegant Icon', 'docly-core' ),
                    'ticon' => esc_html__( 'Themify Icon', 'docly-core' ),
                    'slicon' => esc_html__( 'Simple Line Icon', 'docly-core' ),
                    'flaticon' => esc_html__( 'Flaticon', 'docly-core' ),
                ],
                'default' => 'eicon',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'fontawesome',
            [
                'label' => __( 'Font-Awesome', 'docly-core' ),
                'type' => Controls_Manager::ICON,
                'condition' => [
                    'icon_type' => 'fontawesome'
                ]
            ]
        );

        $this->add_control(
            'eicon',
            [
                'label' => __( 'Elegant Icon', 'docly-core' ),
                'type' => Controls_Manager::ICON,
                'options' => docly_elegant_icons(),
                'include' => docly_include_elegant_icons(),
                'default' => 'icon_volume-low',
                'condition' => [
                    'icon_type' => 'eicon'
                ]
            ]
        );

        $this->add_control(
            'ticon',
            [
                'label' => __( 'Themify Icon', 'docly-core' ),
                'type' => Controls_Manager::ICON,
                'options' => docly_themify_icons(),
                'include' => docly_include_themify_icons(),
                'default' => 'ti-panel',
                'condition' => [
                    'icon_type' => 'ticon'
                ]
            ]
        );

        $this->add_control(
            'flaticon',
            [
                'label'      => __( 'Flaticon', 'docly-core' ),
                'type'       => Controls_Manager::ICON,
                'options'    => docly_flaticons(),
                'include'    => docly_include_flaticons(),
                'default'    => 'flaticon-mortarboard',
                'condition'  => [
                    'icon_type' => 'flaticon'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Tab: Style
         */
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Style Title', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => esc_html__( 'Text Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-docly_alerts_box .title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .explanation::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .notice h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color_title', [
                'label' => esc_html__( 'Background Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .explanation::after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'display_type' => ['explanation']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'label' => esc_html__( 'Typography', 'docly-core' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-widget-docly_alerts_box .title, {{WRAPPER}} .explanation::after, {{WRAPPER}} .notice h5',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_type',
            [
                'label' => __( 'Alert', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-docly_alerts_box p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .explanation p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .notice p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background',
            [
                'label' => __( 'Background Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .message_alert' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .notice' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background2',
            [
                'label' => __( 'Background Color 02', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .explanation' => 'background: linear-gradient(90deg, {{background.VALUE}}, {{VALUE}});',
                ],
                'condition' => [
                    'display_type' => ['explanation']
                ]
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __( 'Border Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .message_alert' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .explanation::before' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .notice' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_left-width',
            [
                'label' => __( 'Left Border Width', 'docly-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .notice' => 'border-left-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'display_type' => [ 'note' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .message_alert' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .media.notice' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .explanation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render alert widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();
        $icon_class = docly_icon_type( $settings['icon_type'] );
        ?>
        <?php if ( $settings['display_type'] == 'alert' ) : ?>
            <div class="alert media message_alert alert-<?php echo esc_attr($settings['alert_type']) ?> fade show" role="alert">
                <i <?php echo $icon_class; ?>></i>
                <div class="media-body">
                    <?php if ( !empty($settings['alert_title']) ) : ?>
                        <h5 class="title"> <?php echo $settings['alert_title'] ?></h5>
                    <?php endif; ?>
                    <?php echo !empty($settings['alert_description']) ? $this->parse_text_editor($settings['alert_description']) : ''; ?>
                    <?php if ( 'show' === $settings['show_dismiss'] ) : ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icon_close"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( $settings['display_type'] == 'note' ) : ?>
            <blockquote class="media notice notice-<?php echo esc_attr($settings['alert_type']) ?>">
                <i <?php echo $icon_class; ?>></i>
                <div class="media-body">
                    <?php if ( !empty($settings['alert_title']) ) : ?>
                        <h5 class="title"> <?php echo $settings['alert_title'] ?></h5>
                    <?php endif; ?>
                    <?php echo $this->parse_text_editor(wpautop($settings['alert_description'])) ?>
                </div>
            </blockquote>
        <?php endif; ?>

        <?php if ( $settings['display_type'] == 'explanation' ) : ?>
            <div class="explanation expn-left">
                <?php echo $this->parse_text_editor(wpautop($settings['alert_description'])) ?>
            </div>
            <?php if ( !empty($settings['alert_title']) ) : ?>
                <style>
                    .explanation::after {
                        font-family: "Roboto", sans-serif;
                        content: "<?php echo $settings['alert_title'] ?>";
                        text-transform: uppercase;
                        font-weight: 700;
                        top: -19px;
                        left: 1rem;
                        padding: 0 0.5rem;
                        font-size: 0.6rem;
                        position: absolute;
                        z-index: 1;
                        color: #000;
                        background: #fff;
                    }
            </style>
            <?php endif; ?>
        <?php endif; ?>

        <?php
    }
}
