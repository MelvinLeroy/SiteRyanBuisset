<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post, $woocommerce;

$size = 'shop_single';

// Fix for Woocommerce 2.2.x
if ( function_exists( 'yit_change_single_width' ) && version_compare( preg_replace( '/-beta-([0-9]+)/', '', $woocommerce->version ), '2.2', '>=' )  ) {
    $size = yit_change_single_width();

    if ( sizeof( $size ) > 0 ) {
        $size = array( $size['width'], $size['height'] );
    }
}

?>



    <div class="images">

        <?php
            if ( has_post_thumbnail() ) {

                $image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $size ) );
                $image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
                $image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
                $attachment_count   = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );

                if ( $attachment_count != 1 ) {
                    $gallery = '[product-gallery]';
                } else {
                    $gallery = '';
                }

                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

            } else {

                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );

            }
        ?>

        <?php do_action( 'woocommerce_product_thumbnails' ); ?>

    </div>
