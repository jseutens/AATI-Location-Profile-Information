    <div class="wrap">
        <h1><?php _e('Location Profile Information Support', AATILPI_TEXTDOMAIN); ?></h1>
        <h2><?php _e('How to use the Location Profile Information shortcode', AATILPI_TEXTDOMAIN); ?></h2>
        <p><?php _e('To display a location, use the following shortcode:', AATILPI_TEXTDOMAIN); ?></p>
        <pre>[contact-card location=ID]</pre>
        <p><?php _e('Replace "ID" with the ID of the location you want to display. If no ID is provided, the first location will be used.', AATILPI_TEXTDOMAIN); ?></p>

        <h2><?php _e('How to contact us', AATILPI_TEXTDOMAIN); ?></h2>
        <p><?php _e('If you need assistance or have any questions, please contact us at', AATILPI_TEXTDOMAIN); ?> <a href="mailto:support@aati.be">support@aati.be</a>.</p>

        <h2><?php _e('Locations', AATILPI_TEXTDOMAIN); ?></h2>
        <div class="aatilpi-locations-table-container">
            <table class="aatilpi-locations-table">
                <thead>
                    <tr>
                        <th><?php _e('Shortcode', AATILPI_TEXTDOMAIN); ?></th>
                        <th><?php _e('Location Name', AATILPI_TEXTDOMAIN); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $locations = aatilpi_get_ordered_locations();
                    foreach ($locations as $location) {
                        $shortcode = '[contact-card location=' . $location->ID . ']';
                        $name = get_the_title($location->ID);
                        ?>
                        <tr>
                            <td><?php echo $shortcode; ?></td>
                            <td><?php echo $name; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>