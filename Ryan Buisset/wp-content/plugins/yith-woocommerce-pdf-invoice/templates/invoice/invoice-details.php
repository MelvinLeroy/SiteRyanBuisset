<?php global $ywpi_document; ?>

<table class="invoice-details">
	<thead>
	<tr>
		<th class="column-product"><?php _e( 'Product', 'yith-woocommerce-pdf-invoice' ); ?></th>
		<th class="column-quantity"><?php _e( 'Qty', 'yith-woocommerce-pdf-invoice' ); ?></th>
		<th class="column-price"><?php _e( 'Price', 'yith-woocommerce-pdf-invoice' ); ?></th>
		<th class="column-total"><?php _e( 'Line total', 'yith-woocommerce-pdf-invoice' ); ?></th>
		<th class="column-tax"><?php _e( 'Tax', 'yith-woocommerce-pdf-invoice' ); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php

	$order_items = $ywpi_document->order->get_items();
	foreach ( $order_items as $item_id => $item ) {
		if ( isset( $item['qty'] ) ) {
			$price_per_unit      = $item["line_subtotal"] / $item['qty'];
			$price_per_unit_sale = $item["line_total"] / $item['qty'];
			$discount            = $price_per_unit - $price_per_unit_sale;
		}
		$tax = $item["line_tax"];

		?>

		<tr>
			<td class="column-product"><?php echo $item['name']; ?></td>
			<td class="column-quantity"><?php echo ( isset( $item['qty'] ) ) ? esc_html( $item['qty'] ) : ''; ?></td>
			<td class="column-price"><?php echo wc_price( $price_per_unit ); ?></td>
			<td class="column-total"><?php echo wc_price( $item["line_subtotal"] ); ?></td>
			<td class="column-tax"><?php echo wc_price( $tax ); ?></td>
		</tr>

	<?php };

	$order_shipping = $ywpi_document->order->get_items( 'shipping' );
	foreach ( $order_shipping as $item_id => $item ) {
		?>

		<tr>
			<td class="column-product">
				<?php echo ! empty( $item['name'] ) ? esc_html( $item['name'] ) : __( 'Shipping', 'yith-woocommerce-pdf-invoice' ); ?>
			</td>

			<td class="column-quantity">
			</td>

			<td class="column-price">
			</td>

			<td class="column-total">
				<?php echo ( isset( $item['cost'] ) ) ? wc_price( wc_round_tax_total( $item['cost'] ) ) : ''; ?>
			</td>

			<td class="column-tax">
				<?php
				$taxes      = 0;
				$taxes_list = maybe_unserialize( $item['taxes'] );
				foreach ( $taxes_list as $tax_id => $tax_item ) {
					$taxes += $tax_item;
				}
				echo( wc_price( wc_round_tax_total( $taxes ) ) );
				?>
			</td>
		</tr>
	<?php
	};

	?>

	</tbody>
</table>

<table>
	<tr>
		<td class="column1">

		</td>
		<td class="column2">
			<table class="invoice-totals">
				<tr class="invoice-details-subtotal">
					<td class="column-product"><?php _e( "Subtotal", 'yith-woocommerce-pdf-invoice' ); ?></td>
					<td class="column-total"><?php echo wc_price( $ywpi_document->order->get_subtotal() ); ?></td>
				</tr>

				<tr>
					<td class="column-product"><?php _e( "Discount", 'yith-woocommerce-pdf-invoice' ); ?></td>
					<td class="column-total"><?php echo wc_price( $ywpi_document->order->get_total_discount() ); ?></td>
				</tr>

				<?php if ( 'yes' == get_option( 'woocommerce_calc_taxes' ) ) : ?>
					<?php foreach ( $ywpi_document->order->get_tax_totals() as $code => $tax ) : ?>
						<tr class="invoice-details-vat">
							<td class="column-product"><?php echo $tax->label; ?>:</td>
							<td class="column-total"><?php echo $tax->formatted_amount; ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>

				<tr class="invoice-details-total">
					<td class="column-product"><?php _e( "Total", 'yith-woocommerce-pdf-invoice' ); ?></td>
					<td class="column-total"><?php echo wc_price( $ywpi_document->order->get_total() ); ?></td>
				</tr>
			</table>
		</td>
	</tr>

</table>