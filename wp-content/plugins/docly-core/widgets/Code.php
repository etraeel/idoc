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

class Code extends Widget_Base {

    public function get_name() {
        return 'docly_code_syntax_highlighter';
    }

    public function get_title() {
        return __( 'Code Syntax Highlighter', 'docly-core' );
    }

    public function get_icon() {
        return 'eicon-editor-code';
    }

    public function get_categories() {
        return [ 'docly-elements' ];
    }

    public function get_keywords() {
        return [ 'code', 'syntax', 'highlighter', 'source code' ];
    }

    public function get_style_depends() {
        return ['prism'];
    }

    public function get_script_depends() {
        return ['prism'];
    }

    public function lng_type() {
        return [
            'markup' => __('HTML Markup', 'docly-core'),
            'css' => __('CSS', 'docly-core'),
            'clike' => __('Clike', 'docly-core'),
            'javascript' => __('JavaScript', 'docly-core'),
            'abap' => __('ABAP', 'docly-core'),
            'abnf' => __('Augmented Backus–Naur form', 'docly-core'),
            'actionscript' => __('ActionScript', 'docly-core'),
            'ada' => __('Ada', 'docly-core'),
            'apacheconf' => __('Apache Configuration', 'docly-core'),
            'apl' => __('APL', 'docly-core'),
            'applescript' => __('AppleScript', 'docly-core'),
            'arduino' => __('Arduino', 'docly-core'),
            'arff' => __('ARFF', 'docly-core'),
            'asciidoc' => __('AsciiDoc', 'docly-core'),
            'asm6502' => __('6502 Assembly', 'docly-core'),
            'aspnet' => __('ASP.NET (C#)', 'docly-core'),
            'autohotkey' => __('AutoHotkey', 'docly-core'),
            'autoit' => __('Autoit', 'docly-core'),
            'bash' => __('Bash', 'docly-core'),
            'basic' => __('BASIC', 'docly-core'),
            'batch' => __('Batch', 'docly-core'),
            'bison' => __('Bison', 'docly-core'),
            'bnf' => __('Bnf', 'docly-core'),
            'brainfuck' => __('Brainfuck', 'docly-core'),
            'bro' => __('Bro', 'docly-core'),
            'c' => __('C', 'docly-core'),
            'csharp' => __('Csharp', 'docly-core'),
            'cpp' => __('Cpp', 'docly-core'),
            'cil' => __('Cil', 'docly-core'),
            'coffeescript' => __('Coffeescript', 'docly-core'),
            'cmake' => __('Cmake', 'docly-core'),
            'clojure' => __('Clojure', 'docly-core'),
            'crystal' => __('Crystal', 'docly-core'),
            'csp' => __('Csp', 'docly-core'),
            'css-extras' => __('Css-extras', 'docly-core'),
            'd' => __('D', 'docly-core'),
            'dart' => __('Dart', 'docly-core'),
            'diff' => __('Diff', 'docly-core'),
            'django' => __('Django', 'docly-core'),
            'dns-zone-file' => __('Dns-zone-file', 'docly-core'),
            'docker' => __('Docker', 'docly-core'),
            'ebnf' => __('Ebnf', 'docly-core'),
            'eiffel' => __('Eiffel', 'docly-core'),
            'ejs' => __('Ejs', 'docly-core'),
            'elixir' => __('Elixir', 'docly-core'),
            'elm' => __('Elm', 'docly-core'),
            'erb' => __('Erb', 'docly-core'),
            'erlang' => __('Erlang', 'docly-core'),
            'fsharp' => __('Fsharp', 'docly-core'),
            'firestore-security-rules' => __('Firestore-security-rules', 'docly-core'),
            'flow' => __('Flow', 'docly-core'),
            'fortran' => __('Fortran', 'docly-core'),
            'gcode' => __('Gcode', 'docly-core'),
            'gdscript' => __('Gdscript', 'docly-core'),
            'gedcom' => __('Gedcom', 'docly-core'),
            'gherkin' => __('Gherkin', 'docly-core'),
            'git' => __('Git', 'docly-core'),
            'glsl' => __('Glsl', 'docly-core'),
            'gml' => __('Gml', 'docly-core'),
            'go' => __('Go', 'docly-core'),
            'graphql' => __('Graphql', 'docly-core'),
            'groovy' => __('Groovy', 'docly-core'),
            'haml' => __('Haml', 'docly-core'),
            'handlebars' => __('Handlebars', 'docly-core'),
            'haskell' => __('Haskell', 'docly-core'),
            'haxe' => __('Haxe', 'docly-core'),
            'hcl' => __('Hcl', 'docly-core'),
            'http' => __('Http', 'docly-core'),
            'hpkp' => __('Hpkp', 'docly-core'),
            'hsts' => __('Hsts', 'docly-core'),
            'ichigojam' => __('Ichigojam', 'docly-core'),
            'icon' => __('Icon', 'docly-core'),
            'inform7' => __('Inform7', 'docly-core'),
            'ini' => __('Ini', 'docly-core'),
            'io' => __('Io', 'docly-core'),
            'j' => __('J', 'docly-core'),
            'java' => __('Java', 'docly-core'),
            'javadoc' => __('Javadoc', 'docly-core'),
            'javadoclike' => __('Javadoclike', 'docly-core'),
            'javastacktrace' => __('Javastacktrace', 'docly-core'),
            'jolie' => __('Jolie', 'docly-core'),
            'jq' => __('Jq', 'docly-core'),
            'jsdoc' => __('Jsdoc', 'docly-core'),
            'js-extras' => __('Js-extras', 'docly-core'),
            'js-templates' => __('Js-templates', 'docly-core'),
            'json' => __('Json', 'docly-core'),
            'jsonp' => __('Jsonp', 'docly-core'),
            'json5' => __('Json5', 'docly-core'),
            'julia' => __('Julia', 'docly-core'),
            'keyman' => __('Keyman', 'docly-core'),
            'kotlin' => __('Kotlin', 'docly-core'),
            'latex' => __('Latex', 'docly-core'),
            'less' => __('Less', 'docly-core'),
            'lilypond' => __('Lilypond', 'docly-core'),
            'liquid' => __('Liquid', 'docly-core'),
            'lisp' => __('Lisp', 'docly-core'),
            'livescript' => __('Livescript', 'docly-core'),
            'lolcode' => __('Lolcode', 'docly-core'),
            'lua' => __('Lua', 'docly-core'),
            'makefile' => __('Makefile', 'docly-core'),
            'markdown' => __('Markdown', 'docly-core'),
            'markup-templating' => __('Markup-templating', 'docly-core'),
            'matlab' => __('Matlab', 'docly-core'),
            'mel' => __('Mel', 'docly-core'),
            'mizar' => __('Mizar', 'docly-core'),
            'monkey' => __('Monkey', 'docly-core'),
            'n1ql' => __('N1ql', 'docly-core'),
            'n4js' => __('N4js', 'docly-core'),
            'nand2tetris-hdl' => __('Nand2tetris-hdl', 'docly-core'),
            'nasm' => __('Nasm', 'docly-core'),
            'nginx' => __('Nginx', 'docly-core'),
            'nim' => __('Nim', 'docly-core'),
            'nix' => __('Nix', 'docly-core'),
            'nsis' => __('Nsis', 'docly-core'),
            'objectivec' => __('Objectivec', 'docly-core'),
            'ocaml' => __('Ocaml', 'docly-core'),
            'opencl' => __('Opencl', 'docly-core'),
            'oz' => __('Oz', 'docly-core'),
            'parigp' => __('Parigp', 'docly-core'),
            'parser' => __('Parser', 'docly-core'),
            'pascal' => __('Pascal', 'docly-core'),
            'pascaligo' => __('Pascaligo', 'docly-core'),
            'pcaxis' => __('Pcaxis', 'docly-core'),
            'perl' => __('Perl', 'docly-core'),
            'php' => __('Php', 'docly-core'),
            'phpdoc' => __('Phpdoc', 'docly-core'),
            'php-extras' => __('Php-extras', 'docly-core'),
            'plsql' => __('Plsql', 'docly-core'),
            'powershell' => __('Powershell', 'docly-core'),
            'processing' => __('Processing', 'docly-core'),
            'prolog' => __('Prolog', 'docly-core'),
            'properties' => __('Properties', 'docly-core'),
            'protobuf' => __('Protobuf', 'docly-core'),
            'pug' => __('Pug', 'docly-core'),
            'puppet' => __('Puppet', 'docly-core'),
            'pure' => __('Pure', 'docly-core'),
            'python' => __('Python', 'docly-core'),
            'q' => __('Q', 'docly-core'),
            'qore' => __('Qore', 'docly-core'),
            'r' => __('R', 'docly-core'),
            'jsx' => __('Jsx', 'docly-core'),
            'tsx' => __('Tsx', 'docly-core'),
            'renpy' => __('Renpy', 'docly-core'),
            'reason' => __('Reason', 'docly-core'),
            'regex' => __('Regex', 'docly-core'),
            'rest' => __('Rest', 'docly-core'),
            'rip' => __('Rip', 'docly-core'),
            'roboconf' => __('Roboconf', 'docly-core'),
            'ruby' => __('Ruby', 'docly-core'),
            'rust' => __('Rust', 'docly-core'),
            'sas' => __('Sas', 'docly-core'),
            'sass' => __('Sass', 'docly-core'),
            'scss' => __('Scss', 'docly-core'),
            'scala' => __('Scala', 'docly-core'),
            'scheme' => __('Scheme', 'docly-core'),
            'shell-session' => __('Shell-session', 'docly-core'),
            'smalltalk' => __('Smalltalk', 'docly-core'),
            'smarty' => __('Smarty', 'docly-core'),
            'soy' => __('Soy', 'docly-core'),
            'splunk-spl' => __('Splunk-spl', 'docly-core'),
            'sql' => __('Sql', 'docly-core'),
            'stylus' => __('Stylus', 'docly-core'),
            'swift' => __('Swift', 'docly-core'),
            'tap' => __('Tap', 'docly-core'),
            'tcl' => __('Tcl', 'docly-core'),
            'textile' => __('Textile', 'docly-core'),
            'toml' => __('Toml', 'docly-core'),
            'tt2' => __('Tt2', 'docly-core'),
            'turtle' => __('Turtle', 'docly-core'),
            'twig' => __('Twig', 'docly-core'),
            'typescript' => __('Typescript', 'docly-core'),
            't4-cs' => __('T4-cs', 'docly-core'),
            't4-vb' => __('T4-vb', 'docly-core'),
            't4-templating' => __('T4-templating', 'docly-core'),
            'vala' => __('Vala', 'docly-core'),
            'vbnet' => __('Vbnet', 'docly-core'),
            'velocity' => __('Velocity', 'docly-core'),
            'verilog' => __('Verilog', 'docly-core'),
            'vhdl' => __('Vhdl', 'docly-core'),
            'vim' => __('Vim', 'docly-core'),
            'visual-basic' => __('Visual-basic', 'docly-core'),
            'wasm' => __('Wasm', 'docly-core'),
            'wiki' => __('Wiki', 'docly-core'),
            'xeora' => __('Xeora', 'docly-core'),
            'xojo' => __('Xojo', 'docly-core'),
            'xquery' => __('Xquery', 'docly-core'),
            'yaml' => __('Yaml', 'docly-core'),
        ];
    }

