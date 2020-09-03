<?php
/* Choice section Block Template */

$buttonTextColor = get_field('button_text_color') ?: '#fff';
$buttonColor = get_field('button_color') ?: '#ffa800';
?>

<?php if (have_rows('choice_block')) : ?>
  <section class="choice">
    <div class="container">
      <div class="row justify-content-center flex-md-row-reverse flex-lg-row text-center">
        <?php while (have_rows('choice_block')) : the_row(); ?>
          <div class="col-12 col-md-6">
            <p><?php echo the_sub_field('title') ?></p>
            <br>
            <a href="<?php echo the_sub_field('button_link') ?>" class="rounded-pill text-2"><?php echo the_sub_field('button_text') ?></a>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
<?php endif; ?>

<style type="text/css">
  .choice a {
    background-color: <?php echo $buttonColor; ?> !important;
    color: <?php echo $buttonTextColor; ?> !important;
  }
</style>