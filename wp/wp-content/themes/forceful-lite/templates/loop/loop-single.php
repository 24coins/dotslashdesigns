<?php if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();

        get_template_part( 'templates/content/content-single', get_post_format() );
?>

    <?php if ( 'show' == get_theme_mod( 'forceful_lite_options_post_about_author_status', 'show' ) ) { ?>
        <div class="about-author clearfix">
            <header class="clearfix">
                <h4><?php esc_html_e( 'About the author', 'forceful-lite' ); ?>&nbsp;/&nbsp;</h4>
                <a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
            </header>

            <a class="avatar-thumb" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 82 ); ?></a>
            <div class="author-content">
                <?php
                $author_facebook_url = get_the_author_meta( 'facebook' );
                $author_twitter_url  = get_the_author_meta( 'twitter' );
                $author_feed_url     = get_the_author_meta( 'feedurl' );
                $author_gplus_url    = get_the_author_meta( 'google-plus' );
                $author_flickr_url   = get_the_author_meta( 'flickr' );

                if ( $author_facebook_url || $author_twitter_url || $author_feed_url || $author_gplus_url || $author_flickr_url ) {
                ?>
                <ul class="social-link clearfix">
                    <!-- facebook -->
                    <?php if ( ! empty( $author_facebook_url ) ) { ?>
                    <li><a href="<?php echo esc_url( $author_facebook_url ); ?>"><?php echo Forceful_Lite_Icon::getIcon('facebook'); ?></a></li>
                    <?php } // endif ?>

                    <!-- twitter -->
                    <?php if ( ! empty( $author_twitter_url ) ) { ?>
                    <li><a href="<?php echo esc_url( $author_twitter_url ); ?>"><?php echo Forceful_Lite_Icon::getIcon('twitter'); ?></a></li>
                    <?php } // endif ?>

                    <!-- feed -->
                    <?php if ( ! empty( $author_feed_url ) ) { ?>
                    <li><a href="<?php echo esc_url( $author_feed_url ); ?>"><?php echo Forceful_Lite_Icon::getIcon('link'); ?></a></li>
                    <?php } // endif ?>

                    <!-- google plus -->
                    <?php if ( ! empty( $author_gplus_url ) ) { ?>
                    <li><a href="<?php echo esc_url( $author_gplus_url ); ?>"><?php echo Forceful_Lite_Icon::getIcon('google-plus'); ?></a></li>
                    <?php } // endif ?>

                    <!-- flickr -->
                    <?php if ( ! empty( $author_flickr_url ) ) { ?>
                    <li><a href="<?php echo esc_url( $author_flickr_url ); ?>"><?php echo Forceful_Lite_Icon::getIcon('flickr'); ?></a></li>
                    <?php } // endif ?>
                </ul>
                <?php } // endif ?>

                <!-- social-link -->
                <p><?php the_author_meta( 'description' ); ?></p>
            </div><!--author-content-->
        </div><!--about-author-->
    <?php } // endif ?>

    <div class="tag-box">
        <?php the_tags( '', ' ', '' ); ?>
    </div><!--tag-box-->

    <?php forceful_lite_get_related_articles(); ?>


    <?php comments_template(); ?>

<?php } // endwhile
} // endif