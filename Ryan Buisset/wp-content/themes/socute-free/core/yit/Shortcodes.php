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
 * Class to manage shortcodes
 * 
 * @since 1.0.0
 */
class YIT_Shortcodes {

	/**
	 * Shortcodes
	 * 
	 * The array is created by using the following rules:
	 * 
	 * [shortcode_name] => array(
	 *     [title] => 'title',
	 *     [description] => 'description',
	 *     [has_content] => true,
	 *     [attributes] => array(
	 *       [param1_name] => array(
	 *        'type' => 'param1_type',
	 * 		  'std'  => 'param1_std'
	 * 	    )
	 * 	    [param2_name] => array(
	 *        'type' => 'param2_type',
	 * 		  'std'  => 'param2_std'
	 * 	    )
	 *    )
	 * )
	 * 
	 * @var array
	 * 
	 */
	public $shortcodes = array();
	
	/**
	 * Constructor
	 * 
	 */
	public function __construct() {
		global $name_tab;
		$name_tab = apply_filters( 'yit_shortcodes_tabs', array(
			'shortcodes' => __('Shortcodes', 'yit'),
			'section' => __('Section', 'yit'),
			'cpt' => __('Post Type', 'yit')
		) );
	}
	
	
	/**
	 * Init
	 * 
	 */
	public function init() {
		add_action('wp_enqueue_scripts', array(&$this, 'add_shortcodes_css_js'));
		
		$awesome_icons = $this->get_awesome_icons();
		
		$shortcodes = array(
            /* === TWITTER === */
            'twitter' => array(
            	'title' => __('Twitter', 'yit' ),
            	'description' =>  __('Print a list of last tweets', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
                    'username' => array(
                        'title' => __('Username', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'consumer_key' => array(
                        'title' => __('Consumer Key', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'consumer_secret' => array(
                        'title' => __('Consumer Secret', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'access_token' => array(
                        'title' => __('Access Token', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'access_token_secret' => array(
                        'title' => __('Access Token Secret', 'yit'),
                        'type' => 'text',
                        'std'  => ''
                    ),
                    'items' => array(
                        'title' => __('N. of items', 'yit'),
                        'type' => 'number',
                        'std'  => '5'
                    ),
                    'class' => array(
                        'title' => __('CSS class', 'yit'),
                        'type' => 'text',
                        'std'  => 'last-tweets-widget'
                    ),
                    'time' => array(
                        'title' => __('Time', 'yit'),
                        'type' => 'checkbox',
                        'std'  => 'yes'
                    ),
            	)
            ),
            /* === LINE === */
            'line' => array(
                'title' => __('Print line', 'yit' ),
                'description' =>  __('Print a line', 'yit' ),
                'tab' => 'shortcodes',
                'has_content' => false,
                'attributes' => array(
                ),
                'hide' => true
            ),
            /* === TESTIMONIALS === */
            'testimonials' => array(
            	'title' => __('Testimonials', 'yit' ),
            	'description' =>  __('Show all post on testimonials post types', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'items' => array(
            			'title' => __('N. of items', 'yit'),
            			'type' => 'number', 
            			'std'  => ''
            		)
            	)
            ),
            /* === CONTACT INFO === */
            'contact_info' => array(
            	'title' => __('Contact info', 'yit' ),
            	'description' =>  __('Show a contact info', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'title' => array(
            			'title' => __('Title', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'address' => array(
            			'title' => __('Address', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'address_icon' => array(
            			'title' => __('Address icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'phone' => array(
            			'title' => __('Phone', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'phone_icon' => array(
            			'title' => __('Phone icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'mobile' => array(
            			'title' => __('Mobile', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'mobile_icon' => array(
            			'title' => __('Mobile icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'fax' => array(
            			'title' => __('Fax', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'fax_icon' => array(
            			'title' => __('Fax icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            		'email' => array(
            			'title' => __('E-mail', 'yit'),
            			'type' => 'text', 
            			'std'  => ''
            		),
            		'email_icon' => array(
            			'title' => __('E-mail icon', 'yit'),
            			'type' => 'select',
            			'options' => $awesome_icons,
            			'std'  => ''
            		),
            	)
            ),
            /* === TESTIMONIALS SLIDER === */
            'testimonials_slider' => array(
            	'title' => __('Testimonials slider', 'yit' ),
            	'description' =>  __('Show a slider with testimonials', 'yit' ),
            	'tab' => 'shortcodes',
            	'has_content' => false,
            	'attributes' => array(
            		'items' => array(
            			'title' => __('N. items', 'yit'),
            			'type' => 'number', 
            			'std'  => ''
            		),
            		'excerpt' => array(
            			'title' => __('Limit words', 'yit'),
            			'type' => 'number', 
            			'std'  => '32'
            		),
            		'speed' => array(
            			'title' => __('Speed (ms)', 'yit'),
            			'type' => 'number', 
            			'std'  => '500'
            		),
            		'timeout' => array(
            			'title' => __('Time out (ms)', 'yit'),
            			'type' => 'number', 
            			'std'  => '5000'
            		)
            	)
            ),
            /* === START SECTIONS === */
            'section' => array(
                'title' => __( 'Section', 'yit' ),
                'description' => __( 'Print a specified section type.', 'yit' ),
                'tab' => 'section',
            	'has_content' => false,
                'attributes' => array(
                    'type' => array(
                        'title' => __('Type', 'yit'),
            			'type' => 'select', //blog|portfolio|services|gallery
            			'options' => array(
							'services' => __('Services', 'yit'),
						),
                        'std' => ''
                    ),
                    'items' => array(
                        'title' => __('N. of items', 'yit'),
            			'type' => 'number',
                        'std' => '-1'
                    ),
                    'title' => array(
                        'title' => __('Title', 'yit'),
            			'type' => 'text',
                        'std' => ''
                    ),
                    'description' => array(
                        'title' => __('Description', 'yit'),
            			'type' => 'text',
                        'std' => ''
                    ),
                    'category' => array(
                        'title' => __('Category', 'yit'),
            			'type' => 'select', // list of category
                        'std' => '0'
                    ),
                    'portfolio' => array(
                        'title' => __('Portfolio', 'yit'),
            			'type' => 'select',
                        'std' => ''
                    ),
                    'show_excerpt' => array(
                        'title' => __('Show excerpt', 'yit'),
            			'type' => 'select',
                        'std' => 'yes'
                    ),
                    'excerpt_length' => array(
                        'title' => __('Limit words', 'yit'),
            			'type' => 'number',
                        'std' => '10'
                    ),
                    'show_title' => array(
                        'title' => __('Show title', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_comments' => array(
                        'title' => __('Show comments', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_date' => array(
                        'title' => __('Show date', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_readmore' => array(
                        'title' => __('Show read more', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'no'
                    ),
                    'readmore_text' => array(
                        'title' => __('More text', 'yit'),
            			'type' => 'text',
                        'std' => __( '|| Read more', 'yit' )
                    ),
 					'show_overlay' => array(
                        'title' => __('Show overlay', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
					),
                    'show_lightbox_hover' => array(
                        'title' => __('Show lightbox hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'no'
                    ),
                    'show_detail_hover' => array(
                        'title' => __('Show detail hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_title_hover' => array(
                        'title' => __('Show title hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_categories' => array(
                        'title' => __('Show categories', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_featured' => array(
                        'title' => __('Show featured', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'featured_excerpt_length' => array(
                        'title' => __('Limit words', 'yit'),
            			'type' => 'number',
                        'std' => '0'
                    ),
                    'other_posts_label' => array(
                        'title' => __('Other posts label', 'yit'),
                        'type' => 'text',
                        'std' => __( 'Other articles', 'yit' )
                    )
                ),
                'hide' => true
            ),
            /* === SECTION -> SERVICES === */
            'section_services' => array(
                'title' => __( 'Services', 'yit' ),
                'description' => __( 'Print a services type.', 'yit' ),
                'tab' => 'section',
            	'has_content' => false,
                'attributes' => array(                    
                    'items' => array(
                        'title' => __('N. of items', 'yit'),
                        'description' => __('Show all with -1', 'yit'),
            			'type' => 'number',
                        'std' => '-1'
                    ),
                    'title' => array(
                        'title' => __('Title', 'yit'),
            			'type' => 'text',
                        'std' => ''
                    ),
                    'description' => array(
                        'title' => __('Description', 'yit'),
            			'type' => 'text',
                        'std' => ''
                    ),
                    'show_excerpt' => array(
                        'title' => __('Show excerpt', 'yit'),
            			'type' => 'checkbox',
            			'std' => 'yes'
                    ),
                    'excerpt_length' => array(
                        'title' => __('Limit words', 'yit'),
            			'type' => 'number',
                        'std' => '10'
                    ),
                    'show_title' => array(
                        'title' => __('Show title', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_detail_hover' => array(
                        'title' => __('Show detail hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                    'show_title_hover' => array(
                        'title' => __('Show title hover', 'yit'),
            			'type' => 'checkbox',
                        'std' => 'yes'
                    ),
                )
            ),
            /* === END SECTION === */
        );
		$this->shortcodes = apply_filters( 'yit_add_shortcodes', $shortcodes );
		asort( $this->shortcodes );
		$this->add_shortcodes();
	}
	
	
	/**
	 * Register shortcodes
	 * 
	 */
	public function add_shortcodes() {
		foreach( $this->shortcodes as $shortcode=> $atts) {
		    if ( isset( $atts['create'] ) && ! $atts['create'] ) continue;
			add_shortcode( $shortcode, array( &$this, 'add_shortcode') );
		}
	}
	
	
	/**
	 * Shortcode callback
	 * 
	 * @param $atts array()
	 * @param $content mixed
	 * @param $shortcode string
	 * 
	 * @return string
	 */
	public function add_shortcode( $atts, $content = null, $shortcode ) {
	
	    $all_atts = $atts;
	    $all_atts['content'] = $content;
		
		if( isset($this->shortcodes[$shortcode]['unlimited']) && $this->shortcodes[$shortcode]['unlimited'] ) {
			$atts['content'] = $content;
		} else {
			//retrieves default atts
			$default_atts = array();
			
			if( !empty( $this->shortcodes[$shortcode]['attributes'] ) ) {
				foreach( $this->shortcodes[$shortcode]['attributes'] as $name=>$type ) {
					$default_atts[$name] = isset($type['std']) ? $type['std'] : '';
				}
			}

			//combines with user attributes
			$atts = shortcode_atts( $default_atts, $atts);
			$atts['content'] = $content;
		}
		
		// remove validate attrs
		foreach ( $atts as $att => $v ) unset( $all_atts[$att] );
		
		ob_start();
		yit_get_template( 'shortcodes/'.$shortcode.'.php', array_merge( $atts, array( 'other_atts' => $all_atts ) ) );
		$shortcode_html = ob_get_clean();
		
		return apply_filters( 'yit_shortcode_' . $shortcode, $shortcode_html );
	}
	
	/**
	 * Add shortcodes style
	 * 
	 */
	public function add_shortcodes_css_js() {
	    $url = get_template_directory_uri() . '/core/assets/css/shortcodes.css';
	    yit_wp_enqueue_style(1200,'shortcodes_css', $url);
	  
	    wp_enqueue_script('shortcode_twitter', get_template_directory_uri() . '/core/assets/js/twitter-text.js', array('jquery'), '', true );
	    //yit_wp_enqueue_style(1200,'shortcode_twitter');
	  
	    yit_wp_enqueue_style(1200,'shortcode_tipsy_css', get_template_directory_uri() . '/core/assets/css/tipsy.css', array('jquery'), '', true );
	    wp_enqueue_script('shortcode_tipsy_js', get_template_directory_uri() . '/core/assets/js/jquery.tipsy.js', array('jquery'), '', true );
	    //yit_wp_enqueue_style(1200,'shortcode_tipsy_js');
	  
	    wp_enqueue_script('shortcode_cycle_js', get_template_directory_uri() . '/core/assets/js/jquery.cycle.min.js', array('jquery'), '', true );
  	    //yit_wp_enqueue_style(1200,'shortcodes_cycle_js');
	  
	    wp_enqueue_script('shortcode_js', get_template_directory_uri() . '/core/assets/js/shortcodes.js', array('jquery'), '', true );
	    //yit_wp_enqueue_style(1200,'shortcodes_js');
	  
	}
	
	/**
	 * Get CSS style of button to show in Color select menu
	 * 
	 */
	public function get_awesome_icons(){				
		$config = YIT_Config::load();
		return $config['awesome_icons'];
	}

}