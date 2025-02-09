<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//Enqueue Scripts

function user_pdf_manager_assets_loader()
{

    // Enqueue styles
    wp_enqueue_style(
        'bootstrap-css', // Handle name for the style
        plugin_dir_url(__FILE__) . '../assets/bootstrap/css/bootstrap.min.css', // Path to the CSS file
        array(), // Dependencies (if any)
        '5.3.3' // Version number
    );
    wp_enqueue_style(
        'bootstrap-icon-css', // Handle name for the style
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', // Path to the CSS file
        array(), // Dependencies (if any)
        '5.3.3' // Version number
    );
    wp_enqueue_style('style-css', plugin_dir_url(__FILE__). '../assets/css/style.css', array(), '1.0.0' );

    // Enqueue scripts
    wp_enqueue_script('bootstrap-js', plugin_dir_url(__FILE__) . '../assets/bootstrap/js/bootstrap.bundle.min.js', array(), '1.0.0');
    wp_enqueue_script(
        'script-js',
        plugin_dir_url(__FILE__) . '../assets/js/script.js',
        array('jquery'),
        '1.0.0',
        true
    );
}

add_action("wp_enqueue_scripts", "user_pdf_manager_assets_loader");