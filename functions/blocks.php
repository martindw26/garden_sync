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

add_action('enqueue_block_assets', 'enqueue_slider_assets');
function enqueue_slider_assets() {
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', [], null, true);

    wp_add_inline_script('swiper-js', "
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.swiper-container', {
                loop: true,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    ");
}


