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

wp_enqueue_script( 'black-and-white' );

$args = array(
	'post_type' => 'services',
	'posts_per_page' => $items,
);

$services = new WP_Query( $args );
$sidebar_layout = yit_get_sidebar_layout();

if( isset( $items_per_row ) && ( $items_per_row == 2 || $items_per_row == 3 || $items_per_row == 4 || $items_per_row == 6 ) ) {
	if ( $sidebar_layout == 'sidebar-no' ){
		$items_span = 12 / $items_per_row;
	} else {
		$items_span = (int) (9 / $items_per_row);
	}

} else {
	$items_span = 3;
}

if( $services->have_posts() ) :
	global $wp_query, $post, $more;
	?>
	<div class="section services margin-bottom section-services-bandw">
		<?php if( !empty( $title ) ) {
			if( !empty($services_icon_title)) { yit_image("src=$services_icon_title"); }
			yit_string( '<h3 class="title">', yit_decode_title($title), '</h3>' );
		} ?>
		<?php if( !empty( $description ) ) { yit_string( '<p class="description">', $description, '</p>' ); } ?>
		<div class="services-row row group">
			<?php while( $services->have_posts() ) : $services->the_post() ?>
				<div class="span<?php echo $items_span; ?> service-wrapper">
					<div class="service group">
						<div class="image-wrapper">
							<a href="<?php the_permalink() ?>" ><?php echo has_post_thumbnail() ? yit_image( 'size=section_services&alt=featured image', false ) : yit_image( 'src=' . YIT_CORE_ASSETS_URL . '/images/no-featured-175.jpg&title=' . __( '(this post does not have a featured image)', 'yit' ) . '&alt=no featured image', false ) ?></a>
						</div>
						<?php if( $show_title == "1" || $show_title == 'yes' ): ?><h4><a href="<?php the_permalink() ?>"><?php echo yit_decode_title(get_the_title()); ?></a></h4><?php endif ?>
						<?php if( $show_excerpt == "1" || $show_excerpt == 'yes' ): ?>
							<?php echo yit_content( 'content', $excerpt_length ); ?>
							<?php if( isset( $show_services_button ) && ( $show_services_button == "1" || $show_services_button == "yes" ) ) : ?>
								<div class="read-more buttons"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo $services_button_text ?></a></div>
							<?php endif ?>
						<?php endif ?>
					</div>
				</div>
			<?php endwhile ?>
		</div><!-- end row -->
	</div>
<?php endif;
wp_reset_query();