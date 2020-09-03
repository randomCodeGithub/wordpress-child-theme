<?php $id = get_the_ID(); ?>

<article class="pdg-post-v3">

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

    <a class="post-overlay" href="<?php the_permalink(); ?>"></a>
</article>