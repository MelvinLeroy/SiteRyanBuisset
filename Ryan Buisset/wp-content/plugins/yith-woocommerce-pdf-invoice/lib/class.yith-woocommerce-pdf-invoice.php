<?php
if ( ! defined ( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists ( 'YITH_WooCommerce_Pdf_Invoice' ) ) {

    /**
     * Implements features of Yith WooCommerce Pdf Invoice
     *
     * @class   YITH_WooCommerce_Pdf_Invoice
     * @package Yithemes
     * @since   1.0.0
     * @author  Your Inspiration Themes
     */
    class YITH_WooCommerce_Pdf_Invoice {
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
        public function __construct () {
            add_action ( 'init', array ( $this, 'init_plugin_actions' ) );

            $this->initialize ();
            $this->set_metabox_actions ();

            $this->add_buttons_on_customer_orders_page ();
            $this->add_features_on_admin_orders_page ();

            $this->add_order_status_related_actions ();

            /*
            * Check if invoice should be attached to emails
            */
            add_filter ( 'woocommerce_email_attachments', array ( $this, 'attach_invoice_to_email' ), 99, 3 );

            /*
             * Add a create/view invoice button on admin orders page
             */
            add_action ( 'woocommerce_admin_order_actions_end', array ( $this, 'add_back_end_invoice_buttons' ) );
            /*
             * Add a create/view shipping list button on admin orders page
             */
            add_action ( 'woocommerce_admin_order_actions_end', array (
                $this,
                'add_back_end_shipping_list_buttons',
            ) );

            //  Add stylesheets and scripts files to back-end
            add_action ( 'admin_enqueue_scripts', array ( $this, 'enqueue_styles' ) );
            add_action ( 'wp_enqueue_scripts', array ( $this, 'enqueue_styles' ) );


        }

        public function initialize () {
            $date = getdate ( time () );
            $year = $date[ 'year' ];

            if ( ! file_exists ( YITH_YWPI_DOCUMENT_SAVE_DIR ) ) {
                wp_mkdir_p ( YITH_YWPI_DOCUMENT_SAVE_DIR );
            }

            if ( ! file_exists ( YITH_YWPI_DOCUMENT_SAVE_DIR . $year ) ) {
                wp_mkdir_p ( YITH_YWPI_DOCUMENT_SAVE_DIR . $year );
            }
        }

        /**
         * Enqueue css file
         *
         * @since  1.0
         * @author Lorenzo Giuffrida
         */
        public function enqueue_styles () {
            /*
                        //  On 'view-order' WooCommerce page add stylesheets and scripts files
                        global $wp;

                        if ( is_front_page() && isset( $wp->query_vars['view-order'] ) ) {
                            wp_enqueue_style( 'ywpi_css', YITH_YWPI_ASSETS_URL . '/css/ywpi.css' );
                        }
            */

            wp_enqueue_style ( 'ywpi_css', YITH_YWPI_ASSETS_URL . '/css/ywpi.css' );
        }

        /*
         * Add some actions triggered by order status
         */
        public function add_order_status_related_actions () {
            //  If invoice generation is only manual, no automatic actions will be added
            if ( 'auto' != get_option ( 'ywpi_invoice_generation' ) ) {
                return;
            }

            if ( 'new' === get_option ( 'ywpi_create_invoice_on' ) ) {
                add_action ( 'woocommerce_order_status_on-hold', array ( $this, 'new_automatic_invoice' ) );
            } else if ( 'processing' === get_option ( 'ywpi_create_invoice_on' ) ) {
                add_action ( 'woocommerce_order_status_processing', array ( $this, 'new_automatic_invoice' ) );
            } else if ( 'completed' === get_option ( 'ywpi_create_invoice_on' ) ) {
                add_action ( 'woocommerce_order_status_completed', array ( $this, 'new_automatic_invoice' ) );
            }
        }

        /**
         * Create a new invoice for the order, generated automatically if the plugin settings permit
         *
         * @param int $order_id
         *
         * @author Lorenzo Giuffrida
         * @since  1.0.0
         */
        public function new_automatic_invoice ( $order_id ) {
            $document = $this->get_document_by_type ( $order_id, YITH_YWPI_INVOICE_ARG_NAME );

            if ( null != $document ) {
                $this->save_document ( $document );
            }
        }

        /**
         * Add invoice actions to the orders listing
         */
        public function add_back_end_invoice_buttons ( $order ) {
            $invoice = $this->get_document_by_type ( $order->id, YITH_YWPI_INVOICE_ARG_NAME );

            if ( $invoice->exists ) {
                $url   = ywpi_document_nonce_url ( YITH_YWPI_VIEW_INVOICE_ARG_NAME, $invoice );
                $text  = __ ( "Show invoice", 'yith-woocommerce-pdf-invoice' );
                $class = "ywpi_view_invoice";
            } else {
                $url   = ywpi_document_nonce_url ( YITH_YWPI_CREATE_INVOICE_ARG_NAME, $invoice );
                $text  = __ ( "Create invoice", 'yith-woocommerce-pdf-invoice' );
                $class = "ywpi_create_invoice";
            }

            echo '<a href="' . $url . '" class="button tips ywpi_buttons ' . $class . '" data-tip="' . $text . '" title="' . $text . '">' . $text . '</a>';
        }

        /**
         * Add shipping list actions to the orders listing
         */
        public function add_back_end_shipping_list_buttons ( $order ) {
            if ( 'yes' == get_option ( 'ywpi_enable_shipping_list' ) ) {

                $shipping_document = new YITH_Shipping( $order->id );

                if ( $shipping_document->exists ) {
                    $url   = ywpi_document_nonce_url ( YITH_YWPI_VIEW_SHIPPING_LIST_ARG_NAME, $shipping_document );
                    $text  = __ ( "Show shipping list document", 'yith-woocommerce-pdf-invoice' );
                    $class = "ywpi_view_shipping_list";

                } else {
                    $url   = ywpi_document_nonce_url ( YITH_YWPI_CREATE_SHIPPING_LIST_ARG_NAME, $shipping_document );
                    $text  = __ ( "Create shipping list document", 'yith-woocommerce-pdf-invoice' );
                    $class = "ywpi_create_shipping_list";

                }

                echo '<a href="' . $url . '" class="button tips ywpi_buttons ' . $class . '" data-tip="' . $text . '" title="' . $text . '">' . $text . '</a>';
            }
        }

        //region Invoice templates actions

        public function attach_invoice_to_email ( $attachments, $status, $object ) {

            if ( ! $object instanceof WC_Order ) {
                return $attachments;
            }

            $invoice = new YITH_Invoice( $object->id );
            if ( ! $invoice->exists ) {
                return $attachments;
            }

            $allowed_statuses = array (
                'new_order',
                'customer_invoice',
                'customer_processing_order',
                'customer_completed_order',
            );

            if ( isset( $status ) && in_array ( $status, $allowed_statuses ) ) {

                $your_pdf_path = YITH_YWPI_DOCUMENT_SAVE_DIR . $invoice->save_path;
                $attachments[] = $your_pdf_path;
            }

            return $attachments;
        }

        //endregion

        /**
         * Add front-end button for actions available for customers
         */
        public function  add_buttons_on_customer_orders_page () {
            /**
             * Show print invoice button on frontend orders page
             */
            add_action ( 'woocommerce_my_account_my_orders_actions', array (
                $this,
                'print_invoice_button',
            ), 10, 2 );
        }

        /**
         * Add back-end buttons for actions available for admins
         */
        public function add_features_on_admin_orders_page () {
            add_action ( 'manage_shop_order_posts_custom_column', array (
                $this,
                'show_invoice_custom_column_data',
            ), 99 );
        }

        /**
         * Append invoice information on order_title column, if current order has an invoice associated
         *
         * @param string $column
         *
         * @return mixed
         * @author Lorenzo Giuffrida
         * @since  1.0.0
         */
        public function show_invoice_custom_column_data ( $column ) {
            global $post;

            if ( 'order_title' != $column ) {
                return $column;
            }

            $invoice = new YITH_Invoice( $post->ID );
            if ( ! $invoice->exists ) {
                return $column;
            }

            echo '<small class="meta">' . sprintf ( __ ( "Invoice No. %s of %s", 'yith-woocommerce-pdf-invoice' ), $invoice->get_formatted_invoice_number (), $invoice->get_formatted_date () ) . '</small>';
        }

        /**
         * add the right action based on GET var current used
         *
         */
        public function  init_plugin_actions () {
            if ( isset( $_GET[ YITH_YWPI_CREATE_INVOICE_ARG_NAME ] ) ) {
                $this->create_document ( $_GET[ YITH_YWPI_CREATE_INVOICE_ARG_NAME ], YITH_YWPI_INVOICE_ARG_NAME );
            } else if ( isset( $_GET[ YITH_YWPI_VIEW_INVOICE_ARG_NAME ] ) ) {
                $this->view_document ( $_GET[ YITH_YWPI_VIEW_INVOICE_ARG_NAME ], YITH_YWPI_INVOICE_ARG_NAME );
            } else if ( isset( $_GET[ YITH_YWPI_RESET_INVOICE_ARG_NAME ] ) ) {
                $this->reset_document ( $_GET[ YITH_YWPI_RESET_INVOICE_ARG_NAME ], YITH_YWPI_INVOICE_ARG_NAME );
            } else if ( isset( $_GET[ YITH_YWPI_CREATE_SHIPPING_LIST_ARG_NAME ] ) ) {
                $this->create_document ( $_GET[ YITH_YWPI_CREATE_SHIPPING_LIST_ARG_NAME ], YITH_YWPI_SHIPPING_LIST_ARG_NAME );
            } else if ( isset( $_GET[ YITH_YWPI_VIEW_SHIPPING_LIST_ARG_NAME ] ) ) {
                $this->view_document ( $_GET[ YITH_YWPI_VIEW_SHIPPING_LIST_ARG_NAME ], YITH_YWPI_SHIPPING_LIST_ARG_NAME );
            } else if ( isset( $_GET[ YITH_YWPI_RESET_SHIPPING_LIST_ARG_NAME ] ) ) {
                $this->reset_document ( $_GET[ YITH_YWPI_RESET_SHIPPING_LIST_ARG_NAME ], YITH_YWPI_SHIPPING_LIST_ARG_NAME );
            }
        }

        /**
         * @param $document
         *
         * @return bool
         * @author Lorenzo Giuffrida
         * @since  1.0.0
         */
        private function check_invoice_url_for_action ( $document ) {

            //  Check if the document is for a valid order
            if ( ! $document->is_valid ) {
                return false;
            }

            //  check for nounce value
            if ( ! ywpi_document_nonce_check ( $document ) ) {
                return false;
            }

            return true;
        }

        //region    ****    Manage invoice operation on plugin init ****

        public function get_document_by_type ( $order_id, $document_type = '' ) {
            switch ( $document_type ) {
                case YITH_YWPI_INVOICE_ARG_NAME :
                    $document = new Yith_Invoice( $order_id );
                    break;
                case YITH_YWPI_SHIPPING_LIST_ARG_NAME:
                    $document = new Yith_Shipping( $order_id );
                    break;
                default:
                    return null;
            }

            return $document;
        }

        /**
         * Create a new document of the type requested, for a specific order
         *
         * @param        $order_id      the order id for which the document is created
         * @param string $document_type the document type to be generated
         */
        public function create_document ( $order_id, $document_type = '' ) {
            $document = $this->get_document_by_type ( $order_id, $document_type );

            if ( null != $document ) {
                /*
                 * Check for url validation
                 */
                if ( ! $this->check_invoice_url_for_action ( $document ) ) {
                    return;
                }

                $this->save_document ( $document );
            }
        }

        /*
         * Save a PDF file starting from an order id and a document type
         */
        public function save_document_by_type ( $order_id, $document_type ) {
            $document = $this->get_document_by_type ( $order_id, $document_type );
            if ( null != $document ) {
                save_document ( $document );
            }
        }

        /*
             * Save a PDF file starting from a previously created document
             */
        public function save_document ( $document ) {
            global $ywpi_document;
            $ywpi_document = $document;
            $ywpi_document->save ();
        }

        public function view_document ( $order_id, $document_type ) {
            $document = $this->get_document_by_type ( $order_id, $document_type );
            if ( null != $document ) {
                /*
                 * Check for url validation
                 */
                if ( ! $this->check_invoice_url_for_action ( $document ) ) {
                    return;
                }

                $full_path = YITH_YWPI_DOCUMENT_SAVE_DIR . $document->save_path;

                //  Check if show pdf invoice on browser or asking to download it
                $where_to_show = get_option ( 'ywpi_pdf_invoice_behaviour' );

                if ( 'open' == $where_to_show ) {
                    header ( 'Content-type: application/pdf' );
                    header ( 'Content-Disposition: inline; filename = "' . basename ( $full_path ) . '"' );
                    header ( 'Content-Transfer-Encoding: binary' );
                    header ( 'Content-Length: ' . filesize ( $full_path ) );
                    header ( 'Accept-Ranges: bytes' );
                    @readfile ( $full_path );
                    exit();
                } else {
                    header ( "Content-type: application/pdf" );
                    header ( 'Content-Disposition: attachment; filename = "' . basename ( $full_path ) . '"' );
                    @readfile ( $full_path );
                }
            }
        }


        public function reset_document ( $order_id, $document_type ) {
            $document = $this->get_document_by_type ( $order_id, $document_type );

            if ( null != $document ) {
                /*
                 * Check for url validation
                 */
                if ( ! $this->check_invoice_url_for_action ( $document ) ) {
                    return;
                }

                $document->reset ();
            }
        }

        //endregion


        //region    ****   Custom menu entry for plugin, using Yith plugin framework    ****


        /**
         * Register actions and filters to be used for creating an entry on YIT Plugin menu
         *
         * @since  1.0
         * @author Lorenzo Giuffrida
         * @access public
         * @return void
         */
        private function set_metabox_actions () {
            /**
             * Add metabox on order, to let vendor add order tracking code and carrier
             */
            add_action ( 'add_meta_boxes', array ( $this, 'add_invoice_metabox' ) );
        }

        /**
         *  Add a metabox on backend order page, to be filled with order tracking information
         *
         * @since  1.0
         * @author Lorenzo Giuffrida
         * @access public
         * @return void
         */
        function add_invoice_metabox () {

            add_meta_box ( 'yith-pdf-invoice-box', __ ( 'YITH PDF Invoice', 'yith-woocommerce-pdf-invoice' ), array (
                $this,
                'show_pdf_invoice_metabox',
            ), 'shop_order', 'side', 'high' );
        }

        /**
         * Show metabox content for tracking information on backend order page
         *
         * @param $post the order object that is currently shown
         *
         * @since  1.0
         * @author Lorenzo Giuffrida
         * @access public
         * @return void
         */
        function show_pdf_invoice_metabox ( $post ) {

            $invoice = $this->get_document_by_type ( $post->ID, YITH_YWPI_INVOICE_ARG_NAME );

            ?>
            <div class="invoice-information">
                <?php if ( ( null != $invoice ) && $invoice->exists ) : ?>
                    <div style="overflow: hidden; padding: 5px 0">
                        <span
                            style="float:left"><?php _e ( 'Invoiced on : ', 'yith-woocommerce-pdf-invoice' ); ?></span>
                        <strong><span
                                style="float:right"><?php echo $invoice->get_formatted_date (); ?></span></strong>
                    </div>

                    <div style="overflow: hidden; padding: 5px 0">

                        <span
                            style="float:left"><?php _e ( 'Invoice number : ', 'yith-woocommerce-pdf-invoice' ); ?></span>
                        <strong><span
                                style="float:right"><?php echo $invoice->get_formatted_invoice_number (); ?></span></strong>
                    </div>

                    <div style="clear: both; margin-top: 15px">
                        <a class="button tips ywpi_view_invoice"
                           data-tip="<?php _e ( "View invoice", 'yith-woocommerce-pdf-invoice' ); ?>"
                           href="<?php echo ywpi_document_nonce_url ( YITH_YWPI_VIEW_INVOICE_ARG_NAME, $invoice ); ?>"><?php _e ( "Invoice", 'yith-woocommerce-pdf-invoice' ); ?></a>
                        <a class="button tips ywpi_cancel_invoice"
                           data-tip="<?php _e ( "Cancel invoice", 'yith-woocommerce-pdf-invoice' ); ?>"
                           href="<?php echo ywpi_document_nonce_url ( YITH_YWPI_RESET_INVOICE_ARG_NAME, $invoice ); ?>"><?php _e ( "Invoice", 'yith-woocommerce-pdf-invoice' ); ?></a>
                    </div>
                <?php else : ?>
                    <p>
                        <a class="button tips ywpi_create_invoice"
                           data-tip="<?php _e ( "Create invoice", 'yith-woocommerce-pdf-invoice' ); ?>"
                           href="<?php echo ywpi_document_nonce_url ( YITH_YWPI_CREATE_INVOICE_ARG_NAME, $invoice ); ?>"><?php _e ( "Invoice", 'yith-woocommerce-pdf-invoice' ); ?></a>
                    </p>
                    <?php
                endif; ?>

                <?php
                if ( 'yes' == get_option ( 'ywpi_enable_shipping_list' ) ) {
                    $shipping = $this->get_document_by_type ( $post->ID, YITH_YWPI_SHIPPING_LIST_ARG_NAME );
                    ?>
                    <?php if ( ( null != $shipping ) && $shipping->exists ) : ?>
                        <div style="clear: both; margin-top: 15px">
                            <a class="button tips ywpi_view_shipping_list"
                               data-tip="<?php _e ( "View shipping list", 'yith-woocommerce-pdf-invoice' ); ?>"
                               href=" <?php echo ywpi_document_nonce_url ( YITH_YWPI_VIEW_SHIPPING_LIST_ARG_NAME, $shipping ); ?>"><?php _e ( "Shipping", 'yith-woocommerce-pdf-invoice' ); ?></a>
                            <a class="button tips ywpi_cancel_shipping_list"
                               data-tip="<?php _e ( "Cancel shipping list", 'yith-woocommerce-pdf-invoice' ); ?>"
                               href="<?php echo ywpi_document_nonce_url ( YITH_YWPI_RESET_SHIPPING_LIST_ARG_NAME, $shipping ); ?>"><?php _e ( "Shipping", 'yith-woocommerce-pdf-invoice' ); ?></a>
                        </div>
                    <?php else : ?>
                        <p>
                            <a class="button tips ywpi_create_shipping_list"
                               data-tip="<?php _e ( "Create shipping list", 'yith-woocommerce-pdf-invoice' ); ?>"
                               href="<?php echo ywpi_document_nonce_url ( YITH_YWPI_CREATE_SHIPPING_LIST_ARG_NAME, $shipping ); ?>"><?php _e ( "Shipping", 'yith-woocommerce-pdf-invoice' ); ?></a>
                        </p>
                        <?php
                    endif;
                } ?>
            </div>
            <?php
        }


        //endregion

        /**
         * Add a button to print invoice, if exists, from order page on frontend.
         */
        public
        function print_invoice_button (
            $actions, $order
        ) {
            $invoice = new YITH_Invoice( $order->id );

            if ( $invoice->exists ) {
                // Add the print button
                $actions[ 'print-invoice' ] = array (
                    'url'  => ywpi_document_nonce_url ( YITH_YWPI_VIEW_INVOICE_ARG_NAME, $invoice ),
                    'name' => __ ( 'Invoice', 'yith-woocommerce-pdf-invoice' ),
                );
            }

            return $actions;
        }
    }
}