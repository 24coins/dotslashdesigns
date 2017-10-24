<?php
if ( class_exists('Kopa_Framework') ){
    add_filter( 'kopa_current_tab_default', 'forceful_lite_set_default_tab');
    add_filter( 'kopa_settings_theme_options_enable', '__return_false' );
}

function forceful_lite_set_default_tab($key) {
    return 'sidebar-manager'; // layout-manager, backup-manager
}

add_action('after_setup_theme', 'forceful_lite_front_after_setup_theme');

function forceful_lite_front_after_setup_theme() {
    add_theme_support( 'title-tag' );
    add_theme_support('post-formats', array('gallery', 'audio', 'video'));
    add_theme_support('post-thumbnails');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');
    add_theme_support('editor_style');
    add_editor_style('editor-style.css');

    global $content_width;
    if (!isset($content_width)) {
        $content_width = 795;
    }

    register_nav_menus(array(
        'main-nav'   => esc_html__('Main Menu', 'forceful-lite'),
        'footer-nav' => esc_html__('Footer Menu', 'forceful-lite')
    ));

    if (!is_admin()) {
        add_action('wp_enqueue_scripts', 'forceful_lite_front_enqueue_scripts');
        add_action('wp_footer', 'forceful_lite_footer');
        add_action('wp_head', 'forceful_lite_head');
        add_filter('the_category', 'forceful_lite_the_category');
        add_filter('get_the_excerpt', 'forceful_lite_get_the_excerpt');
        add_filter('post_class', 'forceful_lite_post_class');
        add_filter('body_class', 'forceful_lite_body_class');
        add_filter('wp_nav_menu_items', 'forceful_lite_add_icon_home_menu', 10, 2);
        add_filter('wp_tag_cloud', 'forceful_lite_tag_cloud');
        add_filter('excerpt_length', 'forceful_lite_custom_excerpt_length');
        add_filter('excerpt_more', 'forceful_lite_custom_excerpt_more');
        add_filter('forceful_lite_icon_get_icon', 'forceful_lite_icon_get_icon', 10, 3);
    }

    $sizes = array(
        'kopa-image-size-0' => array(579, 382, TRUE, esc_html__('Flexslider Post Image (Kopatheme)', 'forceful-lite')),
        'kopa-image-size-1' => array(247, 146, TRUE, esc_html__('Carousel Post Image (Kopatheme)', 'forceful-lite')),
        'kopa-image-size-2' => array(451, 259, TRUE, esc_html__('Popular Widget Post Image (Kopatheme)', 'forceful-lite')),
        'kopa-image-size-4' => array(81, 81, TRUE, esc_html__('Entry List Widget Small Post Image (Kopatheme)', 'forceful-lite')),
        'kopa-image-size-5' => array(276, 202, TRUE, esc_html__('Gallery Widget Post Image (Kopatheme)', 'forceful-lite')),
        'kopa-image-size-6' => array(496, 346, TRUE, esc_html__('Quick Sort Widget Post Image (Kopatheme)', 'forceful-lite')),
        'kopa-image-size-8' => array(648, 430, TRUE, esc_html__('Single Post Image (Kopatheme)', 'forceful-lite')),
    );

    apply_filters('forceful_lite_get_image_sizes', $sizes);

    foreach ($sizes as $slug => $details) {
        add_image_size($slug, $details[0], $details[1], $details[2]);
    }
}

function forceful_lite_tag_cloud($out) {

    $matches = array();
    $pattern = '/<a[^>]*?>([\\s\\S]*?)<\/a>/';
    preg_match_all($pattern, $out, $matches);

    $htmls = $matches[0];
    $texts = $matches[1];
    $new_html = '';
    for ($index = 0; $index < count($htmls); $index++) {

        $new_html.= preg_replace('#(<a.*?(href=\'.*?\').*?>).*?(</a>)#', '<a ' . '$2' . '>' . $texts[$index] . '$3' . ' ', $htmls[$index]);
    }

    return $new_html;
}

function forceful_lite_post_class($classes) {
    if (is_single()) {
        $classes[] = 'entry-box';
        $classes[] = 'clearfix';
    }
    return $classes;
}

function forceful_lite_body_class($classes) {
    $template_setting = forceful_lite_get_template_setting();

    if (is_front_page()) {
        $classes[] = 'home-page';
    } else {
        $classes[] = 'sub-page';
    }

    if (is_404()) {
        $classes[] = 'kopa-404-page';
    }

    switch ($template_setting['layout_id']) {
        case 'single-right-sidebar':
            break;
    }

    return $classes;
}

