<head>
  <!-- Bootstrap 5.3 CSS & JS (Make sure these are included in your theme) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .carousel-item img {
      object-fit: cover;
      height: 300px;
      border-radius: 0.75rem;
    }

    .carousel-caption {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 1rem;
      border-radius: 0.5rem;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      filter: invert(1);
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
    <div id="postCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php $i = 0; while ($query->have_posts()): $query->the_post(); ?>
          <div class="carousel-item <?= $i === 0 ? 'active' : ''; ?>">
            <a href="<?php the_permalink(); ?>">
              <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('large', ['class' => 'd-block w-100']); ?>
              <?php endif; ?>
              <div class="carousel-caption d-none d-md-block">
                <h5><?php the_title(); ?></h5>
              </div>
            </a>
          </div>
        <?php $i++; endwhile; wp_reset_postdata(); ?>
      </div>

      <!-- Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#postCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#postCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  <?php else: ?>
    <p>No posts found.</p>
  <?php endif; ?>
</div>
