<?php
$sb_1 = apply_filters('forceful_lite_get_sidebar', 'sidebar_1', 'pos_sidebar_1');
$forceful_lite_top_banner_code = get_theme_mod( 'forceful_lite_options_top_banner', '' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="page-header">
    <div id="header-top" class="clearfix">
        <div class="wrapper">
            <div class="row-fluid">
                <div class="span12 clearfix">
                    <div class="l-col">
                        <div class="r-color-container"><div class="r-color"></div></div>
                        <nav id="main-nav">
                            <?php
                            if ( has_nav_menu( 'main-nav' ) ) {
                                wp_nav_menu( array(
                                    'theme_location' => 'main-nav',
                                    'container'      => '',
                                    'menu_id'        => 'main-menu',
                                    'items_wrap'     => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>'
                                ) );

                                $mobile_menu_walker = new Forceful_Lite_Mobile_Menu();
                                wp_nav_menu( array(
                                    'theme_location' => 'main-nav',
                                    'container'      => 'div',
                                    'container_id'   => 'mobile-menu',
                                    'menu_id'        => 'toggle-view-menu',
                                    'items_wrap'     => '<span>'.esc_html__( 'Menu', 'forceful-lite' ).'</span><ul id="%1$s">%3$s</ul>',
                                    'walker'         => $mobile_menu_walker
                                ) );
                            } ?>
                        </nav>
                        <!-- main-nav -->
                    </div>
                    <!-- l-col -->
                    <div class="r-col">
                        <?php get_search_form(); ?>
                    </div>
                    <!-- r-col -->
                </div>
                <!-- span12 -->
            </div>
            <!-- row-fluid -->
        </div>
        <!-- wrapper -->
    </div>
    <!-- header-top -->
    <div id="header-bottom">
        <div class="wrapper">
            <div class="row-fluid">
                <div class="span12 clearfix">
                    <div class="l-col clearfix">
                        <div class="r-color"></div>
                        <div id="logo-image">
                            <?php if (get_header_image()) { ?>
                                <a href="<?php echo esc_url(home_url()); ?>">
                                    <img src="<?php header_image(); ?>" width="217" height="70" alt="<?php bloginfo('name'); ?> <?php esc_html_e('Logo', 'forceful-lite'); ?>">
                                </a>
                            <?php } ?>
                            <?php if( is_home() || is_front_page() ) : ?>
                                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name'));?>"><?php echo esc_attr(get_bloginfo('name'), 'display');?></a></h1>
                            <?php else: ?>
                                <div class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name'));?>"><?php echo esc_attr(get_bloginfo('name'), 'display');?></a></div>
                            <?php endif; ?>
                        </div>
                        <!-- logo-image -->
                        <?php if( $forceful_lite_top_banner_code ) : ?>
                            <div class="top-banner">
                                <?php echo htmlspecialchars_decode( stripslashes( $forceful_lite_top_banner_code ) ); ?>
                            </div>
                        <?php endif; ?>
                        <!-- top-banner -->
                    </div>
                    <!-- l-col -->
                    <div class="r-col">
                        <div class="widget-area-1">
                            <?php if ( is_active_sidebar( $sb_1 ) ) {
                                dynamic_sidebar( $sb_1 );
                            } ?>
                        </div>
                        <!-- widget-area-1 -->
                    </div>
                    <!-- r-col -->
                </div>
                <!-- span12 -->
            </div>
            <!-- row-fluid -->
        </div>
        <!-- wrapper -->
    </div>
    <!-- header-bottom -->
</header>
<!-- page-header -->