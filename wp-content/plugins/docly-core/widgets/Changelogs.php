<?php
namespace DoclyCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

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
class Changelogs extends Widget_Base {

    public function get_name() {
        return 'docly_changelogs';
    }

    public function get_title() {
        return esc_html__( 'Changelogs', 'docly-core' );
    }

    public function get_icon() {
        return 'eicon-history';
    }

    public function get_categories() {
        return [ 'docly-elements' ];
    }

    protected function register_controls() {

        /** ============ Title Section ============ **/
        $this->start_controls_section(
            'style_sec',
            [
                'label' => esc_html__( 'Hero', 'docly-core' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Hero Style', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'Cool', 'docly-core'),
                    '2' => esc_html__( 'Light', 'docly-core'),
                ],
                'default' => '1',
            ]
        );

        $this->end_controls_section();

        /** ============ Featured Images ============ **/
        $this->start_controls_section(
            'f_images_sec',
            [
                'label' => esc_html__( 'Featured Images', 'docly-core' ),
                'condition' => [
                    'style' => ['1']
                ]
            ]
        );

        $this->add_control(
            'f_img1', [
                'label' => esc_html__( 'Featured Image 01', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/b_man.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img2', [
                'label' => esc_html__( 'Featured Image 02', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/b_man_two.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img3', [
                'label' => esc_html__( 'Featured Image 03', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/flower.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img4', [
                'label' => esc_html__( 'Featured Image 04', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/girl_img.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img5', [
                'label' => esc_html__( 'Featured Image 05', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/file.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img6', [
                'label' => esc_html__( 'Featured Image 06', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/v.svg', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img7', [
                'label' => esc_html__( 'Featured Image 07', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/b_leaf.svg', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();



        /** ============ Featured Images Light  ============ **/
        $this->start_controls_section(
            'f_images_sec2',
            [
                'label' => esc_html__( 'Featured Images', 'docly-core' ),
                'condition' => [
                    'style' => ['2']
                ]
            ]
        );

        $this->add_control(
            'light_f_img1', [
                'label' => esc_html__( 'Featured Image 01', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/building.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'light_f_img2', [
                'label' => esc_html__( 'Featured Image 02', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/flower.png', __FILE__)
                ]
            ]
        );


        $this->add_control(
            'light_f_img3', [
                'label' => esc_html__( 'Featured Image 03', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/table.svg', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'light_f_img4', [
                'label' => esc_html__( 'Featured Image 04', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/bord.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'light_f_img5', [
                'label' => esc_html__( 'Featured Image 05', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/girl.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


        /** ============ Content Styling ============ **/
        $this->start_controls_section(
            'style_content_sec', [
                'label' => esc_html__( 'Style Content', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => esc_html__( 'Title Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_text h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'label' => esc_html__( 'Title Typography', 'docly-core' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .doc_banner_text h2',
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => esc_html__( 'Subtitle Color', 'docly-core' ),
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


        /** ============ Style Background ============ **/
        $this->start_controls_section(
            'style_bg_sec', [
                'label' => esc_html__( 'Style Background', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['1']
                ]
            ]
        );

        $this->add_control(
            'is_wave', [
                'label' => esc_html__( 'Wave', 'docly-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'style' => ['1']
                ]
            ]
        );

        $this->add_control(
            'background_image', [
                'label' => esc_html__( 'Background Image', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/banner_bg_two.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'star_1', [
                'label' => esc_html__( 'Star 01', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/star.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'star_2', [
                'label' => esc_html__( 'Star 02', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/star.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'star_3', [
                'label' => esc_html__( 'Star 03', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/star.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'color_one', [
                'label' => esc_html__( 'Color One', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'color_two', [
                'label' => esc_html__( 'Color Two', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_area_one' => 'background-image: -webkit-linear-gradient(60deg, {{color_one.VALUE}} 0%, {{VALUE}} 100%)',
                ],
            ]
        );

        $this->end_controls_section();


        /** ============ Style Background Light============ **/
        $this->start_controls_section(
            'style_bg_sec2', [
                'label' => esc_html__( 'Style Background style', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['2']
                ]
            ]
        );

        $this->add_control(
            'plus_1', [
                'label' => esc_html__( 'Plus 01', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/plus.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'plus_2', [
                'label' => esc_html__( 'Plus 02', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/plus_one.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        if ( $settings['style'] == '1' ) {
            include('hero-1.php');
        }
        if ( $settings['style'] == '2' ) {
            include('hero-2.php');
        }
    }
}