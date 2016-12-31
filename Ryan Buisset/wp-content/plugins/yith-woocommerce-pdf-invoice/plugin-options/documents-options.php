<?php
global $YWPI_Instance;
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

if ( ! defined( 'YITH_YWPI_PREMIUM' ) ) {
	$intro_tab = array(
		'section_general_settings_videobox' => array(
			'name'    => __( 'Upgrade to the PREMIUM VERSION', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'videobox',
			'default' => array(
				'plugin_name'               => __( 'YITH WooCommerce PDF Invoice and Shipping List', 'yith-woocommerce-pdf-invoice' ),
				'title_first_column'        => __( 'Discover Advanced Features', 'yith-woocommerce-pdf-invoice' ),
				'description_first_column'  => __( 'Upgrade to the PREMIUM VERSION of YITH WOOCOMMERCE PDF INVOICE AND SHIPPING LIST to benefit from all features!', 'yith-woocommerce-pdf-invoice' ),
				'video'                     => array(
					'video_id'          => '121155123',
					'video_image_url'   => YITH_YWPI_ASSETS_IMAGES_URL . 'videobox-yith-woocommerce-pdf-invoice.jpg',
					'video_description' => __( 'See YITH WooCommerce PDF Invoice and Shipping List plugin with full premium features in action.', 'yith-woocommerce-pdf-invoice' ),
				),
				'title_second_column'       => __( 'Get Support and Pro Features', 'yith-woocommerce-pdf-invoice' ),
				'description_second_column' => __( 'By purchasing the premium version of the plugin, you will take advantage of the advanced features of the product and you will get one year of free updates and support through our platform available 24h/24.', 'yith-woocommerce-pdf-invoice' ),
				'button'                    => array(
					'href'  => YITH_YWPI_Plugin_FW_Loader::get_instance()->get_premium_landing_uri(),
					'title' => 'Get Support and Pro Features'
				)
			),
			'id'      => 'yith_wcas_general_videobox'
		)
	);
}

$general_options = array(

	'documents' => array(
		'section_invoice_settings' => array(
			'name' => __( 'Invoice settings', 'yith-woocommerce-pdf-invoice' ),
			'type' => 'title',
			'id'   => 'ywpi_section_invoice'
		),
		'next_invoice_number'      => array(
			'name'    => __( 'Next invoice number', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'number',
			'id'      => 'ywpi_invoice_number',
			'desc'    => __( 'Invoice number for next invoice document.', 'yith-woocommerce-pdf-invoice' ),
			'default' => 1
		),
		'next_invoice_year'        => array(
			'name'    => __( 'billing year', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'hidden',
			'id'      => 'ywpi_invoice_year_billing',
			'default' => $current_date['year']
		),
		'invoice_prefix'           => array(
			'name' => __( 'Invoice prefix', 'yith-woocommerce-pdf-invoice' ),
			'type' => 'text',
			'id'   => 'ywpi_invoice_prefix',
			'desc' => __( 'Set a text to be used as prefix in invoice number. Leave it blank if no prefix has to be used', 'yith-woocommerce-pdf-invoice' ),
		),
		'invoice_suffix'           => array(
			'name' => __( 'Invoice suffix', 'yith-woocommerce-pdf-invoice' ),
			'type' => 'text',
			'id'   => 'ywpi_invoice_suffix',
			'desc' => __( 'Set a text to be used as suffix in invoice number. Leave it blank if no suffix has to be used', 'yith-woocommerce-pdf-invoice' ),
		),
		'invoice_number_format'    => array(
			'name'    => __( 'Invoice number format', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'text',
			'id'      => 'ywpi_invoice_number_format',
			'desc'    => __( 'Set format for invoice number. Use [number], [prefix] and [suffix] as placeholders', 'yith-woocommerce-pdf-invoice' ),
			'default' => '[prefix]/[number]/[suffix]'
		),
		'invoice_reset'            => array(
			'name'    => __( 'Reset on 1st January', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'checkbox',
			'id'      => 'ywpi_invoice_reset',
			'desc'    => __( 'Set restart from 1 on 1st January.', 'yith-woocommerce-pdf-invoice' ),
			'default' => 'yes'
		),
		'invoice_date_format'      => array(
			'name'    => __( 'Invoice date format', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'text',
			'id'      => 'ywpi_invoice_date_format',
			'desc'    => __( 'Set date format as it should appear on invoices.', 'yith-woocommerce-pdf-invoice' ),
			'default' => 'd/m/Y'
		),
		array(
			'title'   => __( 'Invoice generation', 'yith-woocommerce-pdf-invoice' ),
			'id'      => 'ywpi_invoice_generation',
			'type'    => 'radio',
			'options' => array(
				'auto'   => "Automatic generation",
				'manual' => "Manual generation"
			),
			'default' => 'manual',
			'std'     => 'manual'
		),
		array(
			'title'   => __( 'Generate invoice automatically:', 'yith-woocommerce-pdf-invoice' ),
			'id'      => 'ywpi_create_invoice_on',
			'type'    => 'radio',
			'options' => array(
				'new'        => __( "For new order.", 'yith-woocommerce-pdf-invoice' ),
				'processing' => __( "For processing order.", 'yith-woocommerce-pdf-invoice' ),
				'completed'  => __( "For completed order.", 'yith-woocommerce-pdf-invoice' )
			),
			'default' => 'completed',
			'std'     => 'completed'
		),
		array(
			'title'   => __( 'PDF invoice button behaviour:', 'yith-woocommerce-pdf-invoice' ),
			'id'      => 'ywpi_pdf_invoice_behaviour',
			'type'    => 'radio',
			'options' => array(
				'download' => "Download PDF",
				'open'     => "Open PDF on browser"
			),
			'default' => 'download',
			'std'     => 'download'
		),
		'shipping_list'            => array(
			'name'    => __( 'Enable shipping list', 'yith-woocommerce-pdf-invoice' ),
			'type'    => 'checkbox',
			'id'      => 'ywpi_enable_shipping_list',
			'desc'    => __( 'Add buttons for shipping list document generation.', 'yith-woocommerce-pdf-invoice' ),
			'default' => 'yes'
		),
		'invoice_settings_end'     => array(
			'type' => 'sectionend',
			'id'   => 'ywpi_section_invoice_end'
		)
	)
);

$general_options['documents'] = $intro_tab + $general_options['documents'];

return $general_options;
