<?php if ( is_home() ) {
    get_template_part( 'templates/loop/loop', 'blog' );
} elseif ( is_page() ) {
    get_template_part( 'templates/loop/loop', 'page' );
} elseif ( is_single() ) {
    get_template_part( 'templates/loop/loop', 'single' );
} else {
    get_template_part( 'templates/loop/loop', 'blog' );
}