<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
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

$span_image = yit_get_sidebar_layout() == 'sidebar-no' ? 5 : 4;
$span_text = yit_get_sidebar_layout() == 'sidebar-no' ? 6 : 5;
if( !yit_get_option( '404-custom' ) ) : ?>
    <div class="span4">
        <img class="error-404-image group" src="<?php echo get_template_directory_uri() ?>/images/404.png" title="<?php _e( 'Error 404', 'yit' ); ?>" alt="404" />
    </div>
    <div class="error-404-text group span6">
        <h2><?php echo __('OPS! It seems you missed a page'); ?></h2>
        <p><?php printf( __( 'We are sorry but the page you are looking for does not exist.<br />You could <a href="%s">return to the home page</a> or search using the search box below.', 'yit' ), home_url() ) ?></p>
        <?php get_search_form() ?>
    </div>

<?php
else : ?>

	<div class="border-img-bottom">
		<div class="border-img">		
			<img class="error-404-image group" src="<?php echo yit_get_option( '404-image' ); ?>" title="<?php _e( 'Error 404', 'yit' ); ?>" alt="<?php _e( '404 Error', 'yit' ) ?>" />
		</div>
	</div>
    <div class="error-404-text group">    	
    	<?php echo yit_convert_tags( yit_addp( do_shortcode( stripslashes( yit_get_option( '404-text' ) ) ) ) ) ?>
   </div>
   <div class="error-404-search group">
    	<?php get_search_form() ?>
    </div>   
<?php endif;
?>