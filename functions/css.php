<?php

add_action('enqueue_block_assets', 'enqueue_slider_styles');
function enqueue_slider_styles() {
    wp_enqueue_style('post-slider-css', get_template_directory_uri() . '/css/post-slider.css');
}
