<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/includes
 * @author     ideabox <https://ideabox.io>
 */
class Ib_Ideabox_slider_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function ib_load_plugin_textdomain() {

		load_plugin_textdomain(
			'Ib-ideabox_slider',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
