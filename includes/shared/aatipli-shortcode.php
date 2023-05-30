<?php
function aatilpi_location_shortcode($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'location' => '', // The ID of the location to display
    ), $atts, 'aatilpi_location');

    // Get the location ID
    $location_id = $atts['location'];
    if (empty($location_id)) {
        // If no location ID is given, get the ID of the first location
        $locations = aatilpi_get_ordered_locations();
        if (!empty($locations)) {
            $location_id = $locations[0]->ID;
        }
    }
    // Get the location post object
    $location = get_post($location_id);
    // If the location does not exist or is not a location post type, return an error message
    if (!$location || $location->post_type !== 'aatilpi_location') {
        return '<p>' . __('The specified location does not exist.', AATILPI_TEXTDOMAIN) . '</p>';
    }
//	$output_html = $location->post_title;
    // Render the location 
// list the values in the database for this location with the AATILPI_FIELDS_ARRAY and order the by the values of the order field 
$sorted_metadata_array = get_sorted_metadata(AATILPI_FIELDS_ARRAY, $location_id);
// 5. Display the sorted data
$output_html = '';
foreach ($sorted_metadata_array as $metadata) {
	//ARRAY [NAME,FIELD,TYPE,ORDER,VISUAL,DESCRIPTION]
    $field_data = $metadata['field_data'];
	$field_key = $metadata['field_key'];
    $field_value = $metadata['field_value'];
    $order_value = $metadata['order_value'];
    $visual_value = $metadata['visual_value'];
    $name_value = $metadata['name_value'];
    $output_html .= "NAME: " . $field_data[0] . "<br>" .
    "FIELD: " . $field_data[1] . "<br>" .
    "TYPE: " . $field_data[2] . "<br>" .
    "ORDER: " . $field_data[3] . "<br>" .
    "VISUAL: " . $field_data[4] . "<br>" .
    "DESCRIPTION: " . $field_data[5] . "<br>" .
    "real ORDER: " . $order_value . "<br>" .
    "real VISUAL: " . $visual_value . "<br>" .
    "Content: " . $field_value . "<br>" .		
    "display value: " . $name_value . "<br>" .
    "-----------------------<br>";
}
    return $output_html;
}
add_shortcode('contact-card', 'aatilpi_location_shortcode');


function get_sorted_metadata($fields_array, $location_id) {
    $metadata_array = array();
    
    foreach ($fields_array as $field) {
        $field_key = $field[1]; // Field key
        $order_key = $field_key . '_order'; // Order field key
        $name_key = $field_key . '_name'; // Custom field value name
        $visual_key = $field_key . '_visual'; // Custom field value name
        $field_value = get_post_meta($location_id, $field_key, true);
        $order_value = get_post_meta($location_id, $order_key, true);
        $name_value = get_post_meta($location_id, $name_key, true);
        $visual_value = get_post_meta($location_id, $visual_key, true);
//ARRAY [the array,FIELD,content of the field,real ORDER,real VISUAL,display content of the field]
        // 3. Store the fetched values in a new array
        $metadata_array[] = array(
            'field_data' => $field,
            'field_key' => $field_key,
            'field_value' => $field_value,
            'order_value' => $order_value,
            'visual_value' => $visual_value,
            'name_value' => $name_value 
        );
    }
    
    // 4. Sort the new array by the third field's value
    usort($metadata_array, function ($a, $b) {
        return $a['order_value'] <=> $b['order_value'];
    });

    return $metadata_array;
}