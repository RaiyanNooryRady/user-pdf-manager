<?php
// Retrieve the saved options for button text and link
$button_text = get_option('user_pdf_manager_button_text', __('Click Here', 'user-pdf-manager'));
$button_link = get_option('user_pdf_manager_button_link', '#');
?>
<div class="before-pdf-header text-light text-center py-3 mb-3"><?Php esc_html_e('As a tempcover member enjoy a discount on policies
    lasting
    one day or more', 'user-pdf-manager'); ?></div>
<div class="text-light text-center py-3 mb-3">
    <a href="<?php echo esc_url($button_link); ?>" target="_blank"
        class="btn-get-quote text-decoration-none"><?php esc_html_e($button_text, 'user-pdf-manager'); ?></a>
</div>

<h2 class="upm-author"><?php esc_html_e('Hello ', 'user-pdf-manager'); echo esc_html($current_user->display_name); ?></h2>