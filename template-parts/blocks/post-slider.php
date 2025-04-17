<head>
  <!-- Swiper Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    /* Modern 2025-style slider block */
    :root {
      --color-primary: #0073e6;
      --color-text: #1a1a1a;
      --color-muted: #333;
      --color-bg: #fff;
      --shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
      --radius: 1rem;
      --transition: 0.3s ease;
      --font-sans: 'Inter', sans-serif;
    }

    .post-slider-block {
      max-width: 1200px;
      margin-inline: auto;
      padding: 2rem 1rem;
      font-family: var(--font-sans);
      color: var(--color-text);
    }

    .post-slider-block h2 {
      font-size: clamp(1.75rem, 2.5vw, 2.25rem);
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
      background: var(--color-bg);
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
      transition: transform var(--transition);
      max-width: 90%;
      margin-inline: auto;
    }

    .swiper-slide:hover {
      transform: translateY(-4px);
    }

    .swiper-slide article {
      display: flex;
      flex-direction: column;
      text-align: left;
      padding: 1rem;
      gap: 0.75rem;
    }

    .swiper-slide img {
      width: 100%;
      height: auto;
      display: block;
      border-radius: 0.75rem;
      margin-bottom: 0.75rem;
      object-fit: cover;
    }

    .swiper-slide h3 {
      font-size: 1.25rem;
      font-weight: 600;
      margin: 0;
      line-height: 1.4;
      color: var(--color-muted);
      transition: color var(--transition);
    }

    .swiper-slide a {
      text-decoration: none;
      color: inherit;
      display: block;
    }

    .swiper-slide a:hover h3,
    .swiper-slide a:focus h3 {
      color: var(--color-primary);
    }

    .swiper-button-next,
    .swiper-button-prev {
      color: var(--color-primary);
      background-color: rgba(255, 255, 255, 0.85);
      border-radius: 50%;
      padding: 0.5rem;
      width: 2.5rem;
      height: 2.5rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      transition: background var(--transition), color var(--transition);
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
      background-color: var(--color-primary);
      color: #fff;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
      font-size: 1.2rem;
    }

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
        gap: 1.25rem;
        align-items: center;
      }

      .swiper-slide img {
        width: 50%;
        border-radius: 0.75rem;
      }

      .swiper-slide h3 {
        font-size: 1.5rem;
      }
    }

    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after {
        transition: none !important;
      }
    }
  </style>
</head>

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
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  <?php else: ?>
    <p>No posts found.</p>
  <?php endif; ?>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper-container', {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: false,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        640: {
          slidesPerView: 1.5,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        }
      },
      on: {
        reachEnd: function () {
          const nextBtn = document.querySelector('.swiper-button-next');
          nextBtn.addEventListener('click', () => {
            swiper.slideTo(0);
          }, { once: true });
        },
        fromEdge: function () {
          // Reset button behavior
          const oldNext = document.querySelector('.swiper-button-next');
          const newNext = oldNext.cloneNode(true);
          oldNext.replaceWith(newNext);
          swiper.navigation.init(); // Re-init navigation
        }
      }
    });
  });
</script>
