<?php
function theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function sps_enqueue_scripts() {
    wp_enqueue_script('sps_strict_domains_js', get_stylesheet_directory_uri() . '/strict_domains.js'); 
}
add_action('wp_enqueue_scripts', 'sps_enqueue_scripts');
