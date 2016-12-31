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
 * YIT Buy Themes submenu page
 * 
 * 
 * @since 1.0.0
 */

class YIT_Submenu_Premium extends YIT_Submenu_Abstract {
    
    /**
     * Menu items
     * 
     * @var array
     * @since 1.0.0
     */
    public $_menu = array();
    
    /**
     * Submenu items
     * 
     * @var array
     * @since 1.0.0
     */
    public $_submenu = array();
    

	/**
	 * Constructor
	 * 
	 */
	public function __construct($tabPath, $tabName) {
		$this->init();
		parent::__construct($tabPath, $tabName);
	}

    /**
	 * Init helper method
     * 
	 */
	public function init() {
	    $this->_menu = apply_filters( 'yit_admin_menu_premium', array() );

        if( isset( $_GET['page'] ) && $_GET['page'] == 'yit_panel_premium' ) {
        	add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        }
	}
    
    /**
     * Should print the menu but here it's not needed.
     * 
     * @return bool
     * @since 1.0.0
     */
    public function get_menu($id) {
        return false;
    }
	
	/**
	 * Support forum url
	 * 
	 * @var string
	 */
	protected $_url = 'http://yithemes.com';
	
	
	/**
	 * Enqueue style and scripts
	 * 
	 * @return void
     * @since 1.0.0
	 */
	public function enqueue_scripts() {
	   $base_url = 'http://yithemes.com/wp-content/themes/maya-2';
	   
	   //wp_enqueue_style( 'landing-style', "$base_url/style.css" );
	   
	   wp_enqueue_style( 'pacifico-font', 'http://fonts.googleapis.com/css?family=Pacifico&#038;subset=latin%2Ccyrillic%2Cgreek' );
	   wp_enqueue_style( 'nunito-font', 'http://fonts.googleapis.com/css?family=Nunito&#038;subset=latin%2Ccyrillic%2Cgreek' ); 
	   wp_enqueue_style( 'droid-sans-font', 'http://fonts.googleapis.com/css?family=Droid+Sans&#038;subset=latin%2Ccyrillic%2Cgreek' );  
	   wp_enqueue_style( 'shadows-into-light-font', 'http://fonts.googleapis.com/css?family=Shadows+Into+Light&#038;subset=latin%2Ccyrillic%2Cgreek' ); 
	   wp_enqueue_style( 'oswald-font', 'http://fonts.googleapis.com/css?family=Oswald%3A400%2C700' );
	   wp_enqueue_style( 'landing-bolder', "$base_url/landings/style.css" );
	   //wp_enqueue_style( 'landing-specific-bolder', "$base_url/landings/bolder/style.css" );
	}
	
	
	/**
	 * Print an iframe for the shop
	 * 
	 * @return void
     * @since 1.0.0
	 */
	public function display_page() {
	   yit_get_template( 'admin/panel/premium.php' );   
	}
	
}
