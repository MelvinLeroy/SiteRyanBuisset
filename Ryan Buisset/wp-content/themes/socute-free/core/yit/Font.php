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
 * Fonts handler.
 * It can handle Goolge Fonts and Web fonts
 * @since 1.0.0
 */
class YIT_Font {
    /**
     * Web fonts array
     * 
     * @var array
     * @since 1.0.0
     */
    public $web;
    
    /**
     * Google fonts array
     * 
     * @var array
     * @since 1.0.0
     */
    public $google;
    
    /**
     * Set web and google fonts
     * 
     * @since 1.0.0
     */
    public function __construct() {}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
        add_action( 'admin_print_scripts', array( &$this, 'print_ajax_request' ), 20 );
        add_action( 'wp_ajax_retrieve_google_fonts', array( &$this, 'retrieve_google_fonts_callback' ) );
        add_action( 'init', array( &$this, 'load_options_font' ) );
        
        $this->web = $this->_get_web_fonts();
        $this->google = $this->_get_google_fonts();
        
        $theme_options_fonts = yit_get_option_by( 'type', 'typography' );
    }
    
    /**
     * Load Google Fonts stylesheets
     * 
     * @return void
     * @since 1.0.0
     */
    public function load_options_font() {
        $theme_options_fonts = yit_get_option_by( 'type', 'typography' );
        $google_fonts = yit_get_google_fonts();
        $google_fonts = array_map( 'stripslashes', ( array ) $google_fonts->items );
        
        foreach( $theme_options_fonts as $option ) {
            $option_value = yit_get_option( $option['id'] );

            if ( $option_value['family'] != $option['std']['family'] ) {
                // Prevent Undefined Index
                if ( ! array_key_exists( 'family', $option_value ) ) {
                    continue;
                }
                $family = $option_value['family'];
            }
            else {
                $family = $option['std']['family'];
            }
            
            if( in_array( $family, $google_fonts ) ) {      
                //yit_wp_enqueue_style( 600, 'font-' . sanitize_title( preg_replace( '/:(.*)?/', '', $option['std']['family'] ) ), yit_ssl_url( 'http://fonts.googleapis.com/css?family=' . $option['std']['family'] ) );
                yit_add_google_font( $family );
            }
        }
    }
    
    /**
     * Send a request to Google and retrive a list of fonts. Then send it to an internal method
     * which will cache json datas.
     * 
     * @return void
     * @since 1.0.0
     */
    public function print_ajax_request() {
        $cache = yit_get_model( 'cache' );
        if( $cache->is_expired( 'google_fonts.json' ) ) :
            ?>
            <script type="text/javascript">
            jQuery( document ).ready( function ( $ ) {
                var fonts = null;
                $.ajax({
    				//url: "https://www.googleapis.com/webfonts/v1/webfonts",
    				url: "http://niubbys.altervista.org/google_fonts.php",
    				dataType: "jsonp",
                    success: function( ret ) {
                        var data = {
                    		action: 'retrieve_google_fonts',
                            google_fonts : ret
                    	};
                    
              	        //since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                    	$.post( ajaxurl, data, function( response ) {} );    
                    }
                });
            });
            </script>
            <?php
        endif;
    }
    
    /**
     * Save json Google Fonts in the cache
     * 
     * @return void
     * @since 1.0.0
     */
    public function retrieve_google_fonts_callback() {
        if( isset( $_POST['google_fonts'] ) ) {
            $fonts = $_POST['google_fonts'];
            $fonts = apply_filters( 'yit_google_fonts', $fonts );
            
            $cache = yit_get_model( 'cache' );
            if( $cache->is_expired( 'google_fonts.json' ) ) {
                $cache->save( 'google_fonts.json', json_encode( $fonts ) );    
            }
        }
        
        die();
    }
    
    /**
     * Get a list of web fonts
     * 
     * @return array
     * @since 1.0.0
     */
    protected function _get_web_fonts() {
        $fonts = array(
            'Arial' => 'Arial, Helvetica',
            'Arial Black' => '"Arial Black", Gadget',
            'Comic Sans MS' => '"Comic Sans MS", cursive',
            'Courier New' => '"Courier New", Courier, monospace',
            'Georgia' => 'Georgia',
            'Impact' => 'Impact, Charcoal',
            'Lucida Console' => '"Lucida Console", Monaco, monospace',
            'Lucida Sans Unicode' => '"Lucida Sans Unicode", "Lucida Grande"',
            'Thaoma' => 'Tahoma, Geneva',
            'Trebuchet MS' => '"Trebuchet MS", Helvetica',
            'Verdana' => 'Verdana, Geneva'
        );
        
        return apply_filters( 'yit_web_fonts', $fonts );
    }
    
    /**
     * Get a list of google fonts
     * 
     * @return array
     * @since 1.0.0
     */
    protected function _get_google_fonts() {
        $cache = yit_get_model( 'cache' );
        return json_decode( $cache->read( 'google_fonts.json' ) );
    }
}

if( !function_exists( 'yit_get_google_fonts' ) ) {
    /**
     * Return google fonts list
     * 
     * @return object
     * @since 1.0.0
     */
    function yit_get_google_fonts() {
        $font = yit_get_model( 'font' );
        return $font->google;
    }
}

if( !function_exists( 'yit_get_web_fonts' ) ) {
    /**
     * Return web fonts list
     * 
     * @return array
     * @since 1.0.0
     */
    function yit_get_web_fonts() {
        $font = yit_get_model( 'font' );
        return $font->web;
    }
}