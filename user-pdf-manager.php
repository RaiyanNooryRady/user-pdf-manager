<?php
/*
 * Plugin Name:       UPM - User PDF Manager
 * Description:       A plugin to manage user-specific PDFs. Use [user_pdfs] shortcode to show.
 * Version:           0.1
 * Requires at least: 6.7
 * Requires PHP:      8.2
 * Author:            SparkTech
 * Author URI:        https://sparktech.agency/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       upm
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

// Include core functionality
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/meta-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
require_once plugin_dir_path(__FILE__) . 'includes/enqueue-scripts.php';
