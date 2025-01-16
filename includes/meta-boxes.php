<?php
// Add meta boxes for PDF URL and Username

add_action('add_meta_boxes', function () {
    add_meta_box('pdf_meta', 'PDF Details', 'render_pdf_meta_box', 'user_pdfs', 'normal', 'default');
});

function render_pdf_meta_box($post)
{
    $username = get_post_meta($post->ID, 'username', true);
    // $pdf_link = get_post_meta($post->ID, 'pdf_link1', true);
    for ($i = 1; $i <= 10; $i++) {
        ${"pdf_link$i"} = get_post_meta($post->ID, "pdf_link$i", true);
    }
    ?>
    <p>
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" value="<?php echo esc_attr($username); ?>" style="width:100%;">
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


add_action('save_post', function ($post_id) {
    if (isset($_POST['username'])) {
        update_post_meta($post_id, 'username', sanitize_text_field($_POST['username']));
    }
    
    for ($i = 1; $i <= 10; $i++) {
        // Generate the field name dynamically
        // if (isset($_POST['pdf_link1'])) {
        //     update_post_meta($post_id, 'pdf_link1', sanitize_text_field($_POST['pdf_link1']));
        // }
        $field_name = 'pdf_link' . $i;
    
        // Check if the field is set in $_POST
        if (isset($_POST[$field_name])) {
            // Update the corresponding post meta
            update_post_meta($post_id, $field_name, sanitize_text_field($_POST[$field_name]));
        }
    }
});
