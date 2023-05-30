<?php
/*
Plugin Name: AATI Location Profile Information
Plugin URI: https://github.com/jseutens/location-profile-information
Description: A custom plugin for displaying location profile information for businesses with support for multiple locations
Version: 1.0
Author: Johan Seutens
Author URI: https://www.aati.be
Text Domain: aatilpi
Domain Path: /languages/
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
// Check if the ABSPATH constant is defined
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
// Define constants used throughout the plugin
define( 'AATILPI_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'AATILPI_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'AATILPI_PLUGIN_FNAME', plugin_basename( __FILE__ ) );
define( 'AATILPI_PLUGIN_DIRNAME', plugin_basename( dirname( __FILE__ ) ) );
define( 'AATILPI_VERSION', '1.0.0' );
define( 'AATILPI_TEXTDOMAIN', 'aatilpi');
// load languages
	function aatilpi_load_textdomain() {
		load_plugin_textdomain(AATILPI_TEXTDOMAIN,false, AATILPI_PLUGIN_DIRNAME. '/languages');
	}
	add_action( 'plugins_loaded', 'aatilpi_load_textdomain');
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
// check if a plugin is uploaded
function aatilpi_plugin_is_installed($plugin_folder_name) {
    $installed_plugins = get_plugins();
    foreach ($installed_plugins as $installed_plugin_file => $installed_plugin_data) {
        if (strpos($installed_plugin_file, $plugin_folder_name . '/') === 0) {
            return true;
        }
    }
    return false;
}
// check if a plugin is installed and active
function aatilpi_active_plugins_contains( $name ) {
    $active_plugins = get_option( 'active_plugins' );
    foreach ( $active_plugins as $plugin_file ) {
        // Check if the plugin directory matches the directory you're looking for
        if ( $plugin_file === $name ) {
          return true;
       }
    }
    return false;
}
// warning if Business Profile plugin is active
function aatilpi_show_warning_message() {
    ?>
    <div class="notice notice-warning">
        <p><?php _e('The Location Profile Information plugin is not compatible with the Business Profile plugin. Please deactivate the Business Profile plugin to use the Location Profile Information plugin.', AATILPI_TEXTDOMAIN); ?></p>
    </div>
    <?php
}
// Check if the Business Profile plugin is active
$business_profile_plugin = 'business-profile/business-profile.php';
if (aatilpi_active_plugins_contains($business_profile_plugin)) {
    add_action('admin_notices', 'aatilpi_show_warning_message');
    return; // Stop loading the rest of your plugin's code
}
// Activation hook
register_activation_hook( __FILE__, 'aatilpi_activate' );
function aatilpi_activate() {
  // Activation code here
}

// Deactivation hook
register_deactivation_hook( __FILE__, 'aatilpi_deactivate' );
function aatilpi_deactivate() {
  // Deactivation code here
}
// include admin css
wp_enqueue_style('aatilpi_custom_wp_admin_css', plugins_url('assets/css/admin-styles.css', __FILE__));
// Include aatipli-functions.php
require_once(AATILPI_PLUGIN_DIR . '/includes/shared/aatipli-functions.php');
// Include aatipli-shortcode.php
require_once(AATILPI_PLUGIN_DIR . '/includes/shared/aatipli-shortcode.php');
// Load plugin settings pages
require_once( AATILPI_PLUGIN_DIR . '/includes/shared/aatipli-settings-fields.php' );
require_once( AATILPI_PLUGIN_DIR . '/includes/shared/aatilpi-settings-permalink.php' );
require_once( AATILPI_PLUGIN_DIR . '/includes/shared/aatilpi-settings-extrafields.php' );
require_once( AATILPI_PLUGIN_DIR . '/includes/admin/aatilpi-menu.php');
function aatilpi_support_page() {
    require_once(AATILPI_PLUGIN_DIR . '/includes/aatilpi-support.php');
}
// Include aatipli-functions.php
require_once(AATILPI_PLUGIN_DIR . '/includes/shared/aatipli-functions.php');
// Render support page
register_uninstall_hook( __FILE__, 'aatilpi_uninstall' );
function aatilpi_uninstall() {
    require_once plugin_dir_path( __FILE__ ) . 'uninstall.php';
}