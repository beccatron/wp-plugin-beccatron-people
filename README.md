# Beccatron People #
- Contributors: beccatron
- Donate link: http://beccatron.com
- Tags: custom post type, profiles, people
- Requires at least: 3.0.1
- Tested up to: 3.4
- Stable tag: 4.3
- License: GPLv2 or later
- License URI: http://www.gnu.org/licenses/gpl-2.0.html

A wordpress plugin that creates a custom post type "Beccatron People" for displaying profiles of people.

## Description ##

Creates a custom post type "Beccatron People" for displaying profiles of people (separate from user accounts).

A 'Beccatron Person' includes the following meta-data, which you can incorporate these into your theme using the slug in parentheses and `get_post_meta()`:

### Vital Stats ###

* Email `b_ppl_email`
* Website `b_ppl_website`
* Twitter `b_ppl_twitter`
* Facebook `b_ppl_facebook`
* Institutional Affiliations & Roles (up to 3) `b_ppl_inst1`, `b_ppl_inst2`, `b_ppl_inst3`, `b_ppl_role1`, `b_ppl_role2`, `b_ppl_role3`

### Short Bio ###
Place to enter a short bio for displaying on archive pages & in shortcodes ``b_ppl_shortbio``

### Headshot ###
The featured image box is relabeled as "headshot." ``the_post_thumbnail()``


## Installation ##

This section describes how to install the plugin and get it working.


1. Upload `beccatron-people.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Frequently Asked Questions ##

### How can I add a new metabox? ###

1. Create a new plugin, and extend the class ``Beccatron_People``
2. Create a new instance of ``Beccatron_People_Metabox``
3. Add some fields to your new metabox with the method ``add_meta_field``
4. Use the ``loader`` hook the ``add_meta_box`` and ``meta_save`` actions into WordPress
5. Create an instance of your plugin class and run

` 	class NEW_People extends Beccatron_People{
	
		protected $plugin_name;
		protected $version;

	
		public function __construct() {

			$this->plugin_name = 'NEW-people';
			$this->version = '1.0.0';
			$this->load_dependencies();
			$this->define_hooks();

		}
	
		private function load_dependencies() {
			$this->loader = new Beccatron_People_Loader();

		}
	
		private function define_hooks() {
	
			$NEW_metabox = new Beccatron_People_Metabox( 'slug', 'Title', 'side', 'core'); 		
		
			/* Add a field to your metabox */
			$metabox_NEWFIELD->add_meta_field( 'id', 'title', 'description', 'textarea');	
		
			/* Add the metabox */
			$this->loader->add_action( 'add_meta_boxes', $NEW_metabox, 'add_meta_box' );
		
		
			/* Save Meta Boxes */
			$this->loader->add_action ('save_post', $metabox_council, 'meta_save' );
		}
	}	


	function run_NEW_people() {

		$plugin = new NEW_People();
		$plugin->run();

	}
	run_NEW_people(); `


## Screenshots ##

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

## Changelog ##

= 1.0 =
* Initial Commit. Still needs work!

## Credits ##

Based on the [WordPress Plugin Boilerplate](https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate "WordPress Plugin Boilerplate on github") by Tom Mcfarlin 

