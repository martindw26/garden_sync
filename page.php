<?php get_header(); ?>

<div class="container mt-4"> <!-- Bootstrap class added -->
    <div class="row">
        <div class="col-md-12">

            <main id="main" role="main">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article <?php post_class('mb-4'); ?> id="post-<?php the_ID(); ?>"> <!-- Bootstrap spacing -->
                            <?php the_content(); ?>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="alert alert-warning">
                        <p><?php esc_html_e( 'Sorry, no content found.', 'your-theme-textdomain' ); ?></p>
                    </div>
                <?php endif; ?>
            </main>

        </div>
    </div>
</div>

<?php get_footer(); ?>

