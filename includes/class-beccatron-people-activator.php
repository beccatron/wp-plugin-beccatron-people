<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Beccatron_People
 * @subpackage Beccatron_People/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Beccatron_People
 * @subpackage Beccatron_People/includes
 * @author     Beccatron Studios <rebecca@beccatron.com>
 */
class Beccatron_People_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
	
		/* Flush rewrite rules */
		flush_rewrite_rules();

	}

}
