<?php
/*
 * Search Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => __( 'Archives', 'inspiry' ),
    'id'    => 'archives-section',
    'desc'  => __( 'This section contains options related property post type archive and taxonomy archives pages like property city, property status, property type and property feature.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_archive_module_below_header',
            'type'     => 'button_set',
            'title'    => __( 'What to Display Below Header on Archive Pages', 'inspiry' ),
            'options'  => array(
                'banner'        => __( 'Image Banner', 'inspiry' ),
                'google-map'    => __( 'Google Map', 'inspiry' ),
            ),
            'default'  => 'google-map',
        ),
        array(
            'id'       => 'inspiry_archive_properties_number',
            'type'     => 'select',
            'title'    => __( 'Number of Properties on an Archive Page', 'inspiry' ),
            'options'  => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
                6 => '6',
                7 => '7',
                8 => '8',
                9 => '9',
                10 => '10',
            ),
            'default'  => 6,
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_archive_layout',
            'type'     => 'select',
            'title'    => __( 'Archive Page Layout', 'inspiry' ),
            'options'  => array(
                'list'     => __( 'List Layout - Full Width', 'inspiry' ),
                'grid'     => __( 'Grid Layout - Full Width', 'inspiry' ),
            ),
            'default'  => 'list',
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_archive_order',
            'type'     => 'select',
            'title'    => __( 'Default Order of Properties on an Archive Page.', 'inspiry' ),
            'options'  => array(
                'price-asc'     => __( 'Sort by Price Low to High', 'inspiry' ),
                'price-desc'    => __( 'Sort by Price High to Low', 'inspiry' ),
                'date-asc'      => __( 'Sort by Date Old to New', 'inspiry' ),
                'date-desc'     => __( 'Sort by Date New to Old', 'inspiry' ),
            ),
            'default'  => 'date-desc',
            'select2'  => array( 'allowClear' => false ),
        ),

    ) ) );