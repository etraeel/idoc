<?php
namespace DoclyCore\Widgets;

use Elementor\Repeater;
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
 * Class Hero
 * @package DoclyCore\Widgets
 */
class Hero extends Widget_Base {

    public function get_name() {
        return 'docly_hero';
    }

    public function get_title() {
        return esc_html__( 'Hero Search Form', 'docly-core' );
    }

    public function get_icon() {
        return 'eicon-device-desktop';
    }

    public function get_categories() {
        return [ 'docly-elements' ];
    }

    protected function register_controls() {

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
                    '1' => esc_html__( 'Cool Theme', 'docly-core'),
                    '2' => esc_html__( 'Light Theme', 'docly-core'),
                    '3' => esc_html__( 'Support Desk', 'docly-core'),
                ],
                'default' => '1',
            ]
        );

        $this->end_controls_section();

        /** ============ Title Section ============ **/
        $this->start_controls_section(
            'content_sec',
            [
                'label' => esc_html__( 'Title', 'docly-core' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title Text', 'docly-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Hello, what can we help you find?',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Subtitle Text', 'docly-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


        /** ============ Search Form ============ **/
        $this->start_controls_section(
            'search_form_sec',
            [
                'label' => esc_html__( 'Search Form', 'docly-core' ),
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'docly-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Search for Topics....',
            ]
        );

        $this->add_control(
            'submit_btn_label',
            [
                'label' => esc_html__( 'Submit Button Label', 'docly-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Search',
                'condition' => [
	                'style' => ['1', '2']
                ]
            ]
        );

	    $this->add_control(
		    'is_keywords', [
			    'label' => esc_html__( 'Keywords', 'docly-core' ),
			    'type' => \Elementor\Controls_Manager::SWITCHER,
			    'return_value' => 'yes',
			    'default' => 'yes',
			    'separator' => 'before',
			    'condition' => [
				    'style' => '1'
			    ]
		    ]
	    );

	    $this->add_control(
		    'keywords_label',
		    [
			    'label' => esc_html__( 'Keywords Label', 'docly-core' ),
			    'type' => Controls_Manager::TEXT,
			    'label_block' => true,
			    'default' => 'Popular:',
		    ]
	    );

	    $keywords = new \Elementor\Repeater();

	    $keywords->add_control(
		    'title', [
			    'label' => __( 'Title', 'docly-core' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'label_block' => true,
		    ]
	    );

	    $this->add_control(
		    'keywords',
		    [
			    'label' => __( 'Repeater List', 'docly-core' ),
			    'type' => \Elementor\Controls_Manager::REPEATER,
			    'fields' => $keywords->get_controls(),
			    'default' => [
				    [
					    'title' => __( 'Keyword #1', 'docly-core' ),
				    ],
				    [
					    'title' => __( 'Keyword #2', 'docly-core' ),
				    ],
			    ],
			    'title_field' => '{{{ title }}}',
			    'prevent_empty' => false,
			    'condition' => [
			    	'is_keywords' => 'yes'
			    ]
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
                    'url' => plugins_url('hero/images/b_man.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img2', [
                'label' => esc_html__( 'Featured Image 02', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/b_man_two.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img3', [
                'label' => esc_html__( 'Featured Image 03', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/flower.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img4', [
                'label' => esc_html__( 'Featured Image 04', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/girl_img.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img5', [
                'label' => esc_html__( 'Featured Image 05', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/file.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img6', [
                'label' => esc_html__( 'Featured Image 06', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/v.svg', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'f_img7', [
                'label' => esc_html__( 'Featured Image 07', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/b_leaf.svg', __FILE__)
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
                    'url' => plugins_url('hero/images/building.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'light_f_img2', [
                'label' => esc_html__( 'Featured Image 02', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/flower.png', __FILE__)
                ]
            ]
        );


        $this->add_control(
            'light_f_img3', [
                'label' => esc_html__( 'Featured Image 03', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/table.svg', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'light_f_img4', [
                'label' => esc_html__( 'Featured Image 04', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/bord.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'light_f_img5', [
                'label' => esc_html__( 'Featured Image 05', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/girl.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


	    /**
	     * Peoples Images
	     */
        $this->start_controls_section(
            'peoples_sec', [
                'label' => esc_html__( 'Peoples Images', 'docly-core' ),
                'condition' => [
	                'style' => ['3']
                ]
            ]
        );

	    $peoples = new Repeater();

	    $peoples->add_control(
		    'image', [
			    'label' => esc_html__( 'People Image', 'docly-core' ),
			    'type' => Controls_Manager::MEDIA,
		    ]
	    );

	    $peoples->add_responsive_control(
		    'people_left_position',
		    [
			    'label'         => __( 'Horizontal Position', 'docly-core' ),
			    'type'          => Controls_Manager::SLIDER,
			    'range'         => [
				    'px' 	=> [
					    'min' 	=> 0,
					    'max' 	=> 100,
					    'step'	=> 0.1,
				    ],
			    ],
			    'selectors'     => [
				    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
			    ],
		    ]
	    );

	    $peoples->add_responsive_control(
		    'people_top_position',
		    [
			    'label'         => __( 'Vertical Position', 'docly-core' ),
			    'type'          => Controls_Manager::SLIDER,
			    'range'         => [
				    'px' 	=> [
					    'min' 	=> 0,
					    'max' 	=> 100,
					    'step'	=> 0.1,
				    ],
			    ],
			    'selectors'     => [
				    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
			    ],
		    ]
	    );

	    $this->add_control(
		    'peoples', [
			    'label' => esc_html__('Peoples', 'rogan-core'),
			    'type' => Controls_Manager::REPEATER,
			    'title_field' => '{{{ name }}}',
			    'fields' => $peoples->get_controls(),
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
                    '{{WRAPPER}} h2' => 'color: {{VALUE}};',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'label' => esc_html__( 'Title Typography', 'docly-core' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} h2',
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => esc_html__( 'Subtitle Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => esc_html__( 'Subtitle Typography', 'docly-core' ),
                'name' => 'typography_subtitle',
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .doc_banner_text p',
            ]
        );

        $this->end_controls_section();


	    /**
	     * Style Background
	     * Style 01
	     */
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
            'star_1', [
                'label' => esc_html__( 'Star 01', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/star.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'star_2', [
                'label' => esc_html__( 'Star 02', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/star.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'star_3', [
                'label' => esc_html__( 'Star 03', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/star.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();


	    /**
	     * Background Objects
	     * Style 02, Style 03
	     */
        $this->start_controls_section(
            'style_bg_sec2', [
                'label' => esc_html__( 'Style Background', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['2']
                ]
            ]
        );

	    $this->add_control(
		    'is_bg_objects', [
			    'label' => esc_html__( 'Background Objects', 'docly-core' ),
			    'type' => \Elementor\Controls_Manager::SWITCHER,
			    'return_value' => 'yes',
			    'default' => 'yes',
		    ]
	    );

        $this->add_control(
            'plus_1', [
                'label' => esc_html__( 'Plus 01', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/plus.png', __FILE__)
                ],
                'condition' => [
	                'is_bg_objects' => ['yes']
                ]
            ]
        );

        $this->add_control(
            'plus_2', [
                'label' => esc_html__( 'Plus 02', 'docly-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('hero/images/plus_one.png', __FILE__)
                ],
                'condition' => [
	                'is_bg_objects' => ['yes']
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Section Style
         */
        $this->start_controls_section(
            'style_sec_opt', [
                'label' => esc_html__( 'Section Style', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

	    $this->add_control(
		    'sec_height',
		    [
			    'label' => __( 'Section Height', 'docly-core' ),
			    'type' => Controls_Manager::SLIDER,
			    'size_units' => [ 'px', '%' ],
			    'range' => [
				    'px' => [
					    'min' => 0,
					    'max' => 1000,
					    'step' => 5,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .doc_banner_area_one' => 'min-height: {{SIZE}}{{UNIT}};',
				    '{{WRAPPER}} .doc_banner_area_two' => 'height: {{SIZE}}{{UNIT}};',
				    '{{WRAPPER}} .docly-banner-support' => 'height: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'sec_margin', [
			    'label' => __( 'Padding', 'docly-core' ),
			    'type' => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%', 'em' ],
			    'selectors' => [
				    '{{WRAPPER}} .doc_banner_area_one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
			    'default' => [
				    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
			    ],
			    'condition' => [
				    'style' => ['1']
			    ]
		    ]
	    );

	    $this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
			    'name' => 'background',
			    'label' => __( 'Background', 'docly-core' ),
			    'types' => [ 'classic', 'gradient', 'video' ],
			    'selector' => '{{WRAPPER}} .doc_banner_area_one, {{WRAPPER}} .docly-banner-support, {{WRAPPER}} .doc_banner_area_two',
		    ]
	    );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        include( "hero/hero-{$settings['style']}.php" );
    }
}