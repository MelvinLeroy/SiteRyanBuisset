<?php

//--wpml-------------
$text = yith_wcbm_wpml_string_translate( 'yith-woocommerce-badges-management', sanitize_title( $text ), $text );
//-------------------

if ( $type == 'image' ) {
    // IMAGE BADGE
    $image_url = YITH_WCBM_ASSETS_URL . '/images/' . $image_url;
    $text      = '<img src="' . $image_url . '" />';
}

?>
<div class='yith-wcbm-badge yith-wcbm-badge-<?php echo $id_badge ?>'>
    <?php echo $text ?>
</div><!--yith-wcbm-badge-->