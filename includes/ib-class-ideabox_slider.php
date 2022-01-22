<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/includes
 * @author     ideabox <https://ideabox.io>
 */
class ib_Ideabox_slider {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      ib_Ideabox_slider_Loader    $ib_loader    Maintains and registers all hooks for the plugin.
	 */
	protected $ib_loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $ib_plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $ib_plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $ib_version    The current version of the plugin.
	 */
	protected $ib_version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'IB_IDEABOX_SLIDER_VERSION' ) ) {
			$this->ib_version = IB_IDEABOX_SLIDER_VERSION;
		} else {
			$this->ib_version = '1.0.0';
		}
		$this->ib_plugin_name = 'ideabox_slider';

		$this->ib_load_dependencies();
		$this->ib_set_locale();
		$this->ib_define_admin_hooks();
		$this->ib_define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - ib_Ideabox_slider_Loader. Orchestrates the hooks of the plugin.
	 * - ib_Ideabox_slider_i18n. Defines internationalization functionality.
	 * - ib_Ideabox_slider_Admin. Defines all hooks for the admin area.
	 * - ib_Ideabox_slider_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function ib_load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/ib-class-ideabox_slider-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/ib-class-ideabox_slider-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/ib-class-ideabox_slider-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/ib-class-ideabox_slider-public.php';

		$this->ib_loader = new Ib_Ideabox_slider_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the ib_Ideabox_slider_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function ib_set_locale() {

		$ib_plugin_i18n = new Ib_Ideabox_slider_i18n();

		$this->ib_loader->ib_add_action( 'plugins_loaded', $ib_plugin_i18n, 'ib_load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function ib_define_admin_hooks() {

		$ib_plugin_admin = new Ib_Ideabox_slider_Admin( $this->ib_get_plugin_name(), $this->ib_get_version());
		$this->ib_loader->ib_add_action( 'admin_enqueue_scripts', $ib_plugin_admin, 'ib_enqueue_styles' );
		$this->ib_loader->ib_add_action( 'admin_enqueue_scripts', $ib_plugin_admin, 'ib_enqueue_scripts' );
		$this->ib_loader->ib_add_action( 'admin_menu', $ib_plugin_admin, 'ib_admin_menu_callback' );
		$this->ib_loader->ib_add_action( 'wp_ajax_ib_add_slider_details', $ib_plugin_admin, 'ib_add_slider_details_callback' );
		$this->ib_loader->ib_add_action( 'wp_ajax_ib_delete_img', $ib_plugin_admin, 'ib_delete_img_callback' );
		$this->ib_loader->ib_add_action( 'wp_ajax_ib_suffel_id', $ib_plugin_admin, 'ib_suffel_id_callback' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function ib_define_public_hooks() {

		$ib_plugin_public = new Ib_Ideabox_slider_Public( $this->ib_get_plugin_name(), $this->ib_get_version() );

		$this->ib_loader->ib_add_action( 'wp_enqueue_scripts', $ib_plugin_public, 'ib_enqueue_styles' );
		$this->ib_loader->ib_add_action( 'wp_enqueue_scripts', $ib_plugin_public, 'ib_enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function ib_run() {
		$this->ib_loader->ib_run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function ib_get_plugin_name() {
		return $this->ib_plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ideabox_slider_Loader    Orchestrates the hooks of the plugin.
	 */
	public function ib_get_loader() {
		return $this->ib_loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function ib_get_version() {
		return $this->ib_version;
	}

}
