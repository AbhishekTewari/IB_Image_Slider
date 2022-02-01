<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       
 * @since      1.0.0
 *
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/admin
 * @author     ideabox <https://ideabox.io>
 */
class Ib_Ideabox_slider_Admin {

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

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->ib_plugin_name, plugin_dir_url( __FILE__ ) . 'css/ib-ideabox_slider-admin.css', array(), $this->ib_version, 'all' );

		// For font awsm icons //
		wp_enqueue_style( 'ib_fa_fa_icon', 'https://pro.fontawesome.com/releases/v5.1.0/css/all.css' );

		wp_enqueue_style( 'ib_fas_fa_icon', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css' );

		// For carousel slider //
		wp_enqueue_style( 'ib_carousel', plugin_dir_url( __FILE__ ) . 'css/ib-carousel_min.css', array(), $this->ib_version, 'all' );

		wp_enqueue_style( 'ib_carousel_default', plugin_dir_url( __FILE__ ) . 'css/ib-carousel_default.css', array(), $this->ib_version, 'all' );

		wp_enqueue_style( 'ib_carousel_min_theme', plugin_dir_url( __FILE__ ) . 'css/ib_carousel_min_theme.css', array(), $this->ib_version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
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
		wp_enqueue_script( $this->ib_plugin_name, plugin_dir_url( __FILE__ ) . 'js/ib-ideabox_slider-admin.js', array( 'jquery' ), $this->ib_version, false );
	
		wp_enqueue_script( 'ib_block_ui', plugin_dir_url( __FILE__ ) . 'js/ib-block_ui.js', array( 'jquery' ), $this->ib_version, false );

		/**
		 * localize script to access array in jquery file.
		 */
		$ib_ajax_nonce = wp_create_nonce( "ib-ajax-security-string" );
		$ib_translation_array = array(
										'ib_ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
										'ib_nonce' => $ib_ajax_nonce,
										'ib_sli_name_err' => esc_html__( 'Please enter Slider name', 'Ib-ideabox_slider' ),
										'ib_select_img' => esc_html__( 'Select at least one image', 'Ib-ideabox_slider' ),
									);
		wp_localize_script( $this->ib_plugin_name, 'ib_global_params', $ib_translation_array );

		// For coursal js
		wp_enqueue_script( 'ib_slider_js', plugin_dir_url( __FILE__ ) . 'js/ib-slider_js.js', array( 'jquery' ), $this->ib_version, false  );

		wp_enqueue_script( 'ib_coursal', plugin_dir_url( __FILE__ ) . 'js/ib-coursal.js', array( 'jquery' ), $this->ib_version, false );

		// For all media JS APIs
		wp_enqueue_media();
	}

	/**
	 * Create menu page in admin area.
	 *
	 * @since    1.0.0
	 */
	public function ib_admin_menu_callback()
	{
		// creating plugin main menu // 
		add_menu_page( 
			esc_html__( 'IB Image Slider', 'Ib-ideabox_slider' ),
			esc_html__( 'IB Image Slider', 'Ib-ideabox_slider' ),
			'manage_options',
			'ib_img_sli',
			array( $this, 'ib_admin_panel_html' ),
			IB_URL. 'assets/images/main_admin_menu_icon.png',
			20
		);
	}

	/**
	 * Retrieve html for admin end.
	 *
	 * @since   1.0.0
	 */
	public function ib_admin_panel_html() {

		// retrieve plugin menu page html //
		require IB_DIR. "admin/partials/ib-ideabox_slider-admin-display.php";
	}

	/**
	 * Saving details of slider .
	 *
	 * @since   1.0.0
	 */
	public function ib_add_slider_details_callback() {
		$ib_check_ajax = check_ajax_referer( 'ib-ajax-security-string', 'ib_security_check' );

		if ( $ib_check_ajax )
		{
			$ib_slider_name = isset( $_POST[ 'ib_Slider_name' ] ) ? sanitize_text_field( $_POST[ 'ib_Slider_name' ] ) : "";
			$ib_image_ids = isset( $_POST[ 'ib_id_array' ] ) ? $this->ib_sanitization( $_POST[ 'ib_id_array' ] ) : array();
			$ib_details_arr = get_option( 'ib_slider_details' );

			if( ! empty( $ib_image_ids ) )
			{
				if( empty( $ib_details_arr ) )
				{
					// creating slider first time // 
					$ib_details_arr = array( "ib_name" => $ib_slider_name, "ib_img_ids" => $ib_image_ids );
					$ib_update_details = update_option( 'ib_slider_details', $ib_details_arr );
				}
				else{
					// adding new images when slider already created //
					foreach( $ib_image_ids as $key => $value )
					{
						if( ! in_array( $value, $ib_details_arr[ 'ib_img_ids' ] ) )
						{
							$ib_details_arr[ 'ib_img_ids' ][] = $value;
							update_option( 'ib_slider_details', $ib_details_arr );
						}
						$ib_update_details = true;
					}
				}
			}
			if( $ib_update_details ){
				echo json_encode( array( 'ib_status' => true, 'ib_message' => esc_html__( "Details Updated", 'Ib-ideabox_slider' )) );
			}
			else{
				echo json_encode( array( 'ib_status' => false, 'ib_message' => esc_html__( "Something Went Wrong", 'Ib-ideabox_slider' )) );
			}
		}
		wp_die();
	}

	/**
	 * Delete image from slider callback.
	 *
	 * @since   1.0.0
	 */
	public function ib_delete_img_callback() {
		$ib_check_ajax = check_ajax_referer( 'ib-ajax-security-string', 'ib_security_check' );

		if ( $ib_check_ajax ) 
		{
			$ib_img_id = isset( $_POST[ 'ib_img_id' ] ) ? sanitize_text_field( $_POST[ 'ib_img_id' ] ) : "";
			$ib_img_key = isset( $_POST[ 'ib_img_key' ] ) ? sanitize_text_field( $_POST[ 'ib_img_key' ] ) : "";
			$ib_get_details = get_option( 'ib_slider_details' );

			if( $ib_img_id && ( $ib_img_key > -1 ) )
			{
				if( ! empty( $ib_get_details ) && isset( $ib_get_details[ 'ib_img_ids' ] ) )
				{
					if( in_array( $ib_img_id, $ib_get_details[ 'ib_img_ids' ] ) ) 
					{
						unset( $ib_get_details[ 'ib_img_ids' ][ $ib_img_key ] );
						$ib_update_details = update_option( 'ib_slider_details', $ib_get_details );
					}
				}
			}
			if( $ib_update_details )
			{
				echo json_encode( array( 'ib_status' => true, 'ib_message' => esc_html__( "Details Updated", 'Ib-ideabox_slider' ) ) );
			}
			else{
				echo json_encode( array( 'ib_status' => false, 'ib_message' => esc_html__( "Something Went Wrong", 'Ib-ideabox_slider' ) ) );
			}
		}
		wp_die();
	}

	/**
	 * Reorder image sequence callback .
	 *
	 * @since   1.0.0
	 */
	public function ib_suffel_id_callback() {
		$ib_check_ajax = check_ajax_referer( 'ib-ajax-security-string', 'ib_security_check' );
		
		if ( $ib_check_ajax ) 
		{
			$ib_img_key = isset( $_POST[ 'ib_suffled_ids' ] ) ? $this->ib_sanitization( $_POST[ 'ib_suffled_ids' ] ) : array();

			if( ! empty( $ib_img_key ) )
			{
				$ib_get_details = get_option( 'ib_slider_details' );
				if( ! empty( $ib_get_details[ 'ib_img_ids' ] ) )
				{
					// updating new shuffled array //
					$ib_get_details[ 'ib_img_ids' ] = $ib_img_key;
					$ib_update_details = update_option( 'ib_slider_details', $ib_get_details );
					if( $ib_update_details )
					{
						echo json_encode( array( 'ib_status' => true, 'ib_message' => esc_html__( "Details Updated", 'Ib-ideabox_slider' ) ) );
					}
					else{
						echo json_encode( array( 'ib_status' => false, 'ib_message' => esc_html__( "Something Went Wrong", 'Ib-ideabox_slider' ) ) );
					}
				} 
			}
		}
		wp_die();
	}
	
	/**
	 * sanitize array function.
	 *
	 * @since   1.0.0
	 */
	public function ib_sanitization( $ib_array ){
		$ib_new = array();

		foreach( $ib_array as $key => $value )
		{
			$ib_new[] = sanitize_text_field( $value );
		}

		return $ib_new;

	}

}
