<?php

register_ajax([
    //'archive_filter'
]);

function archive_filter()
{
    check_ajax_referer('archive-nonce', 'nonce');

    $data = sanitize_post($_POST);

    if (empty($data)) {
        wp_send_json_error('There is no data');
        return;
    }
}