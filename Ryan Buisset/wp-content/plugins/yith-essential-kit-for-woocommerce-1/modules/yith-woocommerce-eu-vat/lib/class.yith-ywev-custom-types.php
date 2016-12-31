<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'YITH_YWEV_Custom_Types' ) ) {

	/**
	 * custom types fields
	 *
	 * @class   YITH_YWZM_Custom_Types
	 * @package Yithemes
	 * @since   1.0.0
	 * @author  Your Inspiration Themes
	 */
	class YITH_YWEV_Custom_Types {

		/**
		 * Single instance of the class
		 *
		 * @since 1.0.0
		 */
		protected static $instance;

		/**
		 * Returns single instance of the class
		 *
		 * @since 1.0.0
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct() {

			add_action( 'woocommerce_admin_field_ywev_eu_vat_tax_list',
				array( $this, 'show_eu_vat_tax_list' ) );

			/** Custom types : yith_ywev_eu_vat_tax_report */
			add_action( 'woocommerce_admin_field_ywev_eu_vat_tax_report', array( $this, 'show_eu_vat_tax_report' ) );
		}

		public function show_eu_vat_tax_report( $value ) {
			include( YITH_YWEV_TEMPLATE_DIR . '/admin/eu-vat-tax-report.php' );
		}

		public function show_eu_vat_tax_list( $value ) {

			include( YITH_YWEV_TEMPLATE_DIR . '/admin/eu-vat-tax-list.php' );
		}
	}
}
