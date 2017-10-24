<?php
add_action('tgmpa_register', 'forceful_lite_register_required_plugins');

function forceful_lite_register_required_plugins() {
    $plugins = array(
        array(
            'name'               => 'Kopa Framework',
            'slug'               => 'kopatheme',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => ''
        ),
        array(
            'name'               => 'Forceful Toolkit',
            'slug'               => 'forceful-toolkit',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => true,
        )
    );

    $config = array(
        'has_notices'  => true,
        'is_automatic' => false
    );

    tgmpa($plugins, $config);
}
