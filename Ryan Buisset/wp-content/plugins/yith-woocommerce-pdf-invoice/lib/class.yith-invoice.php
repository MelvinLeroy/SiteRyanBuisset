<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'YITH_Invoice' ) ) {

	/**
	 * Implements features related to a PDF document
	 *
	 * @class   YITH_Invoice
	 * @package Yithemes
	 * @since   1.0.0
	 * @author  Your Inspiration Themes
	 */
	class YITH_Invoice extends YITH_Document {

		public $document_type = 'invoice';

		public $date;

		private $number;

		private $prefix;

		private $suffix;

		public $save_path;

		/**
		 * Constructor
		 *
		 * Initialize plugin and registers actions and filters to be used
		 *
		 * @since  1.0
		 * @author Lorenzo Giuffrida
		 * @access public
		 * @return void
		 */
		public function __construct( $order_id ) {

			/**
			 * Call base class constructor
			 */
			parent::__construct( $order_id );

			/**
			 * if this document is not related to a valid WooCommerce order, exit
			 */
			if ( ! $this->is_valid ) {
				return;
			}

			/**
			 *  Fill invoice information from a previous invoice is exists or from general plugin options plus order related data
			 * */
			$this->init_document();
		}

		/*
		 * Check if an invoice exist for current order and load related data
		 */
		private function init_document() {

			$this->exists = get_post_meta( $this->order->id, '_ywpi_invoiced', true );

			if ( $this->exists ) {
				$this->number    = get_post_meta( $this->order->id, '_ywpi_invoice_number', true );
				$this->prefix    = get_post_meta( $this->order->id, '_ywpi_invoice_prefix', true );
				$this->suffix    = get_post_meta( $this->order->id, '_ywpi_invoice_suffix', true );
				$this->date      = get_post_meta( $this->order->id, '_ywpi_invoice_date', true );
				$this->save_path = get_post_meta( $this->order->id, '_ywpi_invoice_path', true );
			} else {
				$this->prefix = get_option( 'ywpi_invoice_prefix' );
				$this->suffix = get_option( 'ywpi_invoice_suffix' );
			}
		}

		public function get_formatted_invoice_number() {
			$formatted_invoice_number = get_option( 'ywpi_invoice_number_format' );

			$formatted_invoice_number = str_replace(
				array( '[prefix]', '[suffix]', '[number]' ),
				array( $this->prefix, $this->suffix, $this->number ),
				$formatted_invoice_number );


			return apply_filters( 'yith_ywpi_get_formatted_invoice_number', $formatted_invoice_number, $this->order );
		}

		public function get_formatted_date() {
			$format = get_option( 'ywpi_invoice_date_format' );

			return date( $format, $this->date );
		}

		/**
		 *
		 */
		public function reset() {

			delete_post_meta( $this->order->id, '_ywpi_invoiced' );

			delete_post_meta( $this->order->id, '_ywpi_invoice_number' );
			delete_post_meta( $this->order->id, '_ywpi_invoice_prefix' );
			delete_post_meta( $this->order->id, '_ywpi_invoice_suffix' );
			delete_post_meta( $this->order->id, '_ywpi_invoice_path' );
			delete_post_meta( $this->order->id, '_ywpi_invoice_date' );
		}

		/*
		 * Return the next available invoice number
		 */
		private function get_new_invoice_number() {
			//  Check if this is the first invoice of the year, in this case, if reset on new year is enabled, restart from 1

			if ( 'yes' === get_option( 'ywpi_invoice_reset' ) ) {
				$last_year = get_option( 'ywpi_invoice_year_billing' );

				if ( isset( $last_year ) && is_numeric( $last_year ) ) {
					$current_year = getdate();
					$current_year = $current_year['year'];
					if ( $last_year < $current_year ) {
						//  set new year as last invoiced year and reset invoice number
						update_option( 'ywpi_invoice_year_billing', $current_year );
						update_option( 'ywpi_invoice_number', 1 );
					}
				}
			}

			$current_invoice_number = get_option( 'ywpi_invoice_number' );
			if ( ! isset( $current_invoice_number ) || ! is_numeric( $current_invoice_number ) ) {
				$current_invoice_number = 1;
			}

			return $current_invoice_number;
		}

		/**
		 * Set invoice data for current order, picking the invoice number from the related general option
		 */
		public function save() {
			//  Avoid generating a new invoice from a previous one
			if ( $this->exists ) {
				return;
			}

			$this->date = time();
			$date       = getdate( $this->date );
			$year       = $date['year'];

			$invoice_number = apply_filters( 'yith_ywpi_new_invoice_number', null, $this->order );

			$this->number = $invoice_number ? $invoice_number : $this->get_new_invoice_number();

			$this->prefix    = get_option( 'ywpi_invoice_prefix' );
			$this->suffix    = get_option( 'ywpi_invoice_suffix' );
			$this->save_path = $year . "/invoice_" . $this->number . ".pdf";
			$this->exists    = true;

			update_post_meta( $this->order->id, '_ywpi_invoiced', $this->exists );
			update_post_meta( $this->order->id, '_ywpi_invoice_number', $this->number );
			update_post_meta( $this->order->id, '_ywpi_invoice_prefix', $this->prefix );
			update_post_meta( $this->order->id, '_ywpi_invoice_suffix', $this->suffix );
			update_post_meta( $this->order->id, '_ywpi_invoice_date', $this->date );
			update_post_meta( $this->order->id, '_ywpi_invoice_path', $this->save_path );

			$pdf_path = YITH_YWPI_DOCUMENT_SAVE_DIR . $this->save_path;
			add_action( 'ywpi_before_template_generation', array( $this, 'init_template_generation_actions' ) );
			$this->save_file( $pdf_path );

			if ( ! $invoice_number ) {
				//  Auto increment the invoice number for next invoice
				update_option( 'ywpi_invoice_number', $this->number + 1 );
			}
		}

		/**
		 * Reset actions and add new ones related to current document being generated
		 */
		public function init_template_generation_actions() {
			add_action( 'yith_ywpi_invoice_template_sender', array( $this, 'show_invoice_template_sender' ) );
			add_action( 'yith_ywpi_invoice_template_company_logo', array(
				$this,
				'show_invoice_template_company_logo',
			) );
			add_action( 'yith_ywpi_invoice_template_customer_data', array(
				$this,
				'show_invoice_template_customer_data',
			) );
			add_action( 'yith_ywpi_invoice_template_invoice_data', array(
				$this,
				'show_invoice_template_invoice_data',
			) );
			add_action( 'yith_ywpi_invoice_template_products_list', array(
				$this,
				'show_invoice_template_products_list',
			) );
			add_action( 'yith_ywpi_invoice_template_footer', array( $this, 'show_invoice_template_footer' ) );
		}

		/**
		 * Render and show data to "sender section" on invoice template
		 */
		public function show_invoice_template_sender() {
			$company_name    = 'yes' === get_option( 'ywpi_show_company_name' ) ? get_option( 'ywpi_company_name' ) : null;
			$company_details = 'yes' === get_option( 'ywpi_show_company_details' ) ? nl2br( get_option( 'ywpi_company_details' ) ) : null;

			if ( ! isset( $company_name ) && ! isset( $show_logo ) ) {
				return;
			}

			echo '<span class="invoice-from-to">' . __( "Invoice From:", 'yith-woocommerce-pdf-invoice' ) . ' </span>';
			if ( isset( $company_name ) ) {
				echo '<span class="company-name">' . $company_name . '</span>';
			}
			if ( isset ( $company_details ) ) {
				echo '<span class="company-details" > ' . $company_details . '</span > ';
			}
		}

		/**
		 * Show company logo on invoice template
		 */
		public function show_invoice_template_company_logo() {
			$company_logo = 'yes' === get_option( 'ywpi_show_company_logo' ) ? get_option( 'ywpi_company_logo' ) : null;

			if ( ! isset( $company_logo ) ) {
				return;
			}

			if ( isset( $company_logo ) ) {
				echo '<div class="company-logo">
					<img src="' . $company_logo . '">
				</div>';
			}
		}

		/**
		 * Show data of customer on invoice template
		 */
		public function show_invoice_template_customer_data() {
			global $ywpi_document;

			echo '<div class="invoice-to-section" > ';
			// Display values
			if ( $ywpi_document->order->get_formatted_billing_address() ) {
				echo '<span class="invoice-from-to" > ' . __( "Invoice To:", 'yith-woocommerce-pdf-invoice' ) . '</span > ' . wp_kses( $ywpi_document->order->get_formatted_billing_address(), array( "br" => array() ) );
			}

			echo '</div > ';
		}

		/**
		 * Show data of customer on invoice template
		 */
		public function show_invoice_template_invoice_data() {
			global $ywpi_document;


			if ( ! isset( $ywpi_document ) || ! $ywpi_document->exists ) {
				return;
			}
			?>
			<table>
				<tr class="invoice-number">
					<td><?php _e( "Invoice", 'yith-woocommerce-pdf-invoice' ); ?></td>
					<td class="right"><?php echo $ywpi_document->get_formatted_invoice_number(); ?></td>
				</tr>

				<tr class="invoice-order-number">
					<td><?php _e( "Order", 'yith-woocommerce-pdf-invoice' ); ?></td>
					<td class="right"><?php echo $ywpi_document->order->get_order_number(); ?></td>
				</tr>

				<tr class="invoice-date">
					<td><?php _e( "Invoice date", 'yith-woocommerce-pdf-invoice' ); ?></td>
					<td class="right"><?php echo $ywpi_document->get_formatted_date(); ?></td>
				</tr>
				<tr class="invoice-amount">
					<td><?php _e( "Order Amount", 'yith-woocommerce-pdf-invoice' ); ?></td>
					<td class="right"><?php echo wc_price( $ywpi_document->order->get_total() ); ?></td>
				</tr>
			</table>
			<?php
		}

		/**
		 * Show product list for current order on invoice template
		 */
		public function show_invoice_template_products_list() {
			include( YITH_YWPI_INVOICE_TEMPLATE_DIR . 'invoice-details.php' );
		}

		/**
		 * Show footer information on invoice template
		 */
		public function show_invoice_template_footer() {
			include( YITH_YWPI_INVOICE_TEMPLATE_DIR . 'invoice-footer.php' );
		}
	}
}