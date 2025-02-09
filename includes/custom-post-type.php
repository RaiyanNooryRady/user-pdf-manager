<?php
// Register Custom Post Type
function user_pdf_manager_register_custom_post_type(){
    register_post_type('user_pdfs', [
        'labels' => [
            'name' => 'User PDFs',
            'singular_name' => 'User PDF',
        ],
        'public' => true,
        'has_archive' => false,
        'supports' => ['title'],
        'show_in_menu' => true,
    ]);
}
add_action('init', 'user_pdf_manager_register_custom_post_type' );
