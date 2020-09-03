<?php
/**
 * Options
 * 
 * Query:
 * post_type      - Post type to show
 * posts_per_page - How many posts are displayed
 * 
 * Layout:
 * standalone  - Whether to wrap block inside section and container
 * col_class   - Column class for each post
 * block_title - Text shown above grid
 * 
 * Terms:
 * terms
 *   show_all - Text to display on "all" button. If not specified, button will not be included
 *     text - Text shown on button
 *     link - Button link
 *   taxonomy - Taxonomy from which terms will be displayed
 *   current  - Current taxonomy term to filter out posts
 *
 * Button:
 * button
 *   text  - Text shown on button
 *   link  - Button link
 *   class - Button classes
 * 
 * Pager:
 * pager - Whether to enable pager
 */
$setup = get_query_var( 'block_setup' );

$options = array(
    // Query options
    'post_type' => ( $setup[ 'post_type' ] ) ? $setup[ 'post_type' ] : 'post',
    'posts_per_page' => ( $setup[ 'posts_per_page' ] ) ? $setup[ 'posts_per_page' ] : -1,

    // Layout options
    'standalone' => ( isset( $setup[ 'standalone' ] ) ) ? $setup[ 'standalone' ] : true,
    'col_class' => ( $setup[ 'col_class' ] ) ? $setup[ 'col_class' ] : 'col-lg-3 col-md-6',
    'block_title' => ( $setup[ 'block_title' ] ) ? $setup[ 'block_title' ] : false,

    // Terms
    'terms' => array(
        'enabled' => ( isset( $setup[ 'terms' ] ) ) ? true : false,
        'show_all' => array(
            'enabled' => ( isset( $setup[ 'terms' ][ 'show_all' ] ) ) ? true : false,
            'text' => ( $setup[ 'terms' ][ 'show_all' ][ 'text' ] ) ? $setup[ 'terms' ][ 'show_all' ][ 'text' ] : false,
            'link' => ( $setup[ 'terms' ][ 'show_all' ][ 'link' ] ) ? $setup[ 'terms' ][ 'show_all' ][ 'link' ] : '#'
        ),
        'hide_empty' => ( isset( $setup[ 'terms' ][ 'hide_empty' ] ) ) ? $setup[ 'terms' ][ 'hide_empty' ] : true,
        'taxonomy' => ( $setup[ 'terms' ][ 'taxonomy' ] ) ? $setup[ 'terms' ][ 'taxonomy' ] : false,
        'current' => ( $setup[ 'terms' ][ 'current' ] ) ? $setup[ 'terms' ][ 'current' ] : false
    ),

    // Button
    'button' => array(
        'enabled' => ( $setup[ 'button' ] ) ? true : false,
        'text' => ( $setup[ 'button' ][ 'text' ] ) ? $setup[ 'button' ][ 'text' ] : __( 'Visi jaunumi', PANDAGO_TD ),
        'link' => ( $setup[ 'button' ][ 'link' ] ) ? $setup[ 'button' ][ 'link' ] : '#',
        'class' => ( $setup[ 'button' ][ 'class' ] ) ? $setup[ 'button' ][ 'class' ] : 'btn btn-primary'
    ),

    // Pager
    'pager' => ( $setup[ 'pager' ] ) ? true : false
);

set_query_var( 'block_options', $options );

$args = array(
    'post_type' => $options[ 'post_type' ],
    'posts_per_page' => $options[ 'posts_per_page' ]
);

if ( $options[ 'terms' ][ 'current' ] && $options[ 'terms' ][ 'taxonomy' ] ) {
    $args[ 'tax_query' ] = array(
        array(
            'taxonomy' => $options[ 'terms' ][ 'taxonomy' ],
            'field' => 'term_id',
            'terms' => $options[ 'terms' ][ 'current' ]
        )
    );
}

if ( $options[ 'pager' ] ) {
    $args[ 'paged' ] = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
}

$query = new WP_Query( $args );
?>

<?php if ( $query->have_posts() ): ?>

    <?php if ( $options[ 'standalone' ] ): ?>
        <section class="pdg-block pdg-block-news pdg-block-news-v1" data-same-height="title,excerpt">
            <div class="container">
    <?php else: ?>
        <div class="pdg-block pdg-block-news pdg-block-news-v1" data-same-height="title,excerpt">
    <?php endif; ?>

            <?php if ( $options[ 'block_title' ] ): ?>
                <h2 class="block-title pdg-h1"><?php echo $options[ 'block_title' ]; ?></h2>
            <?php endif; ?>

            <?php if ( $options[ 'terms' ][ 'enabled' ] ): ?>
                <?php
                $terms = get_terms( array(
                    'taxonomy' => $options[ 'terms' ][ 'taxonomy' ],
                    'hide_empty' => $options[ 'terms' ][ 'hide_empty' ]
                ) );
                $current_term = get_queried_object()->term_id;
                ?>
                <?php if ( ! is_wp_error( $terms ) && $terms ): ?>
                    <ul class="block-terms terms">
                        <?php if ( $options[ 'terms' ][ 'show_all' ][ 'enabled' ] ): ?>
                            <li <?php if ( ! $current_term ): ?>class="current"<?php endif; ?>>
                                <a href="<?php echo $options[ 'terms' ][ 'show_all' ][ 'link' ]; ?>"><?php echo $options[ 'terms' ][ 'show_all' ][ 'text' ]; ?></a>
                            </li>
                        <?php endif; ?>
                        <?php foreach ( $terms as $term ): ?>
                            <li <?php if ( $current_term && $current_term == $term->term_id ): ?>class="current"<?php endif; ?>>
                                <a href="<?php echo get_term_link( $term->term_id ); ?>"><?php echo $term->name; ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>

            <div class="pdg-posts row">
                <?php
                $i = 0;
                while ( $query->have_posts() ):
                    $query->the_post();
                ?>
                    <div class="pdg-post-wrap <?php echo $options[ 'col_class' ]; ?> <?php if ( $i == 0 ): ?>first<?php endif; ?>">
                        <?php
                        get_template_part( 'template-parts/blocks/news/v1/post' );
                        ?>
                    </div>
                <?php
                    $i++;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

            <?php if ( $options[ 'button' ][ 'enabled' ] ): ?>
                <div class="text-center">
                    <a class="<?php echo $options[ 'button' ][ 'class' ]; ?>" href="#"><?php echo $options[ 'button' ][ 'text' ]; ?></a>
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

<?php endif; ?>