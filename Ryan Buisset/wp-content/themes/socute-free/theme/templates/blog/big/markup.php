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

$post_classes = 'hentry-post group blog-big-image row';
$span = yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9;

$post_format = get_post_format() == '' ? 'standard' : get_post_format();



$meta = yit_get_option( 'blog-show-author' )
        || yit_get_option( 'blog-show-comments' ) && comments_open()
        || yit_get_option( 'blog-show-categories' )
        || yit_get_option( 'blog-show-tags' );


if( yit_get_option( 'blog-post-formats-list' ) ) {
    $post_classes .= ' post-formats-on-list';
}

$has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yit_get_option( 'blog-show-featured' ) ) || ( is_single() && ! yit_get_option( 'blog-show-featured-single' ) ) ) ? false : true;

$upper = yit_get_option('blog-title-uppercase') ? ' upper' : '';

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>

        <?php if(is_single() && $post_format != 'quote') : ?>
            <?php yit_get_template( 'blog/big/post-formats/standard.php', array('span' => $span, 'has_thumbnail' => $has_thumbnail) ); ?>
        <?php elseif( $post_format != 'quote' ): ?>
            <?php yit_get_template( 'blog/big/post-formats/standard.php', array('span' => $span, 'has_thumbnail' => $has_thumbnail) ); ?>
        <?php endif; ?>

    <div class="span<?php echo $span ?>">
        <!-- post content -->
        <div class="blog-big-image-content row">
            <div class="post-footer meta span3">

                <?php if ( get_the_author() != '' && yit_get_option( 'blog-show-author' ) ) : ?>
                    <p>
                       <span class="author"><?php _e( 'Author:', 'yit' ) ?></span> <?php the_author_posts_link(); ?>
                    </p>
                <?php endif; ?>

                <?php if( yit_get_option( 'blog-show-categories' ) ) : ?>
                    <p>
                        <span class="categories"><?php _e( 'Categories:', 'yit' ) ?></span>
                        <?php the_category( ', ' ) ?>
                    </p>
                <?php endif; ?>

                <?php if( yit_get_option( 'blog-show-comments' ) ): ?>
                    <p>
                        <a href="<?php comments_link(); ?>" class="blog-big-image-comments-count">
                            <span class="count"><?php _e('Comments: ', 'yit'); ?> </span>&nbsp;<?php echo get_comments_number(); ?>
                        </a>
                    </p>
                <?php endif ?>

                <?php if( yit_get_option( 'blog-show-tags' ) ) : ?><p><?php  ?><span class="tags"><?php the_tags( __( 'Tags: ', 'yit' ), ', ' ); ?></span></p><?php endif ?>
            </div>

            <div class="the-content-post">

                <!-- post title -->
                <?php
                $link = get_permalink();
                $title = get_the_title() == '' ? __( '(this post does not have a title)', 'yit' ) : get_the_title();

                if($post_format != 'quote'){
                    yit_string( "<h2 class=\"post-title{$upper}\"><a href=\"$link\">", $title, "</a></h2>" );
                }

                if( !is_single() && $post_format != 'quote' ) {

                    if( yit_get_option( 'blog-show-read-more' ) && !yit_get_option( 'blog-show-featured' ) ) {
                        the_content( yit_get_option( 'blog-read-more-text' ) );
                    } else {
                        the_excerpt();
                    }
                } elseif($post_format == 'quote') {

                    yit_string( "<blockquote><p><a href=\"$link\">", get_the_content(), "</a></p><cite>" . $title . "</cite></blockquote>" );
                }

                if(is_single() && $post_format != 'quote'){

                    the_content();
                }

                ?>
                <?php edit_post_link( __( 'Edit', 'yit' ), '<p class="edit-link"><i class="icon-pencil"></i>', '</p>' ); ?>
                <?php wp_link_pages(); ?>
            </div>



        </div>
        <div class="clear"></div>
    </div>
</div>