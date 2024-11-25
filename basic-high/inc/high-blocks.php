<?php

if ( function_exists( 'register_block_style' ) ) {
    register_block_style(
        'core/buttons',
        array(
            'name'         => 'high-button',
            'label'        => __( 'High Button', 'basic-high' ),
            'is_default'   => true,
            'inline_style' => '.wp-block-button.is-style-high-button { padding: 5px 12px; color: #5bb75a;, border: 2px solid #5bb75a; }',
        )
    );
}



function wpdocs_register_block_patterns() {
        register_block_pattern(
            'wpdocs/my-example',
            array(
                'title'         => __( 'My First Block Pattern', 'basic-high' ),
                'description'   => _x( 'This is my first block pattern', 'Block pattern description', 'basic-high' ),
                'content'       => '<!-- wp:paragraph --><p>A single paragraph block style</p><!-- /wp:paragraph -->',
                'categories'    => array( 'text' ),
                'keywords'      => array( 'cta', 'demo', 'example' ),
                'viewportWidth' => 800,
            )
        );
}
add_action( 'init', 'wpdocs_register_block_patterns' );