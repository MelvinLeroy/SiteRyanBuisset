<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

$current_date = getdate();

$general_options = array(

	'template' => array(

		'section_general_settings'     => array(
			'name' => __( 'Invoice template settings', 'yith-woocommerce-pdf-invoice' ),
			'type' => 'title',
			'id'   => 'ywpi_section_general'
		),
		'show_company_name'            => array(
			'name'    => __( 'Show company name', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'checkbox',
			'id'      => 'ywpi_show_company_name',
			'desc'    => __( 'Show company name on invoice document.', 'yith-woocommerce-pdf-invoice' ),
			'default' => 0
		),
		'company_name'                 => array(
			'name'    => __( 'Company name', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'text',
			'id'      => 'ywpi_company_name',
			'desc'    => __( 'Set company name to be shown on invoices', 'yith-woocommerce-pdf-invoice' ),
			'default' => __( 'Your company name', 'yith-woocommerce-pdf-invoice' )
		),
		'show_company_logo'            => array(
			'name'    => __( 'Show company logo', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'checkbox',
			'id'      => 'ywpi_show_company_logo',
			'desc'    => __( 'Show company logo on invoice document.', 'yith-woocommerce-pdf-invoice' ),
			'default' => 0
		),
		'company_logo'                 => array(
			'name' => __( 'Your company logo', 'yith-woocommerce-pdf-invoice' ),
			'type' => 'ywpi_logo',
			'id'   => 'ywpi_company_logo',
			'desc' => __( 'Set a default logo to be shown', 'yith-woocommerce-pdf-invoice' ),
		),
		'show_company_details'         => array(
			'name'    => __( 'Show company details', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'checkbox',
			'id'      => 'ywpi_show_company_details',
			'desc'    => __( 'Show company details on invoice document.', 'yith-woocommerce-pdf-invoice' ),
			'default' => 0
		),
		'company_details'              => array(
			'name'    => __( 'Company details', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'textarea',
			'id'      => 'ywpi_company_details',
			'css'     => 'width:80%; height: 90px;',
			'desc'    => __( 'Set company details to be used on invoice document', 'yith-woocommerce-pdf-invoice' ),
			'default' => __( 'Your company details
Address
City, State' )
		),
		'show_invoice_notes'           => array(
			'name'    => __( 'Show notes', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'checkbox',
			'id'      => 'ywpi_show_invoice_notes',
			'desc'    => __( 'Show notes before the footer.', 'yith-woocommerce-pdf-invoice' ),
			'default' => 0
		),
		'invoice_notes'                => array(
			'name' => __( 'Invoice notes', 'yith-woocommerce-pdf-invoice' ),
			'type' => 'textarea',
			'id'   => 'ywpi_invoice_notes',
			'css'  => 'width:80%; height: 90px;',
			'desc' => __( 'Set notes to show on invoice', 'yith-woocommerce-pdf-invoice' ),
		),
		'show_invoice_footer'          => array(
			'name'    => __( 'Show footer', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'checkbox',
			'id'      => 'ywpi_show_invoice_footer',
			'desc'    => __( 'Show footer.', 'yith-woocommerce-pdf-invoice' ),
			'default' => 0
		),
		'invoice_footer'               => array(
			'name' => __( 'Invoice footer', 'yith-woocommerce-pdf-invoice' ),
			'type' => 'textarea',
			'id'   => 'ywpi_invoice_footer',
			'css'  => 'width:80%; height: 90px;',
			'desc' => __( 'Set text to show on invoice footer', 'yith-woocommerce-pdf-invoice' ),
		),
		'section_general_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywpi_section_general_end'
		)
	)
);

return $general_options;
