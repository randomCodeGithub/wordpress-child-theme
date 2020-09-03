<?php get_header(); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ): the_post(); ?>
          <h1 class="page-title h1"><?php the_title(); ?></h1>
          <div class="editor"><?php the_content(); ?></div>
          <p><?php _e( 'Autors:', TD ); ?> <?php the_author(); ?></p>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
    <div class="col-lg-3 offset-lg-1"><?php get_sidebar(); ?></div>
  </div>
</div>

<?php get_footer(); ?>