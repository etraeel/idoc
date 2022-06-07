<?php
namespace DoclyCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Testimonial_carousel
 * @package DoclyCore\Widgets
 */
class Testimonial_carousel extends \Elementor\Widget_Base {

    public function get_name() {
        return 'docly_testimonial_carousel';
    }

    public function get_title() {
        return __( 'Testimonial Carousel', 'docly-core' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'docly-elements' ];
    }

    public function get_style_depends() {
        return [ 'slick' ];
    }

     public function get_script_depends() {
        return [ 'slick', 'parallaxie' ];
    }


    protected function register_controls() {

        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Testimonials', 'docly-core' ),
            ]
        );

        $this->add_control(
			'testimonials', [
				'label' => __( 'Testimonials', 'docly-core' ),
				'type' => Controls_Manager::REPEATER,
				'title_field' => '{{{ name }}}',
				'fields' => [
					[
						'name' => 'name',
						'label' => __( 'Name', 'docly-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Mark Tony'
					],
					[
						'name' => 'designation',
						'label' => __( 'Designation', 'docly-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Software Developer'
					],
					[
						'name' => 'content',
						'label' => __( 'Testimonial Text', 'docly-core' ),
						'type' => Controls_Manager::TEXTAREA,
					],
					[
						'name' => 'author_image',
						'label' => __( 'Author Image', 'docly-core' ),
						'type' => Controls_Manager::MEDIA,
					],
				],
			]
		);

        $this->end_controls_section();

        /**
         * Style Content
         */
        $this->start_controls_section(
            'style_content_sec', [
                'label' => __( 'Style Content', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color', [
                'label' => __( 'Feedback Text Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_feedback_slider .item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_contents',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .doc_feedback_slider .item h5,
                ',
            ]
        );

        $this->add_control(
            'author_color', [
                'label' => __( 'Author Name Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .doc_feedback_slider .item h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_author',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .doc_feedback_slider .item h5,
                ',
            ]
        );

        $this->add_control(
            'designation_color', [
                'label' => __( 'Author Name Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .doc_feedback_slider .item h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_designation',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .doc_feedback_slider .item h6,
                ',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style Section', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

	    $this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
			    'name' => 'background',
			    'label' => __( 'Background', 'docly-core' ),
			    'types' => [ 'classic', 'gradient', 'video' ],
			    'selector' => '{{WRAPPER}} .doc_feedback_area',
		    ]
	    );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'docly-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .doc_feedback_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $bg_image = !empty($settings['background']['url']) ? "data-background='{$settings['background']['url']};'" : '';
        ?>
        <section class="doc_feedback_area parallaxie sec_pad" <?php echo $bg_image; ?>>
            <div class="overlay_bg"></div>
            <div class="container">
                <div class="doc_feedback_info">
                    <div class="doc_feedback_slider">
                        <?php
                        foreach ( $settings['testimonials'] as $testimonial ) :
                            ?>
                            <div class="item">
                                <?php if ( !empty($testimonial['author_image']['id']) ) : ?>
                                    <div class="author_img">
                                        <?php echo wp_get_attachment_image( $testimonial['author_image']['id'], 'full' ) ?>
                                    </div>
                                <?php endif; ?>
                                <?php echo wpautop($testimonial['content']) ?>
                                <h5> <?php echo esc_html($testimonial['name']); ?> </h5>
                                <?php echo !empty($testimonial['designation']) ? '<h6>'.esc_html($testimonial['designation']).'</h6>' : ''; ?>
                            </div>
                            <?php
                        endforeach;
                        ?>
                    </div>
                    <div class="slider_nav">
                        <div class="prev">
                            <span class="arrow"></span>
                        </div>
                        <div class="next">
                            <span class="arrow"></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            ;(function ($) {
                "use strict";
                $(document).ready(function() {
                    $('.doc_feedback_slider').slick({
                        autoplay: true,
                        <?php if ( is_rtl() ) : ?>
                        rtl:true,
                        <?php endif; ?>
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplaySpeed: 2000,
                        speed: 1000,
                        dots: false,
                        arrows: true,
                        prevArrow: '.prev',
                        nextArrow: '.next',
                    });
                    $('.parallaxie').parallaxie({
                        speed: 0.5,
                    });
                })
            })(jQuery)
        </script>

        <?php
    }
   
}