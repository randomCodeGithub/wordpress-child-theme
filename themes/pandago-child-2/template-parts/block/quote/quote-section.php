<?php
/* Quote section Block Template */

$quote = get_field('quote') ?: 'Add quote' ;
$image = get_field('image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/ideja/Juris.jpg' ;
?>

<section class="ideja-img position-relative d-flex align-items-end">
            <div class="container" style="margin-bottom: 5rem;">
                <div class="row">
                    <div class="col-12 mx-md-auto  col-md-11 col-lg-9">
                        <h3 class="text-white text-center"><?php echo $quote ?></h3>
                    </div>
                </div>
            </div>
        </section>

<style type="text/css">
    .ideja-img {
    background: linear-gradient( 360deg, rgba(47, 72, 88, 0.8) 18.63%, rgba(47, 72, 88, 0) 49.21% ), url(<?php echo $image ?>);
    background-repeat: no-repeat;
    background-size: cover;
    background-position-x: center;
}
</style>