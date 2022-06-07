<?php
namespace DoclyCore\Widgets;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Frontend;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Data_Table extends Widget_Base {
	public function get_name() {
		return 'docly-data-table';
	}

	public function get_title() {
		return esc_html__( 'Docly Data Table', 'docly-core');
	}

	public function get_icon() {
		return 'eicon-table';
	}

   	public function get_categories() {
		return [ 'docly-elements' ];
	}

   	public function get_script_depends() {
		return [ 'floatThead' ];
	}
    
    public function get_keywords() {
        return [
			'table',
			'data table',
			'export eable',
			'CSV',
			'comparison table',
			'grid',
			'essential addons'
		];
    }

	protected function register_controls() {

  		/**
  		 * Data Table Header
  		 */
  		$this->start_controls_section(
  			'section_data_table_header',
  			[
  				'label' => esc_html__( 'Header', 'docly-core')
  			]
  		);

  		$this->add_control(
			'data_table_header_cols_data',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'data_table_header_col' => 'Table Header' ],
					[ 'data_table_header_col' => 'Table Header' ],
					[ 'data_table_header_col' => 'Table Header' ],
					[ 'data_table_header_col' => 'Table Header' ],
				],
				'fields' => [
					[
						'name' => 'data_table_header_col',
						'label' => esc_html__( 'Column Name', 'docly-core'),
						'default' => 'Table Header',
						'type' => Controls_Manager::TEXT,
						'label_block' => false,
					],
					[
						'name' => 'data_table_header_col_span',
						'label' => esc_html__( 'Column Span', 'docly-core'),
						'default' => '',
						'type' => Controls_Manager::TEXT,
						'label_block' => false,
					],
					[
						'name' => 'data_table_header_col_icon_enabled',
						'label' => esc_html__( 'Enable Header Icon', 'docly-core'),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'yes', 'docly-core'),
						'label_off' => __( 'no', 'docly-core'),
						'default' => 'false',
						'return_value' => 'true',
					],
					[
						'name'	=> 'data_table_header_icon_type',
						'label'	=> esc_html__( 'Header Icon Type', 'docly-core'),
						'type'	=> Controls_Manager::CHOOSE,
						'options'               => [
							'none'        => [
								'title'   => esc_html__( 'None', 'docly-core'),
								'icon'    => 'fa fa-ban',
							],
							'icon'        => [
								'title'   => esc_html__( 'Icon', 'docly-core'),
								'icon'    => 'fa fa-star',
							],
							'image'       => [
								'title'   => esc_html__( 'Image', 'docly-core'),
								'icon'    => 'fa fa-picture-o',
							],
						],
						'default'               => 'icon',
						'condition' => [
							'data_table_header_col_icon_enabled' => 'true'
						]
					],
					[
						'name' => 'data_table_header_col_icon_new',
						'label' => esc_html__( 'Icon', 'docly-core'),
						'type' => Controls_Manager::ICONS,
						'fa4compatibility' => 'data_table_header_col_icon',
						'default' => '',
						'condition' => [
							'data_table_header_col_icon_enabled' => 'true',
							'data_table_header_icon_type'	=> 'icon'
						]
					],
					[
						'name' => 'data_table_header_col_img',
						'label' => esc_html__( 'Image', 'docly-core'),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'data_table_header_icon_type'	=> 'image'
						]
					],
					[
						'name' => 'data_table_header_col_img_size',
						'label' => esc_html__( 'Image Size(px)', 'docly-core'),
						'default' => '25',
						'type' => Controls_Manager::NUMBER,
						'label_block' => false,
						'condition' => [
							'data_table_header_icon_type'	=> 'image'
						]
					],
					[
						'name'			=> 'data_table_header_css_class',
						'label'			=> esc_html__( 'CSS Class', 'docly-core'),
						'type'			=> Controls_Manager::TEXT,
						'label_block' 	=> false,
					],
					[
						'name'			=> 'data_table_header_css_id',
						'label'			=> esc_html__( 'CSS ID', 'docly-core'),
						'type'			=> Controls_Manager::TEXT,
						'label_block'	=> false,
					],

				],
				'title_field' => '{{data_table_header_col}}',
			]
		);

  		$this->end_controls_section();

  		/**
  		 * Data Table Content
  		 */
  		$this->start_controls_section(
  			'section_data_table_cotnent',
  			[
  				'label' => esc_html__( 'Content', 'docly-core')
  			]
  		);

  		$this->add_control(
			'data_table_content_rows',
			[
				'type' => Controls_Manager::REPEATER,
				'seperator' => 'before',
				'default' => [
					[ 'data_table_content_row_type' => 'row' ],
					[ 'data_table_content_row_type' => 'col' ],
					[ 'data_table_content_row_type' => 'col' ],
					[ 'data_table_content_row_type' => 'col' ],
					[ 'data_table_content_row_type' => 'col' ],
				],
				'fields' => [
					[
						'name' => 'data_table_content_row_type',
						'label' => esc_html__( 'Row Type', 'docly-core'),
						'type' => Controls_Manager::SELECT,
						'default' => 'row',
						'label_block' => false,
						'options' => [
							'row' => esc_html__( 'Row', 'docly-core'),
							'col' => esc_html__( 'Column', 'docly-core'),
						]
					],
					[
						'name'			=> 'data_table_content_row_colspan',
						'label'			=> esc_html__( 'Col Span', 'docly-core'),
						'type'			=> Controls_Manager::NUMBER,
						'description'	=> esc_html__( 'Default: 1 (optional).'),
						'default' 		=> 1,
						'min'     		=> 1,
						'label_block'	=> true,
						'condition' 	=> [
							'data_table_content_row_type' => 'col'
						]
					],
					[
						'name'			=> 'data_table_content_row_rowspan',
						'label'			=> esc_html__( 'Row Span', 'docly-core'),
						'type'			=> Controls_Manager::NUMBER,
						'description'	=> esc_html__( 'Default: 1 (optional).'),
						'default' 		=> 1,
						'min'     		=> 1,
						'label_block'	=> true,
						'condition' 	=> [
							'data_table_content_row_type' => 'col'
						]
					],
					[
						'name'		=> 'data_table_content_type',
						'label'		=> esc_html__( 'Content Type', 'docly-core'),
						'type'	=> Controls_Manager::CHOOSE,
						'options'               => [
							'textarea'        => [
								'title'   => esc_html__( 'Textarea', 'docly-core'),
								'icon'    => 'fa fa-text-width',
							],
							'editor'       => [
								'title'   => esc_html__( 'Editor', 'docly-core'),
								'icon'    => 'fa fa-pencil',
							],
						],
						'default'	=> 'textarea',
						'condition' => [
							'data_table_content_row_type' => 'col'
						]
					],
					[
						'name' => 'data_table_content_row_title',
						'label' => esc_html__( 'Cell Text', 'docly-core'),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
						'default' => esc_html__( 'Content', 'docly-core'),
						'condition' => [
							'data_table_content_row_type' => 'col',
							'data_table_content_type' => 'textarea'
						]
					],
					[
						'name' => 'data_table_content_row_content',
						'label' => esc_html__( 'Cell Text', 'docly-core'),
						'type' => Controls_Manager::WYSIWYG,
						'label_block' => true,
						'default' => esc_html__( 'Content', 'docly-core'),
						'condition' => [
							'data_table_content_row_type' => 'col',
							'data_table_content_type' => 'editor'
						]
					],
					[
						'name' => 'data_table_content_row_title_link',
						'label' => esc_html__( 'Link', 'docly-core'),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
		        				'url' => '',
		        				'is_external' => '',
		     				],
		     				'show_external' => true,
		     				'separator' => 'before',
		     			'condition' => [
							'data_table_content_row_type' => 'col',
							'data_table_content_type' => 'textarea'
						],
					],
					[
						'name'			=> 'data_table_content_row_css_class',
						'label'			=> esc_html__( 'CSS Class', 'docly-core'),
						'type'			=> Controls_Manager::TEXT,
						'label_block'	=> false,
						'condition' 	=> [
							'data_table_content_row_type' => 'col'
						]
					],
					[
						'name'			=> 'data_table_content_row_css_id',
						'label'			=> esc_html__( 'CSS ID', 'docly-core'),
						'type'			=> Controls_Manager::TEXT,
						'label_block'	=> false,
						'condition' 	=> [
							'data_table_content_row_type' => 'col'
						]
					]
				],
				'title_field' => '{{data_table_content_row_type}}::{{data_table_content_row_title || data_table_content_row_content}}',
			]
		);

		$this->end_controls_section();

  		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'section_data_table_style_settings',
			[
				'label' => esc_html__( 'General Style', 'docly-core'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_control(
            'table_style',
            [
                'label' => __( 'Table Style', 'docly-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'basic' => esc_html__( 'Basic', 'docly-core' ),
                    'normal' => esc_html__( 'Normal', 'docly-core' ),
                    'dark' => esc_html__( 'Dark', 'docly-core' ),
                ],
                'default' => 'normal',
            ]
        );

		$this->add_responsive_control(
            'table_width',
            [
                'label'                 => __( 'Width', 'docly-core'),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units'            => [ '%', 'px' ],
                'range'                 => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1200,
                    ],
                ],
                'selectors'             => [
                    '{{WRAPPER}} .table_shortcode' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
		);

		$this->add_control(
            'table_alignment',
            [
                'label'                 => __( 'Alignment', 'docly-core'),
                'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
                'default'               => 'center',
                'options'               => [
                    'left' 		=> [
                        'title' => __( 'Left', 'docly-core'),
                        'icon' 	=> 'eicon-h-align-left',
                    ],
                    'center' 	=> [
                        'title' => __( 'Center', 'docly-core'),
                        'icon' 	=> 'eicon-h-align-center',
                    ],
                    'right' 	=> [
                        'title' => __( 'Right', 'docly-core'),
                        'icon' 	=> 'eicon-h-align-right',
                    ],
				],
                'prefix_class' => 'elementor%s-align-',
            ]
        );

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Header Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'section_data_table_title_style_settings',
			[
				'label' => esc_html__( 'Header Style', 'docly-core'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_control(
            'sticky_header',
            [
                'label'			=> __( 'Sticky Header', 'docly-core'),
                'type'			=> Controls_Manager::SWITCHER,
                'label_on'		=> esc_html__( 'Yes', 'docly-core'),
                'label_off' 	=> esc_html__( 'No', 'docly-core'),
                'return_value' 	=> 'yes',
            ]
        );

		$this->add_responsive_control(
			'data_table_each_header_padding',
			[
				'label' => esc_html__( 'Padding', 'docly-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .table_shortcode .table-header th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .table_shortcode tbody tr td .th-mobile-screen' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('data_table_header_title_clrbg');

			$this->start_controls_tab( 'data_table_header_title_normal', [ 'label' => esc_html__( 'Normal', 'docly-core') ] );

				$this->add_control(
					'data_table_header_title_color',
					[
						'label' => esc_html__( 'Color', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode thead tr th' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'data_table_header_title_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode thead tr th' => 'background-color: {{VALUE}};'
						],
					]
				);
				
				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'data_table_header_border',
							'label' => esc_html__( 'Border', 'docly-core'),
							'selector' => '{{WRAPPER}} .table_shortcode thead tr th'
						]
				);

			$this->end_controls_tab();
			
			$this->start_controls_tab( 'data_table_header_title_hover', [ 'label' => esc_html__( 'Hover', 'docly-core') ] );

				$this->add_control(
					'data_table_header_title_hover_color',
					[
						'label' => esc_html__( 'Color', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode thead tr th:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'data_table_header_title_hover_bg_color',
					[
						'label' => esc_html__( 'Background Color', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode thead tr th:hover' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'data_table_header_hover_border',
							'label' => esc_html__( 'Border', 'docly-core'),
							'selector' => '{{WRAPPER}} .table_shortcode thead tr th:hover',
						]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'data_table_header_title_typography',
				'selector' => '{{WRAPPER}} .table_shortcode thead > tr th .data-table-header-text',
			]
		);

		$this->add_responsive_control(
            'header_icon_size',
            [
                'label'                 => __( 'Icon Size', 'docly-core'),
				'type'                  => Controls_Manager::SLIDER,
                'size_units'            => [ 'px' ],
                'range'                 => [
                    'px' => [
                        'min' => 1,
                        'max' => 70,
                    ],
				],
				'default'	=> [
					'size'	=> 20
				],
                'selectors'             => [
					'{{WRAPPER}} .table_shortcode thead tr th i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .table_shortcode thead tr th .data-table-header-svg-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				]
            ]
		);

		$this->add_responsive_control(
            'header_icon_position_from_top',
            [
                'label'                 => __( 'Icon Position', 'docly-core'),
				'type'                  => Controls_Manager::SLIDER,
                'size_units'            => [ 'px', '%' ],
                'range'                 => [
                    'px' => [
                        'min' => 1,
                        'max' => 70,
					],
					'%'	=> [
						'min'	=> 0,
						'max'	=> 100
					]
					],
                'selectors'             => [
					'{{WRAPPER}} .table_shortcode thead tr th .data-header-icon' => 'top: {{SIZE}}{{UNIT}};'
				]
            ]
		);

		$this->add_responsive_control(
            'header_icon_space',
            [
                'label'                 => __( 'Icon Space', 'docly-core'),
				'type'                  => Controls_Manager::SLIDER,
                'size_units'            => [ 'px' ],
                'range'                 => [
                    'px' => [
                        'min' => 1,
                        'max' => 70,
                    ],
				],
                'selectors'             => [
					'{{WRAPPER}} .table_shortcode thead tr th i, {{WRAPPER}} .table_shortcode thead tr th img' => 'margin-right: {{SIZE}}{{UNIT}};'
				]
            ]
		);

		$this->add_responsive_control(
			'data_table_header_title_alignment',
			[
				'label' => esc_html__( 'Title Alignment', 'docly-core'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'docly-core'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'docly-core'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'docly-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'prefix_class' => 'eael-dt-th-align-',
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Data Table Content Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'section_data_table_content_style_settings',
			[
				'label' => esc_html__( 'Content Style', 'docly-core'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs('data_table_content_row_cell_styles');

			$this->start_controls_tab('data_table_odd_cell_style', ['label' => esc_html__( 'Normal', 'docly-core')]);

				$this->add_control(
					'data_table_content_odd_style_heading',
					[
						'label' => esc_html__( 'ODD Cell', 'docly-core'),
						'type' => Controls_Manager::HEADING,
					]
				);

				$this->add_control(
					'data_table_content_color_odd',
					[
						'label' => esc_html__( 'Color ( Odd Row )', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode tbody > tr:nth-child(2n) td' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'data_table_content_bg_odd',
					[
						'label' => esc_html__( 'Background ( Odd Row )', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode tbody > tr:nth-child(2n) td' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'data_table_content_even_style_heading',
					[
						'label' => esc_html__( 'Even Cell', 'docly-core'),
						'type' => Controls_Manager::HEADING,
						'separator'	=> 'before'
					]
				);

				$this->add_control(
					'data_table_content_even_color',
					[
						'label' => esc_html__( 'Color ( Even Row )', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode tbody > tr:nth-child(2n+1) td' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'data_table_content_bg_even_color',
					[
						'label' => esc_html__( 'Background Color (Even Row)', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .table_shortcode tbody > tr:nth-child(2n+1) td' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
						[
							'name' => 'data_table_cell_border',
							'label' => esc_html__( 'Border', 'docly-core'),
							'selector' => '{{WRAPPER}} .table_shortcode tbody tr td',
							'separator'	=> 'before'
						]
				);

				$this->add_responsive_control(
					'data_table_each_cell_padding',
					[
						'label' => esc_html__( 'Padding', 'docly-core'),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em' ],
						'selectors' => [
								 '{{WRAPPER}} .table_shortcode tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						 ],
					]
				);

			$this->end_controls_tab();
			
			$this->start_controls_tab('data_table_odd_cell_hover_style', ['label' => esc_html__( 'Hover', 'docly-core')]);

				$this->add_control(
					'data_table_content_hover_color_odd',
					[
						'label' => esc_html__( 'Color ( Odd Row )', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode tbody > tr:nth-child(2n) td:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'data_table_content_hover_bg_odd',
					[
						'label' => esc_html__( 'Background ( Odd Row )', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode tbody > tr:nth-child(2n) td:hover' => 'background: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'data_table_content_even_hover_style_heading',
					[
						'label' => esc_html__( 'Even Cell', 'docly-core'),
						'type' => Controls_Manager::HEADING,
					]
				);

				$this->add_control(
					'data_table_content_hover_color_even',
					[
						'label' => esc_html__( 'Color ( Even Row )', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .table_shortcode tbody > tr:nth-child(2n+1) td:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'data_table_content_bg_even_hover_color',
					[
						'label' => esc_html__( 'Background Color (Even Row)', 'docly-core'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .table_shortcode tbody > tr:nth-child(2n+1) td:hover' => 'background-color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             	'name' => 'data_table_content_typography',
				'selector' => '{{WRAPPER}} .table_shortcode tbody tr td'
			]
		);

		$this->add_control(
			'data_table_content_link_typo',
			[
				'label' => esc_html__( 'Link Color', 'docly-core'),
				'type' => Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

		/* Table Content Link */
		$this->start_controls_tabs( 'data_table_link_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'data_table_link_normal', [ 'label' => esc_html__( 'Normal', 'docly-core') ] );

			$this->add_control(
				'data_table_link_normal_text_color',
				[
					'label' => esc_html__( 'Text Color', 'docly-core'),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .table_shortcode-wrap table td a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'data_table_link_hover', [ 'label' => esc_html__( 'Hover', 'docly-core') ] );

			$this->add_control(
				'data_table_link_hover_text_color',
				[
					'label' => esc_html__( 'Text Color', 'docly-core'),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .table_shortcode-wrap table td a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'data_table_content_alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'docly-core'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'docly-core'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'docly-core'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'docly-core'),
						'icon' => 'fa fa-align-right',
					],
				],
				'toggle' => true,
				'default' => 'left',
				'prefix_class' => 'eael-dt-td-align%s-',
			]
		);
		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Responsive Style (Data Table Content Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'section_data_table_responsive_style_settings',
			[
				'label'		=> esc_html__( 'Responsive Options', 'docly-core'),
				'devices'	=> [ 'tablet', 'mobile' ],
				'tab'		=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
		  'enable_responsive_header_styles',
		  	[
				'label'			=> __( 'Enable Responsive Table', 'docly-core'),
				'description'	=> esc_html__( 'If enabled, table header will be automatically responsive for mobile.', 'docly-core'),
				'type'			=> Controls_Manager::SWITCHER,
				'label_on'		=> esc_html__( 'Yes', 'docly-core'),
				'label_off' 	=> esc_html__( 'No', 'docly-core'),
				'return_value' 	=> 'yes',
		  	]
		);

		$this->add_responsive_control(
            'mobile_table_header_width',
            [
                'label'                 => __( 'Width', 'docly-core'),
				'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size' => 100,
                    'unit' => 'px',
                ],
                'size_units'            => [ 'px' ],
                'range'                 => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'             => [
                    '{{WRAPPER}} .table_shortcode .th-mobile-screen' => 'flex-basis: {{SIZE}}px;',
                ],
                'condition'	=> [
                	'enable_responsive_header_styles'	=> 'yes'
                ]
            ]
		);

		$this->add_responsive_control(
			'data_table_responsive_header_color',
			[
				'label' => esc_html__( 'Color', 'docly-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .table_shortcode tbody .th-mobile-screen'	=> 'color: {{VALUE}};'
				],
				'condition'	=> [
                	'enable_responsive_header_styles'	=> 'yes'
                ]
			]
		);

		$this->add_responsive_control(
			'data_table_responsive_header_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'docly-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .table_shortcode tbody .th-mobile-screen'	=> 'background-color: {{VALUE}};'
				],
				'condition'	=> [
                	'enable_responsive_header_styles'	=> 'yes'
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'		=> 'data_table_responsive_header_typography',
				'selector'	=> '{{WRAPPER}} .table_shortcode .th-mobile-screen',
				'condition'	=> [
                	'enable_responsive_header_styles'	=> 'yes'
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'data_table_responsive_header_border',
					'label' => esc_html__( 'Border', 'docly-core'),
					'selector' => '{{WRAPPER}} tbody td .th-mobile-screen',
					'condition'	=> [
	                	'enable_responsive_header_styles'	=> 'yes'
	                ]
				]
		);


		$this->end_controls_section();

	}


	protected function render( ) {

   		$settings = $this->get_settings();

	  	$table_tr = [];
		$table_td = [];

	  	// Storing Data table content values
	  	foreach( $settings['data_table_content_rows'] as $content_row ) {

	  		$row_id = uniqid();
	  		if( $content_row['data_table_content_row_type'] == 'row' ) {
	  			$table_tr[] = [
	  				'id' => $row_id,
	  				'type' => $content_row['data_table_content_row_type'],
	  			];

	  		}
	  		if( $content_row['data_table_content_row_type'] == 'col' ) {
	  			$target = $content_row['data_table_content_row_title_link']['is_external'] ? 'target="_blank"' : '';
	  			$nofollow = $content_row['data_table_content_row_title_link']['nofollow'] ? 'rel="nofollow"' : '';

	  			$table_tr_keys = array_keys( $table_tr );
				  $last_key = end( $table_tr_keys );
				  
				$tbody_content = ($content_row['data_table_content_type'] == 'editor') ? $content_row['data_table_content_row_content'] : $content_row['data_table_content_row_title'];

	  			$table_td[] = [
	  				'row_id'		=> $table_tr[$last_key]['id'],
	  				'type'			=> $content_row['data_table_content_row_type'],
					'content_type'	=> $content_row['data_table_content_type'],
	  				'title'			=> $tbody_content,
	  				'link_url'		=> $content_row['data_table_content_row_title_link']['url'],
	  				'link_target'	=> $target,
	  				'nofollow'		=> $nofollow,
					'colspan'		=> $content_row['data_table_content_row_colspan'],
					'rowspan'		=> $content_row['data_table_content_row_rowspan'],
					'tr_class'		=> $content_row['data_table_content_row_css_class'],
					'tr_id'			=> $content_row['data_table_content_row_css_id']
	  			];
	  		}
		}  
		$table_th_count = count($settings['data_table_header_cols_data']);
		$this->add_render_attribute('data_table_wrap', [
			'class'                  => 'table-responsive',
			'data-table_id'          => esc_attr($this->get_id()),
			'data-custom_responsive' => $settings['enable_responsive_header_styles'] ? 'true' : 'false'
		]);
		if(isset($settings['section_data_table_enabled']) && $settings['section_data_table_enabled']){
			$this->add_render_attribute('data_table_wrap', 'data-table_enabled', 'true');
		}

		switch ( $settings['table_style'] ) {
            case 'basic':
                $table_style = 'basic_table_info';
                break;
            case 'dark':
                $table_style = 'table-striped table-dark';
                break;
            case 'normal':
                $table_style = 'table_shortcode';
                break;
        }

        if ( $settings['sticky_header'] == 'yes' ) {
            $sticky_header = 'sticky-header';
        } else {
            $sticky_header = '';
            wp_deregister_script( 'floatThead' );
        }

		$this->add_render_attribute('data_table', [
			'class'	=> [ 'table', $table_style, $sticky_header, esc_attr($settings['table_alignment']) ],
			'id'	=> 'docly-table-'.esc_attr($this->get_id())
		]);

		$this->add_render_attribute( 'td_content', [
			'class'	=> 'td-content'
		]);

		if('yes' == $settings['enable_responsive_header_styles']) {
			$this->add_render_attribute('data_table_wrap', 'class', 'custom-responsive-option-enable');
		}
	  	?>

		<div <?php echo $this->get_render_attribute_string('data_table_wrap'); ?>>
			<table <?php echo $this->get_render_attribute_string('data_table'); ?>>
			    <thead>
			        <tr class="table-header">
						<?php $i = 0; foreach( $settings['data_table_header_cols_data'] as $header_title ) :
							$this->add_render_attribute('th_class'.$i, [
								'class'		=> [ $header_title['data_table_header_css_class'] ],
								'id'		=> $header_title['data_table_header_css_id'],
								'colspan'	=> $header_title['data_table_header_col_span']
							]);
						?>
			            <th <?php echo $this->get_render_attribute_string('th_class'.$i); ?>>
							<?php if( $header_title['data_table_header_col_icon_enabled'] == 'true' && $header_title['data_table_header_icon_type'] == 'icon' ) : ?>
								<?php if (empty($header_title['data_table_header_col_icon']) || isset($header_title['__fa4_migrated']['data_table_header_col_icon_new'])) { ?>
									<?php if( isset($header_title['data_table_header_col_icon_new']['value']['url']) ) : ?>
										<img class="data-header-icon data-table-header-svg-icon" src="<?php echo $header_title['data_table_header_col_icon_new']['value']['url'] ?>" alt="<?php echo esc_attr(get_post_meta($header_title['data_table_header_col_icon_new']['value']['id'], '_wp_attachment_image_alt', true)); ?>" />
									<?php else : ?>
										<i class="<?php echo $header_title['data_table_header_col_icon_new']['value'] ?> data-header-icon"></i>
									<?php endif; ?>
								<?php } else { ?>
									<i class="<?php echo $header_title['data_table_header_col_icon'] ?> data-header-icon"></i>
								<?php } ?>
			            	<?php endif; ?>
							<?php
								if( $header_title['data_table_header_col_icon_enabled'] == 'true' && $header_title['data_table_header_icon_type'] == 'image' ) :
									$this->add_render_attribute('data_table_th_img'.$i, [
										'src'	=> esc_url( $header_title['data_table_header_col_img']['url'] ),
										'class'	=> 'table_shortcode-th-img',
										'style'	=> "width:{$header_title['data_table_header_col_img_size']}px;",
										'alt'	=> esc_attr(get_post_meta($header_title['data_table_header_col_img']['id'], '_wp_attachment_image_alt', true))
									]);
							?><img <?php echo $this->get_render_attribute_string('data_table_th_img'.$i); ?>><?php endif; ?><span class="data-table-header-text"><?php echo __( $header_title['data_table_header_col'], 'docly-core'); ?></span></th>
			        	<?php $i++; endforeach; ?>
			        </tr>
			    </thead>
			  	<tbody>
					<?php for( $i = 0; $i < count( $table_tr ); $i++ ) : ?>
						<tr>
							<?php
								for( $j = 0; $j < count( $table_td ); $j++ ) {
									if( $table_tr[$i]['id'] == $table_td[$j]['row_id'] ) {

										$this->add_render_attribute('table_inside_td'.$i.$j,
											[
												'colspan' => $table_td[$j]['colspan'] > 1 ? $table_td[$j]['colspan'] : '',
												'rowspan' => $table_td[$j]['rowspan'] > 1 ? $table_td[$j]['rowspan'] : '',
												'class'		=> $table_td[$j]['tr_class'],
												'id'		=> $table_td[$j]['tr_id']
											]
										);
										?>
										<?php if(  $table_td[$j]['content_type'] == 'textarea' && !empty($table_td[$j]['link_url']) ) : ?>
											<td <?php echo $this->get_render_attribute_string('table_inside_td'.$i.$j); ?>>
												<div class="td-content-wrapper">
													<a href="<?php echo esc_url( $table_td[$j]['link_url'] ); ?>" <?php echo $table_td[$j]['link_target'] ?> <?php echo $table_td[$j]['nofollow'] ?>><?php echo wp_kses_post($table_td[$j]['title']); ?></a>
												</div>
											</td>
										<?php else: ?>
											<td <?php echo $this->get_render_attribute_string('table_inside_td'.$i.$j); ?>>
												<div class="td-content-wrapper"><div <?php echo $this->get_render_attribute_string('td_content'); ?>><?php echo $table_td[$j]['title']; ?></div></div>
											</td>
										<?php endif; ?>
										<?php
									}
								}
							?>
						</tr>
			        <?php endfor; ?>
			    </tbody>
			</table>
		</div>
	  	<?php
	}
}