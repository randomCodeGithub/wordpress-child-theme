<?php 
/* Section Text Block Template */

$sectionText = get_field('text') ?: 'Add text...'; 
?>

<section class="description">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <p class="text-2 d-block mx-auto text-center"> <?php echo $sectionText ?></p>
      </div>
    </div>
  </div>    
  </section>