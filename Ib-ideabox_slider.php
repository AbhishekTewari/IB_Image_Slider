<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              
 * @since             1.0.0
 * @package           ib_Ideabox_slider
 *
 * @wordpress-plugin
 * Plugin Name:       IB Image Slider
 * Plugin URI:        https://ideabox.io
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            ideabox
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Ib-ideabox_slider
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'IB_IDEABOX_SLIDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/Ib-class-ideabox_slider-activator.php
 */
function ib_activate_ideabox_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/ib-class-ideabox_slider-activator.php';
	Ib_Ideabox_slider_Activator::ib_activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/Ib-class-ideabox_slider-deactivator.php
 */
function ib_deactivate_ideabox_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/ib-class-ideabox_slider-deactivator.php';
	Ib_Ideabox_slider_Deactivator::ib_deactivate();
}

register_activation_hook( __FILE__, 'ib_activate_ideabox_slider' );
register_deactivation_hook( __FILE__, 'ib_deactivate_ideabox_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/ib-class-ideabox_slider.php';

//Plugin Constant
if ( !defined( 'IB_DIR' ) ) {
	define('IB_DIR', plugin_dir_path( __FILE__ ) );
}
if ( !defined( 'IB_URL' ) ) {
	define('IB_URL', plugin_dir_url( __FILE__ ) );
}
if ( !defined( 'IB_HOME' ) ) {
	define('IB_HOME', home_url() );
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function ib_run_ideabox_slider() {

	$plugin = new ib_Ideabox_slider();
	$plugin->ib_run();

}
ib_run_ideabox_slider();
