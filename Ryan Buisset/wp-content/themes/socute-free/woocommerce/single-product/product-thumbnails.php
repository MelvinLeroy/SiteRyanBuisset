<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;
?>
<div class="thumbnails nomagnifier<?php if ( yit_get_option('product-single-layout') == 'layout-2' ) echo ' container' ?> <?php echo yit_get_option('single-layout-1-thumbnails-position') ?>"><?php
    $attachments = $product->get_gallery_attachment_ids();

    if ($attachments) {

        $loop = 0;
        $columns = apply_filters( 'woocommerce_product_thumbnails_columns', floor( yit_shop_single_w() / yit_shop_thumbnail_w() ) );

        foreach ( $attachments as $attachment_id ) {
            $attachment = get_post( $attachment_id );

            if ( get_post_meta( $attachment_id, '_woocommerce_exclude_image', true ) == 1 )
                continue;

            $classes = array( 'zoom' );

            if ( $loop == 0 || $loop % $columns == 0 )
                $classes[] = 'first';

            if ( ( $loop + 1 ) % $columns == 0 )
                $classes[] = 'last';

            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" title="%s" data-rel="prettyPhoto[product-gallery]" class="%s">%s</a>', wp_get_attachment_url( $attachment->ID ), esc_attr( $attachment->post_title ), implode(' ', $classes), yit_image( "id=$attachment->ID&size=" . apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), false ) ) );

            $loop++;

        }

    }
?></div>