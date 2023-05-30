<?php
// Register settings
function aatilpi_register_settings() {
    register_setting('aatilpi_general_settings', 'aatilpi_permalink');
    add_settings_section(
        'aatilpi_general_settings_section',
        __('General Settings', AATILPI_TEXTDOMAIN),
        'aatilpi_render_general_settings',
        'aatilpi_settings'
    );
    add_settings_field(
        'aatilpi_permalink',
        __('Custom Permalink', AATILPI_TEXTDOMAIN),
        'aatilpi_permalink_callback',
        'aatilpi_settings',
        'aatilpi_general_settings_section'
    );
}

add_action('admin_init', 'aatilpi_register_settings');

// Render settings page
function aatilpi_settings_page() {
?>
    <div class="wrap">
        <h1><?php _e('Location Profile Information Settings', AATILPI_TEXTDOMAIN); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('aatilpi_general_settings');
            do_settings_sections('aatilpi_settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

// Render General Settings section
function aatilpi_render_general_settings() {
    echo '<p>' . __('General settings for the Location Profile Information plugin.', AATILPI_TEXTDOMAIN) . '</p>';
}

// Permalink input field callback
function aatilpi_permalink_callback() {
?>
    <input type="text" name="aatilpi_permalink" value="<?php echo esc_attr(get_option('aatilpi_permalink', 'locations')); ?>">
    <p class="description"><?php _e('Enter a custom permalink structure for location entries. Make sure this does not conflict with any existing page or post slug.', AATILPI_TEXTDOMAIN); ?></p>
<?php
}
