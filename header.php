<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a class="visually-hidden-focusable" href="#main">Skip to content</a>

<header class="bg-light py-3 mb-4 border-bottom">
  <div class="container d-flex flex-wrap justify-content-between align-items-center">
    <div class="site-logo">
      <?php if (has_custom_logo()) {
        the_custom_logo();
      } else { ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-decoration-none fw-bold fs-4 text-dark">
          <?php bloginfo('name'); ?>
        </a>
      <?php } ?>
    </div>
    <nav class="mt-3 mt-md-0">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'menu_class' => 'nav list-unstyled d-flex gap-3 mb-0',
        ));
      ?>
    </nav>
  </div>
</header>
