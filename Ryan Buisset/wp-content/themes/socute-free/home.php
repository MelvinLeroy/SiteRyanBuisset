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

/*
Template Name: Home
*/

if( is_posts_page() || is_home() )
    { get_template_part( 'blog' ); die; }

// params of sidebar Home Row
$sidebar = 'home-row';
$sidebars = wp_get_sidebars_widgets();

global $wp_registered_sidebars;

if ( isset( $sidebars[$sidebar] ) ) {
    switch ( count( $sidebars[$sidebar] ) ) {
        case 1  : $widget_class = 'span12'; break;
        case 2  : $widget_class = 'span6';  break;
        case 3  : $widget_class = 'span4';  break;
        default : $widget_class = 'span3';  break;
    }

    $widget_class = "home-widget $widget_class";
    $wp_registered_sidebars[$sidebar]['before_widget'] = '<div id="%1$s" class="' . $widget_class . ' %2$s"><div class="widget-wrap">';
    $wp_registered_sidebars[$sidebar]['after_widget'] = '</div></div>';
    //$sidebar_home_position = yit_get_option('sidebar-home-position');
}
			
get_header();
do_action( 'yit_before_primary' ) ?>

<!-- START HOME SIDEBAR TOP -->
<?php if ( ! empty( $sidebars[$sidebar] ) && $sidebar_home_position == 'top' ) { ?>
	<div class="home-row container">
	    <div class="row"><?php dynamic_sidebar($sidebar) ?></div>
	</div>
<?php } ?>
<!-- END HOME SIDEBAR TOP -->

<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout(); ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>	        
			
	        <!-- START CONTENT -->
	        <div id="content-home" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
	        
			<?php do_action( 'yit_loop_page' );
	        
	        comments_template();
	        ?>
	        </div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php get_sidebar() ?>
	        
	        <?php do_action( 'yit_after_sidebar' ) ?>
	        
	        <!-- START EXTRA CONTENT -->
	        <?php do_action( 'yit_extra_content' ) ?>
	        <!-- END EXTRA CONTENT -->			
			<div class="clear"></div>			
	    </div>
    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>