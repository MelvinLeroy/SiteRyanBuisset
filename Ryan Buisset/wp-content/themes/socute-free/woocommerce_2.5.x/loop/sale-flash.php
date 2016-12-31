<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product;

if ( ! $product->is_in_stock() ) return;

$is_active         = get_post_meta( $product->id, '_active_custom_onsale', true );
$preset            = get_post_meta( $product->id, '_preset_onsale_icon', true );
$custom            = get_post_meta( $product->id, '_custom_onsale_icon', true );
$regular_price     = get_post_meta( $product->id, '_regular_price', true );
$regular_price_var = get_post_meta( $product->id, '_min_variation_price', true );

$img = '';

// set a preset image
if ( $is_active && $is_active != 'no' ) {
    switch ( $preset ) {
        case 'onsale' : $img = get_template_directory_uri() . '/woocommerce/images/bullets/sale.png'; break;
        case '-50%'   : $img = get_template_directory_uri() . '/woocommerce/images/bullets/50.png'; break;
        case '-25%'   : $img = get_template_directory_uri() . '/woocommerce/images/bullets/25.png'; break;
        case '-10%'   : $img = get_template_directory_uri() . '/woocommerce/images/bullets/10.png'; break;
        case 'custom' : $img = $custom; break;
    }

} elseif ( $product->is_on_sale() && ( !empty( $regular_price ) || !empty( $regular_price_var ) ) ) {
    $img = get_template_directory_uri() . '/woocommerce/images/bullets/sale.png';
}

if ( empty( $img ) ) return;


yit_image( "src=$img&getimagesize=1&class=onsale&alt=" . __( 'On sale!', 'yit' ) );