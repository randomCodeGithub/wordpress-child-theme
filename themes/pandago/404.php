<?php get_header(); ?>

<div class="container text-center">
  <h1 class="error404-title c-primary">404</h1>
  <h2 class="error404-sub-title c-primary"><?php _e( 'Lapa netika atrasta!', PANDAGO_TD ); ?></h2>
  <p class="error404-message"><?php _e( 'Radusies kāda tehniska kļūda, vai arī šī lapa vairs nav pieejama.', PANDAGO_TD ); ?></p>
  <div class="error404-btn-wrap btn-wrap">
    <a class="btn btn-default" href="<?php echo home_url(); ?>">
      <span><?php _e( 'Uz sākumlapu', PANDAGO_TD ); ?></span>
    </a>
  </div>
</div>

<?php get_footer(); ?>