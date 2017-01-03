<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://rextheme.com
 * @since             1.0.0
 * @package           Rex_Product_Feed
 *
 * @wordpress-plugin
 * Plugin Name:       Best Products Feed for WooCoommerce
 * Plugin URI:        https://rextheme.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            RexTheme
 * Author URI:        https://rextheme.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rex-product-feed
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rex-product-feed-activator.php
 */
function activate_rex_product_feed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rex-product-feed-activator.php';
	Rex_Product_Feed_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rex-product-feed-deactivator.php
 */
function deactivate_rex_product_feed() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rex-product-feed-deactivator.php';
	Rex_Product_Feed_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rex_product_feed' );
register_deactivation_hook( __FILE__, 'deactivate_rex_product_feed' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rex-product-feed.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rex_product_feed() {

	$plugin = new Rex_Product_Feed();
	$plugin->run();

}
run_rex_product_feed();
