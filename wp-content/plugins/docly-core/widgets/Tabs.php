<?php
namespace DoclyCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Docly Tabs
 */
class Tabs extends Widget_Base {

    public function get_name() {
        return 'docly_tabs';
    }

    public function get_title() {
        return esc_html__( 'Docly Tabs', 'docly-core' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'docly-elements' ];
    }

    protected function register_controls() {

        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __( 'Tabs', 'docly-core' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'docly-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'docly-core' ),
                'placeholder' => __( 'Tab Title', 'docly-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label' => __( 'Content', 'docly-core' ),
                'default' => __( 'Tab Content', 'docly-core' ),
                'placeholder' => __( 'Tab Content', 'docly-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );

        $repeater->end_controls_tab();

        $this->add_control(
            'tabs',
            [
                'label' => __( 'Tabs Items', 'docly-core' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        
        //--------------------- Section Color-----------------------------------//
        $this->start_controls_section(
            'style_tabs_sec',
            [
                'label' => __( 'Tabs Style', 'docly-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
        'style_tabs'
        );

        /// Normal  Style
        $this->start_controls_tab(
            'style_normal',
            [
                'label' => __( 'Normal', 'docly-core' ),
            ]
        );

        $this->add_control(
            'normal_title_font_color', [
                'label' => __( 'Title Font Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .design_tab .nav-item .nav-link.normal_color .title_color' => 'color: {{VALUE}}',
                )
            ]
        );

        $this->add_control(
            'normal_subtitle_font_color', [
                'label' => __( 'Subtitle Font Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .design_tab .nav-item .nav-link.normal_color p' => 'color: {{VALUE}}',
                )
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .design_tab .nav-item .nav-link' => 'background: {{VALUE}};',
                )
            ]
        );

        $this->end_controls_tab();

        /// ----------------------------- Active Style--------------------------//
        $this->start_controls_tab(
            'style_active_btn',
            [
                'label' => __( 'Active', 'docly-core' ),
            ]
        );

        $this->add_control(
            'active_title_font_color', [
                'label' => __( 'Title Font Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .design_tab .nav-item .nav-link.active .title_color' => 'color: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'active_subtitle_font_color', [
                'label' => __( 'Subtitle Font Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .design_tab .nav-item .nav-link.active p' => 'color: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'active_bg_color', [
                'label' => __( 'Background Color', 'docly-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .design_tab .nav-item .nav-link.active' => 'background: {{VALUE}};',
                )
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();

        //------------------------------------ Tab Border Radius -------------------------------------------//
        $this->start_controls_section(
            'border_radius_sec', [
                'label' => __( 'Border Radius', 'docly-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_radius', [
                'label' => esc_html__( 'Radius', 'docly-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .design_tab .nav-item .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings();
        $tabs = $this->get_settings_for_display( 'tabs' );
        $id_int = substr( $this->get_id_int(), 0, 3 );
        ?>
        <div class="tab_shortcode">
            <ul class="nav nav-tabs" role="tablist">
                <?php
                $i = 0.2;
                foreach ( $tabs as $index => $item ) :
                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                    $active = $tab_count == 1 ? 'active' : '';
                    $selected = $tab_count == 1 ? 'true' : 'false';
                    $this->add_render_attribute( $tab_title_setting_key, [
                        'href' => '#docly-tab-content-' . $id_int . $tab_count,
                        'class' => [ 'nav-link', $active ],
                        'id' => 'docly'.'-tab-'.$id_int . $tab_count,
                        'role' => 'tab',
                        'aria-controls' => 'docly-tab-content-' . $id_int . $tab_count,
                        'data-toggle' => 'tab',
                        'aria-selected' => $selected,
                    ]);
                    ?>
                    <li class="nav-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                        <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                            <?php echo wp_kses_post($item['tab_title']); ?>
                        </a>
                    </li>
                    <?php
                    $i = $i + 0.2;
                endforeach; ?>
            </ul>
            <div class="tab-content">
                <?php
                foreach ( $tabs as $index => $item ) :
                    $tab_count = $index + 1;
                    $active = $tab_count == 1 ? 'show active' : '';
                    $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
                    $this->add_render_attribute( $tab_content_setting_key, [
                        'class' => [ 'tab-pane', 'fade', $active ],
                        'id' => 'docly-tab-content-' . $id_int . $tab_count,
                        'aria-labelledby' => 'docly'.'-tab-'.$id_int . $tab_count,
                        'role' => 'tabpanel',
                    ] );
                    ?>
                    <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                        <div class="tab_img">
                            <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
        <?php
    }
}