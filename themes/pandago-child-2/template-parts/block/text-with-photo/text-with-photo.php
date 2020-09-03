<?php
/* Right text with photo Block Template */
$title = get_field('title') ?: 'Add title';
$text = get_field('text') ?: 'Add text';
$image = get_field('image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/sapnu_banka/sun.svg';
$isTitleEnabled = get_field('enable_title') ?: 'yes';
$textSide = get_field('text_side') ?: 'right';
?>

<section class="goal" style="<?php if ($isTitleEnabled != 'yes') echo 'margin-top: 0' ?>">
    <div class="container">
        <div class="row no-gutters <?php if ($textSide == 'left') echo 'flex-row-reverse' ?>" style="margin-bottom: 100px;">
            <?php if ($isTitleEnabled == 'yes') : ?>
                <div class="col-12 text-center">
                    <h2><?php echo $title ?></h2>
                </div>
            <?php endif; ?>
            <div class="col-12 col-md-5 <?php echo ($textSide == 'right') ? 'text-right' : 'text-left col-lg-6' ?>">
                <img src="<?php echo $image ?>" style=" <?php echo ($textSide == 'right') ? 'margin-right: 3.8rem;' : 'margin-left: 2.9rem;' ?>" alt="Sun">

            </div>
            <div class="col-12 col-md-7 <?php if ($textSide == 'left') echo 'col-lg-6' ?> d-flex align-items-center">
                <p class="my-0 text-2 <?php if ($textSide == 'left') echo 'text-right' ?>" style="width: 500px; <?php echo ($textSide == 'right') ? 'margin-left: 0.1rem;' : 'margin-left: 2.2rem;' ?>"><?php echo $text ?></p>
            </div>
        </div>
    </div>
</section>