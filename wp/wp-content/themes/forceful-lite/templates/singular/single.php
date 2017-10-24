<?php
$sb_7 = apply_filters('forceful_lite_get_sidebar', 'sidebar_7', 'pos_sidebar_7');
?>

<?php get_template_part('templates/headline'); ?>
asd asdsa f
<div id="main-content">

    <div class="wrapper">
        <div class="row-fluid">
            <div class="span12 clearfix">
                <div class="l-col widget-area-6">
                    <div class="r-color"></div>

                    <?php forceful_lite_breadcrumb(); ?>

                    <div class="row-fluid">
                        <div class="span12">

                            <?php get_template_part( 'templates/content/contents' ); ?>

                        </div>
                        <!-- span12 -->
                    </div>
                    <!-- row-fluid -->

                </div>
                <!-- l-col -->

                <div class="r-col widget-area-7">

                    <?php if ( is_active_sidebar( $sb_7) ) {
                        dynamic_sidebar( $sb_7 );
                    } ?>

                </div>
                <!-- r-col -->
            </div>
            <!-- span12 -->
        </div>
        <!-- row-fluid -->
    </div>
    <!-- wrapper -->
</div>
<!-- main-content -->