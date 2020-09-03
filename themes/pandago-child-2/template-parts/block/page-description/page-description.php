<?php
/* Page description Block Template */

$title = get_field('title') ?: 'Add title';
$text = get_field('text') ?: 'Add text';
$fontSize = get_field('font_size_select') ?: 'text-1';
$textBlockIsEnabled = get_field('enable_text_block') ?: 'yes';
?>

<section class="ideja position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 style="<?php if($textBlockIsEnabled != 'yes') echo 'margin-top: 4rem;' ?>"><?php echo $title ?></h1>
            </div>
            <?php if ($textBlockIsEnabled == 'yes') : ?>
                <div class="col-12 text-center">
                    <p class="<?php echo $fontSize ?>"><?php echo $text ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>