function forceful_lite_footer() {
    wp_nonce_field('forceful_lite_set_view_count', 'forceful_lite_set_view_count_wpnonce', false);
    wp_nonce_field('forceful_lite_set_user_rating', 'forceful_lite_set_user_rating_wpnonce', false);
}

function forceful_lite_front_enqueue_scripts() {
    if (!is_admin()) {
        global $wp_styles, $is_IE;

        $dir = get_template_directory_uri();

        /* STYLESHEETs */
        wp_enqueue_style('forceful-lilte-google-font', '//fonts.googleapis.com/css?family=Open+Sans', array(), NULL);
        wp_enqueue_style('forceful-lilte-bootstrap', $dir . '/css/bootstrap.css');
        wp_enqueue_style('forceful-lilte-FontAwesome', $dir . '/css/font-awesome.css');
        wp_enqueue_style('forceful-lilte-superfish', $dir . '/css/superfish.css');
        wp_enqueue_style('forceful-lilte-prettyPhoto', $dir . '/css/prettyPhoto.css');
        wp_enqueue_style('forceful-lilte-flexlisder', $dir . '/css/flexslider.css');
        wp_enqueue_style('forceful-lilte-mCustomScrollbar', $dir . '/css/jquery.mCustomScrollbar.css');
        wp_enqueue_style('forceful-lilte-owlCarousel', $dir . '/css/owl.carousel.css');
        wp_enqueue_style('forceful-lilte-owltheme', $dir . '/css/owl.theme.css');

        wp_enqueue_style('forceful-lilte-style', get_stylesheet_uri());
        wp_enqueue_style('forceful-lilte-bootstrap-responsive', $dir . '/css/bootstrap-responsive.css');

        if ('enable' == get_theme_mod('forceful_lite_options_responsive_status', 'enable')) {
            wp_enqueue_style('forceful-lilte-responsive', $dir . '/css/responsive.css');
        }

        if ($is_IE) {
            wp_register_style('forceful-lilte-ie', $dir . '/css/ie.css', array(), NULL);
            $wp_styles->add_data('forceful-lilte-ie', 'conditional', 'lt IE 9');
            wp_enqueue_style('forceful-lilte-ie');

            $ie_matches = '';
            preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $ie_matches);
            if (count($ie_matches) > 1) {
                $ie_version = $ie_matches[1];
                if ($ie_version < 9) {
                    wp_enqueue_script('forceful-lilte-ie-html5', $dir . '/js/html5.js');
                    wp_enqueue_script('forceful-lilte-ie-css3', $dir . '/js/css3-mediaqueries.js');
                    wp_enqueue_script('forceful-lilte-pie-678', $dir . '/js/PIE_IE678.js');
                }
            }

        }

        /* JAVASCRIPTs */

        wp_enqueue_script('forceful-lilte-modernizr', $dir . '/js/modernizr.custom.js');
        wp_localize_script('jquery', 'kopa_front_variable', forceful_lite_front_localize_script());
        wp_enqueue_script('forceful-lilte-superfish-js', $dir . '/js/superfish.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-retina', $dir . '/js/retina.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-bootstrap-js', $dir . '/js/bootstrap.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-flexlisder-js', $dir . '/js/jquery.flexslider-min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-carouFredSel', $dir . '/js/jquery.carouFredSel-6.0.4-packed.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-jflickrfeed', $dir . '/js/jflickrfeed.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-prettyPhoto-js', $dir . '/js/jquery.prettyPhoto.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-owlcarousel', $dir . '/js/owl.carousel.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-timeago-js', $dir . '/js/jquery.timeago.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-imagesloaded', $dir . '/js/imagesloaded.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-jquery-validate', $dir . '/js/jquery.validate.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('jquery-form');
        wp_enqueue_script('forceful-lilte-mCustomScrollbar', $dir . '/js/jquery.mCustomScrollbar.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-modernizr-transitions', $dir . '/js/modernizr-transitions.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-masonry', $dir . '/js/masonry.pkgd.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-filtermasonry', $dir . '/js/filtermasonry.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-set-view-count', $dir . '/js/set-view-count.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('forceful-lilte-custom-js', $dir . '/js/custom.js', array('jquery'), NULL, TRUE);
        // send localization to frontend
        wp_localize_script('forceful-lilte-custom-js', 'kopa_custom_front_localization', forceful_lite_custom_front_localization());

        if (is_single() || is_page()) {
            wp_enqueue_script('comment-reply');
        }
    }
}

function forceful_lite_front_localize_script() {
    $forceful_lite_variable = array(
        'ajax' => array(
            'url' => admin_url('admin-ajax.php')
        ),
        'template' => array(
            'post_id' => (is_singular()) ? get_queried_object_id() : 0
        )
    );
    return $forceful_lite_variable;
}

function forceful_lite_custom_front_localization() {
    $front_localization = array(
        'validate' => array(
            'form' => array(
                'submit' => esc_html__('Submit', 'forceful-lite'),
                'sending' => esc_html__('Sending...', 'forceful-lite')
            ),
            'name' => array(
                'required' => esc_html__('Please enter your name.', 'forceful-lite'),
                'minlength' => __('At least {0} characters required.', 'forceful-lite')
            ),
            'email' => array(
                'required' => esc_html__('Please enter your email.', 'forceful-lite'),
                'email' => esc_html__('Please enter a valid email.', 'forceful-lite')
            ),
            'url' => array(
                'required' => esc_html__('Please enter your url.', 'forceful-lite'),
                'url' => esc_html__('Please enter a valid url.', 'forceful-lite')
            ),
            'message' => array(
                'required' => esc_html__('Please enter a message.', 'forceful-lite'),
                'minlength' => __('At least {0} characters required.', 'forceful-lite')
            )
        ),
        'twitter' => array(
            'loading' => esc_html__('Loading...', 'forceful-lite'),
            'failed' => esc_html__('Sorry, twitter is currently unavailable for this user.', 'forceful-lite')
        )
    );

    return $front_localization;
}

function forceful_lite_the_category($thelist) {
    return $thelist;
}

function forceful_lite_set_view_count($post_id) {
    $new_view_count = 0;
    $meta_key = 'forceful_lite_total_view';

    $current_views = (int) get_post_meta($post_id, $meta_key, true);

    if ($current_views) {
        $new_view_count = $current_views + 1;
        update_post_meta($post_id, $meta_key, $new_view_count);
    } else {
        $new_view_count = 1;
        add_post_meta($post_id, $meta_key, $new_view_count);
    }
    return $new_view_count;
}

function forceful_lite_breadcrumb() {
    // get show/hide option
    $forceful_lite_options_breadcrumb_status = get_theme_mod('forceful_lite_options_breadcrumb_status');

    if ($forceful_lite_options_breadcrumb_status != 'show') {
        return;
    }

    if (is_main_query()) {
        global $post, $wp_query;

        $prefix            = '&nbsp;/&nbsp;';
        $current_class     = 'current-page';
        $description       = '';
        $breadcrumb_before = '<div class="row-fluid"><div class="span12"><div class="breadcrumb">';
        $breadcrumb_after  = '</div></div></div>';
        $breadcrumb_home   = '<span>' . __('You are here:', 'forceful-lite') . '</span> <a href="' . esc_url(home_url( '/' )) . '">' . __('Home', 'forceful-lite') . '</a>';
        $breadcrumb        = '';
        ?>

        <?php
        if (is_home()) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Blog', 'forceful-lite'));
        } else if (is_post_type_archive('product') && jigoshop_get_page_id('shop')) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(jigoshop_get_page_id('shop')));
        } else if (is_tag()) {
            $breadcrumb.= $breadcrumb_home;

            $term = get_term(get_queried_object_id(), 'post_tag');
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $term->name);
        } else if (is_category()) {
            $breadcrumb.= $breadcrumb_home;

            $category_id = get_queried_object_id();
            $terms_link = explode(',', substr(get_category_parents(get_queried_object_id(), TRUE, ','), 0, (strlen(',') * -1)));
            $n = count($terms_link);
            if ($n > 1) {
                for ($i = 0; $i < ($n - 1); $i++) {
                    $breadcrumb.= $prefix . $terms_link[$i];
                }
            }
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_category_by_ID(get_queried_object_id()));
        } else if (is_tax('product_cat')) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= '<a href="' . get_page_link(jigoshop_get_page_id('shop')) . '">' . get_the_title(jigoshop_get_page_id('shop')) . '</a>';
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

            $parents = array();
            $parent = $term->parent;
            while ($parent):
                $parents[] = $parent;
                $new_parent = get_term_by('id', $parent, get_query_var('taxonomy'));
                $parent = $new_parent->parent;
            endwhile;
            if (!empty($parents)):
                $parents = array_reverse($parents);
                foreach ($parents as $parent):
                    $item = get_term_by('id', $parent, get_query_var('taxonomy'));
                    $breadcrumb .= '<a href="' . get_term_link($item->slug, 'product_cat') . '">' . $item->name . '</a>';
                endforeach;
            endif;

            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if (is_tax('product_tag')) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= '<a href="' . get_page_link(jigoshop_get_page_id('shop')) . '">' . get_the_title(jigoshop_get_page_id('shop')) . '</a>';
            $queried_object = get_queried_object();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if (is_single()) {
            $breadcrumb.= $breadcrumb_home;

            if (get_post_type() === 'product') :

                $breadcrumb .= '<a href="' . get_page_link(jigoshop_get_page_id('shop')) . '">' . get_the_title(jigoshop_get_page_id('shop')) . '</a>';

                if ($terms = get_the_terms($post->ID, 'product_cat')) :
                    $term = apply_filters('jigoshop_product_cat_breadcrumb_terms', current($terms), $terms);
                    $parents = array();
                    $parent = $term->parent;
                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by('id', $parent, 'product_cat');
                        $parent = $new_parent->parent;
                    endwhile;
                    if (!empty($parents)):
                        $parents = array_reverse($parents);
                        foreach ($parents as $parent):
                            $item = get_term_by('id', $parent, 'product_cat');
                            $breadcrumb .= '<a href="' . get_term_link($item->slug, 'product_cat') . '">' . $item->name . '</a>';
                        endforeach;
                    endif;
                    $breadcrumb .= '<a href="' . get_term_link($term->slug, 'product_cat') . '">' . $term->name . '</a>';
                endif;

                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title());

            else :

                $categories = get_the_category(get_queried_object_id());
                if ($categories) {
                    foreach ($categories as $category) {
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_category_link($category->term_id), $category->name);
                    }
                }

                $post_id = get_queried_object_id();
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title($post_id));

            endif;
        } else if (is_page()) {
            if (!is_front_page()) {
                $post_id = get_queried_object_id();
                $breadcrumb.= $breadcrumb_home;
                $post_ancestors = get_post_ancestors($post);
                if ($post_ancestors) {
                    $post_ancestors = array_reverse($post_ancestors);
                    foreach ($post_ancestors as $crumb)
                        $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_permalink($crumb), get_the_title($crumb));
                }
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(get_queried_object_id()));
            }
        } else if (is_year() || is_month() || is_day()) {
            $breadcrumb.= $breadcrumb_home;

            $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);

            $date['y'] = get_the_time('Y');
            $date['m'] = get_the_time('m');
            $date['d'] = get_the_time('j');

            if (is_year()) {
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['y']);
            }

            if (is_month()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, date('F', mktime(0, 0, 0, $date['m'])));
            }

            if (is_day()) {
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb.= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_month_link($date['y'], $date['m']), date('F', mktime(0, 0, 0, $date['m'])));
                $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['d']);
            }
        } else if (is_search()) {
            $breadcrumb.= $breadcrumb_home;

            $s = get_search_query();
            $c = $wp_query->found_posts;

            $description = sprintf(__('<span class="%1$s">Your search for "%2$s"', 'forceful-lite'), $current_class, $s);
            $breadcrumb .= $prefix . $description;
        } else if (is_author()) {
            $breadcrumb.= $breadcrumb_home;
            $author_id = get_queried_object_id();
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</a>', $current_class, sprintf(__('Posts created by %1$s', 'forceful-lite'), get_the_author_meta('display_name', $author_id)));
        } else if (is_404()) {
            $breadcrumb.= $breadcrumb_home;
            $breadcrumb.= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Error 404', 'forceful-lite'));
        }

        if ($breadcrumb)
            echo apply_filters('forceful_lite_breadcrumb', $breadcrumb_before . $breadcrumb . $breadcrumb_after);
    }
}

