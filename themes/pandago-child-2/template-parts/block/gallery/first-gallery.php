<?php
/* Photo gallery 1 Block Template */
$firstImg = get_field('img-1') ?: '' . get_stylesheet_directory_uri() . '/resources/img/sakumlapa/gallery/Zanda_1.jpg';
$secondImg = get_field('img-2') ?: '' . get_stylesheet_directory_uri() . '/resources/img/sakumlapa/gallery/Sibilla_4.jpg';
$thirdImg = get_field('img-3') ?: '' . get_stylesheet_directory_uri() . '/resources/img/sakumlapa/gallery/Brinuma_meita-15.jpg';
$fourthImg = get_field('img-4') ?: '' . get_stylesheet_directory_uri() . '/resources/img/sakumlapa/gallery/Alina_1.jpg';
$fifthImg = get_field('img-5') ?: '' . get_stylesheet_directory_uri() . '/resources/img/sakumlapa/gallery/Anda_2.jpg';
?>

<section class="gallery">
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