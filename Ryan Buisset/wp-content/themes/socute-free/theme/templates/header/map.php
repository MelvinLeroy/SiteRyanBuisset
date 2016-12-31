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
if( !is_page() || !isset( $post->ID ) )
    { return; }

$map_url = yit_get_post_meta( get_the_ID(), '_google-map' );
if( empty( $map_url ) )
    { return; }

$is_gmap = false;
if( preg_match( '#(www|maps)\.google\.([a-z]{2,4}(\.([a-z]{2,4}))?)/(maps|\?)#', $map_url ) )
    { $is_gmap = true; }

if( !$is_gmap ) {
    $image_id = yit_get_attachment_id( $map_url );

    if ( $image_id != 0 ) {
        list( $image_url, $image_width, $image_height ) = wp_get_attachment_image_src( $image_id, 'map_image' );
        if ( empty( $width ) )  $width = $image_width;
        if ( empty( $height ) ) $height = $image_height;
        $img_attrs['src'] = $image_url;
    }

    $image_link = yit_get_post_meta( get_the_ID(), '_google-map-link' );
    if( !empty( $image_link ) )
        $image = '<a target="_blank" style="display:block;" href="' . $image_link .'"><img class="span12" src="' . $image_url . '" title="" alt="" /></a>';
    else
        $image = '<img class="span12" src="' . $image_url . '" title="" alt="" />';
} ?>
<!-- START MAP -->
<div id="map">
	<div class="border">
	    <?php if( $is_gmap ) : ?>
	    <iframe
	        frameborder="0"
	        scrolling="no"
	        marginheight="0"
	        marginwidth="0"
	        src="<?php echo $map_url ?>&amp;output=embed">
	    </iframe>
	    <?php else : ?>
	    <?php echo $image  ?>
	    <?php endif ?>

<!--	    <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="span12">-->
<!--                    <div class="view-map">-->
<!--                        <a href="--><?php //echo $map_url ?><!--" target="_blank">--><?php //_e('VIEW MAP', 'yit') ?><!--</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--	    </div>-->
	</div>
</div>
<!-- END MAP -->