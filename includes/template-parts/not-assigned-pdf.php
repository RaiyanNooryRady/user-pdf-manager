<?php
// Retrieve the saved options for button text and link
$button_text = get_option('user_pdf_manager_button_text', __('Click Here', 'upm-user-pdf-manager'));
$button_link = get_option('user_pdf_manager_button_link', '#');
?>
<div class="upm-not-assigned-pdf my-3">
    <div class="card shadow-sm">
        <h5 class="policy-header mb-4"><?php esc_html_e('Current & Upcoming', 'upm-user-pdf-manager'); ?></h5>
        <div class="no-policy text-center py-5 rounded-4">
            <h4 class="text-light"><?php esc_html_e('You have no active temporary policies', 'upm-user-pdf-manager'); ?></h4>
            <div class="text-light text-center py-3">
                <a href="<?php echo esc_url($button_link); ?>" target="_blank"
                    class="p-3 btn-get-quote text-decoration-none"><?php echo esc_html($button_text); ?></a>
            </div>
        </div>
        <h5 class="policy-header mt-3"><?php esc_html_e('Past Policies', 'upm-user-pdf-manager'); ?></h5>
    </div>

</div>