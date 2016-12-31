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
 
function yit_tab_pages_404( $items ) {
    unset( $items[15] );

    $items[50] = array(
        'id'   => '404-no-header-footer',
        'type' => 'onoff',
        'name' => __( 'Hide header and footer', 'yit' ),
        'desc' => __( 'Say if you want to hide the header and footer in the 404 page.', 'yit' ),
        'std'  => 0
    );
    
    return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_pages_404', 'yit_tab_pages_404' );