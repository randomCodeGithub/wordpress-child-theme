<?php
/* Supporters section Block Template */
$headerText = get_field('header_text') ?: 'Add header text...';
?>

<?php if (have_rows('supporter')) : ?>
  <section class="supporters d-lg-flex align-items-center">
    <div class="container" style="padding: 3rem 0;">
      <div class="row" style="margin-bottom: 52px;">
        <div class="col-12 text-center">
          <h3><?php echo $headerText ?></h3>
        </div>
      </div>
        <div class="row justify-content-center">      
      <?php while (have_rows('supporter')) : the_row(); ?>
      <?php
          $image = get_sub_field('image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/sakumlapa/supporters/sem_logo.png';
          ?>
          <div class="col-6 col-md-3 d-md-flex align-items-center mb-3">
            <img src="<?php echo $image ?>" class="img-fluid mx-lg-auto" alt="">
          </div>


      <?php endwhile; ?>
        </div>      
    </div>
  </section>
<?php endif; ?>