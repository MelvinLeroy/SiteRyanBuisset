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

/* === INIT & CORE */
add_filter( 'yit_custom_style', 'yit_meta_like_body' );
add_filter( 'yith_wcwl_tab_options', 'yit_remove_wishlist_text_option' );

/* === HEADER */
//add_filter( 'body_class', 'yit_header_fixed', 10 );
add_action( 'yit_head', 'yit_head', 10 );
add_action( 'wp_enqueue_scripts', 'yit_add_custom_styles' );
add_action( 'wp_enqueue_scripts', 'yit_add_custom_scripts' );
add_action( 'yit_topbar', 'yit_topbar', 10 );
add_action( 'yit_header', 'yit_header', 10 );
add_action( 'yit_header_skin', 'yit_header_skin', 10 );
add_action( 'yit_header_search_box', 'yit_header_search_box', 10 );
add_action( 'yit_header', 'yit_slider_section', 10 );
add_action( 'yit_header', 'yit_slogan', 20 );
add_action( 'yit_logo', 'yit_logo', 10 );
add_action( 'yit_header_cart', 'yit_header_cart', 10);
add_action( 'yit_main_navigation', 'yit_main_navigation', 10 );
add_action( 'yit_after_header', 'yit_page_meta' );
add_action( 'yit_header', 'yit_map', 20 );
//add_action( 'yit_loop_page', 'yit_map', 20 );

add_filter( 'wp_page_menu_args', 'yit_page_menu_args' );
add_filter( 'wp_page_menu', 'yit_page_menu', 100 );

add_filter( 'wp_head', 'yit_header_background' );
add_filter( 'wp_head', 'yit_meta_bg' );

//add_action( 'wp_head', 'yit_add_slider_class_body' );
//add_action( 'wp_head', 'yit_add_map_class_body' );

/* BG SLIDER */
//add_action( 'wp_head', 'yit_load_bg_slider', 1 );

/* === PAGE */
add_action( 'yit_page_content', 'yit_page_content', 10 );
add_action( 'yit_loop_page', 'yit_loop_page', 10 );
add_action( 'yit_before_primary', 'yit_is_primary_start', 10 ); 
add_action( 'yit_after_primary', 'yit_is_primary_end', 10 );
add_action( 'yit_404', 'yit_404', 10 );                       
//add_action( 'yit_loop_page', 'yit_page_meta', 5 );

/* === BLOG */
add_action( 'yit_comments', 'yit_comments', 10 );
add_action( 'yit_comments_password_required', 'yit_comments_password_required', 10 );
add_action( 'yit_comments_navigation', 'yit_comments_navigation', 10 );
add_action( 'yit_enqueue_blog_stuffs', 'yit_enqueue_blog_styles' );
add_action( 'yit_trackbacks', 'yit_trackbacks', 10 );
add_action( 'comment_form_top', create_function( '', 'echo "<div class=\"row\">";' ) );
add_action( 'comment_form', create_function( '', 'echo "</div>";' ) );

/* === LOOP */
add_action( 'yit_loop', 'yit_loop', 10 );
add_action( 'yit_loop_internal', 'yit_loop_internal', 10 );
add_action( 'yit_loop_blog_big', 'yit_loop_blog_big', 10 );
add_action( 'yit_loop_blog_small-image', 'yit_loop_blog_small_image', 10 );
add_action( 'yit_loop_blog_pinterest', 'yit_loop_blog_pinterest', 10 );
add_action( 'yit_archives', 'yit_archives', 10 );
add_action( 'the_content_more_link', 'yit_simple_read_more_classes' );

/* === MISC */
add_action( 'wp_head', 'yit_scrollable_variations' );
add_action( 'yit_searchform', 'yit_searchform', 10 );
add_action( 'yit_extra_content', 'yit_extra_content', 10 );
add_filter( 'widget_title', create_function( '$title', 'return yit_decode_title( $title );' ) );
add_filter( 'the_title', create_function( '$title', 'if( !is_admin() ) { return yit_decode_title( $title ); } return $title;' ) );

add_filter( 'script_loader_src', 'yit_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'yit_remove_script_version', 15, 1 );

/* === FOOTER */
add_action( 'yit_footer', 'yit_footer', 10 );
add_action( 'yit_footer_big', 'yit_footer_big', 10 );
add_action( 'yit_copyright', 'yit_copyright', 10 );

/* === SIDEBAR */
add_action( 'yit_default_sidebar', 'yit_default_sidebar', 10 );

/* === UNREGISTER POST TYPES */
//add_action('init', 'yit_unregister_post_types', 10);

/* === FEATURES TAB */
//add_filter( 'yit_before_features_tab_menu', create_function( '$html', 'return $html .= "<img src=\"".get_template_directory_uri()."/theme/assets/images/features-tab-shadow.png\" class=\"shadow\" />";' ) );


/* === AJAX CALLS */
add_action('wp_ajax_nopriv_yit_portfolio_thumbs', 'yit_ajax_portfolio_thumbs');
add_action('wp_ajax_yit_portfolio_thumbs', 'yit_ajax_portfolio_thumbs');

/* == SPECIAL FONT */
add_action('yit_title_special_characters', 'yit_title_special_font');

/* == SAMPLE DATA INSTALL MESSAGE == */
add_action('yit_sampledata_install_message', 'yit_add_sampledata_install_message');

/* == BACK TO TOP == */
add_action( 'yit_after_header', 'yit_back_to_top', 0 );

/* === QUICK CONTACT FORM */
add_filter( 'yit_contact_form_cols', 'yit_contact_form_cols', 10, 2);