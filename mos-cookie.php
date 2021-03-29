<?php
/*
Plugin Name: Mos Cookie
Description: Base of future plugin
Version: 0.0.1
Author: Md. Mostak Shahid
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define MOS_COOKIE_FILE.
if ( ! defined( 'MOS_COOKIE_FILE' ) ) {
	define( 'MOS_COOKIE_FILE', __FILE__ );
}
// Define MOS_COOKIE_SETTINGS.
if ( ! defined( 'MOS_COOKIE_SETTINGS' ) ) {
	define( 'MOS_COOKIE_SETTINGS', admin_url('/options-general.php?page=mos_cookie_settings') );
}

require_once(plugin_dir_path( MOS_COOKIE_FILE ) . 'update/plugin-update-checker.php');
$themeInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/mos-cookie.json',
	__FILE__,
	'mos-cookie'
);

$mos_cookie_options = get_option( 'mos_cookie_options' );
$plugin = plugin_basename(MOS_COOKIE_FILE); 
require_once ( plugin_dir_path( MOS_COOKIE_FILE ) . 'mos-cookie-functions.php' );
require_once ( plugin_dir_path( MOS_COOKIE_FILE ) . 'mos-cookie-settings.php' );
require_once ( plugin_dir_path( MOS_COOKIE_FILE ) . 'mos-cookie-hooks.php' );

/*require_once('plugins/update/plugin-update-checker.php');
$pluginInit = Puc_v4_Factory::buildUpdateChecker(
	'https://raw.githubusercontent.com/mostak-shahid/update/master/mos-cookie.json',
	MOS_COOKIE_FILE,
	'mos-cookie'
);*/


register_activation_hook(MOS_COOKIE_FILE, 'mos_cookie_activate');
add_action('admin_init', 'mos_cookie_redirect');
 
function mos_cookie_activate() {
    $mos_cookie_option = array();
    // $mos_cookie_option['mos_login_type'] = 'basic';
    // update_option( 'mos_cookie_option', $mos_cookie_option, false );
    add_option('mos_cookie_do_activation_redirect', true);
}
 
function mos_cookie_redirect() {
    if (get_option('mos_cookie_do_activation_redirect', false)) {
        delete_option('mos_cookie_do_activation_redirect');
        if(!isset($_GET['activate-multi'])){
            wp_safe_redirect(MOS_COOKIE_SETTINGS);
        }
    }
}

// Add settings link on plugin page
function mos_cookie_settings_link($links) { 
  $settings_link = '<a href="'.MOS_COOKIE_SETTINGS.'">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
} 
add_filter("plugin_action_links_$plugin", 'mos_cookie_settings_link' );



