<?php
/* Preview Block Template */
$image = get_field('image') ?: '' . get_stylesheet_directory_uri() . '/resources/img/Sparkle Video 1.png';
$isPlayButtonEnabled = get_field('is_play_button_enabled') ?: 'yes';
$playButton = get_field('play_button') ?: '' . get_stylesheet_directory_uri() . '/resources/img/Group 2.svg';
$videoLink = get_field('video_link') ?: 'OHjkg_rifTw';

$replaceVideoLink = array("https://www.youtube.com/watch?v=", "https://youtu.be/", "https://www.youtube.com/embed/");

?>
<div class="position-relative preview">
    <img id="preview" src="<?php echo $image ?>" class="w-100" alt="Video">
    <?php if ($isPlayButtonEnabled == 'yes') : ?>
        <div id="video" class="d-none w-100" style="top: 0; z-index: -1; height: 700px">
            <iframe class="h-100 w-100" src="https://www.youtube.com/embed/<?php echo str_replace($replaceVideoLink, "", $videoLink); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <img src="<?php echo $playButton ?>" alt="Play" class="position-absolute play-button">
    <?php endif; ?>
</div>