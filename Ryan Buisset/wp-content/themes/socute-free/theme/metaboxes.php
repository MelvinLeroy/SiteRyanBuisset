<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files the framework register theme metaboxes.
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

if( !is_admin() ) return;

function yit_remove_options_metabox( $array ) {
    
    return $array;
}
add_filter( 'yit_remove_options_metabox', 'yit_remove_options_metabox' );

/**
 * TESTIMONIALS
 */
yit_metaboxes_sep( 'yit-testimonial-site', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Small quote', 'yit' ),
    'desc' =>  __( 'Insert the text to show with blockquote', 'yit' ),
);

yit_add_option_metabox( 'yit-testimonial-site', __( 'Settings', 'yit' ), '_small-quote', 'text', $options );

/* HEADER */
yit_metaboxes_sep( 'yit-page-settings', __( 'Header', 'yit' ) );

$options = array(
    'title' => __( 'Enable custom header background', 'yit' ),
    'desc'  =>  __( 'Set YES if you want to customize the header background.', 'yit' ),
    'std'   => 0
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_enable_custom_header', 'onoff', $options );

/*
$options = array(
    'title' => __( 'Header Min-Height', 'yit' ),
    'desc' =>  __( 'Select the min-height of the header.', 'yit' ),
    'std' => 0
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_header-height', 'number', $options );
*/

$options = array(
    'title' =>  __( 'Header background color', 'yit' ),
    'desc' =>  __( 'Select a background color for the header.', 'yit' )
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header', 'colorpicker', $options );

$options = array(
    'title' => __( 'Header background image', 'yit' ),
    'desc' =>  __( 'Select a background image for the header.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header-image', 'upload', $options );

$options = array(
    'title' => __( 'Background repeat', 'yit' ),
    'desc' => __( 'Select the repeat mode for the background image.', 'yit' ),
    'options' => array(
        '' => __( 'Default', 'yit' ),
        'repeat' => __( 'Repeat', 'yit' ),
        'repeat-x' => __( 'Repeat Horizontally', 'yit' ),
        'repeat-y' => __( 'Repeat Vertically', 'yit' ),
        'no-repeat' => __( 'No Repeat', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header-repeat', 'select', $options );

$options = array(
    'title' => __( 'Background position', 'yit' ),
    'desc' => __( 'Select the position for the background image.', 'yit' ),
    'options' => array(
        '' => __( 'Default', 'yit' ),
        'center' => __( 'Center', 'yit' ),
        'top left' => __( 'Top left', 'yit' ),
        'top center' => __( 'Top center', 'yit' ),
        'top right' => __( 'Top right', 'yit' ),
        'bottom left' => __( 'Bottom left', 'yit' ),
        'bottom center' => __( 'Bottom center', 'yit' ),
        'bottom right' => __( 'Bottom right', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header-position', 'select', $options );

$options = array(
    'title' => __( 'Background attachment', 'yit' ),
    'desc' => __( 'Select the attachment for the background image.', 'yit' ),
    'options' => array(
        '' => __( 'Default', 'yit' ),
        'scroll' => __( 'Scroll', 'yit' ),
        'fixed' => __( 'Fixed', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_background-header-attachment', 'select', $options );

yit_metaboxes_sep( 'yit-page-settings', __( 'Header', 'yit' ) );

$options = array(
    'title' => __( 'Border bottom of header', 'yit' ),
    'desc' => __( 'Select what you want to do for the border bottom of the header, for this page.', 'yit' ),
    'options' => array(
        'default' => __( 'Default', 'yit' ),
        'enable' => __( 'Enable', 'yit' ),
        'remove' => __( 'Remove', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_header-border-bottom-custom', 'select', $options );