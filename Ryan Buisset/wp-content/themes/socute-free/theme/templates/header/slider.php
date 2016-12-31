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
 
global $post;

$post_id = 0;
if ( is_posts_page() ) $post_id = get_option( 'page_for_posts' );
elseif ( function_exists( 'is_shop' ) && is_shop() ) $post_id = woocommerce_get_page_id( 'shop' );
elseif ( isset( $post->ID ) ) $post_id = $post->ID;

// use static header image
if ( isset( $post_id ) && yit_get_post_meta( $post_id, '_use_static_image' ) ) { 
    $image_url = yit_get_post_meta( $post_id, '_static_image' );
	$image_size = @getimagesize($image_url);
    $image_id = yit_get_attachment_id( $image_url );
    list( $thumb_url, $image_width, $image_height ) = wp_get_attachment_image_src( $image_id );
    $static_image_link = yit_get_post_meta( $post_id, '_static_image_link' );
?>
	    <div class="slider fixed-image inner group">
			<div class="fixed-image-wrapper" style="max-width: <?php echo $image_size[0] ?>px;">
	        	<?php if( !empty( $static_image_link ) ) : ?><a href="<?php echo $static_image_link ?>" title="" target="<?php echo yit_get_post_meta( $post_id, '_static_image_target' ) ?>"><?php endif ?>
                    <img src="<?php echo yit_get_post_meta( $post_id, '_static_image' ) ?>" alt="<?php bloginfo('name') ?> Header" />
                <?php if( !empty( $static_image_link ) ) : ?></a><?php endif ?>
			</div>
	    </div>
	<?php
    define( 'YIT_SLIDER_USED', true );
		
// use static header of Appearance -> Header
} elseif ( get_header_image() != '' ) {       
?>
	    <div class="slider fixed-image inner group">
			<div class="fixed-image-wrapper" style="max-width: <?php echo get_custom_header()->width ?>px;">
	        	<img src="<?php header_image() ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name') ?> Header" />
            </div>
	    </div>
	<?php
    define( 'YIT_SLIDER_USED', true );
    
// use the slider
} else {
    if( function_exists('yit_slider') ) {
        yit_slider();
    }
}