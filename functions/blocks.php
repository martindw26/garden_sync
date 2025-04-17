<?php

add_action('acf/init', 'register_slider_block');
function register_slider_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type([
            'name'              => 'post_slider',
            'title'             => __('Post Slider'),
            'description'       => __('A custom block to display posts in a slider'),
            'render_template'   => get_template_directory() . '/template-parts/blocks/post-slider.php',
            'category'          => 'formatting',
            'icon'              => 'images-alt2',
            'keywords'          => ['slider', 'posts', 'carousel'],
            'mode'              => 'preview',
            'supports'          => [
                'align' => false,
                'mode' => true,
            ],
        ]);
    }
}



