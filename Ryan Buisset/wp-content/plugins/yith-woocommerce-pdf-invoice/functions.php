<?php

//region some constant values used for url argument vars
if ( ! defined( 'YITH_YWPI_INVOICE_ARG_NAME' ) ) {
	define( 'YITH_YWPI_INVOICE_ARG_NAME', 'invoice' );
}

if ( ! defined( 'YITH_YWPI_SHIPPING_LIST_ARG_NAME' ) ) {
	define( 'YITH_YWPI_SHIPPING_LIST_ARG_NAME', 'shipping-list' );
}

if ( ! defined( 'YITH_YWPI_CREATE_INVOICE_ARG_NAME' ) ) {
	define( 'YITH_YWPI_CREATE_INVOICE_ARG_NAME', 'create-invoice' );
}

if ( ! defined( 'YITH_YWPI_VIEW_INVOICE_ARG_NAME' ) ) {
	define( 'YITH_YWPI_VIEW_INVOICE_ARG_NAME', 'view-invoice' );
}

if ( ! defined( 'YITH_YWPI_RESET_INVOICE_ARG_NAME' ) ) {
	define( 'YITH_YWPI_RESET_INVOICE_ARG_NAME', 'reset-invoice' );
}

if ( ! defined( 'YITH_YWPI_NONCE_ARG_NAME' ) ) {
	define( 'YITH_YWPI_NONCE_ARG_NAME', 'check' );
}

if ( ! defined( 'YITH_YWPI_CREATE_SHIPPING_LIST_ARG_NAME' ) ) {
	define( 'YITH_YWPI_CREATE_SHIPPING_LIST_ARG_NAME', 'create-shipping-list' );
}

if ( ! defined( 'YITH_YWPI_VIEW_SHIPPING_LIST_ARG_NAME' ) ) {
	define( 'YITH_YWPI_VIEW_SHIPPING_LIST_ARG_NAME', 'view-shipping-list' );
}

if ( ! defined( 'YITH_YWPI_RESET_SHIPPING_LIST_ARG_NAME' ) ) {
	define( 'YITH_YWPI_RESET_SHIPPING_LIST_ARG_NAME', 'reset-shipping-list' );
}
//endregion

function ywpi_get_query_args_list() {
	return array(
		YITH_YWPI_CREATE_INVOICE_ARG_NAME,
		YITH_YWPI_VIEW_INVOICE_ARG_NAME,
		YITH_YWPI_RESET_INVOICE_ARG_NAME,
		YITH_YWPI_NONCE_ARG_NAME,
		YITH_YWPI_CREATE_SHIPPING_LIST_ARG_NAME,
		YITH_YWPI_VIEW_SHIPPING_LIST_ARG_NAME,
		YITH_YWPI_RESET_SHIPPING_LIST_ARG_NAME
	);
}

function ywpi_get_action_name_for_nonce( $document ) {
	return 'ywpi_action_' . $document->exists . $document->order->order_key;
}

/*
 * Build an action link for a specific YITH-WooCommerce-PDF-Invoice action, resetting others query args presented for current url and
 * specified by $ywpi_query_arg_array array.
 */
function ywpi_document_nonce_url( $arg_name, $document ) {
	$action_url   = add_query_arg( $arg_name, $document->order->id, remove_query_arg( ywpi_get_query_args_list() ) );
	$complete_url = wp_nonce_url( $action_url, ywpi_get_action_name_for_nonce( $document ), YITH_YWPI_NONCE_ARG_NAME );

	return esc_url( $complete_url );
}

/**
 * Verify nonce on an url asking to do an action over an invoice
 *
 * @param $order_id the order id of the invoice
 *
 * @return bool Nonce validated
 */
function ywpi_document_nonce_check( $document ) {
	//  check for nounce value
	if ( ! check_admin_referer( ywpi_get_action_name_for_nonce( $document ), YITH_YWPI_NONCE_ARG_NAME ) ) {
		return false;
	}

	return true;
}


