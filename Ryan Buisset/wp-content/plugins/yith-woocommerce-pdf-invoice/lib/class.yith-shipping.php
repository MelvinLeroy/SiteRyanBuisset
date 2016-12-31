<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'YITH_Shipping' ) ) {

	/**
	 * Implements features related to a PDF document
	 *
	 * @class   YITH_Shipping
	 * @package Yithemes
	 * @since   1.0.0
	 * @author  Your Inspiration Themes
	 */
	class YITH_Shipping extends YITH_Document {

		public $document_type = 'shipping_list';

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
		 * Check if a document exist for current order and load related data
		 */
		private function init_document() {
			$this->exists = get_post_meta( $this->order->id, '_ywpi_has_shipping_list', true );

			if ( $this->exists ) {
				$this->save_path = get_post_meta( $this->order->id, '_ywpi_shipping_list_path', true );
			}
		}

		/**
		 *  Cancel shipping list document for the current order
		 */
		public function reset() {
			delete_post_meta( $this->order->id, '_ywpi_has_shipping_list' );
			delete_post_meta( $this->order->id, '_ywpi_shipping_list_path' );
		}

		/**
		 * Set invoice data for current order, picking the invoice number from the related general option
		 */
		public function save() {
			//  Avoid generating a new document if a previous one still exists
			if ( $this->exists ) {
				return;
			}

			$this->save_path = $this->document_type . "_" . $this->order->get_order_number() . ".pdf";
			$this->exists    = true;

			update_post_meta( $this->order->id, '_ywpi_has_shipping_list', $this->exists );
			update_post_meta( $this->order->id, '_ywpi_shipping_list_path', $this->save_path );

			$pdf_path = YITH_YWPI_DOCUMENT_SAVE_DIR . $this->save_path;
			$this->init_template_generation_actions();
			$this->save_file( $pdf_path );
		}

		/**
		 * Reset actions and add new ones related to current document being generated
		 */
		public function init_template_generation_actions() {
			add_action( 'yith_ywpi_invoice_template_head', array( $this, 'add_invoice_style' ) );
			add_action( 'yith_ywpi_invoice_template_content', array( $this, 'add_invoice_content' ) );
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

			echo '<span class="invoice-from-to">' . __( "Shipping From:", 'yith-woocommerce-pdf-invoice' ) . '</span>';
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

			/** @var WC_Order $order */
			$order = $ywpi_document->order;

			echo '<div class="invoice-to-section">';

			// Display values
			if ( $order->get_formatted_shipping_address() ) {
				echo '<span class="invoice-from-to" > ' . __( "Shipping To:", 'yith-woocommerce-pdf-invoice' ) . '</span > ' . wp_kses( $order->get_formatted_shipping_address(), array( "br" => array() ) );
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
				<tr class="invoice-order-number">
					<td><?php _e( "Order", 'yith-woocommerce-pdf-invoice' ); ?></td>
					<td class="right"><?php echo $ywpi_document->order->get_order_number(); ?></td>
				</tr>

				<tr class="invoice-date">
					<td><?php _e( "Order date", 'yith-woocommerce-pdf-invoice' ); ?></td>
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