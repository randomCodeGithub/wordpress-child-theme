<?php
/* Choice section 3 Block Template */
$isTitleEnabled = get_field('is_title_enabled') ?: 'yes';
$title = get_field('title') ?: 'Add Title';
?>

<?php if (have_rows('choice_block')) : ?>
    <section class="banka-choice">
        <div class="container">
            <?php if ($isTitleEnabled == 'yes') : ?>
                <div class="row text-center">
                    <div class="col-12">
                        <h2><?php echo $title ?></h2>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row justify-content-center no-gutters text-center">
                <?php while (have_rows('choice_block')) : the_row(); ?>
                <?php 
                    $image = get_sub_field('image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/piesaki_sapni/Group13.png';
                ?>
                    <div class="col-12 col-md-6">
                        <img src="<?php echo $image ?>" class="img-fluid" style="margin-bottom: 2.01rem;" alt="sound">
                        <p class="text-1 d-block mx-auto"><?php echo the_sub_field('text') ?></p>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </section>
<?php endif; ?>