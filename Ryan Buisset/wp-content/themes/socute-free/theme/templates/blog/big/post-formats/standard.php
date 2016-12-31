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
?>

<?php if ( $has_thumbnail ): ?>
    <div class="thumbnail span<?php echo $span; ?>">

        <div class="thumbnail-wrapper span9">

            <?php
            if( $has_thumbnail ) {
                yit_image( "size=blog_big&alt=blogimage" );
            }
            ?>

            <div class="blog-meta">
                <?php if( yit_get_option( 'blog-show-date' ) ): ?>
                    <div class="blog-big-image-date">
                        <span class="day"><?php echo get_the_date( 'd' ) ?></span>
                        <span class="month"><?php echo get_the_date( 'M' ) ?></span>
                    </div>
                <?php endif ?>
            </div>

            <?php if( $has_thumbnail && yit_get_option( 'blog-show-read-more' ) && !is_single() ) : ?>
                <div class="readmore-wrapper">
                    <a class="read-more alt-button" href="<?php the_permalink() ?>">Read More</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
<?php endif ?>