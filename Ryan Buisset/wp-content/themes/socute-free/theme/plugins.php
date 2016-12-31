<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

add_filter('yit_plugins', 'yit_add_plugins');
function yit_add_plugins( $plugins ) {
    return array_merge( $plugins, array(

        array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
            'version'=> '2.2.8',
        ),

        array(
            'name'         => 'YITH Essential Kit for WooCommerce #1',
            'slug'         => 'yith-essential-kit-for-woocommerce-1',
            'required'     => false,
            'version'      => '1.0.0',
        ),

        array(
            'name'      => 'YITH WooCommerce Featured Video',
            'slug'      => 'yith-woocommerce-featured-video',
            'required'  => false,
            'version'=> '1.0.0',
        ),

        defined( 'YITH_YWPI_PREMIUM' ) ? array() : array(
            'name'      => 'YITH WooCommerce PDF Invoice and Shipping List',
            'slug'      => 'yith-woocommerce-pdf-invoice',
            'required'  => false,
            'version'   => '1.0.0'
        ),
    ));
}