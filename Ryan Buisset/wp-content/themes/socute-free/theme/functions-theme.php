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
 * Theme setup file
 */

/**
 * Set up all theme data.
 * 
 * @return void
 * @since 1.0.0
 */
function yit_setup_theme() {    
    //Content width. WP require it. So give to WordPress what is of WordPress
    if( !isset( $content_width ) ) { $content_width = yit_get_option( 'container-width' ); }
    
    //This theme have a CSS file for the editor TinyMCE
    add_editor_style( 'css/editor-style.css' );
    
    //This theme support post thumbnails
    add_theme_support( 'post-thumbnails' );
    
    //This theme uses the menues
    add_theme_support( 'menus' );
    
    //Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );
    
    //This theme support post formats
    add_theme_support( 'post-formats', apply_filters( 'yit_post_formats_support', array( 'gallery', 'audio', 'video', 'quote' ) ) );

    // Title tag
    add_theme_support( "title-tag" );

    if ( ! defined( 'HEADER_TEXTCOLOR' ) )
        define( 'HEADER_TEXTCOLOR', '' );

    // The height and width of your custom header. You can hook into the theme's own filters to change these values.
    // Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'yiw_header_image_width', 1170 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'yiw_header_image_height', 410 ) );     
    
    // Don't support text inside the header image.
    if ( ! defined( 'NO_HEADER_TEXT' ) )
        define( 'NO_HEADER_TEXT', true );
    
    //This theme support custom header
    add_theme_support( 'custom-header' );
    
    //This theme support custom backgrounds
    add_theme_support( 'custom-backgrounds' );
    
    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 940 pixels wide by 198 pixels tall.
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    // set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );    
    $image_sizes = array(
        'blog_small_image' => array( 465, 421, true ),
        'blog_big'     => array( 864, 421, true ),
        'blog_thumb'   => array( 49, 49, true ),
        'section_blog' => array( 270, 270, true ),
        'section_services' => array( 175, 175, true ),
        'section_portfolio' => array( 270, 270, true ),
        'section_portfolio_large' => array( 270, 370, true ),
        'section_portfolio_small' => array( 270, 170, true ),
        'thumb-testimonial' => array( 160, 160, true ),
        'thumb-testimonial-quote' => array( 160, 160, true ),
        'thumb_portfolio_fulldesc_related' => array( 270, 170, true ),
        'thumb_portfolio_bigimage' => array( 656, 0 ),
        'thumb_portfolio_filterable' => array( 270, 168, true ),
        'thumb_portfolio_fulldesc' => array( 574, 340, true ),
        'thumb_portfolio_fulldesc_big' => array( 1158, 400, true ),
        'portfolio_gallery_thumb' => array( 65, 65, true ),
        'section_video' => array( 162, 136, true ),
        'thumb_portfolio_2cols' => array( 570, 324, true ),
        'thumb_portfolio_3cols' => array( 370, 216, true ),
        'thumb_portfolio_4cols' => array( 270, 172, true ),
        'accordion_thumb' => array( 266, 266, true ),
        'team_rounded_thumb' => array( 130, 130, true ),
        'team_professional_thumb' => array( 270, 270, true ),
        'team_professional_mini_thumb' => array( 70, 70, true ),
        'featured_project_thumb' => array( 320, 154, true ),
        'thumb_portfolio_slide' => array( 560, 377, true ),
        'nav_menu' => array( 170, 0 ),
    );
    
    $image_sizes = apply_filters( 'yit_add_image_size', $image_sizes );
    
    foreach ( $image_sizes as $id_size => $size )               
        yit_add_image_size( $id_size, apply_filters( 'yit_' . $id_size . '_width', $size[0] ), apply_filters( 'yit_' . $id_size . '_height', $size[1] ), isset( $size[2] ) ? $size[2] : false );
    
    //Register theme default header. Usually one
//     register_default_headers( array(
//         'theme_header' => array(
//             'url' => '%s/images/headers/001.jpg',
//             'thumbnail_url' => '%s/images/headers/thumb/001.jpg',
//             /* translators: header image description */
//             'description' => __( 'Design', 'yit' ) . ' 1'
//         )
//     ) );
    
    //Set localization and load language file
    $locale = get_locale();
    $locale_file = YIT_THEME_PATH . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );


    //Register menus
    register_nav_menus(
        array(
            'nav' => __( 'Main Navigation', 'yit' ),
            'welcome-menu' => __( 'Welcome Menu', 'yit' )
        )
    );


    //create the main menu if it doesn't exist
    $menuname = 'Main Navigation';
    if( !wp_get_nav_menu_object( $menuname ) ) {
        $menu_id = wp_create_nav_menu($menuname);

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('HOME'),
            'menu-item-classes' => 'home',
            'menu-item-url' => home_url(),
            'menu-item-status' => 'publish'));

        if( !has_nav_menu( 'nav' ) ){
            $locations = get_theme_mod('nav_menu_locations');
            $locations['nav'] = $menu_id;
            set_theme_mod( 'nav_menu_locations', $locations );
        }
    }

