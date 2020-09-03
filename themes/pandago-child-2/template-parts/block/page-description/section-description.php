<?php
/* Section description Block Template */

$title = get_field('title') ?: 'Add title';
$text = get_field('text') ?: 'Add text';
$fontSize = get_field('font_size_select') ?: 'text-1';
?>

<section class="mission-1">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <h2 style="line-height: 44px;"><?php echo $title ?></h2>
                    </div>
                    <div class="col-12">
                        <p class="<?php echo $fontSize ?>"><?php echo $text ?></p>
                    </div>
                </div>
            </div>
        </section>