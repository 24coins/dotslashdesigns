<?php get_template_part('templates/headline'); ?>
<div id="main-content">
    <div class="wrapper">
        <div class="row-fluid">
            <div class="span12 clearfix">
                <?php forceful_lite_breadcrumb(); ?>
                <!-- breadcrumb -->
                <section class="error-404 clearfix">
                    <div class="left-col">
                        <p><?php esc_html_e( '404', 'forceful-lite' ); ?></p>
                    </div><!--left-col-->
                    <div class="right-col">
                        <h1><?php esc_html_e( 'Page not found...', 'forceful-lite' ); ?></h1>
                        <p><?php esc_html_e( "We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of this options:", 'forceful-lite' ); ?></p>
                        <ul class="arrow-list">
                            <?php if ( isset( $_SERVER['HTTP_REFERER'] ) ) { ?>
                            <li><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><?php esc_html_e( 'Go back to previous page', 'forceful-lite' ); ?></a></li>
                            <?php } ?>
                            <li><a href="<?php echo home_url(); ?>"><?php esc_html_e( 'Go to homepage', 'forceful-lite' ); ?></a></li>
                        </ul>
                    </div><!--right-col-->
                </section><!--error-404-->
            </div>
            <!-- span12 -->
        </div>
        <!-- row-fluid -->
    </div>
    <!-- wrapper -->
</div>
<!-- main-content -->
