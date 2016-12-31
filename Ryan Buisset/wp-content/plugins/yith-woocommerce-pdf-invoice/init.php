<?php
/*
Plugin Name: YITH WooCommerce PDF Invoice and Shipping List
Plugin URI: http://yithemes.com/themes/plugins/yith-woocommerce-pdf-invoice/
Description: Generate PDF invoices for WooCommerce orders. Set manual or automatic invoice generation and shipping list document. Come with fully customizable document template.
Author: YITHEMES
Text Domain: yith-woocommerce-pdf-invoice
Version: 1.1.12
Author URI: http://yithemes.com/
Domain Path: /languages/

@author YITHEMES
@package YITH WooCommerce PDF Invoice
@version 1.1.12
*/

/*  Copyright 2015  Your Inspiration Themes  (email : plugins@yithemes.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

function yith_ywpi_install_woocommerce_admin_notice() {
	?>
	<div class="error">
		<p><?php _e( 'YITH WooCommerce PDF Invoice and Shipping List is enabled but not effective. It requires WooCommerce in order to work.', 'yith-woocommerce-pdf-invoice' ); ?></p>
	</div>
<?php
}

function yith_ywpi_install_free_admin_notice() {
	?>
	<div class="error">
		<p><?php _e( 'You can\'t activate the free version of YITH WooCommerce PDF Invoice and Shipping List while you are using the premium one.', 'yith-woocommerce-pdf-invoice' ); ?></p>
	</div>
<?php
}

if ( ! function_exists( 'yith_plugin_registration_hook' ) ) {
	require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );

//region    ****    Define constants

if ( ! defined( 'YITH_YWPI_FREE_INIT' ) ) {
	define( 'YITH_YWPI_FREE_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YITH_YWPI_VERSION' ) ) {
	define( 'YITH_YWPI_VERSION', '1.1.12' );
}

if ( ! defined( 'YITH_YWPI_FILE' ) ) {
	define( 'YITH_YWPI_FILE', __FILE__ );
}

if ( ! defined( 'YITH_YWPI_DIR' ) ) {
	define( 'YITH_YWPI_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'YITH_YWPI_URL' ) ) {
	define( 'YITH_YWPI_URL', plugins_url( '/', __FILE__ ) );
}

if ( ! defined( 'YITH_YWPI_ASSETS_URL' ) ) {
	define( 'YITH_YWPI_ASSETS_URL', YITH_YWPI_URL . 'assets' );
}

if ( ! defined( 'YITH_YWPI_TEMPLATE_DIR' ) ) {
	define( 'YITH_YWPI_TEMPLATE_DIR', YITH_YWPI_DIR . 'templates' );
}

if ( ! defined( 'YITH_YWPI_INVOICE_TEMPLATE_URL' ) ) {
	define( 'YITH_YWPI_INVOICE_TEMPLATE_URL', YITH_YWPI_URL . 'templates/invoice/' );
}

if ( ! defined( 'YITH_YWPI_INVOICE_TEMPLATE_DIR' ) ) {
	define( 'YITH_YWPI_INVOICE_TEMPLATE_DIR', YITH_YWPI_DIR . 'templates/invoice/' );
}

if ( ! defined( 'YITH_YWPI_ASSETS_IMAGES_URL' ) ) {
	define( 'YITH_YWPI_ASSETS_IMAGES_URL', YITH_YWPI_ASSETS_URL . '/images/' );
}

if ( ! defined( 'YITH_YWPI_LIB_DIR' ) ) {
	define( 'YITH_YWPI_LIB_DIR', YITH_YWPI_DIR . 'lib/' );
}

if ( ! defined( 'YITH_YWPI_DOMPDF_DIR' ) ) {
	define( 'YITH_YWPI_DOMPDF_DIR', YITH_YWPI_LIB_DIR . 'dompdf/' );
}

$wp_upload_dir = wp_upload_dir();

if ( ! defined( 'YITH_YWPI_DOCUMENT_SAVE_DIR' ) ) {
	define( 'YITH_YWPI_DOCUMENT_SAVE_DIR', $wp_upload_dir['basedir'] . '/ywpi-pdf-invoice/' );
}

if ( ! defined( 'YITH_YWPI_SAVE_INVOICE_URL' ) ) {
	define( 'YITH_YWPI_SAVE_INVOICE_URL', $wp_upload_dir['baseurl'] . '/ywpi-pdf-invoice/' );
}

//endregion

/* Plugin Framework Version Check */
if( ! function_exists( 'yit_maybe_plugin_fw_loader' ) && file_exists( YITH_YWPI_DIR . 'plugin-fw/init.php' ) ) {
	require_once( YITH_YWPI_DIR . 'plugin-fw/init.php' );
}
yit_maybe_plugin_fw_loader( YITH_YWPI_DIR  );

function yith_ywpi_init() {

	/**
	 * Load text domain and start plugin
	 */
	load_plugin_textdomain( 'yith-woocommerce-pdf-invoice', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	require_once( YITH_YWPI_LIB_DIR . 'class.yith-ywpi-plugin-fw-loader.php' );
	require_once( YITH_YWPI_LIB_DIR . 'class.yith-woocommerce-pdf-invoice.php' );
	require_once( YITH_YWPI_LIB_DIR . 'class.yith-document.php' );
	require_once( YITH_YWPI_LIB_DIR . 'class.yith-invoice.php' );
	require_once( YITH_YWPI_LIB_DIR . 'class.yith-shipping.php' );
	require_once( YITH_YWPI_DIR . 'functions.php' );

	YITH_YWPI_Plugin_FW_Loader::get_instance();

	global $YWPI_Instance;
	$YWPI_Instance = new YITH_WooCommerce_Pdf_Invoice();
}

add_action( 'yith_ywpi_init', 'yith_ywpi_init' );


function yith_ywpi_install() {

	if ( ! function_exists( 'WC' ) ) {
		add_action( 'admin_notices', 'yith_ywpi_install_woocommerce_admin_notice' );
	} elseif ( defined( 'YITH_YWPI_PREMIUM' ) ) {
		add_action( 'admin_notices', 'yith_ywpi_install_free_admin_notice' );
		deactivate_plugins( plugin_basename( __FILE__ ) );
	} else {
		do_action( 'yith_ywpi_init' );
	}
}

add_action( 'plugins_loaded', 'yith_ywpi_install', 11 );