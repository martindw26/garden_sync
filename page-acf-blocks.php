<?php
/**
 * Template Name: ACF Custom Blocks Page
 */

get_header(); ?>

<main id="main" class="py-5" aria-label="Main Content">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="container mb-5">
      <?php the_content(); ?>
    </section>

    <?php if ( get_field('enable_post_slider') ) : ?>
    <section class="container mb-5">
      <h2 class="mb-4"><?php the_field('post_slider_title'); ?></h2>
      <div class="d-flex overflow-auto gap-3">
        <?php
          $slider_posts = get_field('slider_posts');
          if ($slider_posts):
            foreach ($slider_posts as $post):
              setup_postdata($post); ?>
              <div class="card" style="min-width: 250px;">
                <?php if (has_post_thumbnail()) { ?>
                  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?></a>
                <?php } ?>
                <div class="card-body">
                  <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                </div>
              </div>
            <?php endforeach; wp_reset_postdata();
          endif;
        ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if ( get_field('enable_post_grid') ) : ?>
    <section class="container mb-5">
      <h2 class="mb-4"><?php the_field('post_grid_title'); ?></h2>
      <div class="row g-4">
        <?php
          $grid_posts = get_field('grid_posts');
          if ($grid_posts):
            foreach ($grid_posts as $post):
              setup_postdata($post); ?>
              <div class="col-md-4">
                <div class="card h-100">
                  <?php if (has_post_thumbnail()) { ?>
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?></a>
                  <?php } ?>
                  <div class="card-body">
                    <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                  </div>
                </div>
              </div>
            <?php endforeach; wp_reset_postdata();
          endif;
        ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- Parallax Section -->
    <section class="parallax-section text-white d-flex align-items-center justify-content-center text-center">
      <div class="container">
        <h2 class="display-4 fw-bold">Experience the Beauty of Nature</h2>
        <p class="lead">Let the outdoors inspire your next journey</p>
      </div>
    </section>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
