<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $product, $woocommerce, $yith_wcwl_init;

if ( ! yit_get_option( 'shop-enabled' )  ) {
    add_action( 'woocommerce_single_product_summary', 'yit_product_other_actions', 35 );
}

?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked woocommerce_show_messages - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}
?>

    <div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class( 'product-layout-1' ); ?>>

        <?php
        /**
         * woocommerce_show_product_images hook
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action( 'woocommerce_before_single_product_summary' );
        ?>

        <div class="summary entry-summary">

            <?php
            if ( ! is_shop_enabled() || ! yit_get_option( 'shop-detail-show-price' ) ) {
                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
            }
            if ( ! is_shop_enabled() || ! yit_get_option( 'shop-detail-add-to-cart' ) ) {
                remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
            }

            remove_action( 'woocommerce_single_product_summary', '' );

            // add a separator after title and price
            add_action( 'woocommerce_single_product_summary', create_function( '', 'echo do_shortcode("[line]");' ) );

            /**
             * woocommerce_single_product_summary hook
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             */
            do_action( 'woocommerce_single_product_summary' );
            ?>

        </div>
        <!-- .summary -->

        <div class="after-product-summary">
            <?php
            /**
             * woocommerce_after_single_product_summary hook
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_output_related_products - 20
             */
            do_action( 'woocommerce_after_single_product_summary' ); ?>

        </div>



    </div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>