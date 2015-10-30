<?php
/**
 * @package   Nocaptcha_Done_Right
 * @author    Bryan Haskin <bhhaskin@gmail.com>
 * @license   MIT
 * @link      https://bryans.website
 * @copyright 2015 Bryan Haskin
 * @since 0.1
 *
 * Plugin Name:       NoCAPTCHA Done Right
 * Description:       The best NoCAPTCHA plugin ever.
 * Version:           0.1
 * Author:            Bryan Haskin
 * Author URI:        https://bryans.website
 * Text Domain:       google-nocaptcha-recaptcha-locale
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Domain Path:       /languages
 **/

namespace ndr;

if ( ! defined( 'ABSPATH' ) ) die;

require_once( plugin_dir_path( __FILE__ ) . 'includes/singleton.php' );

if ( !defined( 'NDR_OPTION_NAME' ) ) {
	define( 'NDR_OPTION_NAME', 'ndr_settings' );
}



require_once( plugin_dir_path( __FILE__ ) . 'includes/retrieve-options.php' );
$settings_values = Retrieve_Options::get_instance();
require_once( plugin_dir_path( __FILE__ ) . 'public/nocaptcha.php' );

if ( is_admin() && (!defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/nocaptcha-admin.php' );
	add_action( 'plugins_loaded', array( 'ndr\Nocaptcha_Admin', 'get_instance' ) );
}

$enabled_modules = array();

//include files of all enabled modules.
foreach ( $enabled_modules as $single_module_name => $single_module_slug ) {
	//include files required on admin side
	if ( is_admin() ) {
		if ( file_exists( plugin_dir_path( __FILE__ ) . 'admin/includes/' . $single_module_slug . '/' . $single_module_slug . '-admin.php' ) ) {
			@include_once ( plugin_dir_path( __FILE__ ) . 'admin/includes/' . $single_module_slug . '/' . $single_module_slug . '-admin.php');
		}
	}

	//include files required on admin side as well as on frontend
	if ( file_exists( plugin_dir_path( __FILE__ ) . 'includes/' . $single_module_slug . '/' . $single_module_slug . '.php' ) ) {
		@include_once ( plugin_dir_path( __FILE__ ) . 'includes/' . $single_module_slug . '/' . $single_module_slug . '.php');
	}

	//include files required on frontend
	if ( !is_admin() ) {
		if ( file_exists( plugin_dir_path( __FILE__ ) . 'public/includes/' . $single_module_slug . '/' . $single_module_slug . '-public.php' ) ) {
			@include_once ( plugin_dir_path( __FILE__ ) . 'public/includes/' . $single_module_slug . '/' . $single_module_slug . '-public.php');
		}
	}
}