function forceful_lite_get_related_articles() {
    if (is_single()) {
        $get_by = get_theme_mod('forceful_lite_options_post_related_get_by');
        if ('hide' != $get_by) {
            $limit = (int) get_theme_mod('forceful_lite_options_post_related_limit');
            if ($limit > 0) {
                global $post;
                $taxs = array();
                if ('category' == $get_by) {
                    $cats = get_the_category(($post->ID));
                    if ($cats) {
                        $ids = array();
                        foreach ($cats as $cat) {
                            $ids[] = $cat->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                } else {
                    $tags = get_the_tags($post->ID);
                    if ($tags) {
                        $ids = array();
                        foreach ($tags as $tag) {
                            $ids[] = $tag->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'post_tag',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                }

                if ($taxs) {
                    $related_args = array(
                        'tax_query' => $taxs,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => $limit
                    );
                    $related_posts = new WP_Query($related_args);
                    if ($related_posts->have_posts()) {
                        ?>
                        <div class="kopa-related-post">
                            <h4><?php esc_html_e('Related Posts', 'forceful-lite'); ?></h4>
                            <div class="list-carousel responsive" >
                                <ul class="kopa-featured-news-carousel" data-pagination-id="#single_related_posts_pager" data-scroll-items="1">
                        <?php
                        $post_index = 1;
                        while ($related_posts->have_posts()) {
                            $related_posts->the_post();

                            if ('video' == get_post_format()) {
                                $forceful_lite_data_icon = 'film'; // icon-film-2
                            } elseif ('gallery' == get_post_format()) {
                                $forceful_lite_data_icon = 'images'; // icon-images
                            } elseif ('audio' == get_post_format()) {
                                $forceful_lite_data_icon = 'music'; // icon-music
                            } else {
                                $forceful_lite_data_icon = 'pencil'; // icon-pencil
                            }
                            ?>
                                        <li>
                                            <article class="entry-item clearfix">
                                                <div class="entry-thumb">
                                        <?php
                                        // flag to determine whether or not display arrow button
                                        $kopa_has_printed_thumbnail = false;

                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('kopa-image-size-1'); // 247 x 146
                                            $kopa_has_printed_thumbnail = true;
                                        } elseif ('video' == get_post_format()) {
                                            $video = forceful_lite_content_get_video(get_the_content());

                                            if (isset($video[0])) {
                                                $video = $video[0];
                                            } else {
                                                $video = '';
                                            }

                                            if (isset($video['type']) && isset($video['url'])) {
                                                $video_thumbnail_url = forceful_lite_get_video_thumbnails_url($video['type'], $video['url']);
                                                echo '<img src="' . esc_url($video_thumbnail_url) . '" alt="' . get_the_title() . '">';
                                                $kopa_has_printed_thumbnail = true;
                                            }
                                        } elseif ('gallery' == get_post_format()) {
                                            $gallery_ids = forceful_lite_content_get_gallery_attachment_ids(get_the_content());

                                            if (!empty($gallery_ids)) {
                                                foreach ($gallery_ids as $id) {
                                                    if (wp_attachment_is_image($id)) {
                                                        echo wp_get_attachment_image($id, 'kopa-image-size-1'); // 247 x 146
                                                        $kopa_has_printed_thumbnail = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        } // endif has_post_thumbnail
                                        ?>

                                                    <?php if ($kopa_has_printed_thumbnail) { ?>
                                                        <a href="<?php the_permalink(); ?>"><?php echo Forceful_Lite_Icon::getIcon('exit'); ?></a>
                                                    <?php } // endif ?>
                                                </div>
                                                <div class="entry-content">
                                                    <header class="clearfix">
                                                        <span class="entry-date"><?php the_time(get_option('date_format')); ?></span>
                            <?php
                            $post_rating = round(get_post_meta(get_the_ID(), 'kopa_editor_user_total_all_rating_' . 'forceful-lite', true));

                            if (!empty($post_rating)) {
                                ?>
                                                            <ul class="kopa-rating clearfix">
                                                            <?php
                                                            for ($i = 0; $i < $post_rating; $i++) {
                                                                echo '<li>' . Forceful_Lite_Icon::getIcon('star', 'span') . '</li>';
                                                            }
                                                            for ($i = 0; $i < 5 - $post_rating; $i++) {
                                                                echo '<li>' . Forceful_Lite_Icon::getIcon('star2', 'span') . '</li>';
                                                            }
                                                            ?>
                                                            </ul>
                                                            <?php } ?>
                                                    </header>
                                                    <h4 class="entry-title clearfix"><?php echo Forceful_Lite_Icon::getIcon($forceful_lite_data_icon, 'span'); ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                </div><!--entry-content-->
                                            </article><!--entry-item-->
                                        </li>
                        <?php } // endwhile  ?>
                                </ul>
                                <div class="clearfix"></div>
                                <div id="single_related_posts_pager" class="pager"></div>
                            </div> <!-- list-carousel -->
                        </div>
                        <?php
                    } // endif
                    wp_reset_postdata();
                }
            }
        }
    }
}

function forceful_lite_get_the_excerpt($excerpt) {
    if (is_main_query()) {
        if (is_search()) {
            $keys = implode('|', explode(' ', get_search_query()));
            return preg_replace('/(' . $keys . ')/iu', '<span class="kopa-search-keyword">\0</span>', $excerpt);
        } else {
            return $excerpt;
        }
    }
}

function forceful_lite_content_get_gallery($content, $enable_multi = false) {
    return forceful_lite_content_get_media($content, $enable_multi, array('gallery'));
}

function forceful_lite_content_get_video($content, $enable_multi = false) {
    return forceful_lite_content_get_media($content, $enable_multi, array('vimeo', 'youtube'));
}

function forceful_lite_content_get_audio($content, $enable_multi = false) {
    return forceful_lite_content_get_media($content, $enable_multi, array('audio', 'soundcloud'));
}

function forceful_lite_content_get_media($content, $enable_multi = false, $media_types = array()) {
    $media = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);
    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);

        if (in_array($regex_matches_new[2], $media_types)) :
            $media[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'url' => $regex_matches_new[5]
            );
            if (false == $enable_multi) {
                break;
            }
        endif;
    }

    return $media;
}

function forceful_lite_get_video_thumbnails_url($type, $url) {
    $thubnails = '';
    $matches = array();
    if ('youtube' === $type) {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        $thubnails = 'http://img.youtube.com/vi/'.$matches[0].'/hqdefault.jpg';
    } else if ('vimeo' === $type) {
        preg_match_all('#(http://vimeo.com)/([0-9]+)#i', $url, $matches);
        $imgid           = $matches[2][0];
        $url             = 'http://vimeo.com/api/v2/video/'.$imgid.'.php';
        $video_thumbnail = wp_remote_get($url);
        $thubnails       = unserialize ( wp_remote_retrieve_body( $video_thumbnail ) );
        $thubnails       = $thubnails[0]['thumbnail_large'];
    }
    return $thubnails;
}

function forceful_lite_head() {
    $logo_margin_top    = get_theme_mod('forceful_lite_options_logo_margin_top');
    $logo_margin_left   = get_theme_mod('forceful_lite_options_logo_margin_left');
    $logo_margin_right  = get_theme_mod('forceful_lite_options_logo_margin_right');
    $logo_margin_bottom = get_theme_mod('forceful_lite_options_logo_margin_bottom');

    echo "<style>
        #logo-image{
            margin-top:{$logo_margin_top}px;
            margin-left:{$logo_margin_left}px;
            margin-right:{$logo_margin_right}px;
            margin-bottom:{$logo_margin_bottom}px;
        }
    </style>";

    /* ==================================================================================================
     * Custom CSS
     * ================================================================================================= */
    $forceful_lite_theme_options_custom_css = htmlspecialchars_decode(stripslashes(get_theme_mod('forceful_lite_options_custom_css')));
    if ($forceful_lite_theme_options_custom_css)
        echo "<style>{$forceful_lite_theme_options_custom_css}</style>";

    /* ==================================================================================================
     * IE8 Fix CSS3
     * ================================================================================================= */
    echo "<style>
        .home-slider .entry-item .entry-thumb a,
        .search-box .search-form .search-text,
        .search-box .search-form .search-submit,
        .home-slider .flex-direction-nav a,
        .kopa-carousel-widget .list-carousel ul li .entry-thumb a, 
        .kopa-article-list-widget .tab-container-1 .entry-thumb a, 
        .kopa-related-post .list-carousel ul li .entry-thumb a,
        .kopa-social-widget ul li a,
        .kopa-popular-post-widget .entry-item .entry-thumb a,
        .play-icon,
        #pf-items .element .entry-thumb a,
        .kopa-social-static-widget ul li .social-icon,
        .entry-list li .entry-item .entry-thumb a,
        .kopa-carousel-widget .pager a, .kopa-related-post .pager a {
            behavior: url(" . get_template_directory_uri() . "/js/PIE.htc);
        }
    </style>";
}

function forceful_lite_add_icon_home_menu($items, $args) {

    if ('disable' == get_theme_mod('forceful_lite_options_home_menu_item_status', 'enable')) {
        return $items;
    }

    if ($args->theme_location == 'main-nav') {
        if ($args->menu_id == 'toggle-view-menu') {
            $homelink = '<li class="clearfix"><h3><a href="' . esc_url(home_url( '/' )) . '">' . esc_html__('Home', 'forceful-lite') . '</a></h3></li>';
            $items = $homelink . $items;
        } else if ($args->menu_id == 'main-menu') {
            $homelink = '<li class="menu-home-icon' . ( is_front_page() ? ' current-menu-item' : '') . '"><a href="' . esc_url(home_url( '/' )) . '">' . esc_html__('Home', 'forceful-lite') . '</a><span></span></li>';
            $items = $homelink . $items;
        }
    }
    return $items;
}

function forceful_lite_custom_excerpt_length($length) {
    $kopa_setting = forceful_lite_get_template_setting();

    if ('home' == $kopa_setting['layout_id']) {
        return 25;
    }

    return $length;
}

function forceful_lite_custom_excerpt_more($more) {
    return '...';
}

/**
 * Convert Hex Color to RGB using PHP
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
 */
function kopa_hex2rgba($hex, $alpha = false) {
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    if ($alpha) {
        return array($r, $g, $b, $alpha);
    }

    return array($r, $g, $b);
}

function forceful_lite_content_get_gallery_attachment_ids($content) {
    $gallery = forceful_lite_content_get_gallery($content);

    if (isset($gallery[0])) {
        $gallery = $gallery[0];
    } else {
        return '';
    }

    if (isset($gallery['shortcode'])) {
        $shortcode = $gallery['shortcode'];
    } else {
        return '';
    }

    // get gallery string ids
    preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
    if (isset($gallery_string_ids[0][0])) {
        $gallery_string_ids = $gallery_string_ids[0][0];
    } else {
        return '';
    }

    // get array of image id
    preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
    if (isset($gallery_ids[0])) {
        $gallery_ids = $gallery_ids[0];
    } else {
        return '';
    }

    return $gallery_ids;
}

function kopa_color_brightness($hex, $percent) {
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
    //// CALCULATE 
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

function forceful_lite_icon_get_icon($html, $icon_class, $icon_tag) {
    $classes = '';
    switch ($icon_class) {
        case 'facebook':
            $classes = 'fa fa-facebook';
            break;
        case 'facebook2':
            $classes = 'fa fa-facebook-square';
            break;
        case 'twitter':
            $classes = 'fa fa-twitter';
            break;
        case 'twitter2':
            $classes = 'fa fa-twitter-square';
            break;
        case 'google-plus':
            $classes = 'fa fa-google-plus';
            break;
        case 'google-plus2':
            $classes = 'fa fa-google-plus-square';
            break;
        case 'youtube':
            $classes = 'fa fa-youtube';
            break;
        case 'dribbble':
            $classes = 'fa fa-dribbble';
            break;
        case 'flickr':
            $classes = 'fa fa-flickr';
            break;
        case 'rss':
            $classes = 'fa fa-rss';
            break;
        case 'linkedin':
            $classes = 'fa fa-linkedin';
            break;
        case 'pinterest':
            $classes = 'fa fa-pinterest';
            break;
        case 'email':
            $classes = 'fa fa-envelope';
            break;
        case 'pencil':
            $classes = 'fa fa-pencil';
            break;
        case 'date':
            $classes = 'fa fa-clock-o';
            break;
        case 'comment':
            $classes = 'fa fa-comment';
            break;
        case 'view':
            $classes = 'fa fa-eye';
            break;
        case 'link':
            $classes = 'fa fa-link';
            break;
        case 'film':
            $classes = 'fa fa-film';
            break;
        case 'images':
            $classes = 'fa fa-picture-o';
            break;
        case 'music':
            $classes = 'fa fa-music';
            break;
        case 'long-arrow-right':
            $classes = 'fa fa-long-arrow-right';
            break;
        case 'apple':
            $classes = 'fa fa-apple';
            break;
        case 'star':
            $classes = 'fa fa-star';
            break;
        case 'star2':
            $classes = 'fa fa-star-o';
            break;
        case 'exit':
            $classes = 'fa fa-sign-out';
            break;
        case 'folder':
            $classes = 'fa fa-folder';
            break;
        case 'video':
            $classes = 'fa fa-video-camera';
            break;
        case 'play':
            $classes = 'fa fa-play';
            break;
        case 'spinner':
            $classes = 'fa fa-spinner';
            break;
        case 'bug':
            $classes = 'fa fa-bug';
            break;
        case 'tint':
            $classes = 'fa fa-tint';
            break;
        case 'pause':
            $classes = 'fa fa-pause';
            break;
        case 'crosshairs':
            $classes = 'fa fa-crosshairs';
            break;
        case 'cog':
            $classes = 'fa fa-cog';
            break;
        case 'check-circle':
            $classes = 'fa fa-check-circle-o';
            break;
        case 'hand-right':
            $classes = 'fa fa-hand-o-right';
            break;
        case 'plus-square':
            $classes = 'fa fa-plus-square';
            break;
        case 'trash':
            $classes = 'fa fa-trash-o';
            break;
        case 'arrow-circle-up':
            $classes = 'fa fa-arrow-circle-up';
            break;
    }
    return Forceful_Lite_Icon::createHtml($classes, $icon_tag);
}

class Forceful_Lite_Mobile_Menu extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        if ($depth == 0)
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' clearfix"' : 'class="clearfix"';
        else
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : 'class=""';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        if ($depth == 0) {
            $item_output = $args->before;
            $item_output .= '<h3><a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a></h3>';
            $item_output .= $args->after;
        } else {
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "\n$indent<span>+</span><div class='clear'></div><div class='menu-panel clearfix'><ul>";
        } else {
            $output .= '<ul>'; // indent for level 2, 3 ...
        }
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= '</ul>';
        }
    }

}

