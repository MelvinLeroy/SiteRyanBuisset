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
 * Wordpress Admin Dashboard Management
 * 
 * @since 1.0.0
 */
class YIT_Dashboard {
	/**
	 * Products URL
	 * 
	 * @var string
	 * @access protected
	 * @since 1.0.0
	 */
	protected $_productsFeed = 'http://yithemes.com/feed/?post_type=product';
	protected $_blogFeed = 'http://yithemes.com/feed/';
    protected $_dashboard_path ;
    protected $_dashboard_link ;


	
	/**
	 * Constructor
	 */
	public function __construct() {
        $this->_dashboard_path = get_stylesheet_directory() .'/buy-premium.php' ;
        $this->_dashboard_link = get_stylesheet_directory_uri() .'/buy-premium.php' ;

		add_action( 'wp_dashboard_setup', array($this, 'dashboard_widget_setup' ) );
        add_action('admin_notices', array($this, 'print_banner') );
        add_action('admin_init', array($this, 'dismiss_message') );
	}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		
	}
	
	/**
	 * Dashboard widget setup
	 * 
	 * @return void
	 * @since 1.0.0
	 * @access public
	 */
	public function dashboard_widget_setup() {
		global $wp_meta_boxes;
		
	    wp_add_dashboard_widget( 'yit_dashboard_products_news', __( 'Our latest themes' , 'yiw' ), array($this, 'dashboard_products_news') );
	    wp_add_dashboard_widget( 'yit_dashboard_blog_news', __( 'News from the YIT Blog' , 'yiw' ), array($this, 'dashboard_blog_news') );  	

		$widgets_on_side = array(
	        'yit_dashboard_products_news',
	        'yit_dashboard_blog_news'
	    );
		
	    foreach( $widgets_on_side as $meta ) {
	        $temp = $wp_meta_boxes['dashboard']['normal']['core'][$meta];
	        unset($wp_meta_boxes['dashboard']['normal']['core'][$meta]);
	        $wp_meta_boxes['dashboard']['side']['core'][$meta] = $temp;
	    }
	}
	
	
	/**
	 * Product news Widget
	 * 
	 * @return void
	 * @since 1.0.0
	 * @access public
	 */
	public function dashboard_products_news() {
		$args = array( 'show_author' => 1, 'show_date' => 1, 'show_summary' => 0, 'items'=>10 );
		wp_widget_rss_output( $this->_productsFeed, $args );
	}	
	
	
	/**
	 * Blog news Widget
	 * 
	 * @return void
	 * @since 1.0.0
	 * @access public
	 */
	public function dashboard_blog_news() {
		$args = array( 'show_author' => 1, 'show_date' => 1, 'show_summary' => 0, 'items'=>10 );
		wp_widget_rss_output( $this->_blogFeed, $args );
	}


    /**
     * Print banner in dashboard pagina
     */
    public function print_banner() {

        global $pagenow;

        if( get_transient('yit_dashboard_message_dismiss') == 'yes' ) return;

        $defaults = array(
            'slug' => '',
            'url' => '',
            'img' => YIT_CORE_URL .'/assets/images/buy-premium.png',
            'price' => '65',  // default price, if any response from remote
        );
        $args = wp_parse_args( include( $this->_dashboard_path ), $defaults );
        extract( $args );

        // the price is automatic retrieved from the landing page of yithemes, change the value below only for the first publication
        if ( false === ( $price = get_transient( 'yit_theme_price_' . get_template() ) ) ) {
            $requrl = 'http://yithemes.com/?wc-api=yit_theme_price&theme=' . $slug;

            $response = wp_remote_get( $requrl );
            if ( ! is_wp_error( $response ) ) {
                $remote_price = wp_remote_retrieve_body( $response );
                $price = $remote_price != 'NULL' ? $remote_price : $price;
                set_transient( 'yit_theme_price_' . get_template(), $price, WEEK_IN_SECONDS );
            }
        }

        ob_start();

        ?>

        <div style='position:relative; background: transparent; border: none; padding: 0;' class='yit-dashboard-message updated'>
            <div style='display: inline-block; position: relative;'>
                <a href='<?php echo $url ?>' target='_blank'>
                    <div class="yith-premium-banner-buy" style="position: relative;">
                        <div class="price-premium-buy" style="position: absolute;  color: #ffffff;  font-weight: bolder;  font-size: 18px;  top: 93px;  left: 746px;"><?php echo '$ ' . $price ?></div>
                        <img src="<?php echo $img ?>" class="img-banner-premium-buy">
                    </div>
                </a>
                <a href='<?php echo admin_url('?yit_dashboard_message_dismiss') ?>' class='dismiss' style='position: absolute; right: 14px; top: 40px; background: url("<?php echo YIT_CORE_ASSETS_URL .'/images/dismiss.png' ?>") no-repeat; width: 82px; height: 23px;'></a>
            </div>
        </div>

        <?php

        $result = ob_get_clean();

        echo $result;
    }

    /**
     * Dismiss message
     */
    function dismiss_message() {
        if( isset( $_GET['yit_dashboard_message_dismiss'] ) ) {
            set_transient('yit_dashboard_message_dismiss', 'yes', 4 * WEEK_IN_SECONDS);
            wp_redirect( admin_url() );
            exit();
        }
    }
}