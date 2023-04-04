<?php
/*
 * Header Options
 */
global $opt_name;
Redux::setSection( $opt_name, array (
    'title' => __('Property Detail', 'inspiry'),
    'id'    => 'property-detail-section',
    'desc'  => __('This section contains options for property detail page.', 'inspiry'),
    'fields'=> array (

        array(
            'id'       => 'inspiry_property_header_variation',
            'type'     => 'radio',
            'title'    => __( 'Property Header Design Variation', 'inspiry' ),
            'options'  => array(
                '1' => __( 'Variation One - Simple slider with basic information on right side of slider.', 'inspiry' ),
                '2' => __( 'Variation Two - Thumbnail slider with basic information below slider.', 'inspiry' ),
                '3' => __( 'Variation Three - Horizontally scrollable slider with basic information below slider.', 'inspiry' ),
            ),
            'default'  => '1',
        ),
		
		/*
		 * Breadcrumbs
		*/
		array(
            'id'       => 'inspiry_property_breadcrumbs',
            'type'     => 'switch',
            'title'    => __( 'Property Breadcrumbs', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
		
        /*
         * Description
         */
        array(
            'id'       => 'inspiry_property_description',
            'type'     => 'switch',
            'title'    => __( 'Property Description', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_desc_title',
            'type'      => 'text',
            'title'     => __( 'Description Title', 'inspiry' ),
            'default'   => __( 'Description', 'inspiry' ),
            'required' => array( 'inspiry_property_description', '=', 1 ),
        ),


        /*
         * Additional Details
         */
        array(
            'id'       => 'inspiry_property_details',
            'type'     => 'switch',
            'title'    => __( 'Property Additional Details', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_details_title',
            'type'      => 'text',
            'title'     => __( 'Additional Details Title', 'inspiry' ),
            'default'   => __( 'Additional Details', 'inspiry' ),
            'required' => array( 'inspiry_property_details', '=', 1 ),
        ),


        /*
         * Features
         */
        array(
            'id'       => 'inspiry_property_features',
            'type'     => 'switch',
            'title'    => __( 'Property Features', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_features_title',
            'type'      => 'text',
            'title'     => __( 'Features Title', 'inspiry' ),
            'default'   => __( 'Features', 'inspiry' ),
            'required' => array( 'inspiry_property_features', '=', 1 ),
        ),


        /*
         * Video
         */
        array(
            'id'       => 'inspiry_property_video',
            'type'     => 'switch',
            'title'    => __( 'Property Video', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_video_title',
            'type'      => 'text',
            'title'     => __( 'Video Title', 'inspiry' ),
            'default'   => __( 'Virtual Tour', 'inspiry' ),
            'required' => array( 'inspiry_property_video', '=', 1 ),
        ),


        /*
         * Map
         */
        array(
            'id'       => 'inspiry_property_map',
            'type'     => 'switch',
            'title'    => __( 'Property Map', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_map_title',
            'type'      => 'text',
            'title'     => __( 'Map Title', 'inspiry' ),
            'default'   => __( 'Location', 'inspiry' ),
            'required' => array( 'inspiry_property_map', '=', 1 ),
        ),


        /*
         * Attachments
         */
        array(
            'id'       => 'inspiry_property_attachments',
            'type'     => 'switch',
            'title'    => __( 'Property Attachments', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_attachments_title',
            'type'      => 'text',
            'title'     => __( 'Attachments Title', 'inspiry' ),
            'default'   => __( 'Attachments', 'inspiry' ),
            'required' => array( 'inspiry_property_attachments', '=', 1 ),
        ),


        /*
         * Share
         */
        array(
            'id'       => 'inspiry_property_share',
            'type'     => 'switch',
            'title'    => __( 'Share This Property', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_share_title',
            'type'      => 'text',
            'title'     => __( 'Share This Property Title', 'inspiry' ),
            'default'   => __( 'Share This Property', 'inspiry' ),
            'required' => array( 'inspiry_property_share', '=', 1 ),
        ),


        /*
         * Children Properties
         */
        array(
            'id'       => 'inspiry_children_properties',
            'type'     => 'switch',
            'title'    => __( 'Children Properties', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_property_children_title',
            'type'      => 'text',
            'title'     => __( 'Children Properties Title', 'inspiry' ),
            'default'   => __( 'Sub Properties', 'inspiry' ),
            'required' => array( 'inspiry_children_properties', '=', 1 ),
        ),


        /*
         * Property Comments
         */
        array(
            'id'       => 'inspiry_property_comments',
            'type'     => 'switch',
            'title'    => __( 'Property Comments', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),


        /*
         * Agent
         */
        array(
            'id'       => 'inspiry_property_agent',
            'type'     => 'switch',
            'title'    => __( 'Agent Information', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_agent_contact_form',
            'type'     => 'switch',
            'title'    => __( 'Agent Contact Form', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
            'required' => array( 'inspiry_property_agent', '=', 1 ),
        ),
        array(
            'id'        => 'inspiry_agent_contact_form_title',
            'type'      => 'text',
            'title'     => __( 'Agent Contact Form Title', 'inspiry' ),
            'default'   => __( 'Contact Agent', 'inspiry' ),
            'required' => array( 'inspiry_agent_contact_form', '=', 1 ),
        ),


        /*
         * Similar Properties
         */
        array(
            'id'       => 'inspiry_similar_properties',
            'type'     => 'switch',
            'title'    => __( 'Similar Properties', 'inspiry' ),
            'default'  => 1,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
        ),
        array(
            'id'        => 'inspiry_similar_properties_title',
            'type'      => 'text',
            'title'     => __( 'Similar Properties Title', 'inspiry' ),
            'default'   => __( 'Similar Properties', 'inspiry' ),
            'required' => array( 'inspiry_similar_properties', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_similar_properties_number',
            'type'     => 'select',
            'title'    => __( 'Maximum number of similar properties', 'inspiry' ),
            'options'  => array(
                1  => '1',
                2  => '2',
                3  => '3',
                4  => '4',
                5  => '5',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_similar_properties', '=', 1 ),
        ),
    )
) );
