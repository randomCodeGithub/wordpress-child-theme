<?php
/* Team gallery section Block Template */

$isNameEnabled = get_field('is_name_enabled') ?: 'yes';
$isPositionEnabled = get_field('is_position_enabled') ?: 'yes';
$nameColor = get_field('name_color') ?: '#fff';
$positionColor = get_field('position_color') ?: '#fff';
$isShadowEnabled = get_field('is_shadow_enabled') ?: 'yes';
$shadowColor = get_field('shadow_color') ?: 'rgba(47, 72, 88)';
?>
<?php if (have_rows('team_member')) : ?>
    <section class="team-gallery">
        <div class="container">
            <div class="row text-center team">

                <?php while (have_rows('team_member')) : the_row(); ?>
                    <?php
                    $image = get_sub_field('image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/iedvesmas-stasti/9877fbc1-1605-4322-9e06-f90dba39e238.jpg';
                    ?>
                    <div class="col-12 col-md-7 col-lg-4">
                        <div class="background-img position-absolute"></div>
                        <img src="<?php echo $image ?>" class="img-fluid" alt="Juris Gogulis">

                        <p class="text-1">
                            <?php if ($isNameEnabled == 'yes') : ?>
                                <span class="text-1"><?php echo the_sub_field('name') ?></span>
                            <?php endif; ?>
                            <?php if ($isPositionEnabled == 'yes') : ?>
                                <span class="text-2 d-block"><?php echo the_sub_field('position') ?></span>
                        </p>
                    <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<style type="text/css">
    .team p>span:first-child {
        color: <?php echo $nameColor ?> !important;
    }

    .team p>span:last-child {
        color: <?php echo $positionColor ?> !important;
    }

    .team .background-img {
        background: linear-gradient(180deg, <?php echo $shadowColor ?> 18.63%, rgba(47, 72, 88, 0) 49.21%);
        <?php echo ($isShadowEnabled != 'yes') ? 'opacity: 0' : 'opacity: 0.8' ?>
    }
</style>