<?php if ( have_rows( 'social', 'option' ) ): ?>
  <ul class="social">
    <?php while ( have_rows( 'social', 'option' ) ): the_row(); ?>
      <?php if ( get_sub_field( 'url' ) && get_sub_field( 'icon' ) ): ?>
        <li>
          <a class="ic ic-<?php the_sub_field( 'icon' ); ?>" href="<?php the_sub_field( 'url' ); ?>" target="_blank" rel="nofollow"></a>
        </li>
      <?php endif; ?>
    <?php endwhile; ?>
  </ul>
<?php elseif ( have_rows( 'theme_social', 'option' ) ): ?>
  <ul class="social">
    <?php while ( have_rows( 'theme_social', 'option' ) ): the_row(); ?>
      <?php if ( get_sub_field( 'url' ) && get_sub_field( 'icon' ) ): ?>
        <li>
          <a class="ic ic-<?php the_sub_field( 'icon' ); ?>" href="<?php the_sub_field( 'url' ); ?>" target="_blank" rel="nofollow"></a>
        </li>
      <?php endif; ?>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>