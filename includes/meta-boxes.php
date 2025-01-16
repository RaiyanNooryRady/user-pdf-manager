<?php
// Add meta boxes for PDF URL and Username

add_action('add_meta_boxes', function () {
    add_meta_box('pdf_meta', 'PDF Details', 'render_pdf_meta_box', 'user_pdfs', 'normal', 'default');
});

function render_pdf_meta_box($post)
{
    $pdf_link = get_post_meta($post->ID, 'pdf_link', true);
    $pdf_link2= get_post_meta($post->ID,'pdf_link2', true);
    $pdf_link3= get_post_meta($post->ID,'pdf_link3', true);
    $username = get_post_meta($post->ID, 'username', true);
    ?>
    <p>
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" value="<?php echo esc_attr($username); ?>" style="width:100%;">
    </p>
    <p>
        <label for="pdf_link">PDF URL 1:</label><br>
        <input type="text" name="pdf_link" id="pdf_link" value="<?php echo esc_attr($pdf_link); ?>" style="width:100%;">
    </p>
    <p>
        <label for="pdf_link2">PDF URL 2:</label><br>
        <input type="text" name="pdf_link2" id="pdf_link2" value="<?php echo esc_attr($pdf_link2); ?>" style="width:100%;">
    </p>
    <p>
        <label for="pdf_link3">PDF URL 3:</label><br>
        <input type="text" name="pdf_link3" id="pdf_link3" value="<?php echo esc_attr($pdf_link3); ?>" style="width:100%;">
    </p>
    
    <?php
}


add_action('save_post', function ($post_id) {
    if (isset($_POST['username'])) {
        update_post_meta($post_id, 'username', sanitize_text_field($_POST['username']));
    }
    if (isset($_POST['pdf_link'])) {
        update_post_meta($post_id, 'pdf_link', sanitize_text_field($_POST['pdf_link']));
    }
    if (isset($_POST['pdf_link2'])) {
        update_post_meta($post_id, 'pdf_link2', sanitize_text_field($_POST['pdf_link2']));
    }
    if (isset($_POST['pdf_link3'])) {
        update_post_meta($post_id, 'pdf_link3', sanitize_text_field($_POST['pdf_link3']));
    }
    
});
