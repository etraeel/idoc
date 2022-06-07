<?php
namespace DoclyCore\Widgets;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Chart
 * @package DoclyCore\Widgets
 */
class Chart extends Widget_Base {

	public function get_name() {
		return 'docly_chart';
	}

	public function get_title() {
		return __( 'Chart', 'rogan-core' );
	}

	public function get_icon() {
		return 'eicon-counter-circle';
	}

	public function get_categories() {
		return [ 'docly-elements' ];
	}

	public function get_keywords() {
		return [ 'chart', 'Stats', 'facts' ];
	}

	public function get_script_depends() {
		return [ 'chart', 'counterup', 'waypoints' ];
	}

	protected function register_controls()
	{
		//----------------------------- Counter Section --------------------------------------//
		$this->start_controls_section(
			'counter_sec',
			[
				'label' => esc_html__('Counter', 'rogan-core'),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'desc', [
				'label' => esc_html__('Description', 'rogan-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'percent', [
				'label' => esc_html__('Percent', 'rogan-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Global Customer',
			]
		);

		$this->add_control(
			'counter_section', [
				'label' => esc_html__('Counter', 'rogan-core'),
				'type' => Controls_Manager::REPEATER,
				'title_field' => '{{{ count_value }}}',
				'fields' => $repeater->get_controls(),
			]
		);

		$this->end_controls_section();


		/**
		 * Style Tab
		 * Theme Counter Style
		 */
		/****************************** Theme Counter **************************/
		$this->start_controls_section(
			'theme_counter_sec',
			[
				'label' => esc_html__('Counter Style', 'rogan-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'sec_padding', [
				'label' => __( 'Section padding', 'docly-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .doc_fun_fact_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
				],
			]
		);

		$this->add_control(
			'sec_bg_color', [
				'label' => esc_html__('Background Color', 'rogan-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_fun_fact_area' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_count_value', [
				'label' => esc_html__('Count Text Color', 'rogan-core'),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .doc_fact_item .counter' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_count_value',
				'label' => esc_html__('Count Text Typography', 'rogan-core'),
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .doc_fact_item .counter',
			]
		);

		$this->add_control(
			'color_count_label', [
				'label' => esc_html__('Count Label Color', 'rogan-core'),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .doc_fact_item p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_count_label',
				'label' => esc_html__('Count Text Typography', 'rogan-core'),
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .doc_fact_item p',
			]
		);

		$this->end_controls_section();

	}

	protected function render()
	{
		$settings = $this->get_settings();
		$counters = $settings['counter_section'];
		?>

		<div class="docly-chart-wrapper">
			<ul class="chart-info">
				<li class="info-left-top color-one">
					<div class="counterup">
						<span class="counter">75</span>
						<span>%</span>
					</div>
					<div class="border-image">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
						     width="370" height="61" viewBox="0 0 370 61">
							<path fill-rule="evenodd" fill="<?php echo esc_attr($settings['part1_color']) ?>"
							      d="M319.500,1.423 L370.005,60.139 L369.200,60.721 L318.689,2.000 L-0.000,2.000 L-0.000,1.000 L318.497,1.000 L318.891,0.715 L319.136,1.000 L319.500,1.000 L319.500,1.423 Z" />
						</svg>
					</div>
					<?php echo !empty($settings['part1_desc']) ? wpautop($settings['part1_desc']) : ''; ?>
				</li>
				<li class="info-right-top color-two">
					<div class="counterup">
						<span class="counter">22</span>
						<span>%</span>
					</div>
					<div class="border-image">
						<!-- <img src="img/home_support/brt.png" alt="chart"> -->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
						     width="330px" height="60px">
							<path fill-rule="evenodd" fill="<?php echo esc_attr($settings['part2_color']) ?>"
							      d="M330.000,1.281 L51.455,1.281 L0.802,60.002 L-0.005,59.421 L50.656,0.689 L50.656,0.281 L51.008,0.281 L51.253,-0.003 L51.648,0.281 L330.000,0.281 L330.000,1.281 Z" />
						</svg>
					</div>
					<?php echo !empty($settings['part2_desc']) ? wpautop($settings['part2_desc']) : ''; ?>
				</li>
				<li class="info-left-bottom color-three">
					<div class="counterup">
						<span class="counter">44</span>
						<span>%</span>
					</div>
					<div class="border-image">
						<!-- <img src="img/home_support/blb.png" alt="chart"> -->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
						     width="350px" height="60px">
							<path fill-rule="evenodd" fill="rgb(53, 186, 233)"
							      d="M350.005,0.578 L299.344,59.310 L299.344,59.718 L298.992,59.718 L298.747,60.002 L298.353,59.718 L-0.000,59.718 L-0.000,58.719 L298.544,58.719 L349.198,-0.003 L350.005,0.578 Z" />
						</svg>
					</div>
					<p>
						20 Out of 205 issues haven't got a reply
					</p>
				</li>
				<li class="info-right-bottom color-four">
					<div class="counterup">
						<span class="counter">35</span>
						<span>%</span>
					</div>
					<div class="border-image">
						<!-- <img src="img/home_support/brb.png" alt="chart"> -->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
						     width="390px" height="60px">
							<path fill-rule="evenodd" fill="rgb(252, 193, 3)"
							      d="M390.000,59.719 L51.647,59.719 L51.253,60.002 L51.008,59.719 L50.656,59.719 L50.656,59.310 L-0.005,0.579 L0.802,-0.004 L51.456,58.719 L390.000,58.719 L390.000,59.719 Z" />
						</svg>
					</div>
					<p>
						We are working on 42 out of 205 issues
					</p>
				</li>
			</ul>

			<div class="canvas">
				<canvas id="docly-chart"></canvas>
			</div>
			<!-- /.canvas -->

			<div class="full-amount">
				<h3 class="total-count"><span class="counter">100</span><span>%</span></h3>
			</div>
		</div>

		<script>
            ;(function ($) {
                "use strict";
	            function chartJs() {

	                var windowSize = $(window).width();

	                if (windowSize <= 767) {
	                    var leg = true,
	                        ratio = false;
	                } else {
	                    var leg = false,
	                        ratio = true;
	                }

	                var data = [{
                            'name': '35 out of 205 issues unanswered',
                            'value': 36
	                    },
	                    {
	                        'name': 'We are working on 42 out of 205 issues',
	                        'value': 40
	                    },
	                    {
	                        'name': '20 Out of 205 issues haven\'t got a reply',
	                        'value': 44
	                    },
	                    {
	                        'name': '90 Out of 205 issues resolved in last tow monthsSent',
	                        'value': 50
	                    }
	                ];

	                var labels = [];
	                var datasets = [];
	                var sent = data[0];
	                var opened = data[1];
	                var response = data[2];
	                var secured = data[3];

	                data.forEach(function (items) {
	                    labels.push(items.name);
	                });

	                datasets.push({
	                    data: [sent.value, opened.value, response.value, secured.value],
	                    backgroundColor: ["#f9327a", "#ecb939", "#35bae9", "#42dabf"],
	                    borderWidth: 0,
	                    label: [sent.name, opened.name, response.name, secured.name],
	                });

	                $('#docly-chart').each(function () {


	                    var canvas = $('#docly-chart');
	                    canvas.attr('height', 125);
	                    // chart.canvas.parentNode.style.height = '128px';
	                    // chart.canvas.parentNode.style.width = '128px';

	                    var chart = new Chart(canvas, {
	                        type: 'polarArea',
	                        borderWidth: 0,
	                        hover: false,
	                        data: {
	                            datasets: datasets,
	                            labels: labels
	                        },

	                        options: {
	                            responsive: true,
	                            maintainAspectRatio: ratio,
	                            legend: {
	                                position: 'top',
	                                display: leg,
	                                fullWidth: false,
	                                padding: 10,
	                                align: 'start'
	                            },
	                            scale: {
	                                display: false
	                            },
	                            tooltips: {
	                                enabled: false,
	                                backgroundColor: 'white',
	                                borderColor: '#868e96',
	                                borderWidth: .5,
	                                bodyFontColor: '#868e96',
	                                bodyFontSize: 14,
	                                bodySpacing: 5,
	                                caretSize: 0,
	                                cornerRadius: 0,
	                                displayColors: true,
	                                xPadding: 10,
	                                yPadding: 15,
	                            }
	                        }
	                    });
	                });
	            }
	            $(window).on("load", function () {
	                chartJs();
	            });
            })(jQuery);
		</script>
		<?php
	}
}