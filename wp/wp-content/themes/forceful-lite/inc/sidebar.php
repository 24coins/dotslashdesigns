<?php

add_filter( 'kopa_sidebar_default', 'forceful_lite_set_sidebar_default' );

function forceful_lite_set_sidebar_default( $options ) {
    $options['sidebar_1']      = array(
        'name' => esc_html__( 'Sidebar 1', 'forceful-lite'),
    );
    $options['sidebar_2']      = array(
        'name' => esc_html__( 'Sidebar 2', 'forceful-lite'),
    );
    $options['sidebar_3']      = array(
        'name' => esc_html__( 'Sidebar 3', 'forceful-lite'),
    );
    $options['sidebar_4']      = array(
        'name' => esc_html__( 'Sidebar 4', 'forceful-lite'),
    );
    $options['sidebar_5']      = array(
        'name' => esc_html__( 'Sidebar 5', 'forceful-lite'),
    );
    $options['sidebar_5']      = array(
        'name' => esc_html__( 'Sidebar 5', 'forceful-lite'),
    );
    $options['sidebar_6']      = array(
        'name' => esc_html__( 'Sidebar 6', 'forceful-lite'),
    );
    $options['sidebar_7']      = array(
        'name' => esc_html__( 'Sidebar 7', 'forceful-lite'),
    );
    $options['sidebar_8']      = array(
        'name' => esc_html__( 'Sidebar 8', 'forceful-lite'),
    );

	return  apply_filters( 'friday_set_sidebar_default', $options );
}

add_filter( 'kopa_sidebar_default_attributes', 'forceful_lite_set_sidebar_default_attributes' );

function forceful_lite_set_sidebar_default_attributes($wrap) {
	$wrap['before_widget'] = '<div id="%1$s" class="widget %2$s">';
	$wrap['after_widget']  = '</div>';
	$wrap['before_title']  = '<h2 class="widget-title"><span></span>';
	$wrap['after_title']   = '</h2>';

	return $wrap;
}

function forceful_lite_set_sidebar($sidebar, $position){
    global $forceful_lite_current_layout;

    if(!isset($forceful_lite_current_layout) || empty($forceful_lite_current_layout)){
        $forceful_lite_current_layout = forceful_lite_get_template_setting();
    }

    if(isset($forceful_lite_current_layout['sidebars'][$position])){
        $sidebar = $forceful_lite_current_layout['sidebars'][$position];
    }

    return $sidebar;
}

add_action( 'widgets_init', 'forceful_lite_widgets_init' );
function forceful_lite_widgets_init(){
   /**
    * Creates a sidebar
    * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
    */
    $args = array(
        'name'          => esc_html__( 'Sidebar Extra', 'forceful-lite' ),
        'id'            => 'sidebar_extra',
        'description'   => '',
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title"><span></span>',
        'after_title'   => '</h2>'
    );

    register_sidebar( $args );
}
