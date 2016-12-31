<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files the framework register default metaboxes.
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

yit_register_metabox( 'yit-page-settings', __( 'Page settings', 'yit' ), 'page' );
yit_register_metabox( 'yit-post-settings', __( 'Post settings', 'yit' ), 'post' );
yit_register_metabox( 'yit-testimonial-site', __( 'Other Testimonial info', 'yit' ), 'testimonial' );
yit_register_metabox( 'yit-page-extra-content', __( 'Extra content', 'yit' ), 'page' );                     
/**
 * SETTINGS TAB
 */
$options = array(
    'title' => __( 'Show title', 'yit' ),
    'desc' =>  __( 'Show or not the title of the page.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_show-title', 'checkbox', $options );
yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Show breadcrumb', 'yit' ),
    'desc' =>  __( 'Show or not the breadcrumb.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_show-breadcrumb', 'checkbox', $options );
yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Sidebar', 'yit' ),
    'desc' =>  __( 'Select the sidebar layout and the sidebar to use.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_sidebar-layout', 'sidebar-layout', $options );
yit_add_option_metabox( 'yit-post-settings', __( 'Settings', 'yit' ), '_sidebar-layout', 'sidebar-layout', $options );

/**
 * HEADER TAB
 */
$options = array(
    'title' => __( 'Use static image', 'yit' ),
    'desc'  =>  __( 'Set YES if you want a static header.', 'yit' ),
    'std'   => 0
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_use_static_image', 'onoff', $options );

$options = array(
    'title' => __( 'Static image', 'yit' ),
    'desc'  =>  __( 'Upload here the image to use for the static header, only if you have set to YES the option above.', 'yit' ),
    'std'   => ''
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_static_image', 'upload', $options );

$options = array(
    'title' => __( 'Static image Link', 'yit' ),
    'desc'  =>  __( 'The URL where the fixed image will link.', 'yit' ),
    'std'   => ''
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_static_image_link', 'text', $options ); 

$options = array(
    'title' => __( 'Static image target', 'yit' ),
    'desc' =>  __( 'How to open the link of the static image.', 'yit' ),
    'options' => array(                 
        '_self' => __( 'Default', 'yit' ),    
        '_parent' => __( 'Parent frameset', 'yit' ),
        '_top' => __( 'Full body of the window', 'yit' ),
        '_blank' => __( 'In a new window', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_static_image_target', 'select', $options ); 

/**
 * TESTIMONIAL
 */
$options = array(
    'title' => __( 'Label', 'yit' ),
    'desc' =>  __( 'Insert the label used for testimonial if Website Url is set.', 'yit' ),
);
yit_add_option_metabox( 'yit-testimonial-site', __( 'Settings', 'yit' ), '_site-label', 'text', $options );
yit_metaboxes_sep( 'yit-testimonial-site', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Web Site URL', 'yit' ),
    'desc' =>  __( 'Insert the url referred to Testimonial.', 'yit' ),
);
yit_add_option_metabox( 'yit-testimonial-site', __( 'Settings', 'yit' ), '_site-url', 'text', $options );
   
/**
 * EXTRA CONTENT
 */
$options = array(
    'desc' =>  __( 'Put here the content you want to show after content and sidebar.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-extra-content', __( 'Extra content', 'yit' ), '_extra-content', 'textarea-editor', $options );

include_once YIT_THEME_FUNC_DIR . '/metaboxes.php';