<!-- Post Slider Block Template -->
<?php
$slider_title = get_field('slider_title');
$title_alignment = get_field('title_alignment') ?: 'left';
$num_posts = get_field('number_of_posts') ?: 5;
$categories = get_field('categories');

// WP Query
$args = [
    'post_type' => 'post',
    'posts_per_page' => $num_posts,
];

if ($categories) {
    $args['category__in'] = $categories;
}

$query = new WP_Query($args);
?>

<div class="post-slider-block">
    <?php if ($slider_title): ?>
        <h2 style="text-align: <?= esc_attr($title_alignment); ?>;">
            <?= esc_html($slider_title); ?>
        </h2>
    <?php endif; ?>

    <?php if ($query->have_posts()): ?>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <div class="swiper-slide">
                        <article>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
                                <h3><?php the_title(); ?></h3>
                            </a>
                        </article>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <!-- Optional nav -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>
</div>
