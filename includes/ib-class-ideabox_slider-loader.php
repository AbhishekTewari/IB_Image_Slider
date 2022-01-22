<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       
 * @since      1.0.0
 *
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    ib_Ideabox_slider
 * @subpackage ib_Ideabox_slider/includes
 * @author     ideabox <https://ideabox.io>
 */
class Ib_Ideabox_slider_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $ib_actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $ib_actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $ib_filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $ib_filters;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->ib_actions = array();
		$this->ib_filters = array();

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $ib_hook             The name of the WordPress action that is being registered.
	 * @param    object               $ib_component        A reference to the instance of the object on which the action is defined.
	 * @param    string               $ib_callback         The name of the function definition on the $ib_component.
	 * @param    int                  $ib_priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $ib_accepted_args    Optional. The number of arguments that should be passed to the $ib_callback. Default is 1.
	 */
	public function ib_add_action( $ib_hook, $ib_component, $ib_callback, $ib_priority = 10, $ib_accepted_args = 1 ) {
		$this->ib_actions = $this->ib_add( $this->ib_actions, $ib_hook, $ib_component, $ib_callback, $ib_priority, $ib_accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $ib_hook             The name of the WordPress filter that is being registered.
	 * @param    object               $ib_component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $ib_callback         The name of the function definition on the $ib_component.
	 * @param    int                  $ib_priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int                  $ib_accepted_args    Optional. The number of arguments that should be passed to the $ib_callback. Default is 1
	 */
	public function ib_add_filter( $ib_hook, $ib_component, $ib_callback, $ib_priority = 10, $ib_accepted_args = 1 ) {
		$this->ib_filters = $this->ib_add( $this->ib_filters, $ib_hook, $ib_component, $ib_callback, $ib_priority, $ib_accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array                $ib_hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string               $ib_hook             The name of the WordPress filter that is being registered.
	 * @param    object               $ib_component        A reference to the instance of the object on which the filter is defined.
	 * @param    string               $ib_callback         The name of the function definition on the $component.
	 * @param    int                  $ib_priority         The priority at which the function should be fired.
	 * @param    int                  $ib_accepted_args    The number of arguments that should be passed to the $ib_callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function ib_add( $ib_hooks, $ib_hook, $ib_component, $ib_callback, $ib_priority, $ib_accepted_args ) {

		$ib_hooks[] = array(
			'hook'          => $ib_hook,
			'component'     => $ib_component,
			'callback'      => $ib_callback,
			'priority'      => $ib_priority,
			'accepted_args' => $ib_accepted_args
		);

		return $ib_hooks;

	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function ib_run() {

		foreach ( $this->ib_filters as $ib_hook ) {
			add_filter( $ib_hook['hook'], array( $ib_hook['component'], $ib_hook['callback'] ), $ib_hook['priority'], $ib_hook['accepted_args'] );
		}

		foreach ( $this->ib_actions as $ib_hook ) {
			add_action( $ib_hook['hook'], array( $ib_hook['component'], $ib_hook['callback'] ), $ib_hook['priority'], $ib_hook['accepted_args'] );
		}

	}

}
