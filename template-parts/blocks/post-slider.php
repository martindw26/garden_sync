<head>
  <!-- Bootstrap 5.3 CSS & JS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .carousel-item img {
      object-fit: cover;
      height: 400px;
      border-radius: 1rem;
      transition: transform 0.4s ease;
    }

    .carousel-item a:hover img {
      transform: scale(1.02);
    }

    .carousel-caption {
      background: linear-gradient(to top, rgba(0, 0, 0, 0.65), transparent);
      padding: 1rem 1.25rem;
      border-radius: 0 0 1rem 1rem;
      text-align: left;
      bottom: 0;
      left: 0;
      right: 0;
    }

    .carousel-caption h5 {
      color: #fff;
      font-size: 1.25rem;
      margin: 0;
    }

    .carousel-indicators [data-bs-target] {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: #555;
    }

    .carousel-indicators .active {
      background-color: #0073e6;
    }

    .carousel-counter {
      font-size: 0.9rem;
      color: #666;
    }

    /* Custom next/prev buttons */
    .carousel-control-prev,
    .carousel-control-next {
      width: auto;
      height: auto;
      top: 50%;
      transform: translateY(-50%);
    }

    .custom-carousel-icon {
      font-size: 1.5rem;
      color: #0073e6;
      background: rgba(255, 255, 255, 0.85);
      border-radius: 50%;
      padding: 0.5rem 0.75rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      transition: background 0.3s, color 0.3s;
    }

    .carousel-control-prev:hover .custom-carousel-icon,
    .carousel-control-next:hover .custom-carousel-icon {
      background: #0073e6;
      color: #fff;
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

<div class="container my-5">
  <?php if ($slider_title): ?>
    <h2 class="mb-4 text-<?= esc_attr($title_alignment); ?>"><?= esc_html($slider_title); ?></h2>
  <?php endif; ?>

  <?php if ($query->have_posts()): ?>
    <div id="postCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000" data-bs-pause="hover">
      <!-- Indicators -->
      <div class="carousel-indicators">
        <?php for ($j = 0; $j < $query->post_count; $j++): ?>
          <button type="button" data-bs-target="#postCarousel" data-bs-slide-to="<?= $j; ?>" class="<?= $j === 0 ? 'active' : ''; ?>" aria-current="<?= $j === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?= $j + 1; ?>"></button>
        <?php endfor; ?>
      </div>

      <!-- Slides -->
      <div class="carousel-inner">
        <?php $i = 0; while ($query->have_posts()): $query->the_post(); ?>
          <div class="carousel-item <?= $i === 0 ? 'active' : ''; ?>" data-slide-index="<?= $i; ?>">
            <a href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('large', ['class' => 'd-block w-100']); ?>
              <?php endif; ?>
              <div class="carousel-caption d-none d-sm-block">
                <h5><?php the_title(); ?></h5>
              </div>
            </a>
          </div>
        <?php $i++; endwhile; wp_reset_postdata(); ?>
      </div>

      <!-- Custom Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#postCarousel" data-bs-slide="prev">
        <span class="custom-carousel-icon" aria-hidden="true">&larr;</span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#postCarousel" data-bs-slide="next">
        <span class="custom-carousel-icon" aria-hidden="true">&rarr;</span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Slide Counter -->
    <div class="d-flex justify-content-end mt-2">
      <span class="carousel-counter">
        <span id="carousel-current">1</span> / <?= $query->post_count; ?>
      </span>
    </div>

    <!-- JS for Slide Counter -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('postCarousel');
        const counter = document.getElementById('carousel-current');
        const items = carousel.querySelectorAll('.carousel-item');

        carousel.addEventListener('slid.bs.carousel', function () {
          const index = [...items].findIndex(item => item.classList.contains('active'));
          counter.textContent = index + 1;
        });
      });
    </script>
  <?php else: ?>
    <p>No posts found.</p>
  <?php endif; ?>
</div>
