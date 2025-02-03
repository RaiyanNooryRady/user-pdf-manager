<?php
// Add meta boxes for PDF URL and Username

add_action('add_meta_boxes', function () {
    add_meta_box('pdf_meta', 'PDF Details', 'user_pdf_manager_render_pdf_meta_box', 'user_pdfs', 'normal', 'default');
});

function user_pdf_manager_render_pdf_meta_box($post)
{
    //username
    $username = get_post_meta($post->ID, 'username', true);

    //start date and time
    $start_date_time = get_post_meta($post->ID,'start_date_time', true);

    //end date and time
    $end_date_time = get_post_meta($post->ID,'end_date_time', true);

    //policy status
    $policy_status= get_post_meta($post->ID,'policy_status', true);

    // $pdf_link = get_post_meta($post->ID, 'pdf_link1', true);
    for ($i = 1; $i <= 10; $i++) {
        ${"pdf_link$i"} = get_post_meta($post->ID, "pdf_link$i", true);
    }
    ?>
    <p>
        <label for="username"><?php echo esc_html_e('Username','user-pdf-manager'); ?></label><br>
        <input type="text" name="username" id="username" value="<?php echo esc_attr($username); ?>" style="width:100%;">
    </p>
    <p>
        <label for="start_date_time"><?php echo esc_html_e('Select Start Date & Time','user-pdf-manager'); ?></label>
        <input type="datetime-local" name="start_date_time" id="start_date_time" value="<?php echo esc_attr($start_date_time); ?>" style="width:100%;">
    </p>
    <p>
        <label for="end_date_time"><?php echo esc_html_e('Select End Date & Time','user-pdf-manager'); ?></label>
        <input type="datetime-local" name="end_date_time" id="end_date_time" value="<?php echo esc_attr($end_date_time); ?>" style="width:100%;">
    </p>
    <p>
        <label for="policy_status"><?php echo esc_html_e('Policy Status:','user-pdf-manager'); ?></label><br>
        <input type="text" name="policy_status" id="policy_status" value="<?php echo esc_attr($policy_status); ?>" style="width:100%;">
    </p>
    <?php
    //Displaying the custom meta fields in dashboard
    for ($i = 1; $i <= 10; $i++) {
        ?>
        <p>
            <label for="pdf_link<?php echo $i; ?>">PDF URL <?php echo $i; ?>:</label><br>
            <input type="text" name="pdf_link<?php echo $i; ?>" id="pdf_link<?php echo $i; ?>" value="<?php echo esc_attr(${"pdf_link$i"}); ?>" style="width:100%;">
        </p>

        <?php
    }
    ?>
    <?php
}

function user_pdf_manager_save_post($post_id){
    if (isset($_POST['username'])) {
        update_post_meta($post_id, 'username', sanitize_text_field($_POST['username']));
    }
    if(isset($_POST['start_date_time'])) {
        update_post_meta($post_id,'start_date_time', sanitize_text_field($_POST['start_date_time']));
    }
    if(isset($_POST['end_date_time'])) {
        update_post_meta($post_id,'end_date_time', sanitize_text_field($_POST['end_date_time']));
    }
    if (isset($_POST['policy_status'])) {
        update_post_meta($post_id, 'policy_status', sanitize_text_field($_POST['policy_status']));
    }
    for ($i = 1; $i <= 10; $i++) {
        // Generate the field name dynamically
        $field_name = 'pdf_link' . $i;
        // Check if the field is set in $_POST
        if (isset($_POST[$field_name])) {
            // Update the corresponding post meta
            update_post_meta($post_id, $field_name, sanitize_text_field($_POST[$field_name]));
        }
    }
}
add_action('save_post', 'user_pdf_manager_save_post');