/*
    //create the menu items if they don't exist
    $menuname = 'Welcome Menu';
    if( !wp_get_nav_menu_object( $menuname ) ) {
        $menu_id = wp_create_nav_menu($menuname);

        if( is_shop_installed() ) {

            if( get_option('woocommerce_myaccount_page_id') ) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => __('My Account', 'yit'),
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => get_option('woocommerce_myaccount_page_id'),
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish'));
            }

            if ( get_option('woocommerce_change_password_page_id') ) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => __('Change Password', 'yit'),
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => get_option('woocommerce_change_password_page_id'),
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish'));
            }

            if ( get_option('woocommerce_edit_address_page_id') ) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => __('Edit My Address', 'yit'),
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => get_option('woocommerce_edit_address_page_id'),
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish'));
            }

            if ( get_option('woocommerce_view_order_page_id') ) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => __('View Orders', 'yit'),
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => get_option('woocommerce_view_order_page_id'),
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish'));
            }


            if ( get_option('yith_wcwl_wishlist_page_id') ) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => __('Wishlist', 'yit'),
                    'menu-item-object' => 'page',
                    'menu-item-object-id' => get_option('yith_wcwl_wishlist_page_id'),
                    'menu-item-type' => 'post_type',
                    'menu-item-status' => 'publish'));
            }

            if( defined('YITH_WOOCOMPARE') && YITH_WOOCOMPARE ) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' =>  __('Compare', 'yit'),
                    'menu-item-classes' => 'yith-woocompare-open',
                    'menu-item-url' => '#',
                    'menu-item-status' => 'publish'));
            }

        }

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __('{logout}'),
            'menu-item-classes' => 'logout',
            'menu-item-url' => '#',
            'menu-item-status' => 'publish'));

        if( !has_nav_menu( 'welcome-menu' ) ){
            $locations = get_theme_mod('nav_menu_locations');
            $locations['welcome-menu'] = $menu_id;
            set_theme_mod( 'nav_menu_locations', $locations );
        }
    }
*/


    //Register sidebars
    register_sidebar( yit_sidebar_args( 'Default Sidebar' ) );
    register_sidebar( yit_sidebar_args( 'Topbar Left', 'Left widget area for Tob Bar' ) );
    register_sidebar( yit_sidebar_args( 'Topbar Right', 'Right widget area for Tob Bar' ) );
    register_sidebar( yit_sidebar_args( 'Header Sidebar', 'Widget area above the navigation' ) );
    register_sidebar( yit_sidebar_args( 'Blog Sidebar' ) );
    register_sidebar( yit_sidebar_args( '404 Sidebar' ) );

    /**********************
     * Re-enable this sidebar when the skin 3 will be added
     *********************/
    //register_sidebar( yit_sidebar_args( 'Header Sidebar', 'Widget area for Header', 'widget' ) );

    //User defined sidebars
    do_action( 'yit_register_sidebars' );
    
    //Register custom sidebars
    $sidebars = maybe_unserialize( yit_get_option( 'custom-sidebars' ) );
    if( is_array( $sidebars ) && ! empty( $sidebars ) ) {
        foreach( $sidebars as $sidebar ) {
            register_sidebar( yit_sidebar_args( $sidebar, '', 'widget', apply_filters( 'yit_custom_sidebar_title_wrap', 'h3' ) ) );
        }
    }
    
    //Footer with sidebar type widgets
    if( strstr( yit_get_option( 'footer-type' ), 'sidebar' ) ) {
        register_sidebar( yit_sidebar_args( "Footer Widgets Area", __( "The widget area used in Footer With Sidebar section", 'yit' ), 'widget span2', apply_filters( 'yit_footer_widget_area_wrap', 'h3' ) ) );
        register_sidebar( yit_sidebar_args( "Footer Sidebar", __( "The sidebar used in Footer With Sidebar section", 'yit' ), 'widget span6', apply_filters( 'yit_footer_widget_area_wrap', 'h3' ) ) );
    } //else {
        //Footer sidebars
        for( $i = 1; $i <= yit_get_option( 'footer-rows', 0 ); $i++ ) {
            register_sidebar( yit_sidebar_args( "Footer Row $i", sprintf(  __( "The widget area #%d used in Footer section", 'yit' ), $i ), 'widget span' . ( 12 / yit_get_option( 'footer-columns' ) ), apply_filters( 'yit_footer_sidebar_' . $i . '_wrap', 'h3' ) ) );
        }
    //}


    //remove wpml stylesheet
    define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
}

