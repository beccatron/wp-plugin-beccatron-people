<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Beccatron_People
 *
 * @wordpress-plugin
 * Plugin Name:       Beccatron People
 * Plugin URI:        https://github.com/beccatron/wp-plugin-beccatron-people
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress dashboard.
 * Version:           1.0.0
 * Author:            Beccatron Studios
 * Author URI:        http://beccatron.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       beccatron-people
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-beccatron-people-activator.php
 */
function activate_beccatron_people() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-beccatron-people-activator.php';
	Beccatron_People_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-beccatron-people-deactivator.php
 */
function deactivate_beccatron_people() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-beccatron-people-deactivator.php';
	Beccatron_People_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_beccatron_people' );
register_deactivation_hook( __FILE__, 'deactivate_beccatron_people' );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-beccatron-people.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_beccatron_people() {

	$plugin = new Beccatron_People();
	$plugin->run();

}
run_beccatron_people();
