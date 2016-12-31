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
 * Class to print fields in the tab Shop -> Products page
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Shop_Products_page extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_shop_products_page
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
        	10 => array(
                'id'   => 'shop-products-title',
                'type' => 'onoff',
                'name' => __( 'Show products page title', 'yit' ),
                'desc' => __( 'Activate/Deactivate the page title on Products.', 'yit' ),
                'std'  => true,
            ),
            18 => array(
                'id'   => 'shop-show-breadcrumb',
                'type' => 'onoff',
                'name' => __( 'Show breadcrumb', 'yit' ),
                'desc' => __( 'Say if you want the breadcrumb in the shop pages.', 'yit' ),
                'std'  => true,
            ),
            30 => array(
                'id'   => 'shop-view-show-title',
                'type' => 'onoff',
                'name' => __( 'Show product title', 'yit' ),
                'desc' => __( 'Say if you want to show the product title.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-title_std', 1 )
            ),
            40 => array(
                'id'   => 'shop-view-show-price',
                'type' => 'onoff',
                'name' => __( 'Show product price', 'yit' ),
                'desc' => __( 'Say if you want to show the product price.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-price_std', 1 )
            ),  
            45 => array(
                'id'   => 'shop-view-show-rating',
                'type' => 'onoff',
                'name' => __( 'Show product rating', 'yit' ),
                'desc' => __( 'Say if you want to show the product rating.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-rating_std', 1 )
            ),  
            50 => array(
                'id'   => 'shop-view-show-add-to-cart',
                'type' => 'onoff',
                'name' => __( 'Show add to cart icon', 'yit' ),
                'desc' => __( 'Say if you want to show the details icon.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-view-show-add-to-cart_std', 1 )
            ),
            100 => array(
                'id'   => 'shop-added-icon',
                'type' => 'upload',
                'name' => __( 'Added icon', 'yit' ),
                'desc' => __( 'Change the icon for the Added feedback message, when you add to cart a product in AJAX.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-added-icon_std', get_template_directory_uri() . '/woocommerce/images/bullets/added.png' ),
                'style' => array(
                	'selectors' => '.woocommerce ul.products li.product span.added',
                	'properties' => 'background-image'
				)
            ),   
            110 => array(
                'id'   => 'shop-open-hover',
                'type' => 'onoff',
                'name' => __( 'Force open hover', 'yit' ),
                'desc' => __( 'Force to open the hover box.', 'yit' ),
                'std'  => apply_filters( 'yit_shop-open-hover_std', 0 )
            ),
            120 => array(
                'id'   => 'shop-featured-image-size',
                'type' => 'imagesize',
                'name' => __( 'Featured image size', 'yit' ),
                'desc' => __( 'Set the image size for featured products', 'yit' ),
                'std'  => array(
                    'width' => 160,
                    'height' => 160,
                    'crop' => true
                )
            ),
        );
    }
}