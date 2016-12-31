<div class="invoice-document">
	<div class="company-header">
		<table>
			<tr>
				<td class="invoice-from-section">
					<?php
					/**
					 * yith_ywpi_invoice_template_sender hook
					 *
					 * @hooked show_invoice_template_sender - 10 (Render and show data to "sender section" on invoice template)
					 */
					do_action( 'yith_ywpi_invoice_template_sender' );
					?>

				</td>
				<td class="invoice-logo">
					<?php
					/**
					 * yith_ywpi_invoice_template_company_logo hook
					 *
					 * @hooked show_invoice_template_company_logo - 10 (Show company logo on invoice template)
					 */
					do_action( 'yith_ywpi_invoice_template_company_logo' );
					?>
				</td>
			</tr>

		</table>

	</div>

	<div class="invoice-header">
		<table>
			<tr>
				<td class="invoice-to-section">
					<?php
					/**
					 * yith_ywpi_invoice_template_customer_data hook
					 *
					 * @hooked show_invoice_template_customer_details - 10 (Show data of customer on invoice template)
					 */
					do_action( 'yith_ywpi_invoice_template_customer_data' );
					?>
				</td>
				<td class="invoice-data">
					<?php
					/**
					 * yith_ywpi_invoice_template_invoice_data hook
					 *
					 * @hooked show_invoice_template_customer_details - 10 (Show data of customer on invoice template)
					 */
					do_action( 'yith_ywpi_invoice_template_invoice_data' );
					?>
				</td>
			</tr>
		</table>
	</div>


	<div class="invoice-content">
		<?php
		/**
		 * yith_ywpi_invoice_template_products_list hook
		 *
		 * @hooked show_invoice_products_list_template - 10 (Show products list)
		 */
		do_action( 'yith_ywpi_invoice_template_products_list' );
		?>
	</div>

	<?php
	/**
	 * yith_ywpi_invoice_template_footer hook
	 *
	 * @hooked show_document_footer_template - 10 (add data on footer)
	 */
	do_action( 'yith_ywpi_invoice_template_footer' );
	?>

</div>