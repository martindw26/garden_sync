<?php get_header(); ?>
<main id="main">
<h1>Search Results</h1>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); get_template_part('template-parts/content-archive'); endwhile; else: ?><p>No results found.</p><?php endif; ?>
</main>
<?php get_footer(); ?>