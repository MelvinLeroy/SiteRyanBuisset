<?php
/**
 * Content Wrappers
 */

if ( is_product() ) return;
?>
<!-- START PAGE META -->
<div id="page-meta" class="group<?php if ( is_product() ) echo ' span12' ?>">
    <?php if ( ! is_single() && yit_get_option( 'shop-products-title' ) ) : ?>
        <h1 class="page-title"><?php woocommerce_page_title() ?></h1>
    <?php endif; ?>

    <?php do_action( 'shop_page_meta' ) ?>

    <?php if ( is_single() && yit_get_option('shop-show-back') ) : ?>
        <div class="back-shop"> <a href="<?php echo get_permalink( yith_wc_get_page_id( 'shop' ) ) ?>">&lsaquo; <?php _e('Back to the shop', 'yit' ) ?></a> </div>
    <?php endif; ?>
</div>
<!-- END PAGE META -->