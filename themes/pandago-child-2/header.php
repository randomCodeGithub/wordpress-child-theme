<?php get_template_part('template-parts/head'); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white pt-0 ripped-border fixed-top w-100">
  <a class="brand" href="<?php echo get_option("siteurl"); ?>">
    <?php
    $custom_logo_id = get_theme_mod('custom_logo');
    $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
    if (has_custom_logo()) {
      echo '<img src="' . esc_url($logo[0]) . '" alt="Logo" class="img-fluid">';
    } else {
      echo '<img src="' . get_stylesheet_directory_uri() . '/resources/img/header.png' . '" alt="Logo" class="img-fluid">';
    }
    ?>

  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
    <?php // pandago_nav('header'); ?>
    <?php
    $defaults = array(
      'theme_location' => 'header-nav',
      'menu' => '',
      'container' => '',
      'container_class' => '',
      'container_id' => '',
      'menu_class' => 'main_menu',
      'menu_id' => '',
      'echo' => true,
      'fallback_cb' => 'wp_page_menu',
      'before' => '',
      'after' => '',
      'link_before' => '',
      'link_after' => '',
      'items_wrap' => '<ul class="navbar-nav">%3$s</ul>',
      'depth' => 0,
      'walker' => ''
    );
    wp_nav_menu($defaults);
    ?>
  </div>
</nav>

<div class="site-content">