<?php

$setup = get_query_var( 'block_setup' );

$options = array(
    'current_menu' => $setup[ 'current_menu' ],
    'block_title' => ( isset( $setup[ 'block_title' ] ) ) ? $setup[ 'block_title' ] : false
);


// Query sub pages for side menu
// $current_page = $post->ID;
// $current_index = ( $setup[ 'current_index' ] ) ? $setup[ 'current_index' ] : 0;

$sub_pages_args = array(
    'post_type' => 'page',
    'post_parent' => $setup[ 'root_page' ]
);

$sub_pages_query = new WP_Query( $sub_pages_args );

$menu = array();

if ( $sub_pages_query->have_posts() ) {
    $i = 1;

    while ( $sub_pages_query->have_posts() ) {
        $sub_pages_query->the_post();

        $menu[ $i ] = array(
            'title' => get_the_title(),
            'link' => get_permalink(),
            'current' => ( $setup[ 'current_menu' ] == $i ) ? true : false
        );

        $i++;
    }
    wp_reset_postdata();
}
?>

<section class="pdg-block pdg-block-content-with-sidebar">
    <div class="container">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-3 hide-md hide-sm hide-xs">

                <?php if ( $options[ 'block_title' ] ): ?>
                    <h2 class="block-title pdg-h2"><?php echo $options[ 'block_title' ]; ?></h2>
                <?php endif; ?>

                <?php if ( $menu ): ?>
                    <ul class="menu">
                        <?php foreach ( $menu as $item ): ?>
                            <li <?php if ( $item[ 'current' ] ): ?>class="current"<?php endif; ?>>
                                <a class="pdg-p" href="<?php echo $item[ 'link' ]; ?>"><?php echo $item[ 'title' ]; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <!-- /Sidebar -->

            <!-- Content -->
            <div class="col-lg-9">
                <?php
                if ( is_array( $setup[ 'content' ] ) ) {
                    set_query_var( 'block_setup', $setup[ 'content' ][ 'setup' ] );
                    get_template_part( $setup[ 'content' ][ 'path' ] );
                } else {
                    get_template_part( $setup[ 'content' ] );
                }
                ?>
            </div>
            <!-- /Content -->

        </div>
    </div>
</section>