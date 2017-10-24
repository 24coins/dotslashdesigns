<?php
$sb_3 = apply_filters('forceful_lite_get_sidebar', 'sidebar_3', 'pos_sidebar_3');
$sb_4 = apply_filters('forceful_lite_get_sidebar', 'sidebar_4', 'pos_sidebar_4');
$sb_5 = apply_filters('forceful_lite_get_sidebar', 'sidebar_5', 'pos_sidebar_5');
$sb_6 = apply_filters('forceful_lite_get_sidebar', 'sidebar_6', 'pos_sidebar_6');
$forceful_lite_custom_footer_description = get_theme_mod( 'forceful_lite_options_footer', '' );
?>

<?php if ( is_active_sidebar( $sb_3 ) || is_active_sidebar( $sb_4) || is_active_sidebar( $sb_5 ) || is_active_sidebar( $sb_6 ) ) { ?>
    <div id="bottom-sidebar">
        <div class="wrapper">
            <div class="row-fluid">
                <div class="span12 clearfix">
                    <div class="l-col">
                        <div class="r-color"></div>
                        <div class="row-fluid">
                            <div class="span4 widget-area-8">
                                <?php if ( is_active_sidebar( $sb_3 ) ) {
                                    dynamic_sidebar( $sb_3 );
                                } ?>
                            </div><!--span4-->
                            <div class="span4 widget-area-9">
                                <?php if ( is_active_sidebar( $sb_4 ) ) {
                                    dynamic_sidebar( $sb_4 );
                                } ?>
                            </div><!--span4-->
                            <div class="span4 widget-area-10">
                                <?php if ( is_active_sidebar( $sb_5 ) ) {
                                    dynamic_sidebar( $sb_5 );
                                } ?>
                            </div><!--span4-->
                        </div><!--row-fluid-->
                    </div><!--l-col-->
                    <div class="r-col widget-area-11">
                        <?php if ( is_active_sidebar( $sb_6) ) {
                            dynamic_sidebar( $sb_6 );
                        } ?>
                    </div><!--r-col-->
                </div><!--span12-->
            </div><!--row-fluid-->
        </div><!--wrapper-->
    </div><!--bottom-sidebar-->
<?php } ?>

<footer id="page-footer">
    <div class="wrapper clearfix">
        <div class="l-col clearfix">
            <div class="r-color"></div>
            <p id="copyright"><?php  echo htmlspecialchars_decode( stripslashes( $forceful_lite_custom_footer_description ) ); ?></p>
        </div>
        <div class="r-col clearfix">
            <?php
            if ( has_nav_menu( 'footer-nav' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'footer-nav',
                    'container'      => '',
                    'menu_id'        => 'footer-menu',
                    'items_wrap'     => '<ul id="%1$s" class="clearfix">%3$s</ul>',
                    'depth'          => -1
                ) );
            }
            ?>
        </div>
    </div><!--wrapper-->
</footer><!--page-footer-->

<?php wp_footer(); ?>
</body>

</html>