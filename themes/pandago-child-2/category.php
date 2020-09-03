<?php get_header(); ?>

<div class="page-layout-container container">
  <div class="page-layout-row row">
    <div class="col-lg-2">
      <div class="sidebar-left">
      <?php
      $args = array(
        'child_of' => 5,
        'hide_empty' => false
      );
      $categories = get_categories( $args );

      if ( $categories ):
      ?>
        <ul>
          <?php foreach ( $categories as $category ): ?>
            <li>
              <a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
              <?php
              $args = array(
                'posts_per_page' => -1,
                'category__in' => $category->term_id
              );
              $query = new WP_Query( $args );

              if ( $query->have_posts() ):
              ?>
                <ul>
                  <?php while ( $query->have_posts() ): $query->the_post(); ?>
                    <li>
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                  <?php endwhile; wp_reset_postdata(); ?>
                </ul>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      </div>
    </div>
    <div class="col-lg-6">
    </div>
    <div class="col-lg-3 offset-lg-1">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>