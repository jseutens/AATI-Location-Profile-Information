<?php
/*
Plugin Name: AATI Events
Plugin URI: https://github.com/jseutens/aati-events
Description: A custom plugin to create a new post type 'Events' and add additional fields.
Version: 1.0
Author: Johan Seutens
Author URI: https://www.aati.be
Text Domain: aati-events
Domain Path: /languages/
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
// Check if the ABSPATH constant is defined
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Define constants used throughout the plugin
define( 'AATIEVENTS_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'AATIEVENTS_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'AATIEVENTS_PLUGIN_FNAME', plugin_basename( __FILE__ ) );
define( 'AATIEVENTS_PLUGIN_DIRNAME', plugin_basename( dirname( __FILE__ ) ) );
define( 'AATIEVENTS_VERSION', '1.0.0' );
define( 'AATIEVENTS_TEXTDOMAIN', 'aati-events');
// load languages
	function aatievents_load_textdomain() {
		load_plugin_textdomain(AATIEVENTS_TEXTDOMAIN,false, AATIEVENTS_PLUGIN_DIRNAME. '/languages');
	}
	add_action( 'plugins_loaded', 'AATIEVENTS_load_textdomain');
	

// Activation hook
register_activation_hook( __FILE__, 'aatievents_activate' );
function aatievents_activate() {
  // Activation code here
}

// Deactivation hook
register_deactivation_hook( __FILE__, 'aatievents_deactivate' );
function aatievents_deactivate() {
  // Deactivation code here
}

// Register the uninstall hook
register_uninstall_hook(__FILE__, 'aatievents_uninstall');
function aatievents_uninstall()
{
    require_once plugin_dir_path(__FILE__) . 'uninstall.php';
}

//

function aati_events_register_post_type() {
	$slug = get_option('aati_events_slug', 'event');
    $labels = array(
        'name'               => __('Events', 'aati-events'),
        'singular_name'      => __('Event', 'aati-events'),
        'add_new'            => __('Add New', 'aati-events'),
        'add_new_item'       => __('Add New Event', 'aati-events'),
        'edit_item'          => __('Edit Event', 'aati-events'),
        'new_item'           => __('New Event', 'aati-events'),
        'all_items'          => __('All Events', 'aati-events'),
        'view_item'          => __('View Event', 'aati-events'),
        'search_items'       => __('Search Events', 'aati-events'),
        'not_found'          => __('No events found', 'aati-events'),
        'not_found_in_trash' => __('No events found in Trash', 'aati-events'),
        'menu_name'          => __('Events', 'aati-events')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite' => array('slug' => $slug),
		'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title','editor','excerpt','custom-fields','revisions','thumbnail','author','page-attributes',)
    );

    register_post_type('event', $args);
}
add_action('init', 'aati_events_register_post_type',20);

function aati_events_add_meta_boxes() {
    $post_types = array('event'); // Add 'post' to the array of post types
    foreach ($post_types as $post_type) {
        add_meta_box(
            'aati_events_meta_box',
            __('Event Details', 'aati-events'),
            'aati_events_meta_box_callback',
            $post_type,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'aati_events_add_meta_boxes');


function aati_events_meta_box_callback($post) {
    wp_nonce_field('aati_events_save_meta_box_data', 'aati_events_meta_box_nonce');

    // Get the current values of the custom fields
    $link = get_post_meta($post->ID, '_aati_event_link', true);
    $start_date = get_post_meta($post->ID, '_aati_event_start_date', true);
    $end_date = get_post_meta($post->ID, '_aati_event_end_date', true);
    $address = get_post_meta($post->ID, '_aati_event_address', true);

	echo '<table>';
	
    echo '<tr><td><label for="aati_event_link">' . __('Link (more info or buy tickets):', 'aati-events') . '</label></td>';
    echo '<td><input type="text" id="aati_event_link" name="aati_event_link" value="' . esc_attr($link) . '" size="50" /></td></tr>';

    echo '<tr><td><label for="aati_event_start_date">' . __('Start Date:', 'aati-events') . '</label></td>';
    echo '<td><input type="date" id="aati_event_start_date" name="aati_event_start_date" value="' . esc_attr($start_date) . '" /></td></tr>';

    echo '<tr><td><label for="aati_event_end_date">' . __('End Date:', 'aati-events') . '</label></td>';
    echo '<td><input type="date" id="aati_event_end_date" name="aati_event_end_date" value="' . esc_attr($end_date) . '" /></td></tr>';

    echo '<tr><td><label for="aati_event_address">' . __('Address:', 'aati-events') . '</label></td>';
    echo '<td><textarea id="aati_event_address" name="aati_event_address" rows="4" cols="50">' . esc_textarea($address) . '</textarea></td></tr>';

 	echo '<tr><td><label for="aati_event_ics">' . __('Calendar:', 'aati-events') . '</label></td>';	
    // After your existing code, retrieve the .ics URL from post meta and display the link:
    $ics_url = get_post_meta($post->ID, '_aati_event_ics_url', true);
    if (!empty($ics_url)) {
        echo '<td><a href="' . esc_url($ics_url) . '" download>Add to calendar</a></td></tr>';
    } else {
		echo '<td>' . __('Calendar No Link:', 'aati-events') . '</td></tr>';
	}
    echo '</table>';
}

function aati_events_save_meta_box_data($post_id) {
    if (!isset($_POST['aati_events_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['aati_events_meta_box_nonce'], 'aati_events_save_meta_box_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $post = get_post($post_id); // Get the post object

    $link = sanitize_text_field($_POST['aati_event_link']);
    $start_date = sanitize_text_field($_POST['aati_event_start_date']);
    $end_date = sanitize_text_field($_POST['aati_event_end_date']);
    $address = sanitize_textarea_field($_POST['aati_event_address']);

    // Check if slug has changed, if so delete old .ics file
    $old_slug = get_post_meta($post_id, '_aati_event_slug', true);
    if ($old_slug !== $post->post_name) {
        if (file_exists(plugin_dir_path( __FILE__ ) . "events/{$old_slug}.ics")) {
            unlink(plugin_dir_path( __FILE__ ) . "events/{$old_slug}.ics");
        }
    }

    // Generate new .ics file and save path in post meta
    if (!empty($start_date) && !empty($end_date)) {
        $ics_data = generate_ics_data($start_date, $end_date, $_POST['post_title'], $_POST['post_content'], $address);
        $file_path = plugin_dir_path( __FILE__ ) . "events/{$post->post_name}.ics";

        file_put_contents($file_path, $ics_data);
        update_post_meta($post_id, '_aati_event_ics_url', plugin_dir_url( __FILE__ ) . "events/{$post->post_name}.ics");
    }

    update_post_meta($post_id, '_aati_event_link', $link);
    update_post_meta($post_id, '_aati_event_start_date', $start_date);
    update_post_meta($post_id, '_aati_event_end_date', $end_date);
    update_post_meta($post_id, '_aati_event_address', $address);
    // Save new slug in post meta
    update_post_meta($post_id, '_aati_event_slug', $post->post_name);
}

add_action('save_post', 'aati_events_save_meta_box_data');

function aati_events_add_to_calendar_link($post_id) {
    $start_date = get_post_meta($post_id, '_aati_event_start_date', true);
    $end_date = get_post_meta($post_id, '_aati_event_end_date', true);
    $title = get_the_title($post_id);
    $details = wp_strip_all_tags(get_post_field('post_content', $post_id));

    $base_url = "https://www.google.com/calendar/render?action=TEMPLATE";

    $url = $base_url . "&text=" . urlencode($title) . "&dates=" . date('Ymd\THis', strtotime($start_date)) . "/" . date('Ymd\THis', strtotime($end_date)) . "&details=" . urlencode($details);

    return $url;
}

// this adds the custom fields in a non bricks way to the post content  so currently diabled but i keep the code
function aati_events_add_custom_fields_to_content($content) {
    if (get_post_type() === 'event') {
        $link = get_post_meta(get_the_ID(), '_aati_event_link', true);
        $start_date = get_post_meta(get_the_ID(), '_aati_event_start_date', true);
        $end_date = get_post_meta(get_the_ID(), '_aati_event_end_date', true);

        // Get WordPress date format
        $date_format = get_option('date_format');

        // Format the start and end dates using the WordPress date format
		$formatted_start_date = aati_events_format_date($start_date);
		$formatted_end_date = aati_events_format_date($end_date);

        $custom_fields = '<p><strong>' . __('Link:', 'aati-events') . '</strong> <a href="' . esc_url($link) . '">' . esc_url($link) . '</a></p>';
        $custom_fields .= '<p><strong>' . __('Start Date:', 'aati-events') . '</strong> ' . esc_html($formatted_start_date) . '</p>';
        $custom_fields .= '<p><strong>' . __('End Date:', 'aati-events') . '</strong> ' . esc_html($formatted_end_date) . '</p>';

        $content .= $custom_fields;
    }

    return $content;
}
// disabled
//add_filter('the_content', 'aati_events_add_custom_fields_to_content');

function aati_events_format_date($date) {
    $date_format = get_option('date_format');
    $formatted_date = date_i18n($date_format, strtotime($date));
    return $formatted_date;
}
// make sure we can change the slug to use for the events / exhibitions 
function aati_events_settings_page() {
    add_submenu_page(
        'edit.php?post_type=event',
        __('AATI Events Settings', 'aati-events'),
        __('Settings', 'aati-events'),
        'manage_options',
        'aati-events-settings',
        'aati_events_settings_page_content'
    );
}
add_action('admin_menu', 'aati_events_settings_page');

function aati_events_format_event_date($start_date, $end_date) {
    // Create DateTime objects from the start and end dates
    $start_date_obj = new DateTime($start_date);
    $end_date_obj = new DateTime($end_date);

    $formatted_date = '';

    if ($start_date_obj->format('Y') == $end_date_obj->format('Y')) {
        // Same year
        if ($start_date_obj->format('m') == $end_date_obj->format('m')) {
            // Same month
            if ($start_date_obj->format('d') == $end_date_obj->format('d')) {
                // Same day
                $formatted_date = $start_date_obj->format('j F Y');
            } else {
                // Different day
                $formatted_date = $start_date_obj->format('j') . ' - ' . $end_date_obj->format('j F Y');
            }
        } else {
            // Different month
            $formatted_date = $start_date_obj->format('j F') . ' - ' . $end_date_obj->format('j F Y');
        }
    } else {
        // Different year
        $formatted_date = $start_date_obj->format('j F Y') . ' - ' . $end_date_obj->format('j F Y');
    }

    return $formatted_date;
}


function aati_events_settings_page_content() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['aati_events_slug']) && wp_verify_nonce($_POST['aati_events_nonce'], 'aati_events_save_slug')) {
        update_option('aati_events_slug', sanitize_text_field($_POST['aati_events_slug']));
    }

    $slug = get_option('aati_events_slug', 'event');
    ?>
    <div class="wrap">
        <h1><?php _e('AATI Events Settings', 'aati-events'); ?></h1>
        <form method="post">
            <?php wp_nonce_field('aati_events_save_slug', 'aati_events_nonce'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Events Slug', 'aati-events'); ?></th>
                    <td><input type="text" name="aati_events_slug" value="<?php echo esc_attr($slug); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function aati_events_admin_scripts($hook) {
    $current_screen = get_current_screen();

    if ($current_screen->id === 'event') {
        wp_enqueue_script('aati_events_admin', AATIEVENTS_PLUGIN_URL . '/assets/js/admin.js', array('jquery'), '1.0', true);
    }
}
add_action('admin_enqueue_scripts', 'aati_events_admin_scripts');

function generate_ics_file($start_date, $end_date, $summary, $description, $location, $event_id) {
    $ics_data = generate_ics_data($start_date, $end_date, $summary, $description, $location);
    $file_path = plugin_dir_path( __FILE__ ) . "events/event_{$event_id}.ics";

    // Ensure the events directory exists
    if (!is_dir(plugin_dir_path( __FILE__ ) . "events")) {
        mkdir(plugin_dir_path( __FILE__ ) . "events");
    }

    file_put_contents($file_path, $ics_data);

    // Return the URL to the .ics file
    return plugin_dir_url( __FILE__ ) . "events/event_{$event_id}.ics";
}

function generate_ics_data($start_date, $end_date, $summary, $description, $location) {
	$description = str_replace("\n", "\\n ", $description);
    $location = str_replace("\n", "\\n ", $location);
    $ics_data = "BEGIN:VCALENDAR\n";
    $ics_data .= "VERSION:2.0\n";
    $ics_data .= "PRODID:-//hacksw/handcal//NONSGML v1.0//EN\n";
    $ics_data .= "BEGIN:VEVENT\n";

    $start_date_ics = date('Ymd\THis\Z', strtotime($start_date));
    $end_date_ics = $end_date ? date('Ymd\THis\Z', strtotime($end_date)) : $start_date_ics;
    
    $ics_data .= "DTSTART:$start_date_ics\n";
    $ics_data .= "DTEND:$end_date_ics\n";
    $ics_data .= "SUMMARY:$summary\n";
    $ics_data .= "DESCRIPTION:$description\n";
    $ics_data .= "LOCATION:$location\n";
    $ics_data .= "END:VEVENT\n";
    $ics_data .= "END:VCALENDAR\n";

    return $ics_data;
}
