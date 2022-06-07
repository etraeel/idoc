<?php
/**
 * Plugin Name: Docly Core
 * Plugin URI: https://themeforest.net/user/creativegigs/portfolio
 * Description: This plugin adds the core features to the Docly WordPress theme. You must have to install this plugin to get all the features included with the Docly theme.
 * Version: 1.5.4
 * Author: CreativeGigs
 * Author URI: https://themeforest.net/user/creativegigs/portfolio
 * Text domain: docly-core
 */

if ( !defined( 'ABSPATH') )
    die( '-1');

// Docly Core Directories
define( 'SC_IMAGES', plugins_url( 'widgets/images/', __FILE__));

require_once __DIR__ . '/vendor/autoload.php';

// Make sure the same class is not loaded twice in free/premium versions.
if ( !class_exists( 'Docly_core' ) ) {
	/**
	 * Main Docly Core Class
	 *
	 * The main class that initiates and runs the Docly Core plugin.
	 */
	class Docly_core {
		/**
		 * Docly Core Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '1.0' ;
		/**
		 * Minimum Elementor Version
		 *
		 * Holds the minimum Elementor version required to run the plugin.
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
		/**
		 * Minimum PHP Version
		 *
		 * Holds the minimum PHP version required to run the plugin.
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const  MINIMUM_PHP_VERSION = '5.4' ;
        /**
         * Plugin's directory paths
         * @since 1.0
         */
        const CSS = null;
        const JS = null;
        const IMG = null;
        const VEND = null;

		/**
		 * Instance
		 *
		 * Holds a single instance of the `Docly_Core` class.
		 *
		 * @access private
		 * @static
		 *
		 * @var Docly_Core A single instance of the class.
		 */
		private static  $_instance = null ;
		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @access public
		 * @static
		 *
		 * @return Docly_Core An instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Clone
		 *
		 * Disable class cloning.
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'docly-core' ), '1.7.0' );
		}

		/**
		 * Wakeup
		 *
		 * Disable unserializing the class.
		 *
		 * @access protected
		 *
		 * @return void
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'docly-core' ), '1.7.0' );
		}

		/**
		 * Constructor
		 *
		 * Initialize the Docly Core plugins.
		 *
		 * @access public
		 */
		public function __construct() {
            $opt = get_option('docly_opt');
            $is_mega_menu_cpt = isset($opt['is_mega_menu_cpt']) ? $opt['is_mega_menu_cpt'] : '1';
            if ( $is_mega_menu_cpt == '1' ) {
                add_action('init', [$this, 'mega_menu_include']);
            }

			$this->init_hooks();
			$this->core_includes();
			do_action( 'docly_core_loaded' );
		}

		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
		 *
		 * @access public
		 */
		public function core_includes() {
            $opt = get_option('docly_opt');
            $is_faq_cpt = isset($opt['is_faq_cpt']) ? $opt['is_faq_cpt'] : '1';

			// Extra functions
			require_once __DIR__ . '/inc/extra.php';
			require_once __DIR__ . '/inc/custom-fonts/custom-fonts.php';
			require_once __DIR__ . '/inc/metaboxes.php';
			require_once __DIR__ . '/inc/metaboxes.php';
			if ( class_exists('bbPress') ) {
				require_once __DIR__ . '/inc/bbp_solved_topic.php';
			}
			// Custom post types
            $is_mega_menu_cpt = isset($opt['is_mega_menu_cpt']) ? $opt['is_mega_menu_cpt'] : '1';
            if ( $is_mega_menu_cpt == '1' ) {
                require_once __DIR__ . '/post-type/docly_mega_menu.pt.php';
            }

            if ( $is_faq_cpt == '1' ) {
                require_once __DIR__ . '/post-type/faq.pt.php';
            }

            require_once __DIR__ . '/post-type/none.pt.php';

            // Gutenberg Blocks
            //require_once __DIR__ . '/blocks/_blocks.php';

            /**
             * Register widget area.
             *
             * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
             */
			require_once __DIR__ . '/wp-widgets/widgets.php';

			// Elementor custom field icons
			require_once __DIR__ . '/inc/icons.php';

            // RGBA color picker
            require plugin_dir_path(__FILE__) . '/inc/acf-rgba/acf-rgba-color-picker.php';

            // Shortcodes
            require_once  __DIR__.'/shortcodes/reference.php';
            require_once  __DIR__.'/shortcodes/direction.php';
            require_once  __DIR__.'/shortcodes/tooltip.php';
            require_once  __DIR__.'/shortcodes/conditional_data.php';
            require_once  __DIR__.'/shortcodes/authors.php';
		}

		function mega_menu_include() {
            // Mega Menu
            $mega_menus = new WP_Query(array(
                'post_type' => 'megamenu',
                'posts_per_page' => -1,
            ));
            $mega_menu_count = $mega_menus->post_count;
            if ( $mega_menu_count > 0 && has_nav_menu( 'main_menu') ) {
                require plugin_dir_path(__FILE__) . '/inc/mega_menu.php';
            }
        }

		/**
		 * Init Hooks
		 *
		 * Hook into actions and filters.
		 *
		 * @access private
		 */
		private function init_hooks() {
			add_action( 'init', [ $this, 'i18n' ] );
			add_action( 'plugins_loaded', [ $this, 'init' ] );
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * @access public
		 */
		public function i18n() {
			load_plugin_textdomain( 'docly-core', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}


		/**
		 * Init Docly Core
		 *
		 * Load the plugin after Elementor (and other plugins) are loaded.
		 *
		 * @access public
		 */
		public function init() {

			if ( !did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
				return;
			}

			// Check for required Elementor version

			if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
				return;
			}

			// Check for required PHP version

			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
				return;
			}

			// Add new Elementor Categories
			add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );

			// Register Widget Scripts
			add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_widget_scripts' ] );
			add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'register_widget_scripts' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

			// Register Widget Styles
            add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_elementor_editor_styles' ] );
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_widget_styles' ] );
			add_action( 'elementor/frontend/after_register_styles', [ $this, 'enqueue_widget_styles' ] );

			// Register New Widgets
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		}


		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {
			$message = sprintf(
			/* translators: 1: Docly Core 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'docly-core' ),
				'<strong>' . esc_html__( 'Docly core', 'docly-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'docly-core' ) . '</strong>'
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {
			$message = sprintf(
			/* translators: 1: Docly Core 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'docly-core' ),
				'<strong>' . esc_html__( 'Docly Core', 'docly-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'docly-core' ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {
			$message = sprintf(
			/* translators: 1: Docly Core 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'docly-core' ),
				'<strong>' . esc_html__( 'Docly Core', 'docly-core' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'docly-core' ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Add new Elementor Categories
		 *
		 * Register new widget categories for Docly Core widgets.
		 *
		 * @since 1.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		public function add_elementor_category() {
			\Elementor\Plugin::instance()->elements_manager->add_category( 'docly-elements', [
				'title' => __( 'Docly Elements', 'docly-core' ),
			], 1 );
		}

		/**
		 * Register Widget Scripts
		 *
		 * Register custom scripts required to run Docly Core.
		 *
		 * @access public
		 */
		public function register_widget_scripts() {
            wp_register_script( 'ajax-chimp', plugins_url( 'assets/js/ajax-chimp.js', __FILE__ ), 'jquery', '1.0', true );
		    wp_register_script( 'prism', plugins_url( 'assets/vendors/prism/prism.js', __FILE__), array('jquery'), '1.17.1', true );
		    wp_register_script( 'tooltipster', plugins_url( 'assets/vendors/tooltipster/js/tooltipster.bundle.min.js', __FILE__), array('jquery'), '4.2.7', true );
		    wp_register_script( 'slick', plugins_url( 'assets/vendors/slick/slick.min.js', __FILE__), array('jquery'), '1.9.0', true );
		    wp_register_script( 'parallaxie', plugins_url( 'assets/js/parallaxie.js', __FILE__), array('jquery'), '0.5', true );
		    wp_register_script( 'floatThead', plugins_url( 'assets/js/jquery.floatThead.min.js', __FILE__), array('jquery'), '2.1.4', true );
		    wp_register_script( 'counterup', plugins_url( 'assets/vendors/counterup/jquery.counterup.min.js', __FILE__), array('jquery'), '1.0.0', true );
		    wp_register_script( 'waypoints', plugins_url( 'assets/vendors/counterup/jquery.waypoints.min.js', __FILE__), array('jquery'), '4.0.1', true );
		    wp_register_script( 'tweenmax', plugins_url( 'assets/js/TweenMax.min.js', __FILE__), array('jquery'), '2.0.0', true );
		    wp_register_script( 'wavify', plugins_url( 'assets/js/jquery.wavify.js', __FILE__), array('jquery'), '1.0.0', true );
		    wp_register_script( 'chart', plugins_url( 'assets/js/Chart.js', __FILE__), array('jquery'), '1.0.0', true );
		}

		/**
		 * Register Widget Styles
		 *
		 * Register custom styles required to run Docly Core.
		 *
		 * @access public
		 */
		public function enqueue_widget_styles() {
            wp_register_style( 'slick', plugins_url( 'assets/vendors/slick/slick.css', __FILE__ ) );
            wp_register_style( 'prism', plugins_url( 'assets/vendors/prism/prism.min.css', __FILE__ ) );
		}

		public function enqueue_elementor_editor_styles() {
            wp_enqueue_style( 'simple-line-icon', plugins_url( 'assets/vendors/simple-line-icon/simple-line-icons.css', __FILE__ ) );
            wp_enqueue_style( 'elegant-icon', plugins_url( 'assets/vendors/elegant-icon/style.css', __FILE__ ) );
            wp_enqueue_style( 'docly-elementor-editor', plugins_url( 'assets/css/elementor-editor.css', __FILE__ ) );
		}

        public function enqueue_scripts() {
            $opt = get_option('docly_opt');
            $is_wc_block = isset($opt['is_wc_block']) ? $opt['is_wc_block'] : '';

            wp_deregister_style('elementor-animations');
            wp_deregister_style('e-animations');
            //wp_deregister_script('wedocs-anchorjs');
            if ( $is_wc_block != '1' ) {
                wp_deregister_style('wc-block-style');
                wp_deregister_style('wc-block-vendors-style');
            }
        }

		/*public function register_admin_styles() {
            wp_enqueue_style( 'docly_core_admin', plugins_url( 'assets/css/docly-core-admin.css', __FILE__ ) );
        }*/

		/**
		 * Register New Widgets
		 *
		 * Include Docly Core widgets files and register them in Elementor.
		 *
		 * @access public
		 */
		public function on_widgets_registered() {
			$this->include_widgets();
			$this->register_widgets();
		}

		/**
		 * Include Widgets Files
		 *
		 * Load Docly Core widgets files.
		 *
		 * @access private
		 */
		private function include_widgets() {
            require_once __DIR__ . '/vendor/autoload.php';
        }

		/**
		 * Register Widgets
		 *
		 * Register Docly Core widgets.
		 *
		 * @access private
		 */
		private function register_widgets() {
			// Site Elements
			$widgets = array(
				'Hero', 'Accordion', 'Button', 'Docs', 'Single_doc', 'Testimonial_carousel', 'Faq', 'Tabs', 'Process_Tabs', 'Alerts_box', 'Data_Table', 'Image_HotSpots', 'Code',
				'Counter', 'Forums', 'Forum_posts', 'Quote', 'Info_box', 'Cheatsheet', 'List_item'
			);

			foreach ( $widgets as $widget ) {
				$classname = "\\DoclyCore\\Widgets\\$widget";
				\Elementor\Plugin::instance()->widgets_manager->register( new $classname() );
			}
        }
	}
}
// Make sure the same function is not loaded twice in free/premium versions.

if ( !function_exists( 'docly_core_load' ) ) {
	/**
	 * Load Docly Core
	 *
	 * Main instance of Docly_Core.
	 *
	 */
	function docly_core_load() {
		return Docly_core::instance();
	}

	// Run Docly Core
    docly_core_load();
}


function docly_admin_cpt_script( $hook ) {
    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'service' === $post->post_type ) {
            wp_enqueue_style( 'themify-icons', plugins_url( 'assets/vendors/themify-icon/themify-icons.css', __FILE__ ));
        }
    }
}
add_action( 'admin_enqueue_scripts', 'docly_admin_cpt_script', 10, 1 );