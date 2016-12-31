<?php
/**
 * Custom template for single variation
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<div class="variations_button group">
	<input type="hidden" name="variation_id" value="" />
	<table class="variations" cellspacing="0">
		<tr>
			<td class="label"><label><?php _e( 'Quantity', 'yit' ) ?></label></td>
			<td class="value"><?php woocommerce_quantity_input(); ?></td>
		</tr>
	</table>

	<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ) ?></button>
</div>

<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
<input type="hidden" name="product_id" value="<?php echo esc_attr( $product->ID ); ?>" />
<input type="hidden" name="variation_id" class="variation_id" value="" />

<div class="clear"></div>

<div class="single_variation"></div>

<a class="reset_variations" href="#reset"><?php _e( 'Clear selection', 'woocommerce' ) ?></a>