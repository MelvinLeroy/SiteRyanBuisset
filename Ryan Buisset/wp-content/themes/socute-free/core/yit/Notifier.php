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
 * Manage Theme Updates.
 * 
 * @since 1.0.0
 */
class YIT_Notifier {
	
	/**
	 * The time interval for the remote XML cache in the database 
	 * (21600 seconds = 6 hours)
	 * 
	 * @var int
	 */
	protected $_interval = 21600;

	/**
	 * Constructor
	 */
	public function __construct() {}
	
	/**
	 * Init
	 * 
	 */
	public function init() {
        if( defined( 'YIT_SHOW_UPDATES' ) && YIT_SHOW_UPDATES ) {
            add_action('admin_menu', array( &$this, 'update_notifier_menu'));
            add_filter('yit_admin_tree', array( &$this, 'update_theme_options_menu'));
        }
	}
	
	/**
	 * Get the remote XML file contents and return its data (Version and Changelog)
	 * Uses the cached version if available and inside the time interval defined
	 * 
	 * @param $interval int
	 * @return XML object
	 */
	public function get_latest_theme_version($interval) {
	    $notifier_file_url = YIT_THEME_NOTIFIER_URL; 
	    $db_cache_field = 'notifier-cache_' . get_template();
	    $db_cache_field_last_updated = 'notifier-cache-last-updated_' . get_template();
	    $last = get_option( $db_cache_field_last_updated );
	    $now = time();
	    // check the cache
	    if ( !$last || (( $now - $last ) > $interval) ) {
	        // cache doesn't exist, or is old, so refresh it
// 	        if( function_exists('curl_init') ) { // if cURL is available, use it...
// 	            $ch = curl_init($notifier_file_url);
// 	            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	            curl_setopt($ch, CURLOPT_HEADER, 0);
// 	            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
// 	            $cache = curl_exec($ch);
// 	            curl_close($ch);
// 	        } else {
// 	            $cache = @file_get_contents($notifier_file_url); // ...if not, use the common file_get_contents()
// 	        }
            $remote_get = wp_remote_get( $notifier_file_url );
            $cache = wp_remote_retrieve_body( $remote_get );
	        
	        if ($cache) {           
	            // we got good results  
	            update_option( $db_cache_field, $cache );
	            update_option( $db_cache_field_last_updated, time() );
	        } 
	        // read from the cache file
	        $notifier_data = get_option( $db_cache_field );
	    }
	    else {
	        // cache file is fresh enough, so read from it
	        $notifier_data = get_option( $db_cache_field );
	    }
	    
	    // Let's see if the $xml data was returned as we expected it to.
	    // If it didn't, use the default 1.0.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	    if( strpos((string)$notifier_data, '<notifier>') === false ) {
	        $notifier_data = file_get_contents( YIT_CORE_TEMPLATES_DIR . '/admin/notifier/default.xml' );
	    }
	    
	    // Load the remote XML data into a variable and return it
	    $xml = @simplexml_load_string($notifier_data); 
	    
	    return $xml;
	}
	
	
	/**
	 * Adds an update notification to the WordPress Dashboard menu
	 * if the theme is not updated
	 * 
	 */
	public function update_notifier_menu() {
		$config = YIT_Config::load();
		  
        if( !$this->isUpdated() ) { // Compare current theme version with the remote XML version
            add_dashboard_page( YIT_THEME_NAME . ' Theme Updates', $config['theme']['name'] . ' <span class="update-plugins count-1"><span class="update-count">1</span></span>', 'administrator', 'theme-update-notifier', array( $this, 'display_page' ) );
		}
	}

	/**
	 * Adds an update notification to the WordPress Dashboard menu
	 * if the theme is not updated
	 * 
	 */
	public function update_theme_options_menu( $items ) {
        if( !$this->isUpdated() ) {
        	return array_merge( $items, array( 
				'update' => array(
					'parent_slug' => 'yit_panel',
					'page_title'  => 'Update Theme',
					'menu_title'  => 'Update Theme <span class="update-plugins count-1"><span class="update-count">1</span></span>',
					'capability'  => 'administrator',
					'menu_slug'   => 'yit_panel_update',
					'function'    => 'display_page',
					'deps'
				)
			));
		} else {
			return $items;
		}
	}
	
	/** 
	 * Returns if the theme needs to be updated
	 * 
	 * @return bool
	 */
	public function isUpdated() {
	    if (function_exists('simplexml_load_string')) { // Stop if simplexml_load_string funtion isn't available
	        $xml = $this->get_latest_theme_version( $this->_interval ); // Get the latest remote XML file on our server
	        
			$config = YIT_Config::load();
			$version = $config['theme']['version'];
	        
	        if ( ! is_object( $xml ) )
	            return;
	
	        return !version_compare($xml->latest, $version, '>');
	    } 
	}
	
	
	/**
	 * Return changelog
	 * 
	 * @return string
	 */
	public function getXml() {
		$db_cache_field = 'notifier-cache_' . get_template();
		$xml = $xml = @simplexml_load_string(get_option( $db_cache_field )); 
		
		return $xml;
	}       
	
	
	/**
	 * Print the update page
	 * 
	 * @return void
     * @since 1.0.0
	 */
	public function display_page() {
		$config = YIT_Config::load();
		$name = $config['theme']['name']; 
		yit_get_template( 'admin/panel/notifier.php', $config['theme'] );
	}
}