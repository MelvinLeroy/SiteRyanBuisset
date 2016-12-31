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
$footer_rows    = yit_get_option( 'footer-rows' );
$footer_columns = yit_get_option( 'footer-columns' );
?>
<!-- START FOOTER -->
<div id="footer" <?php if ( yit_get_option( 'footer-newsletter') == 1 ) : ?> class="newsletter-footer"<?php endif ?>>
    <?php if ( yit_get_option( 'footer-newsletter') == 1 ) :
        $method = yit_get_option( 'newsletter-request' );
        $action = yit_get_option( 'newsletter-action' );
        $email = yit_get_option( 'newsletter-email-name' );
        $email_label = yit_get_option( 'newsletter-email-label' );
        $hidden_fields = yit_get_option( 'newsletter-hidden' );
        $submit = yit_get_option( 'newsletter-submit-label' ); ?>

        <div id="footernewsletter-container" class="group">
            <form role="search" method="<?php echo $method ?>" id="footernewsletter" action="<?php echo $action; ?>">
                <?php // hidden fileds
                    if ( $hidden_fields != '' ) {
                        $hidden_fields = explode( '&', $hidden_fields );
                        foreach ( $hidden_fields as $field ) {
                            list( $id_field, $value_field ) =
                                explode( '=', $field );
                            echo '<input type="hidden" name="' . $id_field . '" value="' . $value_field . '" />';
                        }
                    }

                    echo wp_nonce_field( 'mc_submit_signup_form', '_mc_submit_signup_form_nonce', false, false ); //MailChimp nonce
                    echo wp_nonce_field( 'mymail_form_nonce', '_wpnonce', false, false ); //MyMail nonce
                ?>
                <div class="group formborder">
                    <input  type="text" value="" name="<?php echo $email ?>" id="footers" placeholder="<?php echo $email_label ?>" />
                    <input  type="submit" class="button" id="footernewslettersubmit" value="<?php echo $submit ?>" />
                </div>
            </form>
        </div>
    <?php endif ?>

    <div class="container">
        <div class="row">
            <?php if( !strstr( yit_get_option( 'footer-type'), 'sidebar' ) ) : ?>
                <?php for( $i = 1; $i <= $footer_rows; $i++ ) : ?>
                <?php do_action( 'yit_before_footer_row_' . $i ) ?>
                <div class="footer-row-<?php echo $i ?> footer-columns-<?php echo $footer_columns ?>">
                    <?php dynamic_sidebar( 'Footer Row ' . $i ) ?>
                </div>
                <div class="clear"></div>
                <?php do_action( 'yit_after_footer_row_' . $i ) ?>
                <?php endfor ?>
            <?php else : ?>
            <div class="footer-widgets-area with-<?php echo yit_get_option( 'footer-layout' ) ?>">
                <?php dynamic_sidebar( 'Footer Widgets Area' ) ?>
            </div>
            
            <div class="footer-widgets-sidebar with-<?php echo yit_get_option( 'footer-layout' ) ?>">
                <?php dynamic_sidebar( 'Footer Sidebar' ) ?>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>
<!-- END FOOTER -->