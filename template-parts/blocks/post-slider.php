<head>

<style>
/* Modern 2025-style slider block */
.post-slider-block {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
    font-family: 'Inter', sans-serif;
    color: #1a1a1a;
  }
  
  .post-slider-block h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.3;
    text-transform: capitalize;
    letter-spacing: -0.02em;
  }
  
  .swiper-container {
    position: relative;
    overflow: hidden;
  }
  
  .swiper-wrapper {
    display: flex;
  }
  
  .swiper-slide {
    background: #fff;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
    max-width: 90%;
    margin: 0 auto;
  }
  
  .swiper-slide:hover {
    transform: translateY(-5px);
  }
  
  .swiper-slide article {
    display: flex;
    flex-direction: column;
    text-align: left;
    padding: 1rem;
  }
  
  .swiper-slide img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 0.75rem;
    margin-bottom: 1rem;
  }
  
  .swiper-slide h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    line-height: 1.4;
    color: #333;
    transition: color 0.3s ease;
  }
  
  .swiper-slide a {
    text-decoration: none;
    color: inherit;
  }
  
  .swiper-slide a:hover h3 {
    color: #0073e6;
  }
  
  /* Swiper navigation buttons */
  .swiper-button-next,
  .swiper-button-prev {
    color: #0073e6;
    background-color: rgba(255, 255, 255, 0.85);
    border-radius: 50%;
    padding: 0.5rem;
    width: 2.5rem;
    height: 2.5rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: background 0.3s ease;
  }
  
  .swiper-button-next:hover,
  .swiper-button-prev:hover {
    background-color: #0073e6;
    color: #fff;
  }
  
  /* Responsive tweaks */
  @media (min-width: 640px) {
    .swiper-slide {
      max-width: 80%;
    }
  }
  
  @media (min-width: 768px) {
    .swiper-slide {
      max-width: 600px;
    }
  
    .swiper-slide article {
      flex-direction: row;
      gap: 1rem;
    }
  
    .swiper-slide img {
      width: 50%;
      object-fit: cover;
    }
  
    .swiper-slide h3 {
      font-size: 1.5rem;
    }
  }
</style>
</head>

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
        <header>
            <h2 style="text-align: <?= esc_attr($title_alignment); ?>;">
                <?= esc_html($slider_title); ?>
            </h2>
        </header>
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
