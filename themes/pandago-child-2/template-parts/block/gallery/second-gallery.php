<?php
/* Photo gallery 2 Block Template */
$firstImg = get_field('img-1') ?: '' . get_stylesheet_directory_uri() . '/resources/img/piesaki_sapni/gallery/Lauma_4.jpg';
$secondImg = get_field('img-2') ?: '' . get_stylesheet_directory_uri() . '/resources/img/piesaki_sapni/gallery/Brinuma_meita-3.jpg';
$thirdImg = get_field('img-3') ?: '' . get_stylesheet_directory_uri() . '/resources/img/piesaki_sapni/gallery/Arta_2.jpg';
$fourthImg = get_field('img-4') ?: '' . get_stylesheet_directory_uri() . '/resources/img/piesaki_sapni/gallery/Lauma_3.jpg';
$fifthImg = get_field('img-5') ?: '' . get_stylesheet_directory_uri() . '/resources/img/piesaki_sapni/gallery/Brinuma_meita-2.jpg';
?>

<section class="gallery-2">
      <div class="gallery-container">
        <div class="item1">
          <img src="<?php echo $firstImg ?>" alt="">
        </div>
        <div class="item2">
          <img src="<?php echo $secondImg ?>" alt="">
        </div>
        <div class="item3">
          <img src="<?php echo $thirdImg ?>" alt="">
        </div>
        <div class="item4">
          <img src="<?php echo $fourthImg ?>" alt="">
        </div>
        <div class="item5">
          <img src="<?php echo $fifthImg ?>" alt="">
        </div>
      </div>
    </section>