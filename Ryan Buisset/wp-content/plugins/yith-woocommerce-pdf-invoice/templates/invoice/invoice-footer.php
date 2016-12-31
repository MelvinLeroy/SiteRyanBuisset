<?php if ( 'yes' == get_option( 'ywpi_show_invoice_notes' ) ) : ?>
	<div class="notes">
		<span class="notes-title"><?php _e("Notes", 'yith-woocommerce-pdf-invoice'); ?></span>
		<span><?php echo nl2br( get_option( 'ywpi_invoice_notes' ) ); ?></span>
	</div>
<?php endif; ?>

<?php if ( 'yes' == get_option( 'ywpi_show_invoice_footer' ) ) : ?>
	<footer>
		<span><?php echo nl2br( get_option( 'ywpi_invoice_footer' ) ); ?></span>
	</footer>
<?php endif; ?>
