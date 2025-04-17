<?php
// Enqueue scripts and styles
function naturepress_scripts() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'naturepress_scripts');

// Theme setup
function naturepress_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'gallery', 'caption'));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'naturepress')
    ));
}
add_action('after_setup_theme', 'naturepress_setup');

// Widget area
function naturepress_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'naturepress'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.'),
        'before_widget' => '<section class="mb-4">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="h5 mb-2">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'naturepress_widgets_init');


