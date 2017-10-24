<?php

add_filter( 'kopa_layout_manager_settings', 'forceful_lite_register_layouts');

function forceful_lite_get_positions(){
	return apply_filters('friday_get_positions', array(
		'pos_sidebar_1'  => esc_html__( 'WIDGET AREA 1', 'forceful-lite' ),
		'pos_sidebar_2'  => esc_html__( 'WIDGET AREA 2', 'forceful-lite' ),
		'pos_sidebar_3'  => esc_html__( 'WIDGET AREA 3', 'forceful-lite' ),
		'pos_sidebar_4'  => esc_html__( 'WIDGET AREA 4', 'forceful-lite' ),
		'pos_sidebar_5'  => esc_html__( 'WIDGET AREA 5', 'forceful-lite' ),
		'pos_sidebar_6'  => esc_html__( 'WIDGET AREA 6', 'forceful-lite' ),
		'pos_sidebar_7'  => esc_html__( 'WIDGET AREA 7', 'forceful-lite' ),
		'pos_sidebar_8'  => esc_html__( 'WIDGET AREA 8', 'forceful-lite' )
	));
}

function forceful_lite_get_sidebars(){
	return apply_filters('forceful_lite_get_sidebars', array(
		'pos_sidebar_1'  => 'sidebar_1',
		'pos_sidebar_2'  => 'sidebar_2',
		'pos_sidebar_3'  => 'sidebar_3',
		'pos_sidebar_4'  => 'sidebar_4',
		'pos_sidebar_5'  => 'sidebar_5',
		'pos_sidebar_6'  => 'sidebar_6',
		'pos_sidebar_7'  => 'sidebar_7',
		'pos_sidebar_8'  => 'sidebar_8'
	));
}

function forceful_lite_register_layouts( $options ) {
	$positions = forceful_lite_get_positions();
	$sidebars  = forceful_lite_get_sidebars();

	$blog_sidebar = array(
		'title'     => esc_html__( 'Blog Right Sidebar', 'forceful-lite' ),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/blog.jpg',
		'positions' => array(
			'pos_sidebar_1',
            'pos_sidebar_2',
            'pos_sidebar_8',
            'pos_sidebar_7',
            'pos_sidebar_3',
            'pos_sidebar_4',
            'pos_sidebar_5',
            'pos_sidebar_6',
		)
	);

	$static_page_sidebar = array(
		'title'     => esc_html__( 'Static Page', 'forceful-lite' ),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/page.jpg',
		'positions' => array(
			'pos_sidebar_1',
            'pos_sidebar_7',
            'pos_sidebar_3',
            'pos_sidebar_4',
            'pos_sidebar_5',
            'pos_sidebar_6',
		)
	);

	$single_right_sidebar = array(
		'title'     => esc_html__( 'Single Right Sidebar', 'forceful-lite' ),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/single.jpg',
		'positions' => array(
			'pos_sidebar_1',
            'pos_sidebar_7',
            'pos_sidebar_3',
            'pos_sidebar_4',
            'pos_sidebar_5',
            'pos_sidebar_6',
		)
	);

	$error_404 = array(
		'title'     => esc_html__('404 Page', 'forceful-lite'),
		'preview'   => get_template_directory_uri() . '/inc/assets/images/layouts/error-404.jpg',
		'positions' => array(
			'pos_sidebar_1',
            'pos_sidebar_3',
            'pos_sidebar_4',
            'pos_sidebar_5',
            'pos_sidebar_6',
		)
	);

	#1: Blog
	$options['blog-layout']['positions'] = $positions;
	$options['blog-layout']['layouts'] = array(
		'blog'   => $blog_sidebar
	);
	$options['blog-layout']['default'] = array(
		'layout_id' => 'blog',
		'sidebars'  => array(
			'blog'   => $sidebars
		)
	);

	#2: Single
	$options['post-layout']['positions'] = $positions;
	$options['post-layout']['layouts'] = array(
		'single-right-sidebar'   => $single_right_sidebar
	);
	$options['post-layout']['default'] = array(
		'layout_id' => 'single-right-sidebar',
		'sidebars'  => array(
			'single-right-sidebar'   => $sidebars
		)
	);

	#3: Page
	$options['page-layout']['positions'] = $positions;
    $options['page-layout']['layouts'] = array(
		'static-page'     => $static_page_sidebar
    );
    $options['page-layout']['default'] = array(
		'layout_id' => 'static-page',
		'sidebars'  => array(
			'static-page'     => $sidebars
        )
    );

    #4: Front Page
    $options['frontpage-layout']['positions'] = $positions;
    $options['frontpage-layout']['layouts'] = array(
        'static-page' => $static_page_sidebar
    );
    $options['frontpage-layout']['default'] = array(
		'layout_id' => 'static-page',
		'sidebars'  => array(
            'static-page' => $sidebars
        )
    );

	#5: Search Page
    $options['search-layout']['positions'] = $positions;
    $options['search-layout']['layouts'] = array(
        'blog'   => $blog_sidebar
    );

    $options['search-layout']['default'] = array(
		'layout_id' => 'blog',
		'sidebars'  => array(
            'blog'   => $sidebars
        )
	);

	#6: Error 404
    $options['error404-layout']['positions'] = $positions;
    $options['error404-layout']['layouts'] = array(
        'error-404' => $error_404
    );

    $options['error404-layout']['default'] = array(
		'layout_id' => 'error-404',
		'sidebars'  => array(
            'error-404' => $sidebars
        )
    );

	return $options;
}
