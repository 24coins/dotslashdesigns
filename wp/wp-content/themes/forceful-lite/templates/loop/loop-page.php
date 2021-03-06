<?php if ( have_posts() ) {
    while ( have_posts() ) {
        the_post(); ?>

    <div id="page-<?php the_ID(); ?>" <?php post_class('elements-box'); ?>>
        <?php the_content(); ?>
    </div>

    <div class="wp-link-pages clearfix">
        <?php wp_link_pages( array(
            'before'   => '<p>',
            'after'    => '</p>',
            'pagelink' => esc_html__( 'Page %', 'forceful-lite' )
        ) ); ?>
    </div> <!-- .wp-link-pages -->

    <?php comments_template(); ?>

<?php } // endwhile
} // endif
?>