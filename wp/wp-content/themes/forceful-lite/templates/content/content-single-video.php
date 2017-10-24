<?php
$forceful_lite_options_featured_image_status = get_theme_mod( 'forceful_lite_options_featured_image_status', 'show');
$forceful_lite_options_post_thumbnail_style  = get_theme_mod( 'forceful_lite_options_post_thumbnail_style', 'small' );

if ( 'small' == $forceful_lite_options_post_thumbnail_style && 'show' == $forceful_lite_options_featured_image_status && has_post_thumbnail() ) {
    echo '<div class="kopa-single-2">';
} // endif
?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-thumb-video">
            <?php
                $video = forceful_lite_content_get_video( get_the_content() );

                if ( isset( $video[0] ) ) {
                    $video = $video[0];
                } else {
                    $video = '';
                }

                if ( isset( $video['shortcode'] ) ) {
                    echo do_shortcode( $video['shortcode'] );
                }
            ?>
        </div>
        <?php if ( !isset( $video['shortcode'] ) && 'show' == $forceful_lite_options_featured_image_status && 'small' == $forceful_lite_options_post_thumbnail_style && has_post_thumbnail() ) { ?>
            <div class="entry-thumb">
                <?php the_post_thumbnail( 'kopa-image-size-8' ); // 795 x 429 ?>
            </div>
        <?php } // endif ?>

        <header>
            <span class="entry-categories"><?php echo Forceful_Lite_Icon::getIcon('star', 'span'); ?><?php the_category( ', ' ); ?></span>
            <span class="entry-box-icon"><?php echo Forceful_Lite_Icon::getIcon('pencil', 'span'); ?></span>
            <div class="entry-box-title clearfix">
                <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="meta-box">
                    <span class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></span>
                    <span class="entry-author"><?php esc_html_e( 'By', 'forceful-lite' ); ?> <?php the_author_posts_link(); ?></span>
                    <?php if(comments_open()){ ?>
                    <span class="entry-comments"><?php echo Forceful_Lite_Icon::getIcon('comment', 'span'); ?><?php ?><?php comments_popup_link( '0', '1', '%'); ?></span>
                    <?php } ?>
                    <?php
                    $forceful_lite_total_view = get_post_meta( get_the_ID(), 'forceful_lite_total_view', true );

                    if ( 'show' == get_theme_mod('forceful_lite_options_post_view_count_status') && $forceful_lite_total_view ) {
                    ?>
                        <span class="entry-view"><?php echo Forceful_Lite_Icon::getIcon('view', 'span'); ?><?php echo wp_kses_post( $forceful_lite_total_view ); ?></span>
                    <?php } // endif ?>
                </div>
                <!-- meta-box -->

                <div class="clear"></div>
            </div>
            <!-- entry-box-title -->
            <div class="clear"></div>
        </header>
        <?php if ( !isset( $video['shortcode'] ) && 'show' == $forceful_lite_options_featured_image_status && 'large' == $forceful_lite_options_post_thumbnail_style ) { ?>
            <div class="entry-thumb">
                <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'large' ); // 795 x auto
                } ?>
            </div>
        <?php } // endif ?>

        <div class="elements-box">
            <?php $content = get_the_content();
                $content = preg_replace( '/\[vimeo.*].*\[\/vimeo]/', '', $content );
                $content = preg_replace( '/\[vimeo.*]/', '', $content );
                $content = str_replace(']]>', ']]&gt;', $content);

                $content = preg_replace( '/\[youtube.*].*\[\/youtube]/', '', $content );
                $content = preg_replace( '/\[youtube.*]/', '', $content );
                $content = apply_filters( 'the_content', $content );
                $content = str_replace(']]>', ']]&gt;', $content);

                echo  sprintf( '%s', $content );
            ?>
        </div>
        <div class="clear"></div>

        <div class="wp-link-pages clearfix">
            <?php wp_link_pages( array(
                'before'   => '<p>',
                'after'    => '</p>',
                'pagelink' => esc_html__( 'Page %', 'forceful-lite' )
            ) ); ?>
        </div> <!-- .wp-link-pages -->

        <footer class="clearfix">
            <?php get_template_part( 'templates/post-navigation' ); ?>
        </footer>
    </div>
    <!-- entry-box -->

<?php
if ( 'small' == $forceful_lite_options_post_thumbnail_style && 'show' == $forceful_lite_options_featured_image_status && has_post_thumbnail() ) {
    echo '</div> <!-- .kopa-single-2 -->';
} // endif
?>