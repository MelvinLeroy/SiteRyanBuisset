<?php
/**
 * Main class
 *
 * @author Yithemes
 * @package YITH WooCommerce Waiting List
 * @version 1.0.0
 */


if ( ! defined( 'YITH_WCWTL' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'YITH_WCWTL' ) ) {
	/**
	 * YITH WooCommerce Waiting List
	 *
	 * @since 1.0.0
	 */
	class YITH_WCWTL {

		/**
		 * Single instance of the class
		 *
		 * @var \YITH_WCWTL
		 * @since 1.0.0
		 */
		protected static $instance;

		/**
		 * Plugin version
		 *
		 * @var string
		 * @since 1.0.0
		 */
		public $version = YITH_WCWTL_VERSION;


		/**
		 * Returns single instance of the class
		 *
		 * @return \YITH_WCWTL
		 * @since 1.0.0
		 */
		public static function get_instance(){
			if( is_null( self::$instance ) ){
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$enable = get_option( 'yith-wcwtl-enable' ) == 'yes';

			// Class admin
			if ( $this->is_admin() ) {

			    // required class
                require_once( 'class.yith-wcwtl-admin.php' );
                require_once( 'class.yith-wcwtl-meta.php' );

				// Load Plugin Framework
				add_action( 'after_setup_theme', array( $this, 'plugin_fw_loader' ), 1 );
				
				YITH_WCWTL_Admin();
				// add meta in product edit page
				if( $enable ) {
					YITH_WCWTL_Meta();
				}
			}
			elseif( $enable ) {

			    // required class
                require_once( 'class.yith-wcwtl-frontend.php' );

				// Class frontend
				YITH_WCWTL_Frontend();
			}

			// Email actions
			add_filter( 'woocommerce_email_classes', array( $this, 'add_woocommerce_emails' ) );
			add_action( 'woocommerce_init', array( $this, 'load_wc_mailer' ) );
		}

		/**
		 * Load Plugin Framework
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 * @author Andrea Grillo <andrea.grillo@yithemes.com>
		 */
		public function plugin_fw_loader() {
			if ( ! defined( 'YIT_CORE_PLUGIN' ) ) {
            global $plugin_fw_data;
            if( ! empty( $plugin_fw_data ) ){
                $plugin_fw_file = array_shift( $plugin_fw_data );
                require_once( $plugin_fw_file );
            }
		    }
		}

        /**
         * Check if is admin
         *
         * @since 1.1.0
         * @access public
         * @author Francesco Licandro
         * @return boolean
         */
        public function is_admin(){
            $context_check = isset( $_REQUEST['context'] ) && $_REQUEST['context'] == 'frontend';
            $actions_to_check = apply_filters( 'yith_wcwtl_actions_to_check_admin', array(
                'jckqv'
            ) );
            $action_check  = isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $actions_to_check );

            return is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX && ( $context_check || $action_check ) );
        }

		/**
		 * Filters woocommerce available mails, to add waitlist related ones
		 *
		 * @param $emails array
		 *
		 * @return array
		 * @since 1.0
		 */
		public function add_woocommerce_emails( $emails ) {
			$emails['YITH_WCWTL_Mail_Instock'] = include( 'email/class.yith-wcwtl-mail-instock.php' );
			return $emails;
		}

		/**
		 * Loads WC Mailer when needed
		 *
		 * @return void
		 * @since 1.0
		 * @author Francesco Licandro <francesco.licandro@yithemes.it>
		 */
		public function load_wc_mailer() {
			add_action( 'send_yith_waitlist_mail_instock', array( 'WC_Emails', 'send_transactional_email' ), 10, 2 );
		}
	}
}

/**
 * Unique access to instance of YITH_WCWTL class
 *
 * @return \YITH_WCWTL
 * @since 1.0.0
 */
function YITH_WCWTL(){
	return YITH_WCWTL::get_instance();
}