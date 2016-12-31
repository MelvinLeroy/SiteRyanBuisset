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
 
/**
 * Class to print fields in the tab Shop -> Products details page
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Products_details_page extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_products_details_page
     * 
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }
    
    /**
     * Set default values
     * 
     * @return array
     * @since 1.0.0
     */
    public function init() {
        return array(
            40 => array(
                'id'   => 'shop-single-show-breadcrumb',
                'type' => 'onoff',
                'name' => __( 'Show breadcrumb', 'yit' ),
                'desc' => __( 'Say if you want the breadcrumb in the product detail page.', 'yit' ),
                'std'  => true,
            ),
        	60 => array(
                'id'   => 'shop-products-details-title',
                'type' => 'onoff',
                'name' => __( 'Show products details page title', 'yit' ),
                'desc' => __( 'Activate/Deactivate the page title on Products details.', 'yit' ),
                'std'  => true,
            ),
            170 => array(
                'id'   => 'shop-detail-show-price',
                'type' => 'onoff',
                'name' => __( 'Show price', 'yit' ),
                'desc' => __( 'Select if you want to show a the price on the products list.', 'yit' ),
				'std' => 1
            ),
            180 => array(
                'id'   => 'shop-detail-add-to-cart',
                'type' => 'onoff',
                'name' => __( 'Show button add to cart', 'yit' ),
                'desc' => __( 'Select if you want to show the purchase button.', 'yit' ),
				'std' => 1
            ),
            270 => array(
                'type' => 'title',
                'name' => __( 'Related products', 'yit' ),
                'desc' => __( 'Manage the related products.', 'yit' )
            ),
            275 => array(
                'id'   => 'shop-show-related',
                'type' => 'onoff',
                'name' => __( 'Show related products', 'yit' ),
                'desc' => __( 'Select if you want to display Related Products.', 'yit' ),
                'std'  => 1
            ),
            280 => array(
                'id'   => 'shop-show-custom-related',
                'type' => 'onoff',
                'name' => __( 'Custom Related Products number', 'yit' ),
                'desc' => __( 'Select if you want to customize the number of Related Products. Note: if you are already using a custom filter to do that, please don\'t enable this option.', 'yit' ),
                'std'  => 0,
                'deps' => array(
                    'ids' => 'shop-show-related',
                    'values' => 1
                ),
            ),
            290 => array(
                'id'   => 'shop-number-related',
                'type' => 'number',
                'name' => __( 'Number of Related Products', 'yit' ),
                'desc' => __( 'Select the total numbers of the related products displayed, on the product detail page. Note: related products are displayed randomly from Woocommerce. Sometimes the number of related products could be less than the number of items selected. This number depends from the query plugin, not from the theme.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-number-related_std', 3 ),
                'min'  => 1,
                'deps' => array(
					'ids' => 'shop-show-custom-related',
					'values' => 1
				),
            ),
            300 => array(
                'id'   => 'shop-show-metas',
                'type' => 'onoff',
                'name' => __( 'Show product metas (categories and tags)', 'yit' ),
                'desc' => __( 'Say if you want to show product metas in your single product page. It also remove Bands if you are using WooCommerce Brands Addon.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-show-metas_std', 1 ),
            ),
        );
    }
}