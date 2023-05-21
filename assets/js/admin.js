jQuery(document).ready(function($) {
    // Disable the end date field until a start date is chosen
    if (!$('#aati_event_start_date').val()) {
        $('#aati_event_end_date').prop('disabled', true);
    }

    // Enable the end date field and set its minimum allowed value whenever the start date changes
    $('#aati_event_start_date').on('change', function() {
        var startDate = $(this).val();

        if (startDate) {
            $('#aati_event_end_date').prop('disabled', false).attr('min', startDate);
        } else {
            $('#aati_event_end_date').prop('disabled', true);
        }
    });
});
