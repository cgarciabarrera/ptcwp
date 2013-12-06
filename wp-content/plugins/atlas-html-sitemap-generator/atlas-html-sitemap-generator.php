<?php
/**
 * Plugin Name: HTML Sitemap Generator
 * Plugin URI: http://cranesandskyhooks.com/wordpress-plugins/html-sitemap-generator/
 * Description: Add a customizable HTML sitemap to any page on your site.
 * Version: 1.5
 * Author: Donal MacArthur
 * Author URI: http://donalmacarthur.com/
 * Licence: GPL2
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License,
 * version 2, as published by the Free Software Foundation.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @package HTML_Sitemap_Generator
 * @version 1.5
 * @author Donal MacArthur
 * @copyright Copyright (c) 2011, Donal MacArthur
 * @link http://www.cranesandskyhooks.com/wordpress-plugins/html-sitemap-generator/
 */

/* If the file has been loaded directly, halt execution. */
if ( !function_exists( 'add_action' ) )
	die( "This page should not be loaded directly." );

/* Register the plugin's activation/deactivation routines. */
register_activation_hook( __FILE__, 'activate_dmac_html_sitemap' );
register_deactivation_hook( __FILE__, 'deactivate_dmac_html_sitemap' );

/* Delete the cached version of the sitemap whenever a post is saved. */
add_action( 'save_post', 'dmac_delete_html_sitemap_cache' );
	
/* Delete the cached version when the sitemap settings are updated. */
add_action( 'dmac_html_sitemap_updated', 'dmac_delete_html_sitemap_cache' );

/* Initialize the plugin. */
add_action( 'init', 'initialize_dmac_html_sitemap' );

/**
 * Initialization function. Runs on the 'init' action hook.
 *
 * @since 1.0
 */
function initialize_dmac_html_sitemap() {

	/* Load the functions file. */
	include_once( 'functions/sitemap-functions.php' );
	
	/* Load the DMAC_Plugin_Tools() class, if required. */
	if ( !class_exists( 'DMAC_Plugin_Tools_1_0_00' ) )
		include_once( 'classes/dmac-plugin-tools.php' );
	
	/* Register the [sitemap] shortcode. */
	add_shortcode( 'sitemap', 'dmac_html_sitemap' );

	/* If we're on an admin page, load the back-end classes. */
	if ( is_admin() ) {
	
		/* Set plugin constants. */
		define( 'DMAC_HTML_SITEMAP_URL', plugin_dir_url(__FILE__) );
		define( 'DMAC_HTML_SITEMAP_PATH', plugin_dir_path(__FILE__) );
		define( 'DMAC_HTML_SITEMAP_BASENAME', plugin_basename( __FILE__ ) );
		
		/* Load the DMAC_Admin_Tools() class. */
		if ( !class_exists( 'DMAC_Admin_Tools_1_0_00' ) )
			include_once( 'classes/dmac-admin-tools.php' );

		/* Load the DMAC_HTML_Sitemap_Backend() class. */
		include_once( 'classes/html-sitemap-backend.php' );
		
		/* Instantiating the DMAC_HTML_Sitemap_Backend() class initializes the plugin's back-end functionality. */
		$instance = new DMAC_HTML_Sitemap_Backend();
	}
}

/**
 * Activation routine.
 * 
 * Sets the appropriate autoload value for the plugin's database option.
 *
 * @since 1.0
 */
function activate_dmac_html_sitemap() {
	add_option( 'dmac_html_sitemap', '', '', 'no' );
}

/**
 * Deactivation routine.
 * 
 * Delete the plugin's option from the database along with the cached version of the sitemap. 
 *
 * @since 1.0
 */
function deactivate_dmac_html_sitemap() {
	delete_option( 'dmac_html_sitemap' );
	dmac_delete_html_sitemap_cache();
}