function forceful_lite_get_template_setting($default = null) {
    if(function_exists('kopa_get_template_setting')){
        return kopa_get_template_setting();
    }

    return $default;
}

function forceful_lite_social(){
    $dribbble_url       = get_theme_mod( 'forceful_lite_options_social_links_dribbble_url' );
    $gplus_url          = get_theme_mod( 'forceful_lite_options_social_links_google_plus_url' );
    $facebook_url       = get_theme_mod( 'forceful_lite_options_social_links_facebook_url' );
    $twitter_url        = get_theme_mod( 'forceful_lite_options_social_links_twitter_url' );
    $rss_url            = get_theme_mod( 'forceful_lite_options_social_links_rss_url' );
    $flickr_url         = get_theme_mod( 'forceful_lite_options_social_links_flickr_url' );
    $youtube_url        = get_theme_mod( 'forceful_lite_options_social_links_youtube_url' );
    $social_link_target = get_theme_mod( 'forceful_lite_options_social_links_target' , '_self');
    ?>
    <div class="widget kopa-social-widget">
        <ul class="clearfix">
            <!-- dribbble -->
            <?php if ( ! empty ( $dribbble ) ) { ?>
            <li><a href="<?php echo esc_url( $dribbble_url ); ?>" target="<?php echo esc_attr( $social_link_target ); ?>"><?php echo Forceful_Lite_Icon::getIcon('dribbble'); ?></a></li>
            <?php } ?>

            <!-- google plus -->
            <?php if ( ! empty ( $gplus_url ) ) { ?>
                <li><a href="<?php echo esc_url( $gplus_url ); ?>" target="<?php echo esc_attr( $social_link_target ); ?>"><?php echo Forceful_Lite_Icon::getIcon('google-plus'); ?></a></li>
            <?php } ?>

            <!-- facebook -->
            <?php if ( ! empty ( $facebook_url ) ) { ?>
                <li><a href="<?php echo esc_url( $facebook_url ); ?>" target="<?php echo esc_attr( $social_link_target ); ?>"><?php echo Forceful_Lite_Icon::getIcon('facebook'); ?></a></li>
            <?php } ?>

            <!-- twitter -->
            <?php if ( ! empty ( $twitter_url ) ) { ?>
            <li><a href="<?php echo esc_url( $twitter_url ); ?>" target="<?php echo esc_attr( $social_link_target ); ?>"><?php echo Forceful_Lite_Icon::getIcon('twitter'); ?></a></li>
            <?php } ?>

            <!-- rss -->
            <?php if ( $rss_url != 'HIDE' ) {
                if ( empty( $rss_url ) ) {
                    $rss_url = get_bloginfo( 'rss2_url' );
                } else {
                    $rss_url = esc_url( $rss_url );
                }
            ?>
                <li><a href="<?php echo esc_url( $rss_url ); ?>" target="<?php echo esc_attr( $social_link_target ); ?>"><?php echo Forceful_Lite_Icon::getIcon('rss'); ?></a></li>
            <?php } // endif ?>

            <!-- flickr -->
            <?php if ( ! empty ( $flickr_url ) ) { ?>
                <li><a href="<?php echo esc_url( $flickr_url ); ?>" target="<?php echo esc_attr( $social_link_target ); ?>"><?php echo Forceful_Lite_Icon::getIcon('flickr'); ?></a></li>
            <?php } ?>

            <!-- youtube -->
            <?php if ( ! empty ( $youtube_url ) ) { ?>
                <li><a href="<?php echo esc_url( $youtube_url ); ?>" target="<?php echo esc_attr( $social_link_target ); ?>"><?php echo Forceful_Lite_Icon::getIcon('youtube'); ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <?php
}   