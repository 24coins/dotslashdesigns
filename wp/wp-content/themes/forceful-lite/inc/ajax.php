<?php

if (!function_exists('kopa_ajax_send_contact')) {

    function kopa_ajax_send_contact() {
        check_ajax_referer('kopa_send_contact_nicole_kidman', 'kopa_send_contact_nonce');

        foreach ($_POST as $key => $value) {
            if (ini_get('magic_quotes_gpc')) {
                $_POST[$key] = stripslashes($_POST[$key]);
            }
            $_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
        }

        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];

        $message_body = "Name: {$name}" . PHP_EOL . "Message: {$message}";

        $to = get_bloginfo('admin_email');
        if ( isset( $_POST["subject"] ) && $_POST["subject"] != '' ) {
            $subject = "Contact Form: $name - {$_POST['subject']}";
        } else {
            $subject = "Contact Form: $name";
        }

        if ( isset( $_POST['url'] ) && $_POST['url'] != '' ) {
            $message_body .= PHP_EOL . esc_html__('Website:', 'forceful-lite') . $_POST['url'];
        }

        $headers[] = 'From: ' . $name . ' <' . $email . '>';
        $headers[] = 'Cc: ' . $name . ' <' . $email . '>';

        $result = '<span class="failure">' . esc_html__('Oops! errors occured.', 'forceful-lite') . '</span>';
        if (wp_mail($to, $subject, $message_body, $headers)) {
            $result = '<span class="success">' . esc_html__('Success! Your email has been sent.', 'forceful-lite') . '</span>';
        }

        die($result);
    }

    add_action('wp_ajax_kopa_send_contact', 'kopa_ajax_send_contact');
    add_action('wp_ajax_nopriv_kopa_send_contact', 'kopa_ajax_send_contact');
}

if (!function_exists('forceful_lite_ajax_set_view_count')) {

    function forceful_lite_ajax_set_view_count() {
        check_ajax_referer('forceful_lite_set_view_count', 'wpnonce');
        if (!empty($_POST['post_id'])) {
            $post_id = (int) $_POST['post_id'];
            $data['count'] = forceful_lite_set_view_count($post_id);
            echo json_encode($data);
        }
        die();
    }

    add_action('wp_ajax_forceful_lite_set_view_count', 'forceful_lite_ajax_set_view_count');
    add_action('wp_ajax_nopriv_forceful_lite_set_view_count', 'forceful_lite_ajax_set_view_count');
}