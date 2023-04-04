<?php
/*
 * Search Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => __( 'Search', 'inspiry' ),
    'id'    => 'search-section',
    'desc'  => __( 'This section contains options related to property search.', 'inspiry' ),
    'fields'=> array(


        array(
            'id'       => 'inspiry_home_search_form_title',
            'type'     => 'text',
            'title'    => __( 'Search Form Title', 'inspiry' ),
            'default'  => __( 'Quick Search', 'inspiry' ),
        ),
        array(
            'id'      => 'inspiry_search_fields',
            'type'    => 'sorter',
            'title'   => __('Search Form Fields Manager', 'inspiry'),
            'options' => array(
                'enabled'  => array(
                    'keyword'           => __( 'Keyword', 'inspiry' ),
                    'location'          => __( 'Location', 'inspiry' ),
                    'status'            => __( 'Status', 'inspiry' ),
                ),
                'disabled' => array(
                    'type'              => __( 'Type', 'inspiry' ),
                    'min-beds'          => __( 'Min Beds', 'inspiry' ),
                    'min-baths'         => __( 'Min Baths', 'inspiry' ),
                    'min-max-price'     => __( 'Min Max Price', 'inspiry' ),
                    'min-max-area'      => __( 'Min Max Area', 'inspiry' ),
                    'property-id'       => __( 'Property ID', 'inspiry' ),
                ),
            )
        ),
        array(
            'id'       => 'inspiry_search_features',
            'type'     => 'switch',
            'title'    => __( 'Property Features in Search Form', 'inspiry' ),
            'desc'     => __( 'Property features will be displayed below other search form fields.', 'inspiry' ),
            'default'  => 0,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_search_locations_number',
            'type'     => 'select',
            'title'    => __( 'Number of Location Select Boxes', 'inspiry' ),
            'options'  => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
            ),
            'default'  => 1,
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_search_location_title_1',
            'type'     => 'text',
            'title'    => __( 'Title for 1st Location Select Box', 'inspiry' ),
            'default'  => __( 'Country', 'inspiry' ),
            'required' => array( 'inspiry_search_locations_number', '=', array( 1, 2, 3, 4 ) ),
        ),
        array(
            'id'       => 'inspiry_search_location_title_2',
            'type'     => 'text',
            'title'    => __( 'Title for 2nd Location Select Box', 'inspiry' ),
            'default'  => __( 'State', 'inspiry' ),
            'required' => array( 'inspiry_search_locations_number', '=', array( 2, 3, 4 ) ),
        ),
        array(
            'id'       => 'inspiry_search_location_title_3',
            'type'     => 'text',
            'title'    => __( 'Title for 3rd Location Select Box', 'inspiry' ),
            'default'  => __( 'City', 'inspiry' ),
            'required' => array( 'inspiry_search_locations_number', '=', array( 3, 4 ) ),
        ),
        array(
            'id'       => 'inspiry_search_location_title_4',
            'type'     => 'text',
            'title'    => __( 'Title for 4th Location Select Box', 'inspiry' ),
            'default'  => __( 'Area', 'inspiry' ),
            'required' => array( 'inspiry_search_locations_number', '=', array( 4 ) ),
        ),
        array(
            'id'           => 'inspiry_minimum_prices',
            'type'         => 'textarea',
            'title'        => __( 'Values for Minimum Prices Field', 'inspiry' ),
            'desc'         => __( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces or currency signs.', 'inspiry' ),
            'validate'     => 'no_html',
            'default'      => '1000, 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000',
        ),
        array(
            'id'           => 'inspiry_maximum_prices',
            'type'         => 'textarea',
            'title'        => __( 'Values for Maximum Prices Field', 'inspiry' ),
            'desc'         => __( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces or currency signs.', 'inspiry' ),
            'validate'     => 'no_html',
            'default'      => '5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1500000, 2000000, 2500000, 5000000, 10000000',
        ),
        array(
            'id'       => 'inspiry_search_page',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => __( 'Properties Search Page', 'inspiry' ),
            'subtitle' => __( 'Select a page for properties search results.', 'inspiry' ),
            'desc'     => __( 'Make sure the selected page is using Property Search template.', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_search_module_below_header',
            'type'     => 'button_set',
            'title'    => __( 'What to Display Below Header on Property Search Page', 'inspiry' ),
            'options'  => array(
                'banner'        => __( 'Image Banner', 'inspiry' ),
                'google-map'    => __( 'Google Map', 'inspiry' ),
            ),
            'default'  => 'google-map',
        ),
        array(
            'id'       => 'inspiry_search_properties_number',
            'type'     => 'select',
            'title'    => __( 'Number of Properties on Search Page', 'inspiry' ),
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
            'id'       => 'inspiry_search_layout',
            'type'     => 'select',
            'title'    => __( 'Search Page Layout', 'inspiry' ),
            'options'  => array(
                'list'     => __( 'List Layout - Full Width', 'inspiry' ),
                'grid'     => __( 'Grid Layout - Full Width', 'inspiry' ),
            ),
            'default'  => 'list',
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_search_order',
            'type'     => 'select',
            'title'    => __( 'Default Order of Search Results', 'inspiry' ),
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