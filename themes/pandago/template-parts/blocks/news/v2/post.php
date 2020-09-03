<?php
$id = get_the_ID();
?>
<article class="pdg-post-v2">

    <?php if ( has_post_thumbnail() ): ?>
        <div class="post-thumbnail-wrap">
            <figure class="post-thumbnail js-lazy" data-src="<?php echo get_media_url( get_post_thumbnail_id() ); ?>"></figure>
        </div>
    <?php endif; ?>

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
            <span class="pdg-ic pdg-ic-caret-right"></span>
        </span>
    </p>
    <!-- /Read more -->

    <a class="post-overlay" href="<?php the_permalink(); ?>"></a>
</article>