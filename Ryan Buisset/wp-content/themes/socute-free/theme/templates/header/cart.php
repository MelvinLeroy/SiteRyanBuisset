<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if( ! is_shop_installed() || ! is_shop_enabled() || ! yit_get_option('show-header-woocommerce-cart') ) return;
?>
<div class="woo_cart<?php if ( !yit_get_option('responsive-show-header-cart') ) echo ' hidden-phone' ?>">
    <?php the_widget('YIT_Widget_Cart') ?>
</div>
