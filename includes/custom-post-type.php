<?php
// Register Custom Post Type

add_action('init', function () {
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
});
