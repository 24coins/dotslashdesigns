<?php

add_action('after_setup_theme', 'forceful_lite_init');

function forceful_lite_init(){
	add_filter('kopa_customization_init_options', 'forceful_lite_init_options');
}

function forceful_lite_init_options($options){

	$all_cats = get_categories();
	$categories = array('' => esc_html__('Latest Posts', 'forceful-lite'));
	foreach ( $all_cats as $cat ) {
		$categories[ $cat->slug ] = $cat->name;
	}

	#Panels
	$options['panels'][] = array(
		'id'    => 'forceful_lite_panel_general_setting',
		'title' => esc_html__('General Setting', 'forceful-lite'));

	#Sections
	$options['sections'][] = array(
    'id'    => 'forceful_lite_section_logo_setting',
    'panel' => 'forceful_lite_panel_general_setting',
    'title' => esc_html__('Logo Margin', 'forceful-lite'));

	$options['sections'][] = array(
    'id'    => 'forceful_lite_section_general_setting',
    'panel' => 'forceful_lite_panel_general_setting',
    'title' => esc_html__('General Setting', 'forceful-lite'));

    $options['sections'][] = array(
    'id'    => 'forceful_lite_section_single_post',
    'title' => esc_html__('Single Post', 'forceful-lite'));

    $options['sections'][] = array(
    'id'    => 'forceful_lite_section_social_links',
    'title' => esc_html__('Social Links', 'forceful-lite'));

    $options['sections'][] = array(
    'id'    => 'forceful_lite_section_custom_css',
    'title' => esc_html__('Custom CSS', 'forceful-lite'));

    #LOGO Margin
	#1. Top Margin
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_logo_margin_top',
		'label'       => esc_html__('Top margin:', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_logo_setting',
		'transport'   => 'refresh');
	#2. Top Margin
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_logo_margin_left',
		'label'       => esc_html__('Left margin:', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_logo_setting',
		'transport'   => 'refresh');
	#3. Right Margin
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_logo_margin_right',
		'label'       => esc_html__('Right margin:', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_logo_setting',
		'transport'   => 'refresh');
	#4. Bottom Margin
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_logo_margin_bottom',
		'label'       => esc_html__('Bottom margin:', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_logo_setting',
		'transport'   => 'refresh');

	#GENERAL SETTING
	#1. Responsive layout
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_responsive_status',
		'label'       => esc_html__('Responsive Layout', 'forceful-lite'),
		'default'     => 'enable',
		'type'        => 'radio',
		'choices'     => array(
			'enable'  => esc_html__('Enable', 'forceful-lite'),
			'disable' => esc_html__('Disable', 'forceful-lite')
		),
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');
	#2. Headline status
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_header_headline_status',
		'label'       => esc_html__('Header Headline - Status', 'forceful-lite'),
		'default'     => 'show',
		'description' => esc_html__('Show/Hide headline', 'forceful-lite'),
		'type'        => 'radio',
		'choices'     => array(
			'show' => esc_html__('Show', 'forceful-lite'),
			'hide' => esc_html__('Hide', 'forceful-lite')
		),
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');
	#3. Headlite title
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_header_headline_title',
		'label'       => esc_html__('Header Headline - Title', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');
	#4. Headlite light title
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_header_headline_light_title',
		'label'       => esc_html__('Header Headline - Light Title', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');
	#5. Headlite categories
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_header_headline_category',
		'label'       => esc_html__('Header Headline - Category', 'forceful-lite'),
		'default'     => '',
		'description' => esc_html__('Choose category to display posts in headline', 'forceful-lite'),
		'type'        => 'select',
		'choices'     => $categories,
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');
	#6. Headlite limit
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_header_headline_limit',
		'label'       => esc_html__('Header Headline - Number Of Posts', 'forceful-lite'),
		'default'     => '5',
		'description' => esc_html__('Choose category to display posts in headline', 'forceful-lite'),
		'type'        => 'text',
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');
	#7. Breadcrumbs
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_breadcrumb_status',
		'label'       => esc_html__('Breadcrumb', 'forceful-lite'),
		'default'     => 'show',
		'description' => esc_html__('Show/Hide Breadcrumb', 'forceful-lite'),
		'type'        => 'radio',
		'choices'     => array(
			'show' => esc_html__('Show', 'forceful-lite'),
			'hide' => esc_html__('Hide', 'forceful-lite')
		),
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');
	#8. Home in menu
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_home_menu_item_status',
		'label'       => esc_html__('Home Menu Item', 'forceful-lite'),
		'default'     => 'enable',
		'description' => esc_html__('Add home menu item as first item on main menu.', 'forceful-lite'),
		'type'        => 'radio',
		'choices'     => array(
			'enable'  => esc_html__('Enable', 'forceful-lite'),
			'disable' => esc_html__('Disable', 'forceful-lite')
		),
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');
	#9. Top banner
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_top_banner',
		'label'       => esc_html__('Top Banner', 'forceful-lite'),
		'default'     => '',
		'description' => esc_html__('Paste your Adsense, BSA or other ad code here to show ads on top banner.', 'forceful-lite'),
		'type'        => 'textarea',
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');
	#10. Footer
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_footer',
		'label'       => esc_html__('Footer', 'forceful-lite'),
		'default'     => '',
		'description' => esc_html__('Enter the content you want to display in your left footer (e.g. copyright text).', 'forceful-lite'),
		'type'        => 'text',
		'section'     => 'forceful_lite_section_general_setting',
		'transport'   => 'refresh');

	#SINGLE POST
	#1. Featured post thumbnail
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_featured_image_status',
		'label'       => esc_html__('Featured Post Thumbnail', 'forceful-lite'),
		'description' => esc_html__('Show/Hide featured post thumbnail', 'forceful-lite'),
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'forceful-lite'),
			'hide' => esc_html__('Hide', 'forceful-lite')
		),
		'type'        => 'radio',
		'section'     => 'forceful_lite_section_single_post',
		'transport'   => 'refresh');
	#2. Post thumbnail style
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_post_thumbnail_style',
		'label'       => esc_html__('Post Thumbnail Style', 'forceful-lite'),
		'default'     => 'small',
		'choices'     => array(
			'small' => esc_html__('Small Thumbnail', 'forceful-lite'),
			'large' => esc_html__('Large Thumbnail', 'forceful-lite')
		),
		'type'        => 'radio',
		'section'     => 'forceful_lite_section_single_post',
		'transport'   => 'refresh');
	#3. View count on post
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_post_view_count_status',
		'label'       => esc_html__('View Count On Post', 'forceful-lite'),
		'description' => esc_html__('Show/Hide view count on post', 'forceful-lite'),
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'forceful-lite'),
			'hide' => esc_html__('Hide', 'forceful-lite')
		),
		'type'        => 'radio',
		'section'     => 'forceful_lite_section_single_post',
		'transport'   => 'refresh');
	#4. About author
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_post_about_author_status',
		'label'       => esc_html__('About Author', 'forceful-lite'),
		'description' => esc_html__('Show/Hide about author', 'forceful-lite'),
		'default'     => 'show',
		'choices'     => array(
			'show' => esc_html__('Show', 'forceful-lite'),
			'hide' => esc_html__('Hide', 'forceful-lite')
		),
		'type'        => 'radio',
		'section'     => 'forceful_lite_section_single_post',
		'transport'   => 'refresh');
	#5. Get by
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_post_related_get_by',
		'label'       => esc_html__('Related Posts', 'forceful-lite'),
		'default'     => 'category',
		'description' => esc_html__('GET BY', 'forceful-lite'),
		'type'        => 'select',
		'choices'     => array(
			'hide'     => esc_html__('-- Hide --', 'forceful-lite'),
			'post_tag' => esc_html__('Tags', 'forceful-lite'),
			'category' => esc_html__('Category', 'forceful-lite')
		),
		'section'     => 'forceful_lite_section_single_post',
		'transport'   => 'refresh');
	#6. Related Posts - Limit
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_post_related_limit',
		'label'       => esc_html__('Related Posts', 'forceful-lite'),
		'default'     => 5,
		'description' => esc_html__('LIMIT', 'forceful-lite'),
		'type'        => 'text',
		'section'     => 'forceful_lite_section_single_post',
		'transport'   => 'refresh');

	#SOCIAL LINKS
	#1. RSS URL
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_social_links_rss_url',
		'label'       => esc_html__('RSS URL', 'forceful-lite'),
		'default'     => '',
		'description' => __('Display the RSS feed button with the default RSS feed or enter a custom feed below.<code>Enter "HIDE" if you want to hide it</code>', 'forceful-lite'),
		'type'        => 'text',
		'section'     => 'forceful_lite_section_social_links',
		'transport'   => 'refresh');
	#2. FACEBOOK URL
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_social_links_facebook_url',
		'label'       => esc_html__('FACEBOOK URL', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_social_links',
		'transport'   => 'refresh');
	#3. TWITTER URL
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_social_links_twitter_url',
		'label'       => esc_html__('TWITTER URL', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_social_links',
		'transport'   => 'refresh');
	#4. GOOGLE + URL
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_social_links_google_plus_url',
		'label'       => esc_html__('GOOGLE PLUS URL', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_social_links',
		'transport'   => 'refresh');
	#5. DRIBBBLE URL
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_social_links_dribbble_url',
		'label'       => esc_html__('DRIBBBLE URL', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_social_links',
		'transport'   => 'refresh');
	#6. YOUTUBE URL
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_social_links_youtube_url',
		'label'       => esc_html__('YOUTUBE URL', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_social_links',
		'transport'   => 'refresh');
	#7. FLICKR URL
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_social_links_flickr_url',
		'label'       => esc_html__('FLICKR URL', 'forceful-lite'),
		'default'     => '',
		'type'        => 'text',
		'section'     => 'forceful_lite_section_social_links',
		'transport'   => 'refresh');
	#8. Target
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_social_links_target',
		'label'       => esc_html__('Target', 'forceful-lite'),
		'default'     => '_self',
		'type'        => 'select',
		'choices'     => array(
			'_blank' => esc_html__('Open window in new tab', 'forceful-lite'),
			'_self'  => esc_html__('Open window in current tab', 'forceful-lite')
		),
		'section'     => 'forceful_lite_section_social_links',
		'transport'   => 'refresh');

	#CUSTOM CSS
	#1. Custom CSS
	$options['settings'][] = array(
		'settings'    => 'forceful_lite_options_custom_css',
		'label'       => esc_html__('Custom CSS', 'forceful-lite'),
		'default'     => '',
		'type'        => 'textarea',
		'section'     => 'forceful_lite_section_custom_css',
		'transport'   => 'refresh');

	return apply_filters( 'forceful_lite_init_options', $options );
}