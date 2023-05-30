<?php
function aatilpi_register_location_post_type() {
    $labels = array(
        'name' => __('Locations', AATILPI_TEXTDOMAIN),
        'singular_name' => __('Location', AATILPI_TEXTDOMAIN),
        // Add more labels as needed
    );

    $permalink_slug = get_option('aatilpi_permalink', 'locations');

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'thumbnail', 'page-attributes'),
        'taxonomies' => array(),
        'has_archive' => false,
        'rewrite' => array('slug' => $permalink_slug),
    );

    register_post_type('aatilpi_location', $args);
}
add_action('init', 'aatilpi_register_location_post_type');
function aatilpi_get_ordered_locations() {
    $args = array(
    	'post_type' => 'aatilpi_location',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    );

    return get_posts($args);
}

// Add custom columns to the locations list table
function aatilpi_location_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key == 'date') {
            $new_columns['menu_order'] = __('Order', AATILPI_TEXTDOMAIN);
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
}
add_filter('manage_aatilpi_location_posts_columns', 'aatilpi_location_columns');

// Fill custom columns with data
function aatilpi_location_custom_column($column, $post_id) {
    if ($column == 'menu_order') {
        $post = get_post($post_id);
        echo $post->menu_order;
    }
}
add_action('manage_aatilpi_location_posts_custom_column', 'aatilpi_location_custom_column', 10, 2);

// Make the custom columns sortable
function aatilpi_location_sortable_columns($columns) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}
add_filter('manage_edit-aatilpi_location_sortable_columns', 'aatilpi_location_sortable_columns');

// display a input field with : field_id (the name of the variable), field_name (the name of the variable), field_label (visual name before the input field), field_value (the actual value of the field), size (25 or 5)
// echo aatilpi_text_field('aatilpi_address', 'aatilpi_address', 'Address', $address_value , 25);
function aatilpi_text_field($field_id, $field_name, $field_label, $field_value, $size) {
    $label_html = !empty($field_label) ? '<label for="' . esc_attr($field_id) . '">' . esc_html($field_label) . ' </label>' : '';
    return $label_html . '<input type="text" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_name) . '" value="' . esc_attr($field_value) . '" size="' . esc_attr($size) . '" />';
}

// display a input field with : field_id (the name of the variable), field_name (the name of the variable), field_label (visual name before the input field), field_value (the actual value of the field), size (25 or 5)
// echo aatilpi_number_field('aatilpi_address', 'aatilpi_address', 'Address', $address_value , 5);
function aatilpi_number_field($field_id, $field_name, $field_label, $field_value, $size) {
    $label_html = !empty($field_label) ? '<label for="' . esc_attr($field_id) . '">' . esc_html($field_label) . ' </label>' : '';
    return $label_html . '<input type="number" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_name) . '" value="' . esc_attr($field_value) . '" size="' . esc_attr($size) . '" />';
}

// display a input field with : field_id (the name of the variable), field_name (the name of the variable), field_label (visual name before the input field), field_value (the actual value of the field), rows (5) , cols (40)
// echo aatilpi_textarea_field('aatilpi_textarea_field_id', 'aatilpi_textarea_field_name', 'AATILPI Textarea Field', $field_value, 5, 40);
function aatilpi_textarea_field($field_id, $field_name, $field_label, $field_value, $rows, $cols) {
    $label_html = !empty($field_label) ? '<label for="' . esc_attr($field_id) . '">' . esc_html($field_label) . ' </label>' : '';
    return $label_html . '<textarea id="' . esc_attr($field_id) . '" name="' . esc_attr($field_name) . '" rows="' . esc_attr($rows) . '" cols="' . esc_attr($cols) . '">' . esc_textarea($field_value) . '</textarea>';
}


// display a select field with : field_id (the name of the variable), field_name (the name of the variable), field_label (visual name before the input field), field_value (the actual value of the field), options (array with the values to select)
function aatilpi_select_field($field_id, $field_name, $field_label, $field_value, $options) {
    $html = '<select id="' . esc_attr($field_id) . '" name="' . esc_attr($field_name) . '">';
    foreach ($options as $key => $value) {
        $selected = $field_value === $key ? ' selected' : '';
        $html .= '<option value="' . esc_attr($key) . '"' . $selected . '>' . esc_html($value) . '</option>';
    }
    $html .= '</select>';
    return $html;
}
