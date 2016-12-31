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

if( yit_get_option( 'custom-logo' ) && yit_get_option( 'logo-url' ) != '' ) : ?>
<a id="logo-img" href="<?php echo home_url() ?>" title="<?php bloginfo( 'name' ) ?>">
    <?php $size = @getimagesize(yit_get_option( 'logo-url' )); ?>
    <img src="<?php echo yit_ssl_url( yit_get_option( 'logo-url' ) ) ?>" <?php if( yit_get_option( 'logo-retina-url' ) ): ?>data-at2x="<?php echo yit_ssl_url( yit_get_option( 'logo-retina-url' ) ) ?>"<?php endif ?>title="<?php bloginfo( 'name' ) ?>" alt="<?php bloginfo( 'name' ) ?>" <?php if( !empty($size) && isset($size[3] ) ) echo $size[3] ?> />
</a>
<?php else : ?>
<a id="textual" href="<?php echo home_url() ?>" title="<?php echo str_replace( array( '[', ']' ), '', bloginfo( 'name' ) ) ?>">
    <?php echo yit_decode_title( get_bloginfo( 'name' ) ) ?>
</a>
<?php endif ?>

<?php if( yit_get_option( 'logo-tagline' ) ): 
    $class = array();
    if ( strpos( get_bloginfo( 'description' ), '|') ) $class[] = 'multiline';
    if ( ! yit_get_option('responsive-show-logo-tagline') ) $class[] = 'hidden-phone';
    $class = ! empty( $class ) ? ' class="' . implode( $class, ' ' ) . '"' : '';
    ?>
	<?php yit_string( "<p id='tagline'{$class}>", yit_decode_title( get_bloginfo( 'description' ) ), '</p>' );?>
<?php endif ?>
