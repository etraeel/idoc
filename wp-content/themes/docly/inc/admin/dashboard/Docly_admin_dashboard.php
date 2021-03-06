<?php
/**
* Liquid Themes Theme Framework
* The Liquid_Admin_Dashboard base class
*/

if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Docly_admin_dashboard extends Docly_admin_page {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->id = 'docly';
		$this->page_title = esc_html__( 'Docly Dashboard', 'docly' );
		$this->menu_title = esc_html__( 'Register/Verify', 'docly' );
		$this->position = '50';

		parent::__construct();
	}

	/**
	 * [display description]
	 * @method display
	 * @return [type]  [description]
	 */
	public function display() {
		include_once( get_template_directory() . '/inc/admin/dashboard/dashboard.php' );
	}

	/**
	 * [save description]
	 * @method save
	 * @return [type] [description]
	 */
	public function save() {

	}
}
new Docly_admin_dashboard;
