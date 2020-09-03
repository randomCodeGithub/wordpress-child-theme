<article class="pdg-post-v1-open">

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
    <p class="date"><?php echo get_the_date( 'd.m.Y.', $id ); ?></p>
    <!-- /Date -->

    <!-- Title -->
    <h1 class="title pdg-h2"><?php the_title(); ?></h1>
    <!-- Title -->

    <!-- Post content -->
    <div class="post-content editor">
        <?php the_content(); ?>
    </div>
    <!-- /Post content -->

    <!-- Back button -->
    <div>
        <button class="btn btn-primary size-186 js-back"><?php _e( 'Atpakaļ', TD ); ?></button>
    </div>
    <!-- /Back button -->
</article>