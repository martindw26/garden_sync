<?php get_header(); ?>
<main id="main" class="px-6 py-10" aria-label="Content">

<section class="post-slider mb-12">
  <h2 class="text-2xl font-semibold text-green-900 mb-4">Featured Posts</h2>
  <div class="flex gap-4 overflow-x-auto scroll-smooth">
    <?php
    $featured = new WP_Query(array('posts_per_page' => 5, 'tag' => 'featured'));
    if ($featured->have_posts()) :
      while ($featured->have_posts()) : $featured->the_post(); ?>
        <div class="min-w-[250px] bg-white rounded shadow p-4 flex-shrink-0">
          <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) {
              the_post_thumbnail('medium', ['class' => 'rounded mb-2']);
            } ?>
            <h3 class="text-lg font-semibold"><?php the_title(); ?></h3>
          </a>
        </div>
    <?php endwhile; wp_reset_postdata(); endif; ?>
  </div>
</section>

<section class="post-grid">
  <h2 class="text-2xl font-semibold text-green-900 mb-6">Latest Posts</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post(); ?>
        <article class="bg-white p-4 rounded shadow hover:shadow-lg transition">
          <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) the_post_thumbnail('medium', ['class' => 'rounded mb-3']); ?>
            <h3 class="text-lg font-semibold"><?php the_title(); ?></h3>
          </a>
        </article>
    <?php endwhile; endif; ?>
  </div>
</section>

</main>
<?php get_footer(); ?>
