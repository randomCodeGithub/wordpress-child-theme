<?php
/* Stories section Block Template */

$isBackgroundEnabled = get_field('is_background_image_enabled') ?: 'yes';
$backgroundImage = get_field('background_image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/iedvesmas-stasti/background.jpg';
$isPhotoNumberEnabled = get_field('is_photo_number_enabled') ?: 'yes';
$photoNumber = 1;
$photoTextColor = get_field('photo_number_color') ?: '#fff';

$playButton = get_field('play_button') ?: '' . get_stylesheet_directory_uri() . '/resources/img/Group 2.svg';
$replaceVideoLink = array("https://www.youtube.com/watch?v=", "https://youtu.be/", "https://www.youtube.com/embed/");
?>
<?php if (have_rows('stories_block')) : ?>
    <section class="stasti">
        <div class="container">
            <div class="row stasti-gallery text-center">
                <?php while (have_rows('stories_block')) : the_row(); ?>
                    <?php 
                    $videoLink = get_sub_field('video_link');
                    $image = get_sub_field('image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/iedvesmas-stasti/1.jpg';
                    $preview = get_sub_field('preview') ?: '' . get_stylesheet_directory_uri() . '/resources/img/Sparkle Video 1.png';
                    ?>
                    <div class="story-item col-6 col-md-3 col-lg-2">
                        <div class="background-img position-absolute"></div>
                        <img class="img-fluid" src="<?php echo $image ?>" alt="">
                        <h3 class="block-text"><?php echo the_sub_field('person_name') ?></h3>
                        <?php if ($isPhotoNumberEnabled == 'yes') : ?>
                            <p class="number"><?php echo $photoNumber ?></p>
                        <?php endif; ?>
                        <img id="story-img-data" src="<?php echo $preview ?>" style="display: none;" alt="">
                        <iframe id="story-video-data" style="display: none;" class="h-100 w-100" src="https://www.youtube.com/embed/<?php echo str_replace($replaceVideoLink, "", $videoLink); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <?php $photoNumber++ ?>

                <?php endwhile; ?>
            </div>
        </div>

        <div class="stories-overlay" style="display: none;">
            <span id="close-overlay" class="close-overlay position-absolute" style="right: 5%; top:2rem; cursor: pointer"><i class="fa fa-close" style="font-size:36px"></i></span>
            <div class="position-absolute preview stories-preview" style="width: 50%;">
                <img id="preview" src="" class="w-100 h-100" alt="Video">
                <div id="video" class="position-absolute story-video d-none w-100" style="z-index: -1; height: 400px">
                    <iframe id="story-video" class="h-100 w-100" src="https://www.youtube.com/embed/" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <img src="<?php echo $playButton ?>" alt="Play" class="position-absolute play-button">
            </div>
            <h3 id="item-text" class="block-text" style="opacity: 1;top: 90%"></h3>
        </div>

    </section>

<?php endif; ?>


<style type="text/css">
    .stasti-gallery .background-img {
        background-image: url(<?php echo $backgroundImage ?>);
        <?php if ($isBackgroundEnabled != 'yes') echo 'opacity: 0' ?>
    }

    .stories-preview,
    .story-video {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }


    .block-text {
        opacity: 0;
        transition: opacity .5s;
    }

    .stasti>.container>.row>.col-6:hover .block-text {
        opacity: 1;
    }

    .stasti>.container>.row>.col-6:hover .background-img {
        opacity: 1;
        transition: all 0.5s ease-in-out;
    }

    .number {
        color: <?php echo $photoTextColor ?>;
    }

    .stories-overlay {
        position: fixed;
        top: 0;
        background-color: rgb(47, 72, 88, 0.8);
        height: 100%;
        width: 100%;
        z-index: 9999;
        color: #fff;

    }

    .story-item {
        cursor: pointer;
    }
</style>