<?php
/* Choice section 2 Block Template */
$buttonTextColor = get_field('button_text_color') ?: '#fff';
$buttonColor = get_field('button_color') ?: '#ffa800';
?>

<?php if (have_rows('choice_block')) : ?>
  <section class="sapnis-choice">
    <div class="container">
      <div class="row text-center justify-content-center">

        <?php while (have_rows('choice_block')) : the_row(); ?>
          <?php
          $image = get_sub_field('image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/piesaki_sapni/Group13.png';
          ?>
          <div class="col-12 col-lg-6 position-relative" style="height: 604px;">
            <img src="<?php echo $image ?>" alt="piesaku sapnis">
            <h2><?php echo the_sub_field('title') ?></h2>
            <p style="width: 394px;" class="text-2 d-block mx-auto"><?php echo the_sub_field('text') ?></p>
            <a href="<?php echo the_sub_field('link') ?>" class="rounded-pill position-absolute text-2" style="top: 90%; left: 50%; transform: translateX(-50%);"><?php echo the_sub_field('button_text') ?></a>
          </div>
        <?php endwhile; ?>

      </div>
    </div>
  </section>
<?php endif; ?>

<style type="text/css">
  .sapnis-choice a {
    background-color: <?php echo $buttonColor; ?> !important;
    color: <?php echo $buttonTextColor; ?> !important;
  }
</style>