<?php
$setup = get_query_var( 'block_setup' );

$options = array(
    // Query options
    'post_type' => ( $setup[ 'post_type' ] ) ? $setup[ 'post_type' ] : 'post',
    'posts_per_page' => ( $setup[ 'posts_per_page' ] ) ? $setup[ 'posts_per_page' ] : -1,

    // Layout options
    'standalone' => ( isset( $setup[ 'standalone' ] ) ) ? $setup[ 'standalone' ] : true,
    'col_class' => ( $setup[ 'col_class' ] ) ? $setup[ 'col_class' ] : 'col-lg-4 col-md-6',
    'block_title' => ( $setup[ 'block_title' ] ) ? $setup[ 'block_title' ] : false,

    // Filters
    'filters' => array(
        'labels' => array(
            'from' => ( $setup[ 'filters' ][ 'labels' ][ 'from' ] ) ? $setup[ 'filters' ][ 'labels' ][ 'from' ] : __( 'No', PANDAGO_TD ),
            'to' => ( $setup[ 'filters' ][ 'labels' ][ 'to' ] ) ? $setup[ 'filters' ][ 'labels' ][ 'to' ] : __( 'Līdz', PANDAGO_TD ),
            'submit' => ( $setup[ 'filters' ][ 'labels' ][ 'submit' ] ) ? $setup[ 'filters' ][ 'labels' ][ 'submit' ] : __( 'Atlasīt', PANDAGO_TD ),
            'reset' => ( $setup[ 'filters' ][ 'labels' ][ 'reset' ] ) ? $setup[ 'filters' ][ 'labels' ][ 'reset' ] : __( 'Notīrīt', PANDAGO_TD ),
            'toggle' => ( $setup[ 'filters' ][ 'labels' ][ 'toggle' ] ) ? $setup[ 'filters' ][ 'labels' ][ 'toggle' ] : __( 'Atlasīt', PANDAGO_TD ),
        ),
        'classes' => array(
            'submit' => ( $setup[ 'filters' ][ 'classes' ][ 'submit' ] ) ? $setup[ 'filters' ][ 'classes' ][ 'submit' ] : 'btn btn-primary',
            'reset' => ( $setup[ 'filters' ][ 'classes' ][ 'reset' ] ) ? $setup[ 'filters' ][ 'classes' ][ 'reset' ] : 'btn btn-secondary',
            'toggle' => ( $setup[ 'filters' ][ 'classes' ][ 'toggle' ] ) ? $setup[ 'filters' ][ 'classes' ][ 'toggle' ] : 'btn btn-primary'
        )
    )
);

set_query_var( 'block_options', $options );

$args = array(
    'post_type' => $options[ 'post_type' ],
    'posts_per_page' => $options[ 'posts_per_page' ],
    'orderby' => 'date',
    'order' => 'DESC',
    'date_query' => array(
        'inclusive' => true
    )
);

// Filter by date
$date_from = $_POST[ 'date_from' ];
$date_to = $_POST[ 'date_to' ];

if ( isset( $date_from ) && $date_from ) {
    $date_from_split = explode( '.', $date_from );

    $args[ 'date_query' ][ 'after' ] = array(
        'year' => $date_from_split[ 2 ],
        'month' => $date_from_split[ 1 ],
        'day' => $date_from_split[ 0 ],
    );
}

if ( isset( $date_to ) && $date_to ) {
    $date_to_split = explode( '.', $date_to );

    $args[ 'date_query' ][ 'before' ] = array(
        'year' => $date_to_split[ 2 ],
        'month' => $date_to_split[ 1 ],
        'day' => $date_to_split[ 0 ],
    );
}

$query = new WP_Query( $args );
?>



<?php if ( $options[ 'standalone' ] ): ?>
    <section class="pdg-block pdg-block-news pdg-block-news-v3">
        <div class="container">
<?php else: ?>
    <div class="pdg-block pdg-block-news pdg-block-news-v3">
<?php endif; ?>

        <?php if ( $options[ 'block_title' ] ): ?>
            <h2 class="block-title pdg-h1"><?php echo $options[ 'block_title' ]; ?></h2>
        <?php endif; ?>

        <div class="filters">
            <div class="form-bg"></div>
            <div class="form-wrap">
                <form class="form" method="post">
                    <p class="form-legend"><?php echo $options[ 'filters' ][ 'labels' ][ 'toggle' ]; ?></p>
                    <div class="input-group">
                        <div class="single-input-wrap">
                            <div class="single-input">
                                <input class="input pdg-datepicker" type="text" name="date_from" placeholder="<?php echo $options[ 'filters' ][ 'labels' ][ 'from' ]; ?>" <?php if ( isset( $date_from ) && $date_from ): ?>value="<?php echo $date_from; ?>"<?php endif; ?>>
                                <span class="icon pdg-ic pdg-ic-calendar"></span>
                            </div>
                        </div>
                        <div class="single-input-wrap">
                            <div class="single-input">
                                <input class="input pdg-datepicker" type="text" name="date_to" placeholder="<?php echo $options[ 'filters' ][ 'labels' ][ 'to' ]; ?>" <?php if ( isset( $date_to ) && $date_to ): ?>value="<?php echo $date_to; ?>"<?php endif; ?>>
                                <span class="icon pdg-ic pdg-ic-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="controls">
                        <div>
                            <button class="<?php echo $options[ 'filters' ][ 'classes' ][ 'submit' ]; ?>" type="submit"><?php echo $options[ 'filters' ][ 'labels' ][ 'submit' ]; ?></button>
                        </div>
                        <div>
                            <button class="<?php echo $options[ 'filters' ][ 'classes' ][ 'reset' ]; ?> js-pdg-reset-form" type="reset"><?php echo $options[ 'filters' ][ 'labels' ][ 'reset' ]; ?></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="toggle">
                <button class="<?php echo $options[ 'filters' ][ 'classes' ][ 'toggle' ]; ?>"><?php echo $options[ 'filters' ][ 'labels' ][ 'toggle' ]; ?></button>
            </div>
        </div>

        <?php if ( $query->have_posts() ): ?>
            <div class="pdg-posts row">
                <?php
                $i = 0;
                while ( $query->have_posts() ):
                    $query->the_post();
                ?>
                    <div class="pdg-post-wrap <?php echo $options[ 'col_class' ]; ?> <?php if ( $i == 0 ): ?>first<?php endif; ?>">
                        <?php
                        get_template_part( 'template-parts/blocks/news/v3/post' );
                        ?>
                    </div>
                <?php
                    $i++;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>

        <?php if ( $options[ 'button' ][ 'enabled' ] ): ?>
            <div class="text-center">
                <a class="<?php echo $options[ 'button' ][ 'class' ]; ?>" href="#"><?php echo $options[ 'button' ][ 'title' ]; ?></a>
            </div>
        <?php endif; ?>

        <?php
        if ( $options[ 'pager' ] ) {
            pandago_pager( $query, array(
                'prev' => '<span class="pdg-ic pdg-ic-caret-left"></span>',
                'next' => '<span class="pdg-ic pdg-ic-caret-right"></span>'
            ) );
        }
        ?>

<?php if ( $options[ 'standalone' ] ): ?>
        </div>
    </section>
<?php else: ?>
    </div>
<?php endif; ?>