<?php
/* Photo & text section Block Template */

$text = get_field('text') ?: 'Add text';
$image = get_field('image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/sapnu_banka/Group.svg';
?>

<section class="d-lg-flex align-items-center mission-2">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        <img src="<?php echo $image ?>" class="img-fluid" alt="">

                    </div>
                    <div class="col-12 col-md-11 mx-md-auto col-lg-9">
                        <p class="text-1"><?php echo $text ?></p>
                    </div>
                </div>
            </div>
        </section>

