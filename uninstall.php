<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

function aati_events_uninstall()
{
    if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {
        exit();
    }

    // Delete the custom post type and its associated posts
    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => -1,
        'post_status'    => 'any',
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            wp_delete_post(get_the_ID(), true);
        }
    }
    wp_reset_postdata();
    unregister_post_type('event');
}

aati_events_uninstall();
// Uninstall Plugin
