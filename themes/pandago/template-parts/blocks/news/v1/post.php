<?php
$id = get_the_ID();
?>
<article class="pdg-post-v1">

    <!-- Category -->
    <?php
    /*
     * Change to any other taxonomy
     * to suit your needs.
     */
    $terms = get_the_terms( $id, 'category' );
    ?>
    <?php if ( ! is_wp_error( $terms ) && $terms ): ?>
        <ul class="terms">
            <?php foreach ( $terms as $term ): ?>
                <li>
                    <a href="<?php echo get_term_link( $term->term_id ); ?>"><?php echo $term->name; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <!-- /Category -->

    <!-- Date -->
    <p class="date pdg-p"><?php echo get_the_date( 'd.m.Y.', $id ); ?></p>
    <!-- /Date -->

    <!-- Title -->
    <h3 class="title pdg-h2"><?php the_title(); ?></h3>
    <!-- /Title -->

    <!-- Excerpt -->
    <p class="excerpt pdg-p"><?php echo pdg_get_words( get_the_content(), 12, '...' ); ?></p>
    <!-- /Excerpt -->

    <!-- Read more -->
    <p class="read-more pdg-p">
        <span>
            <?php _e( 'Lasīt vairāk', TD ); ?>
            <span class="pdg-ic pdg-ic-arrow-right"></span>
        </span>
    </p>
    <!-- /Read more -->

    <a class="post-overlay" href="<?php the_permalink(); ?>"></a>
</article>