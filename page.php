<?php get_header(); ?>

<div id="container">

<main id="main" role="main">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                <?php the_content(); ?>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php esc_html_e( 'Sorry, no content found.', 'your-theme-textdomain' ); ?></p>
    <?php endif; ?>
</main>

</div>

<?php get_footer(); ?>
