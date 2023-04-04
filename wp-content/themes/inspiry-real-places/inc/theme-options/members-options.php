<?php
/*
 * Members Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => __( 'Members', 'inspiry' ),
    'id'    => 'memebers-section',
    'desc'  => __( 'This section contains options related to registered users.', 'inspiry' ),
    'fields'=> array(

        array(
            'id'       => 'inspiry_header_user_nav',
            'type'     => 'switch',
            'title'    => __( 'User Navigation in Header', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),

        array(
            'id'       => 'inspiry_restricted_level',
            'type'     => 'radio',
            'title'    => __( 'Restrict Admin Access', 'inspiry' ),
            "desc"     => __( 'Restrict admin access to any user level equal to or below the selected user level.', 'inspiry' ),
            'options'  => array(
                '0' => __( 'Subscriber ( Level 0 )', 'inspiry' ),
                '1' => __( 'Contributor ( Level 1 )', 'inspiry' ),
                '2' => __( 'Author ( Level 2 )', 'inspiry' ),
                // '7' => __( 'Editor ( Level 7 )', 'inspiry' ),
            ),
            'default'  => '0',
        ),

        /*
         * Profile Page
         */
        array(
            'id'       => 'inspiry_edit_profile_page',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => __( 'Edit Profile Page', 'inspiry' ),
            'desc'     => __( 'Make sure the selected page is using Edit Profile template.', 'inspiry' ),
        ),


        /*
         * Favorites Page
         */
        array(
            'id'       => 'inspiry_favorites_page',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => __( 'Favorites Page', 'inspiry' ),
            'subtitle' => __( 'Select a page to display favorite properties.', 'inspiry' ),
            'desc'     => __( 'Make sure the selected page is using Favorites template.', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_favorites_properties_number',
            'type'     => 'select',
            'title'    => __( 'Number of Properties on Favorites Page', 'inspiry' ),
            'options'  => array(
                3 => '3',
                6 => '6',
                9 => '9',
                12 => '12',
                15 => '15',
            ),
            'default'  => 6,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_favorites_page', '>', 0 )
        ),


        /*
         * Properties Page
         */
        array(
            'id'       => 'inspiry_my_properties_page',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => __( 'My Properties Page', 'inspiry' ),
            'desc'     => __( 'Make sure the selected page is using My Properties template.', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_my_properties_number',
            'type'     => 'select',
            'title'    => __( 'Number of Properties on My Properties Page', 'inspiry' ),
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
            'default'  => 5,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_my_properties_page', '>', 0 )
        ),


        /*
         * Submit Property
         */
        array(
            'id'       => 'inspiry_submit_property_page',
            'type'     => 'select',
            'data'     => 'pages',
            'title'    => __( 'Submit Property Page', 'inspiry' ),
            'desc'     => __( 'Make sure the selected page is using Submit Property template.', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_default_submit_status',
            'type'     => 'button_set',
            'title'    => __( 'Default Status of Submitted Property', 'inspiry' ),
            'options'  => array(
                'pending' => __( 'Pending for Review', 'inspiry' ),
                'publish' => __( 'Publish', 'inspiry' ),
            ),
            'default'  => 'pending',
            'required' => array( 'inspiry_submit_property_page', '>', 0 )
        ),
        array(
            'id'       => 'inspiry_submit_address',
            'type'     => 'text',
            'title'    => __( 'Default Address for Property Submit Form', 'inspiry' ),
            'default'  => '15421 Southwest 39th Terrace, Miami, FL 33185, USA',
            'required' => array( 'inspiry_submit_property_page', '>', 0 )
        ),
        array(
            'id'       => 'inspiry_submit_location_coordinates',
            'type'     => 'text',
            'title'    => __( 'Default Location Coordinates for Property Submit Map', 'inspiry' ),
            'desc'     => sprintf ( 'You can use <a href="%1$s" target="_blank">latlong.net</a> or <a href="%2$s" target="_blank">itouchmap.com</a> to get Latitude and longitude of your desired location.', esc_url( 'http://www.latlong.net/' ), esc_url( 'http://itouchmap.com/latlong.html' ) ),
            'default'  => '25.7308309,-80.44414899999998',
            'required' => array( 'inspiry_submit_property_page', '>', 0 )
        ),
        array(
            'id'       => 'inspiry_submit_notice_email',
            'type'     => 'text',
            'title'    => __( 'Email for Property Submit Notice', 'inspiry' ),
            'desc'     => __( 'This email address will receive a notice whenever a user submits a property.', 'inspiry' ),
            'validate' => 'email',
            'required' => array( 'inspiry_submit_property_page', '>', 0 )
        ),
        array(
            'id'       => 'inspiry_submit_message_to_reviewer',
            'type'     => 'switch',
            'title'    => __( 'Message for Reviewer on Property Submit Form', 'inspiry' ),
            'default'  => 0,
            'on'       => __('Enabled', 'inspiry'),
            'off'      => __('Disabled', 'inspiry'),
            'required' => array(
                array( 'inspiry_submit_property_page', '>', 0 ),
                array( 'inspiry_submit_notice_email', '!=', '' ),
            ),
        ),

    ) ) );