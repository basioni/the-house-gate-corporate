<?php
/*
 * Footer Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => __( 'Property Card', 'inspiry' ),
    'id'    => 'property-card-section',
    'desc'  => __( 'This section contains options for property card displayed in various pages across the theme.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_property_card_gallery',
            'type'     => 'switch',
            'title'    => __( 'Display images gallery for property card in list and grid layout', 'inspiry' ),
            'subtitle' => __( 'This option has performance implications.', 'inspiry' ),
            'default'  => 0,
            'on'       => 'Enabled',
            'off'      => 'Disabled',
        ),
        array(
            'id'       => 'inspiry_property_card_gallery_limit',
            'type'     => 'select',
            'title'    => __( 'Maximum number of images allowed in property card gallery.', 'inspiry' ),
            'options'  => array(
                1  => '1',
                2  => '2',
                3  => '3',
                4  => '4',
                5  => '5',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_property_card_gallery', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_property_card_desc_title',
            'type'      => 'text',
            'title'     => __( 'Description title for property card in list layout', 'inspiry' ),
            'default'   => __( 'Description', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_card_price_title',
            'type'      => 'text',
            'title'     => __( 'Price title for property card in list layout', 'inspiry' ),
            'default'   => __( 'Price', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_card_button_text',
            'type'      => 'text',
            'title'     => __( 'Button text for property card in list layout', 'inspiry' ),
            'default'   => __( 'Show Details', 'inspiry' ),
        ),

    ) ) );