<?php
$link = get_post_meta(get_the_ID(), '_aati_event_link', true);
$start_date = get_post_meta(get_the_ID(), '_aati_event_start_date', true);
$end_date = get_post_meta(get_the_ID(), '_aati_event_end_date', true);
$add_to_calendar_link = aati_events_add_to_calendar_link(get_the_ID());

echo '<p><strong>' . __('Link:', 'aati-events') . '</strong> <a href="' . esc_url($link) . '" target="_blank">' . esc_html($link) . '</a></p>';
echo '<p><strong>' . __('Start Date:', 'aati-events') . '</strong> ' . esc_html($start_date) . '</p>';
echo '<p><strong>' . __('End Date:', 'aati-events') . '</strong> ' . esc_html($end_date) . '</p>';
echo '<p><a href="' . esc_url($add_to_calendar_link) . '" target="_blank">' . __('Add to Calendar', 'aati-events') . '</a></p>';
