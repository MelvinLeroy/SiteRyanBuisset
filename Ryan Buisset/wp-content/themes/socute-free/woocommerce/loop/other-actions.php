<?php
/**
 * Other actions (Compare, Wishlist, Share)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product;

$actions = array();

$actions['wishlist'] = '<div class="action wishlist">' . do_shortcode('[yith_wcwl_add_to_wishlist]') . '</div>';

if ( ( get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' && !is_product() ) ||
     ( get_option( 'yith_woocompare_compare_button_in_product_page' ) == 'yes' && is_product() ) ) {
    $actions['compare']  = shortcode_exists( 'yith_compare_button' ) ? '<div class="action compare">' . do_shortcode('[yith_compare_button type="link"]') . '</div>' : '';
}

/*if( ( yit_get_option('shop-view-show-share') && !is_product() ) ||
    ( yit_get_option('shop-single-show-share') && is_product() )) {
    if( yit_get_option('shop-share-lite-style') ) {
        $actions['share']    = '<a href="#" class="yit_share">' . __( 'Share', 'yit' ) . '</a>';
    } elseif ( isset( $woocommerce->integrations->integrations['sharethis'] ) && !empty( $woocommerce->integrations->integrations['sharethis']->publisher_id ) ) {
        $actions['share']    = sprintf('<a href="%s" rel="nofollow" title="%s" class="share" id="%s" onclick="return false;">%s</a>', '#', __( 'Share', 'yit' ), "share_$product->id", __( 'Share', 'yit' ));;
    }
}*/


if ( ! defined( 'YITH_WCWL' ) || get_option( 'yith_wcwl_enabled' ) != 'yes' || empty( $actions['wishlist'] ) ) { unset( $actions['wishlist'] ); }

//foreach ( array( 'wishlist' ) as $button ) {
//    if ( ! is_product() && ! yit_get_option('shop-view-show-'.$button) ||
//           is_product() && ! yit_get_option('shop-single-show-'.$button) ||
//           empty( $actions[$button] )
//       ) {
//        unset( $actions[$button] );
//    }
//}

// add share for single product
global $woocommerce_loop;
if ( ! isset( $woocommerce_loop ) && yit_get_option('shop-single-show-share') ) {
    $actions['share']  = '<div class="action share"><a href="#" class="yit_share">' . __( 'Share it', 'yit' ) . '</a></div>';
    $actions['share'] .= '<div class="product-share">' . do_shortcode('[share title="' . __('Share on:', 'yit') . ' " icon_type="round" socials="facebook, twitter, google, pinterest, bookmark"]') . '</div>';
}

if ( empty( $actions ) ) return;

// add first class in the first item
$actions = array_values( $actions );
$actions[0] = str_replace( '<div class="action ', '<div class="action first ', $actions[0] );
?>

<div class="product-actions buttons_<?php echo count( $actions ); ?> group">
    <?php echo implode( array_values( $actions ), ' / ' ); ?>
</div>

<?php if( !yit_get_option( 'shop-enabled' ) && ! isset( $woocommerce_loop ) ) : ?><div class="clear"></div><?php endif ?>