    /**
     * Register content related controls
     */
    protected function register_controls() {
        // Source Code Section Start
        $this->start_controls_section(
            '_section_source_code',
            [
                'label' => __('Source Code', 'docly-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'lng_type',
            [
                'label' => __('Language Type', 'docly-core'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'default' => 'markup',
                'options' => $this->lng_type(),
            ]
        );

        $this->add_control(
            'theme',
            [
                'label' => __('Theme', 'docly-core'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'default' => 'prism',
                'options' => [
                    'prism' => __('Default', 'docly-core'),
                    'prism-coy' => __('Coy', 'docly-core'),
                    'prism-dark' => __('Dark', 'docly-core'),
                    'prism-funky' => __('Funky', 'docly-core'),
                    'prism-okaidia' => __('Okaidia', 'docly-core'),
                    'prism-solarizedlight' => __('Solarized light', 'docly-core'),
                    'prism-tomorrow' => __('Tomorrow', 'docly-core'),
                    'prism-twilight' => __('Twilight', 'docly-core'),
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'source_code',
            [
                'label' => __('Source Code', 'docly-core'),
                'type' => Controls_Manager::CODE,
                'rows' => 20,
                'default' => '<p class="random-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>',
                'placeholder' => __('Source Code....', 'docly-core'),
                'condition' => [
                    'lng_type!' => '',
                ],
            ]
        );
        $this->end_controls_section();

        /**
         * Style Controls
         */
        $this->start_controls_section(
            '_section_source_code_style',
            [
                'label' => __('Style', 'docly-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'source_code_box_height',
            [
                'label' => __('Height', 'docly-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .docly-source-code pre' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => __('Box Border', 'docly-core'),
                'selector' => '{{WRAPPER}}  .docly-source-code pre[class*="language-"]',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label' => __('Border Radius', 'docly-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .docly-source-code pre[class*="language-"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'source_code_box_padding',
            [
                'label' => __('Padding', 'docly-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .docly-source-code pre' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'source_code_box_margin',
            [
                'label' => __('Margin', 'docly-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .docly-source-code pre' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        wp_enqueue_style('prism');
        $source_code = $settings['source_code'];
        $theme = !empty($settings['theme']) ? $settings['theme'] : 'prism';
        $this->add_render_attribute('docly-code-wrap', 'class', 'docly-source-code');
        $this->add_render_attribute('docly-code-wrap', 'class', $theme);
        $this->add_render_attribute('docly-code-wrap', 'data-lng-type', $settings['lng_type']);
        $this->add_render_attribute('docly-code', 'class', 'language-' . $settings['lng_type']);
        ?>
        <?php if (!empty($source_code)): ?>
            <div <?php $this->print_render_attribute_string('docly-code-wrap'); ?>>
			<pre>
				<code <?php $this->print_render_attribute_string('docly-code'); ?>>
					<?php echo esc_html($source_code); ?>
				</code>
			</pre>
            </div>
        <?php endif; ?>
        <?php

    }

}
