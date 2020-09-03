<?php

function pdg_template_block( $module, $sub_module, $setup, $render = true ) {
    if ( $render ) {
        set_query_var( 'block_setup', $setup );
        get_template_part( 'template-parts/blocks/' . $module . '/' . $sub_module . '/index' );
    } else {
        return array(
            'setup' => $setup,
            'path' => 'template-parts/blocks/' . $module . '/' . $sub_module . '/index'
        );
    }
}