<?php
$prev_post = get_previous_post();

if ( ! empty( $prev_post ) ) { ?>
    <div class="prev-post">
        <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><span>&laquo;</span>&nbsp;<?php esc_html_e( 'Previous Article', 'forceful-lite' ); ?></a>
        <p>
            <a class="article-title" href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo wp_kses_post( $prev_post->post_title ); ?></a>
            <span class="entry-date"><?php echo get_the_time( get_option( 'date_format' ), $prev_post->ID ); ?></span>
            <span class="entry-author"><?php esc_html_e( 'By', 'forceful-lite' ); ?> <a href="<?php echo get_author_posts_url( $prev_post->post_author ); ?>"><?php the_author_meta( 'display_name', $prev_post->post_author ); ?></a></span>
        </p>
    </div>
<?php } // endif ?>

<?php
$next_post = get_next_post();
if ( ! empty( $next_post ) ) { ?>
    <div class="next-post">
        <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php esc_html_e( 'Next Article', 'forceful-lite' ); ?>&nbsp;<span>&raquo;</span></a>
        <p>
            <a class="article-title" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo wp_kses_post( $next_post->post_title ); ?></a>
            <span class="entry-date"><?php echo get_the_time( get_option( 'date_format' ), $next_post->ID ); ?></span>
            <span class="entry-author"><?php esc_html_e( 'By', 'forceful-lite' ); ?> <a href="<?php echo get_author_posts_url( $next_post->post_author ); ?>"><?php the_author_meta( 'display_name', $next_post->post_author ); ?></a></span>
        </p>
    </div>
<?php } // endif ?>