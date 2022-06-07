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
 * Class Alerts_box
 * @package DoclyCore\Widgets
 */
class Info_box extends Widget_Base {

    public function get_name() {
        return 'docly_info_box';
    }

    public function get_title() {
        return __( 'Info Box', 'docly-core' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_keywords() {
        return [ 'docly', 'info' ];
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
            'title',
            [
                'label' => __( 'Title', 'docly-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link_title',
            [
                'label' => __( 'Link Title', 'docly-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => __( 'Link URL', 'docly-core' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Icon Image', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
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
                    '{{WRAPPER}} .community-box .community-content .com-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'label' => esc_html__( 'Typography', 'docly-core' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .community-box .community-content .com-title',
            ]
        );

        $this->end_controls_section();


	    /**
	     * Style Link
	     */
        $this->start_controls_section(
            'style_link',
            [
                'label' => __( 'Style Link', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .community-box .community-content .details-link' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label' => __( 'Hover Text Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .community-box .community-content .details-link:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

	    /**
	     * Style Section
	     */
	    $this->start_controls_section(
		    'style_section',
		    [
			    'label' => __( 'Style Section', 'docly-core' ),
			    'tab' => Controls_Manager::TAB_STYLE,
		    ]
	    );

        $this->add_control(
            'sec_border_top_color_hover',
            [
                'label' => __( 'Border top Color', 'docly-core' ),
                'description' => __( 'Border top color on hover', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .community-box:hover:before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sec_background',
            [
                'label' => __( 'Background Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .community-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding',
            [
                'label' => __( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .community-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        ?>
        <div class="community-box">
            <?php if ( !empty($settings['icon']['id']) ) : ?>
                <div class="icon-container">
                    <?php echo wp_get_attachment_image($settings['icon']['id'], 'full') ?>
                </div>
            <?php endif; ?>
            <div class="community-content">
                <?php if ( !empty($settings['title']) ) : ?>
                    <h3 class="com-title"> <?php echo wp_kses_post($settings['title']) ?> </h3>
                <?php endif; ?>
                <?php if ( !empty($settings['link_title']) ) : ?>
                    <a <?php docly_el_btn($settings['url']) ?> class="details-link">
                        <?php echo esc_html($settings['link_title']) ?> <i class="<?php doclycore_arrow_left_right() ?>"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
