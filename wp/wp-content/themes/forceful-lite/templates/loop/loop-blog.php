<ul class="entry-list">
    <?php
    if ( have_posts() ) {
        while( have_posts() ) {
            the_post();

            if ( 'video' == get_post_format() ) {
                $forceful_lite_data_icon = 'video'; // icon-film-2
            } elseif ( 'gallery' == get_post_format() ) {
                $forceful_lite_data_icon = 'images'; // icon-images
            } elseif ( 'audio' == get_post_format() ) {
                $forceful_lite_data_icon = 'music'; // icon-music
            } else {
                $forceful_lite_data_icon = 'pencil'; // icon-pencil
            }
    ?>
    <li id="li-post-<?php the_ID(); ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class('entry-item clearfix'); ?>>
            <div class="entry-thumb">
                <?php
                // flag to determine whether or not display arrow button
                $forceful_lite_has_printed_thumbnail = false;

                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'kopa-image-size-6' ); // 496 x 346
                    $forceful_lite_has_printed_thumbnail = true;
                } elseif ( 'video' == get_post_format() ) {
                    $video = forceful_lite_content_get_video( get_the_content() );

                    if ( isset( $video[0] ) ) {
                        $video = $video[0];
                    } else {
                        $video = '';
                    }

                    if ( isset( $video['type'] ) && isset( $video['url'] ) ) {
                        $video_thumbnail_url = forceful_lite_get_video_thumbnails_url( $video['type'], $video['url'] );
                        echo '<img src="'.esc_url( $video_thumbnail_url ).'" alt="'.get_the_title().'">';
                        $forceful_lite_has_printed_thumbnail = true;
                    }
                } elseif ( 'gallery' == get_post_format() ) {
                    $gallery_ids = forceful_lite_content_get_gallery_attachment_ids( get_the_content() );

                    if ( ! empty( $gallery_ids ) ) {
                        foreach ( $gallery_ids as $id ) {
                            if ( wp_attachment_is_image( $id ) ) {
                                echo wp_get_attachment_image( $id, 'kopa-image-size-6' ); // 496 x 346
                                $forceful_lite_has_printed_thumbnail = true;
                                break;
                            }
                        }
                    }
                } // endif has_post_thumbnail
                ?>

                <?php if ( $forceful_lite_has_printed_thumbnail  ) { ?>
                    <a href="<?php the_permalink(); ?>"><?php echo Forceful_Lite_Icon::getIcon('long-arrow-right'); ?></a>
                <?php } // endif ?>
            </div>
            <!-- entry-thumb -->
            <div class="entry-content">
                <header>

                    <?php // show categories only for post
                    if ( 'post' == $post->post_type ) { ?>
                        <span class="entry-categories"><?php echo Forceful_Lite_Icon::getIcon('star', 'span'); ?><?php the_category(', '); ?></span>
                    <?php } // endif ?>

                    <h4 class="entry-title clearfix">

                        <?php if ( 'post' == $post->post_type ) { ?>
                            <?php echo Forceful_Lite_Icon::getIcon($forceful_lite_data_icon , 'span'); ?>
                        <?php } // endif ?>

                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                    <div class="meta-box">
                        <span class="entry-date"><a href="<?php echo get_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>

                        <?php if ( 'post' == $post->post_type ) { ?>
                            <span class="entry-author"><?php esc_html_e( 'By', 'forceful-lite' ); ?> <?php the_author_posts_link(); ?></span>
                        <?php } // endif ?>

                        <?php if(comments_open()){ ?>
                    <span class="entry-comments"><?php echo Forceful_Lite_Icon::getIcon('comment', 'span'); ?><?php ?><?php comments_popup_link( '0', '1', '%'); ?></span>
                    <?php } ?>

                        <?php $kopa_total_view_count = get_post_meta( get_the_ID(), 'forceful_lite_total_view', true );

                        if ( 'show' == get_theme_mod('forceful_lite_options_post_view_count_status', 'show') && $kopa_total_view_count ) { ?>

                        <span class="entry-view"><?php echo Forceful_Lite_Icon::getIcon('view', 'span'); ?><?php echo wp_kses_post( $kopa_total_view_count ); ?></span>

                        <?php } ?>
                    </div>
                    <!-- meta-box -->

                    <div class="clear"></div>
                </header>
                <?php the_excerpt(); ?>
            </div>
            <!-- entry-content -->
        </article>
        <!-- entry-item -->
    </li>
    <?php
        } // endwhile
    } // endif
    ?>
</ul>
<!-- entry-list -->

<!-- pagination -->
<?php get_template_part('templates/pagination'); ?>