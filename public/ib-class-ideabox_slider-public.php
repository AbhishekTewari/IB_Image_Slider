<?php

/**
 * The public-specific functionality of the plugin.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/public
 */

/**
 * The public-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-specific stylesheet and JavaScript.
 *
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/public
 * @author     ideabox <https://ideabox.io>
 */
class Ib_Ideabox_slider_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $ib_plugin_name    The ID of this plugin.
	 */
	private $ib_plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $ib_version    The current version of this plugin.
	 */
	private $ib_version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $ib_plugin_name       The name of this plugin.
	 * @param      string    $ib_version    The version of this plugin.
	 */
	public function __construct( $ib_plugin_name, $ib_version ) {

		$this->ib_plugin_name = $ib_plugin_name;
		$this->ib_version = $ib_version;
		add_shortcode('ib_show_slideshow',array($this , 'ib_show_slideshow_callback'));
	}

	/**
	 * Register the stylesheets for the public area.
	 *
	 * @since    1.0.0
	 */
	public function ib_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the ib_run() function
		 * defined in Ideabox_slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ideabox_slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->ib_plugin_name, plugin_dir_url( __FILE__ ) . 'css/ib-ideabox_slider-public.css', array(), $this->ib_version, 'all' );
		wp_enqueue_style('ib_slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.min.css');
		wp_enqueue_style('ib_slick_theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css');
	}

	/**
	 * Register the JavaScript for the public area.
	 *
	 * @since    1.0.0
	 */
	public function ib_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the ib_run() function
		 * defined in Ideabox_slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ideabox_slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->ib_plugin_name, plugin_dir_url( __FILE__ ) . 'js/ib-ideabox_slider-public.js', array( 'jquery' ), $this->ib_version, false );
		wp_enqueue_script('ib_slick_js',  plugin_dir_url( __FILE__ ) . 'js/ib-slick_js.js', array( 'jquery' ), $this->ib_version, false );

	}

	public function ib_show_slideshow_callback(){
		
		ob_start();
		include_once ( IB_DIR.'public/partials/ib-ideabox_slider-public-display.php');
		return ob_get_clean();
	
	}

}
