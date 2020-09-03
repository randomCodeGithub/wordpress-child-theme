<?php
/* Quote section 2 Block Template */

$author = get_field('author') ?: 'Add author' ;
$authorDescription = get_field('author_description') ?: 'Add author description' ;
$quote = get_field('quote') ?: 'Add quote' ;

?>

<section class="quote">
            <div class="container mb-5">
                <div class="row">
                    <div class="col-12 col-lg-7 mx-lg-auto">
                        <h3><?php echo $author ?></h3>
                        <p class="text-2"><?php echo $authorDescription ?></p>
                        <p class="text-1"><?php echo $quote ?></p>

                        <div class="d-flex mt-4">
                            <div class="prev"></div>
                            <div class="next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>