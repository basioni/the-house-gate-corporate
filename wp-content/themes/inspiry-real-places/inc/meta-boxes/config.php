<?php
/**
 * Meta box configuration file.
 */

if( !function_exists( 'inspiry_register_meta_boxes' ) ) {
    /**
     * Register meta boxes for this theme
     *
     * @param $meta_boxes
     * @return array
     * @since 1.0.0
     */
    function inspiry_register_meta_boxes ( $meta_boxes ) {

        $prefix = 'REAL_HOMES_';
        $admin_email = get_option('admin_email');


        /*
         * INDEX
         * 1. Video Gallery
         * 2. Post Gallery
         * 3. Contact Page
         * 4. Pages Banner
         * 5. Homepage Banner
         * 6. Properties Filter
         */


        /*
         * Video embed code meta box for video post format
         */
        $meta_boxes[] = array(
            'id'        => 'video-meta-box',
            'title'     => __( 'Video Embed Code', 'inspiry' ),
            'pages'     => array( 'post' ),
            'context'   => 'normal',
            'priority'  => 'high',
            'show'   => array(
                'post_format' => array( 'video' ), // List of post formats. Array. Case insensitive. Optional.
            ),
            'fields'    => array(
                array(
                    'name'  => __( 'Video Embed Code', 'inspiry' ),
                    'desc'  => __( 'If you are not using self hosted videos then please provide the video embed code and remove the width and height attributes.', 'inspiry' ),
                    'id'    => "{$prefix}embed_code",
                    'type'  => 'textarea',
                    'cols'  => '20',
                    'rows'  => '3'
                )
            )
        );


        /*
         * Gallery Meta Box
         */
        $meta_boxes[] = array(
            'id'        => 'gallery-meta-box',
            'title'     => __( 'Gallery Images', 'inspiry'),
            'pages'     => array( 'post' ),
            'context'   => 'normal',
            'priority'  => 'high',
            'show'   => array(
                'post_format' => array( 'gallery' ), // List of post formats. Array. Case insensitive. Optional.
            ),
            'fields'    => array(
                array(
                    'name'  => __( 'Upload Gallery Images', 'inspiry' ),
                    'id'    => "{$prefix}gallery",
                    'desc'  => __( 'Images should have minimum width of 850px and minimum height of 567px, Bigger size images will be cropped automatically.', 'inspiry' ),
                    'type'  => 'image_advanced',
                    'max_file_uploads' => 48
                )
            )
        );

        /*
         * Contact Meta Box
         */
        $meta_boxes[] = array(
            'id'        => 'contact-meta-box',
            'title'     => __( 'Contact Page Information', 'inspiry'),
            'pages'     => array( 'page' ),
            'context'   => 'normal',
            'priority'  => 'high',
            'tabs'      => array(
                'google-map'  => array(
                    'label' => __( 'Google Map', 'inspiry' ),
                    'icon'  => 'dashicons-location',
                ),
                'contact-details'  => array(
                    'label' => __( 'Contact Details', 'inspiry' ),
                    'icon'  => 'dashicons-phone',
                ),
                'contact-form' => array(
                    'label' => __( 'Contact Form', 'inspiry' ),
                    'icon'  => 'dashicons-email',
                ),
            ),
            // Tab style: 'default', 'box' or 'left'. Optional
            'tab_style' => 'left',
            'show'   => array(
                // List of page templates (used for page only). Array. Optional.
                'template'    => array( 'page-templates/contact.php' ),
            ),
            'fields'    => array(
                array(
                    'id'    => "inspiry_map_address",
                    'name'  => __( 'Office Address', 'inspiry' ),
                    'desc'  => __( 'Leaving it empty will hide the google map.', 'inspiry'),
                    'type'  => 'text',
                    'std'   => '121 King St, Melbourne VIC 3000, Australia',
                    'tab'   => 'google-map',
                    'size'  => 50,
                ),
                array(
                    'id'    => "inspiry_map_location",
                    'name'  => __( 'Office Location', 'inspiry' ),
                    'desc'  => __( 'Drag the marker to point your office location. You can also use the address field above to search for your address.', 'inspiry' ),
                    'type'  => 'map',
                    'std'   => '-37.817314,144.955431',         // 'latitude,longitude[,zoom]' (zoom is optional)
                    'style' => 'width: 95%; height: 400px',
                    'address_field' => "inspiry_map_address",
                    'tab'   => 'google-map',
                ),
                array(
                    'id'   => 'inspiry_map_zoom',
                    'type' => 'slider',
                    'name' => __( 'Map Zoom Level', 'inspiry' ),
                    'desc' => __( 'Zoom level for resulted map on contact page.', 'inspiry'),
                    // jQuery UI slider options. See here http://api.jqueryui.com/slider/
                    'js_options' => array(
                        'min'   => 6,
                        'max'   => 18,
                        'step'  => 1,
                    ),
                    'std'   => 14,
                    'tab'   => 'google-map',
                ),
                array(
                    'id'    => 'inspiry_address',
                    'name'  => __( 'Office Address to Display', 'inspiry' ),
                    'desc'  => __( 'Given address will be displayed on contact page.', 'inspiry' ),
                    'type'  => 'textarea',
                    'tab'   => 'contact-details',
                ),
                array(
                    'id'    => "inspiry_phone",
                    'name'  => __( 'Phone', 'inspiry' ),
                    'type'  => 'text',
                    'tab'   => 'contact-details',
                ),
                array(
                    'id'    => "inspiry_mobile",
                    'name'  => __( 'Mobile', 'inspiry' ),
                    'type'  => 'text',
                    'tab'   => 'contact-details',
                ),
                array(
                    'id'    => "inspiry_fax",
                    'name'  => __( 'Fax', 'inspiry' ),
                    'type'  => 'text',
                    'tab'   => 'contact-details',
                ),
                array(
                    'id'    => "inspiry_display_email",
                    'name'  => __( 'Email to Display', 'inspiry' ),
                    'desc'  => __( 'Given email address will be displayed on contact page.', 'inspiry' ),
                    'type'  => 'text',
                    'std'   => $admin_email,
                    'tab'   => 'contact-details',
                ),
                array(
                    'id'    => "inspiry_work_hours",
                    'name'  => __( 'Working Hours', 'inspiry' ),
                    'type'  => 'text',
                    'clone' => true,
                    'tab'   => 'contact-details',
                ),
                array(
                    'id'    => "inspiry_form_heading",
                    'name'  => __( 'Contact Form Heading', 'inspiry' ),
                    'type'  => 'text',
                    'std'   => __( 'Send Us a Message', 'inspiry' ),
                    'tab'   => 'contact-form',
                ),
                array(
                    'id'    => "inspiry_email",
                    'name'  => __( 'Contact Form Email', 'inspiry' ),
                    'desc'  => __( 'Given email address will receive messages from theme based contact form', 'inspiry' ),
                    'type'  => 'text',
                    'std'   => $admin_email,
                    'tab'   => 'contact-form',
                ),
                array(
                    'id'    => "inspiry_contact_form_7",
                    'name'  => __( 'Contact Form 7 Shortcode', 'inspiry' ),
                    'desc'  => __( 'You can provide contact form 7 shortcode, If you want to use a custom form. It will be displayed if above given email address is empty.', 'inspiry' ),
                    'type'  => 'text',
                    'std'   => '',
                    'tab'   => 'contact-form',
                    'size'  => 50,
                ),
            )
        );

        /*
         * Banner meta box for home page templates
         */
        $meta_boxes[] = array(
            'id'        => 'home-banner-meta-box',
            'title'     => __( 'Banner Settings', 'inspiry' ),
            'pages'     => array( 'page' ),
            'context'   => 'normal',
            'priority'  => 'low',
            'show'   => array(
                'template'    => array( 'page-templates/home.php' ),
            ),
            'fields' => array(
                array(
                    'name'  => __( 'Banner Image', 'inspiry' ),
                    'id'    => "inspiry_homepage_banner_image",
                    'desc'  => __( 'Banner image should have minimum width of 2000px and minimum height of 320px.', 'inspiry' ),
                    'type'  => 'image_advanced',
                    'max_file_uploads' => 1
                )
            )
        );

        /*
         * Banner meta box
         */
        $meta_boxes[] = array(
            'id'        => 'banner-meta-box',
            'title'     => __( 'Banner Settings', 'inspiry' ),
            'pages'     => array( 'post', 'page', 'agent' ),
            'context'   => 'normal',
            'priority'  => 'low',
            'hide'   => array(
                'template'    => array(
                    'page-templates/home.php',
                ),
            ),
            'fields' => array(
                array(
                    'name'  => __( 'Banner Image', 'inspiry' ),
                    'id'    => "{$prefix}page_banner_image",
                    'desc'  => __( 'Banner image should have minimum width of 2000px and minimum height of 320px.', 'inspiry' ),
                    'type'  => 'image_advanced',
                    'max_file_uploads' => 1
                ),
                array(
                    'name' => __('Revolution Slider Alias', 'inspiry'),
                    'id' => "{$prefix}rev_slider_alias",
                    'desc' => __('If you want to replace banner with revolution slider then provide its alias here.', 'inspiry'),
                    'type' => 'text'
                )
            )
        );


        /*
         * Meta boxes for properties list pages
         */
        $locations = array();
        inspiry_get_terms_array( 'property-city', $locations );

        $types = array();
        inspiry_get_terms_array( 'property-type', $types );

        $statuses = array();
        inspiry_get_terms_array( 'property-status', $statuses );

        $features = array();
        inspiry_get_terms_array( 'property-feature', $features );

        $meta_boxes[] = array(
            'id'        => 'properties-list-meta-box',
            'title'     => __( 'Properties Settings', 'inspiry' ),
            'pages'     => array( 'page' ),
            'context'   => 'normal',
            'priority'  => 'high',
            'show'   => array(
                'template'    => array(
                    'page-templates/properties-list.php',
                    'page-templates/properties-list-with-sidebar.php',
                    'page-templates/properties-grid.php',
                    'page-templates/properties-grid-with-sidebar.php',
                ),
            ),
            'fields' => array(
                array(
                    'id'    => 'inspiry_posts_per_page',
                    'name'  => __( 'Number of Properties Per Page', 'inspiry' ),
                    'type'  => 'number',
                    'step'  => '1',
                    'min'   => 1,
                    'std'   => 6,
                ),
                array(
                    'id'          => "inspiry_properties_order",
                    'name'        => __( 'Order Properties By', 'inspiry' ),
                    'type'        => 'select',
                    'options'     => array(
                        'date-desc'     => __( 'Date New to Old', 'inspiry' ),
                        'date-asc'      => __( 'Date Old to New', 'inspiry' ),
                        'price-asc'     => __( 'Price Low to High', 'inspiry' ),
                        'price-desc'    => __( 'Price High to Low', 'inspiry' ),
                    ),
                    'multiple'    => false,
                    'std'         => 'date-desc',
                ),
                array(
                    'id'          => "inspiry_properties_locations",
                    'name'        => __( 'Locations', 'inspiry' ),
                    'type'        => 'select',
                    'options'     => $locations,
                    'multiple'    => true,
                ),
                array(
                    'id'          => "inspiry_properties_statuses",
                    'name'        => __( 'Statuses', 'inspiry' ),
                    'type'        => 'select',
                    'options'     => $statuses,
                    'multiple'    => true,
                ),
                array(
                    'id'          => "inspiry_properties_types",
                    'name'        => __( 'Types', 'inspiry' ),
                    'type'        => 'select',
                    'options'     => $types,
                    'multiple'    => true,
                ),
                array(
                    'id'          => "inspiry_properties_features",
                    'name'        => __( 'Features', 'inspiry' ),
                    'type'        => 'select',
                    'options'     => $features,
                    'multiple'    => true,
                ),
                array(
                    'id'    => 'inspiry_properties_min_beds',
                    'name'  => __( 'Minimum Beds', 'inspiry' ),
                    'type'  => 'number',
                    'step'  => 'any',
                    'min'   => 0,
                    'std'   => 0,
                ),
                array(
                    'id'    => 'inspiry_properties_min_baths',
                    'name'  => __( 'Minimum Baths', 'inspiry' ),
                    'type'  => 'number',
                    'step'  => 'any',
                    'min'   => 0,
                    'std'   => 0,
                ),
                array(
                    'id'    => 'inspiry_properties_min_price',
                    'name'  => __( 'Minimum Price', 'inspiry' ),
                    'type'  => 'number',
                    'step'  => 'any',
                    'min'   => 0,
                    'std'   => 0,
                ),
                array(
                    'id'    => 'inspiry_properties_max_price',
                    'name'  => __( 'Maximum Price', 'inspiry' ),
                    'type'  => 'number',
                    'step'  => 'any',
                    'min'   => 0,
                    'std'   => 0,
                ),
                array(
                    'id'   => 'inspiry_display_google_map',
                    'name' => __( 'Google Map in Header', 'inspiry' ),
                    'type' => 'checkbox',
                    'desc' => __( 'Display Google Map with Properties Markers', 'inspiry' ),
                ),
            )
        );


        /*
         * Meta box for agents list pages
         */
        $meta_boxes[] = array(
            'id'        => 'agents-list-meta-box',
            'title'     => __( 'Agents Settings', 'inspiry' ),
            'pages'     => array( 'page' ),
            'context'   => 'normal',
            'priority'  => 'high',
            'show'   => array(
                'template'    => array(
                    'page-templates/agents-list-2-columns.php',
                    'page-templates/agents-list-3-columns.php',
                    'page-templates/agents-list-4-columns.php',
                ),
            ),
            'fields' => array(
                array(
                    'id'    => 'inspiry_agents_per_page',
                    'name'  => __( 'Number of Agents Per Page', 'inspiry' ),
                    'type'  => 'number',
                    'step'  => '1',
                    'min'   => 1,
                    'std'   => 6,
                ),
            )
        );

        // apply a filter before returning meta boxes
        $meta_boxes = apply_filters( 'inspiry_theme_meta', $meta_boxes );

        return $meta_boxes;

    }

    add_filter( 'rwmb_meta_boxes', 'inspiry_register_meta_boxes' );

}