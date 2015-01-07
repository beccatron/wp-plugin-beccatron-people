<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://beccatron.com
 * @since      1.0.0
 *
 * @package    Beccatron_People
 * @subpackage Beccatron_People/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Beccatron_People
 * @subpackage Beccatron_People/admin
 * @author     Beccatron Studios <rebecca@beccatron.com>
 */
class Beccatron_People_Admin {

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
	 * @var      string    $plugin_name		The name of this plugin.
	 * @var      string    $version			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Beccatron_People_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Beccatron_People_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/beccatron-people-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Beccatron_People_Admin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Beccatron_People_Admin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/beccatron-people-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Rename the featured image metabox.
	 *
	 * @since    1.0.0
	 */	
	public function change_image_box() {
   		remove_meta_box( 'postimagediv', 'beccatron_people', 'side' );
    	add_meta_box('postimagediv', __('Headshot'), 'post_thumbnail_meta_box', 'beccatron_people', 'side', 'high');
	}
	
	
	
}

/**
 * Adds a custom metabox
 *
 * Description here
 * 
 *
 * @package    Beccatron_People
 * @subpackage Beccatron_People/admin
 * @author     Beccatron Studios <rebecca@beccatron.com>
 */

class Beccatron_People_MetaBox {

	/**
	 * The ID of the metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    	$slug    	The unique identifier of the metabox.
	 */
	public $slug;
	
	/**
	 * The title of the metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    	$title   	The name of the metabox.
	 */
	protected $title;

	/**
	 * The context of the metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    	$context   	The location of the screen where the metabox is displayed.
	 */
	protected $context;
	
	/**
	 * The context of the metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    	$priority   	The weight the metabox is displayed.
	 */
	protected $priority;

	/**
	 * The array containing the meta keys of the metabox
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $meta_fields    The fields of a given metabox.
	 */
	protected $meta_fields;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $slug		The unique identifier for the metabox.
	 * @var      string    $title		The name of the metabox.
	 * @var      string    $context   	The location of the screen where the metabox is displayed.
	 * @var      string    $priority   	The weight the metabox is displayed.	 
	 */
	public function __construct($slug, $title, $context, $priority) {

		$this->slug = $slug;
		$this->title = $title;
		$this->context = $context;
		$this->priority = $priority;
		$this->meta_fields = array();
		
		// this is hardcoded -- seems ugly. Remember to change if copying & pasting.
		$this->post_type = 'beccatron_people';

		// Commented out callback because its automatically generated
		// TO-DO: option to provide manual callback?
		// $this->callback = $settings->callback; coment

	}
				
	/**
	 * Add the meta box to wordpress.
	 *
	 * add_meta_box( $id, $title, $callback, $post_type, $context,
     *   $priority, $callback_args );
	 * 
	 * @since    1.0.0
	 */
	
	public function add_meta_box(){
	
		add_meta_box(
			$this->slug, 						// unique identifier for the metabox
			$this->title, 						// Title
			array ($this, 'render_meta_box'), 	// Callback
			$this->post_type,					// Post Type
			$this->context,						// Context (screen location)
			$this->priority  					// Priority
		);
	}
	
	
	/**
	 * Add a new key to the metabox.
	 *
	 * @since    1.0.0
	 * @var      string               $key            	A key for the meta field
	 * @var      string               $label        	How the field will be labeled in the front-end.
	 * @var      string               $desc	         	A description of the meta field.
	 * @var      string			      $type		        The type of field (text area, drop down, etc.)
	 */
	public function add_meta_field( $key, $label, $desc, $type ) {
		$prefix = 'b_ppl';
		
		$this->meta_fields[$key] = array(
			'id'=>$prefix.'_'.$key, // affix a prefix to the ID to keep it unique (multiple metaboxes might have the same "key")
			'label'=>$label, 
			'desc'=>$desc, 
			'type'=>$type
			);
	}
	 
	 
	 /**
	 * Render the meta box.
	 * 
	 * via http://code.tutsplus.com/articles/reusable-custom-meta-boxes-part-1-intro-and-basic-fields--wp-23259
	 * @since    1.0.0
	 */
	 
	 public function render_meta_box(){
	 	
	 	// require_once plugin_dir_path( __FILE__ ) . 'partials/beccatron-people-meta-display.php';
	 	
	 	// class for admin styling
	 	echo '<div class="beccatron_people_meta">';
				
		// Use nonce for verification
		echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
     
   		// Begin the field table and loop
    	foreach ( $this->meta_fields as $field ) {
			
			
			// get value of this field if it exists for this post
			$meta = get_post_meta(get_the_ID(), $field['id'], true);
			
			// print the label
			echo '<p>
					<label for="'.$field['id'].'">'.$field['label'].'</label>';
					switch($field['type']) {

						// text
						case 'text':
							echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'. esc_attr($meta) .'" />
								<br /><span class="description">'.$field['desc'].'</span>';
						break;
						
						// textarea
						case 'textarea':
							echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" >'. esc_attr($meta) .'</textarea>
								<br /><span class="description">'.$field['desc'].'</span>';
						break;
						
						// email
						case 'email':
							echo '<input type="email" name="'.$field['id'].'" id="'.$field['id'].'" value="'. esc_attr($meta) .'" />
								<br /><span class="description">'.$field['desc'].'</span>';
						break;
						
						// url
						case 'url':
							echo '<input type="url" name="'.$field['id'].'" id="'.$field['id'].'" value="'. esc_attr($meta) .'" placeholder="http://" />
								<br /><span class="description">'.$field['desc'].'</span>';
						break;
						
						// twitter
						case 'twitter': 
							echo '<br /><span class="input-prefix">@</span> <input class="has-prefix" type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'. esc_attr($meta) .'" />
								<br /><span class="description">'.$field['desc'].'</span>';
						break;
					
					
					} //end switch
			echo '</p>';
    	} // end foreach
	 
	 	echo '</div>';	
	 }
	 
	/**
	 * Save the custom meta
	 * 
	 * @since    1.0.0
	 */
	 
	public function meta_save( ) {
 
 		$person_id = get_the_ID();
 		
   		// Checks save status
    	$is_autosave = wp_is_post_autosave( $person_id );
    	$is_revision = wp_is_post_revision( $person_id );
    	$is_valid_nonce = ( isset( $_POST[ 'person_nonce' ] ) && wp_verify_nonce( $_POST[ 'person_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    	// Exits script depending on save status
    	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        	return;
    	}
		
		// loop through fields and save the data
    	foreach ($this->meta_fields as $field) {
    		
    		$key = $field['id'];
    		$value = null;
    		
    		// If the field has a new value
    		if ( !empty ($_POST[ $field['id']])) {
    		
				// Sanitize Values
				// TODO Replace switch statements w/ OO-functions for child classes!
				switch($field['type']) {
				
					// email
					case 'email':
						// sanitize
						$value = sanitize_email( $_POST[ $field['id']] );
						is_email($value);
					break;
				
					// url
					case 'url':
						// sanitize
						$value = esc_url_raw( $_POST[ $field['id']] );
					break;
				
					default:
						// sanitize
						$value = sanitize_text_field( $_POST[ $field['id']] );
					break;
				 
				
				} //end switch 	
				
				if( !empty ($value)) {
					update_post_meta( $person_id, $key, $value );
				}
			}	// end if			
			
    
    	} // end foreach
	
	}
	
}

	