function yit_include_woocommerce_functions() {
    if ( ! is_shop_installed() ) return;

    include_once locate_template( basename( YIT_THEME_FUNC_DIR ) . '/woocommerce.php' );
}
add_action( 'yit_loaded', 'yit_include_woocommerce_functions' );


wp_oembed_add_provider( '#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true );   

function yit_meta_like_body( $css ) {
    $body_bg = yit_get_option( 'background-style' );
    
    return $css . '.blog-big .meta, .blog-small .meta { background: ' . $body_bg['color'] . '; }';
}

/**
 * Remove Add to wishlist text option
 * 
 */
function yit_remove_wishlist_text_option( $options ) {
    if( isset( $options['general_settings'][7] ) && $options['general_settings'][7]['id'] == 'yith_wcwl_add_to_wishlist_text' )
        { unset( $options['general_settings'][7] ); }
    
    return $options;
} 

/**
 * Remove Add to wishlist text option
 * 
 */
function yit_add_slider_class_body() {
    $slider_name = yit_slider_name();
    if ( $slider_name == 'none' || empty( $slider_name ) ) return;

    $slider_type = yit_slider_get_setting( 'slider_type', $slider_name );
    $slider_width = yit_slider_get_setting( 'width_' . $slider_type, $slider_name );

    if ( in_array( $slider_type, array( 'revolution', 'revolution-slider', 'elastic', 'thumbnails' ) ) && $slider_width == 0 ) {
        $is_full_width = true;
    } else {
        $is_full_width = false;
    }

    // revolution slider
    if ( $slider_type == 'revolution-slider' && class_exists( 'RevSlider' ) ) {
        $revolution = yit_slider_get_setting( 'slider_name_' . $slider_type, $slider_name );
        $the_slider = new RevSlider();
        $the_slider->initByMixed($revolution);
        if ( in_array( $the_slider->getParam('slider_type'), array( 'fixed', 'responsitive' ) ) ) {
            $is_full_width = false;
        }
    }

    yit_add_body_class( 'header-slider-' . $slider_type );
    yit_add_body_class( 'slider-' . ( $is_full_width ? 'full-width' : 'fixed' ) );
}

if( !function_exists( 'yit_title_special_font' ) ) {
    /** 
     * The chars used in yit_decode_title() and yit_encode_title()
     * 
     * E.G.
     * string: This is [my title] with | a new line
     * return: This is <span class="highlight">my title</span> with <br /> a new line  
     *  
     * @param  string  $title The string to convert
     * @return string  The html 
     * 
     * @since 1.0  
     */ 
    function yit_title_special_font( $chars )
    {
        return array_merge( $chars, array(
            '/[=\[](.*?)[=\]]/' => '<span class="title-highlight">$1</span>',
            '/\|/' => '<br />',
            '/[#]{2}(.*?)[#]{2}/' => '<span class="special-font">$1</span>',
        ) );
    }   
}

/**
 * Add the style for variations dropdowns scrollable.
 */
function yit_scrollable_variations() {
    if( is_shop_installed() && !is_product() ) { return; }

    if( yit_get_option( 'shop-variations-scrollable' ) ) : ?>
    <style>
        .variations .select-wrapper .sbOptions { max-height: <?php echo yit_get_option( 'shop-variations-scrollable-height' ) ?>px !important; overflow: scroll; }
    </style>
    <?php
    endif;
}

/*
 * Remove the query string from static contents
 */
function yit_remove_script_version( $src ) {
    if( yit_get_option('remove_script_version') ) {
        $parts = explode( '?v', $src );
        return $parts[0];
    } else {
        return $src;
    }
}

/**
 * Add body class when the page have a map
 *
 */
function yit_add_map_class_body() {
    global $post;
    if( !is_page() || !isset( $post->ID ) )
    { return; }

    $map_url = yit_get_post_meta( get_the_ID(), '_google-map' );
    if( !empty( $map_url ) ){
        yit_add_body_class( 'page-with-map' );
    }
}

/**
 * Add body class when the page have a map
 *
 */
function yit_add_sampledata_install_message() {
    //echo '<p>' . __('<strong>Note:</strong> if you want to install Sample Data of Black and White version, please download the sample data and the images from <a href="http://support.yithemes.com/entries/23707017-How-to-import-sample-data-in-Room-09">this link</a> then <strong>upload this folder via FTP</strong>.', 'yit') . '</p>';
}

/**
 * Add a back to top button
 *
 */
function yit_back_to_top() {
    if ( yit_get_option('back-top') ) {
        echo '<div id="back-top"><a href="#top">' . __('Back to top', 'yit') . '</a></div>';
    }
}

/**
 * Get the skin name
 *
 * @return string
 */
function yit_get_header_skin() {
    if( isset($_GET['yit_header_skin']) && in_array($_GET['yit_header_skin'], array('skin1', 'skin2') ) ) {
        return $_GET['yit_header_skin'];
    } elseif( yit_get_option('header-skin') ) {
        return yit_get_option('header-skin');
    } else {
        return 'skin1';
    }
}


// add the table for the importer of sample data
function yit_add_all_around_tables( $tables ) {
    global $wpdb, $all_around_version;

    if( isset($all_around_version) ) {
        $tables[] = 'all_around_thmb';
        $tables[] = 'all_around';
    }

    return $tables;
}
add_filter( 'yit_sample_data_tables', 'yit_add_all_around_tables' );


if( !function_exists( 'is_visibility_option_installed' ) ) {
    /**
     * Detect if there is a wc catalog mode plugin installed
     *
     *
     * @return void
     * @since 2.3.x
     */
    function is_visibility_option_installed() {
        global $wc_cvo;
        if( isset( $wc_cvo )) {
            return true;
        } else {
            return false;
        }
    }
}

if ( ! function_exists( 'yit_get_ajax_loader_gif_url' ) ) {
    function yit_get_ajax_loader_gif_url() {
        return YIT_THEME_ASSETS_URL . '/images/ajax-loader.gif';
    }
}