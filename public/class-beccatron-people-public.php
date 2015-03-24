<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Beccatron_People
 * @subpackage Beccatron_People/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks to register the 
 * custom post type & to enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Beccatron_People
 * @subpackage Beccatron_People/public
 * @author     Beccatron Studios <rebecca@beccatron.com>
 */
class Beccatron_People_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $beccatron_people       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Beccatron_People_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Beccatron_People_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/beccatron-people-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Beccatron_People_Public_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Beccatron_People_Public_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/beccatron-people-public.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Register the custom post type, "Beccatron People"
	 *
	 * @since    1.0.0
	 */
	
	public function register_post_type() {
		$labels = array(
			'name' => 'People',
			'name_singular' => 'Person',
			'menu_name' => 'People',
			'all_items' => 'People',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Person',
			'edit_item' => 'Edit Person',
			'new_item' => 'New Person',
			'view_item' => 'View Person',
			'search_items' => 'Search People',
			'not_found' => 'No People found',
			'not_found_in_trash' => 'No People found in Trash',
			'parent_item_colon' => ''
		);

		$supports = array( 'title', 'editor', 'thumbnail', 'revisions' );

		$cpt_args = array(
			'labels' => $labels,
			'public' => true,
			'show_ui' => true,
			'show_in_nav_menu' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 20,
			'menu_icon' => '',
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'has_archive' => true,
			'can_export' => true,
			'hierarchical' => false,
			'rewrite' => array(
    						'with_front' => false,
    						'slug'       => 'people'
							),
			'description' => 'Profiles for individual people (team members, staff, etc.) containing bios, photos and some custom meta.',
			'supports' => $supports
		);

		register_post_type( 'beccatron_people', $cpt_args );
		

	}
	
	

}
