<?php
function aatilpi_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=aatilpi_location',
        __('Location Profile Information Settings', AATILPI_TEXTDOMAIN),
        __('Settings', AATILPI_TEXTDOMAIN),
        'manage_options',
        'aatilpi_settings',
        'aatilpi_settings_page'
    );
    add_submenu_page(
        'edit.php?post_type=aatilpi_location',
        __('Location Profile Information Support', AATILPI_TEXTDOMAIN),
        __('Support', AATILPI_TEXTDOMAIN),
        'manage_options',
        'aatilpi_support',
        'aatilpi_support_page'
    );
}
add_action('admin_menu', 'aatilpi_admin_menu');

