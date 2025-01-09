<?php
/**
 * Plugin Name: User PDF Manager
 * Description: A plugin to manage user-specific PDFs. Use [user_pdfs] shortcode to show.
 * Version: 1.0
 * Author: Hridoy Khan
 */

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

// Include core functionality
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
