<?php
$forceful_lite_options_header_headline_status = get_theme_mod( 'forceful_lite_options_header_headline_status', 'show' );
if ( 'show' == $forceful_lite_options_header_headline_status ) { ?>
    <!-- top-sidebar -->
    <div class="kp-headline-wrapper">
        <div class="wrapper">
            <div class="row-fluid">
                <div class="span12 clearfix">
                    <div class="l-col widget-area-4">
                        <div class="r-color"></div>
                        <h4 class="kp-headline-title"><?php echo get_theme_mod( 'forceful_lite_options_header_headline_title', 'Breaking'); ?> <span><?php echo get_theme_mod( 'forceful_lite_options_header_headline_light_title', 'News' ) ?></span></h4>
                        <div class="kp-headline clearfix">
                            <dl class="ticker-1 clearfix">
                                <?php
                                $forceful_lite_headline_category_id                = (int) get_theme_mod( 'forceful_lite_options_header_headline_category' );
                                $forceful_lite_theme_options_headline_posts_number = (int) get_theme_mod( 'forceful_lite_options_header_headline_limit' );

                                if ( $forceful_lite_theme_options_headline_posts_number <= 1 ) {
                                    $forceful_lite_theme_options_headline_posts_number = 10;
                                }

                                $forceful_lite_headline_posts = new WP_Query( array(
                                    'cat'            => $forceful_lite_headline_category_id,
                                    'posts_per_page' => $forceful_lite_theme_options_headline_posts_number,
                                ) );

                                if ( $forceful_lite_headline_posts->have_posts() ) {
                                    while ( $forceful_lite_headline_posts->have_posts() )  {
                                        $forceful_lite_headline_posts->the_post();
                                        echo '<dd><a href="'.get_permalink().'">'.get_the_title().'</a></dd>';
                                    }
                                }

                                wp_reset_postdata();
                                ?>
                            </dl>
                            <!--ticker-1-->
                        </div>
                        <!--kp-headline-->
                    </div>
                    <!-- widget-area-4 -->
                    <div class="r-col widget-area-5">
                        <?php forceful_lite_social(); ?>
                    </div>
                    <!-- widget-area-5 -->
                </div>
                <!-- span12 -->
            </div>
            <!-- row-fluid -->
        </div>
        <!-- wrapper -->
    </div>
    <!--kp-headline-wrapper-->
<?php
} // endif
?>