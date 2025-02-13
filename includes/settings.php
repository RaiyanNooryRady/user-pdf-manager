<?php
// Add a submenu under "User PDFs" for settings
add_action('admin_menu', function () {
    add_submenu_page(
        'edit.php?post_type=user_pdfs', // ✅ Parent menu: User PDFs
        __('Settings', 'upm-user-pdf-manager'), // Page title
        __('Settings', 'upm-user-pdf-manager'), // Menu title
        'manage_options', // Capability required
        'user_pdf_manager_settings', // Menu slug
        'user_pdf_manager_render_settings_page' // Function to render settings page
    );
});

// Render the settings page
function user_pdf_manager_render_settings_page() {
    if (!current_user_can('manage_options')) {
        wp_die(esc_html_e('You do not have sufficient permissions to access this page.', 'upm-user-pdf-manager'));
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('User PDFs Settings', 'upm-user-pdf-manager'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('user_pdf_manager_settings_group');
            do_settings_sections('user_pdf_manager_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
function upm_user_pdf_manager_sanitize_button_text($input){
    return sanitize_text_field($input);
}
function upm_user_pdf_manager_sanitize_button_link($input){
    return esc_url_raw($input);
}
// Register settings, fields, and sections
add_action('admin_init', function () {
    register_setting('user_pdf_manager_settings_group', 'user_pdf_manager_button_text',['upm_user_pdf_manager_sanitize_button_text']);
    register_setting('user_pdf_manager_settings_group', 'user_pdf_manager_button_link',['upm_user_pdf_manager_sanitize_button_link']);

    add_settings_section(
        'user_pdf_manager_button_settings_section',
        __('Button Settings', 'upm-user-pdf-manager'), // ✅ Section title
        'user_pdf_manager_section_callback', // ✅ Required, even if empty
        'user_pdf_manager_settings'
    );

    add_settings_field(
        'user_pdf_manager_button_text',
        __('Button Text', 'upm-user-pdf-manager'),
        'user_pdf_manager_render_button_text_field',
        'user_pdf_manager_settings',
        'user_pdf_manager_button_settings_section'
    );

    add_settings_field(
        'user_pdf_manager_button_link',
        __('Button Link', 'upm-user-pdf-manager'),
        'user_pdf_manager_render_button_link_field',
        'user_pdf_manager_settings',
        'user_pdf_manager_button_settings_section'
    );
});

// ✅ Empty callback function for section description
function user_pdf_manager_section_callback() {
    echo '<p>' . esc_html_e('Configure button settings here.', 'upm-user-pdf-manager') . '</p>';
}

// Callback function to render the button text field
function user_pdf_manager_render_button_text_field() {
    $value = get_option('user_pdf_manager_button_text', __('Click Here', 'upm-user-pdf-manager'));
    echo '<input type="text" name="user_pdf_manager_button_text" value="' . esc_attr($value) . '" style="width: 300px;">';
}

// Callback function to render the button link field
function user_pdf_manager_render_button_link_field() {
    $value = get_option('user_pdf_manager_button_link', '#');
    echo '<input type="url" name="user_pdf_manager_button_link" value="' . esc_url($value) . '" style="width: 300px;">';
}
?>
