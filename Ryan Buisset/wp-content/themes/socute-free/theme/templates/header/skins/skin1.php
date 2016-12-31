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


<div id="header-container" class="header_skin1 container">
    <!-- START LOGO -->
    <?php do_action( 'yit_before_logo' ) ?>
    <div id="logo">
        <?php
        /**
         * @see yit_logo
         */
        do_action( 'yit_logo' ) ?>
    </div>
    <?php do_action( 'yit_after_logo' ) ?>
    <!-- END LOGO -->


    <!-- START HEADER RIGHT CONTENT -->
    <?php do_action( 'yit_before_header_right_content' ); ?>
    <div id="header-right-content">
        <!-- START HEADER SIDEBAR -->
        <div id="header-sidebar"<?php if ( ! yit_get_option('responsive-show-header-sidebar') ) echo ' class="hidden-phone"' ?>>
            <?php get_sidebar( 'header' ) ?>
        </div>
        <!-- END HEADER SIDEBAR -->

        <!-- START NAVIGATION -->
        <div id="nav">
            <?php
            /**
             * @see yit_main_navigation
             */
            do_action( 'yit_main_navigation') ?>
        </div>
        <!-- END NAVIGATION -->
    </div>
    <?php do_action( 'yit_after_header_right_content' ); ?>
    <!-- END HEADER RIGHT CONTENT -->
</div>