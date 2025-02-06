<?php
// Add meta boxes for PDF URL and Username

add_action('add_meta_boxes', function () {
    add_meta_box('pdf_meta', 'PDF Details', 'user_pdf_manager_render_pdf_meta_box', 'user_pdfs', 'normal', 'default');
});

function user_pdf_manager_render_pdf_meta_box($post)
{
    // Add a nonce field to secure form submission
    wp_nonce_field('user_pdf_manager_save_nonce_action', 'user_pdf_manager_save_nonce');

    //username
    $username = get_post_meta($post->ID, 'username', true);

    //id number
    $upm_id_number = get_post_meta($post->ID, 'upm_id_number', true);

    //Full Name
    $upm_full_name = get_post_meta($post->ID, 'upm_full_name', true);

    //registration number
    $upm_registration_number = get_post_meta($post->ID, 'upm_registration_number', true);

    //start date and time
    $start_date_time = get_post_meta($post->ID, 'start_date_time', true);

    //end date and time
    $end_date_time = get_post_meta($post->ID, 'end_date_time', true);

    //policy status
    $policy_status = get_post_meta($post->ID, 'policy_status', true);

    // $pdf_link = get_post_meta($post->ID, 'pdf_link1', true);
    $pdf_links = [];
    for ($i = 1; $i <= 10; $i++) {
        $pdf_links[$i] = get_post_meta($post->ID, "pdf_link$i", true);
    }
    ?>
    <p>
        <label for="username"><?php esc_html_e('Username', 'user-pdf-manager'); ?></label><br>
        <input type="text" name="username" id="username" value="<?php echo esc_attr($username); ?>" style="width:100%;">
    </p>
    <p>
        <label for="upm_id_number"><?php esc_html_e('Id Number', 'user-pdf-manager'); ?></label>
        <input type="text" name="upm_id_number" id="upm_id_number" value="<?php echo esc_attr($upm_id_number); ?>"
            style="width:100%;">
    </p>
    <p>
        <label for="upm_full_name"><?php esc_html_e('Full Name', 'user-pdf-manager'); ?></label><br>
        <input type="text" name="upm_full_name" id="upm_full_name" value="<?php echo esc_attr($upm_full_name); ?>"
            style="width:100%;">
    </p>
    <p>
        <label for="upm_registration_number"><?php esc_html_e('Registration Number', 'user-pdf-manager'); ?></label>
        <input type="text" name="upm_registration_number" id="upm_registration_number"
            value="<?php echo esc_attr($upm_registration_number); ?>" style="width:100%;">
    </p>
    <p>
        <label for="start_date_time"><?php esc_html_e('Select Start Date & Time', 'user-pdf-manager'); ?></label>
        <input type="datetime-local" name="start_date_time" id="start_date_time"
            value="<?php echo esc_attr($start_date_time); ?>" style="width:100%;">
    </p>
    <p>
        <label for="end_date_time"><?php esc_html_e('Select End Date & Time', 'user-pdf-manager'); ?></label>
        <input type="datetime-local" name="end_date_time" id="end_date_time" value="<?php echo esc_attr($end_date_time); ?>"
            style="width:100%;">
    </p>
    <p>
        <label for="policy_status"><?php esc_html_e('Policy Status:', 'user-pdf-manager'); ?></label><br>
        <input type="text" name="policy_status" id="policy_status" value="<?php echo esc_attr($policy_status); ?>"
            style="width:100%;">
    </p>
    <?php
    //Displaying the custom meta fields in dashboard
    foreach ($pdf_links as $i => $pdf_link) {
        ?>
        <p>
            <label for="pdf_link<?php echo $i; ?>"><?php esc_html_e('PDF URL', 'user-pdf-manager'); ?>
                <?php echo esc_html($i . ":"); ?></label><br>
            <input type="text" name="pdf_link<?php echo $i; ?>" id="pdf_link<?php echo $i; ?>"
                value="<?php echo esc_attr($pdf_link); ?>" style="width:100%;">
        </p>
        <?php
    }
?>
<?php
}

function user_pdf_manager_save_post($post_id)
{

    // ✅ Step 1: Check if the nonce is set and valid

    if (
        !isset($_POST['user_pdf_manager_save_nonce']) ||
        !wp_verify_nonce(sanitize_text_field($_POST['user_pdf_manager_save_nonce']), 'user_pdf_manager_save_nonce_action')
    ) {
        return;
    }


    // ✅ Step 2: Check if the user has permission to edit this post
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // ✅ Step 3: Prevent autosave from overwriting post meta
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // ✅ Step 4: Sanitize and save meta fields

    if (isset($_POST['username'])) {
        update_post_meta($post_id, 'username', sanitize_text_field($_POST['username']));
    }
    if (isset($_POST['upm_id_number'])) {
        update_post_meta($post_id, 'upm_id_number', sanitize_text_field($_POST['upm_id_number']));
    }
    if (isset($_POST['upm_full_name'])) {
        update_post_meta($post_id, 'upm_full_name', sanitize_text_field($_POST['upm_full_name']));
    }
    if (isset($_POST['upm_registration_number'])) {
        update_post_meta($post_id, 'upm_registration_number', sanitize_text_field($_POST['upm_registration_number']));
    }
    if (isset($_POST['start_date_time']) && strtotime($_POST['start_date_time'])) {
        update_post_meta($post_id, 'start_date_time', $_POST['start_date_time']);
    }
    if (isset($_POST['end_date_time']) && strtotime($_POST['end_date_time'])) {
        update_post_meta($post_id, 'end_date_time', $_POST['end_date_time']);
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
            update_post_meta($post_id, $field_name, esc_url_raw($_POST[$field_name]));
        }
    }
}
add_action('save_post', 'user_pdf_manager_save_post');
