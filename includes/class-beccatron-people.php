<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Beccatron_People
 * @subpackage Beccatron_People/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Beccatron_People
 * @subpackage Beccatron_People/includes
 * @author     Beccatron Studios <rebecca@beccatron.com>
 */
class Beccatron_People {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Beccatron_People_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'beccatron-people';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Beccatron_People_Loader. Orchestrates the hooks of the plugin.
	 * - Beccatron_People_i18n. Defines internationalization functionality.
	 * - Beccatron_People_Admin. Defines all hooks for the dashboard.
	 * - Beccatron_People_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-beccatron-people-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-beccatron-people-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the Dashboard.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-beccatron-people-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-beccatron-people-public.php';

		$this->loader = new Beccatron_People_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Beccatron_People_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Beccatron_People_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Beccatron_People_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		/* Rename Featured Image Metabox */
		$this->loader->add_action('do_meta_boxes', $plugin_admin, 'change_image_box');

		
		/* Initialize the two metaboxes 
		 *
		 * new Beccatron_People_Metabox( $slug, $title, $context, $priority)
		 *
		 */

		$metabox_fullname = new Beccatron_People_Metabox( 'fullname', 'Full Name', 'side', 'core'); 							// Full Name Meta Box
		$metabox_contact = new Beccatron_People_Metabox( 'contact', 'Contact Information', 'side', 'core'); 					// Contact Meta Box
		$metabox_affiliations = new Beccatron_People_Metabox( 'affiliations', 'Institutional Affiliations', 'side', 'core');	// Institutions Meta Box
		$metabox_shortbio = new Beccatron_People_Metabox( 'shortbio', 'Short Biography', 'normal', 'core'); 		// Short Biography Meta Box
		
		/**
		 * Add the new fields to the metaboxes.
		 *
		 * add_meta_field( $key, $label, $desc, $type )
		 *
		 * @var      string               $key            	A key for the meta field
		 * @var      string               $label        	How the field will be labeled in the front-end.
		 * @var      string               $desc	         	A description of the meta field.
		 * @var      string			      $type		        The type of field (text area, drop down, etc.)
		 */
		
		/* Fullname Fields */
		$metabox_fullname->add_meta_field( 'prefix', 'Prefix', 'eg. Dr/Mrs/Mr.', 'text'); 	// Honorific Prefix
		$metabox_fullname->add_meta_field( 'first', 'First Name', '', 'text'); 				// First Name
		$metabox_fullname->add_meta_field( 'middle', 'Middle Name', '', 'text');			// Middle Name
		$metabox_fullname->add_meta_field( 'last', 'Last Name', '', 'text');				// Last Name
		$metabox_fullname->add_meta_field( 'suffix', 'Suffix', 'eg. M.D. /PhD/MSCSW', 'text');	// Suffix
		
		/* Contact Fields*/
		$metabox_contact->add_meta_field( 'email', 'Email', '', 'email');			// Email
		$metabox_contact->add_meta_field( 'website', 'Website', 'Full URL', 'url');	// Website
		$metabox_contact->add_meta_field( 'phone', 'Phone', '', 'text');			// Phone
		$metabox_contact->add_meta_field( 'fax', 'Fax', '', 'text');				// Fax
		$metabox_contact->add_meta_field( 'twitter', 'Twitter', '', 'twitter');	// Twitter
		$metabox_contact->add_meta_field( 'facebook', 'Facebook', 'Full URL', 'url');	// Facebook
		
		/* Affiliations Fields*/
		$metabox_affiliations->add_meta_field( 'inst1', 'Institutional Affiliation (Primary)', 'Business/Organization/University', 'text');	// Primary Institutional Affiliation
		$metabox_affiliations->add_meta_field( 'role1', 'Position (Primary)', 'Position/Role/Title', 'text');				// Primary Position
		$metabox_affiliations->add_meta_field( 'inst2', 'Institutional Affiliation (Secondary)', 'Business/Organization/University', 'text');	// Secondary Institutional Affiliation
		$metabox_affiliations->add_meta_field( 'role2', 'Position (Secondary)', 'Position/Role/Title', 'text');			// Secondary Position
		$metabox_affiliations->add_meta_field( 'inst3', 'Institutional Affiliation (Tertiary)', 'Business/Organization/University', 'text');	// Tertiary Institutional Affiliation
		$metabox_affiliations->add_meta_field( 'role3', 'Position (Tertiary)', 'Position/Role/Title', 'text');				// Tertiary Position

		/* Short Bio Field */
		$metabox_shortbio->add_meta_field( 'shortbio', 'Short Bio', '1-2 Line Biography', 'textarea');	// Short Bio
		
		/* Add Meta Boxes */
		$this->loader->add_action( 'add_meta_boxes', $metabox_fullname, 'add_meta_box' );
		$this->loader->add_action( 'add_meta_boxes', $metabox_contact, 'add_meta_box' );
		$this->loader->add_action( 'add_meta_boxes', $metabox_affiliations, 'add_meta_box' );
		$this->loader->add_action( 'add_meta_boxes', $metabox_shortbio, 'add_meta_box' );

		
		/* Save Meta Boxes */
		$this->loader->add_action ('save_post', $metabox_fullname, 'meta_save' );
		$this->loader->add_action ('save_post', $metabox_contact, 'meta_save' );
		$this->loader->add_action ('save_post', $metabox_affiliations, 'meta_save' );
		$this->loader->add_action ('save_post', $metabox_shortbio, 'meta_save' );
		
		

	}


	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Beccatron_People_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		/* Register Custom Post Type */
		$this->loader->add_action ('init', $plugin_public, 'register_post_type' );


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Beccatron_People_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
