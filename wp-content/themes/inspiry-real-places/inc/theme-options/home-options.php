<?php
/*
 * Home Options
 */
global $opt_name;
Redux::setSection( $opt_name, array(
    'title' => __('Home', 'inspiry'),
    'id'    => 'home-section',
    'desc'  => __('This section contains options for homepage.', 'inspiry'),
    'fields'=> array(
        array(
            'id'       => 'inspiry_home_module_below_header',
            'type'     => 'button_set',
            'title'    => __( 'What to display below header', 'inspiry' ),
            'options'  => array(
                'banner'        => __( 'Image Banner', 'inspiry' ),
                'google-map'    => __( 'Google Map', 'inspiry' ),
                'slider'        => __( 'Slider', 'inspiry' ),
            ),
            'default'  => 'slider',
        ),
        array(
            'id'       => 'inspiry_slider_type',
            'type'     => 'select',
            'title'    => __( 'Select the type of slider', 'inspiry' ),
            'options'  => array(
                'properties-slider'     => __( 'Properties Slider', 'inspiry' ),
                'properties-slider-two' => __( 'Properties Slider Two', 'inspiry' ),
                'properties-slider-three' => __( 'Properties Slider Three', 'inspiry' ),
                'revolution-slider'     => __( 'Revolution Slider', 'inspiry' ),
            ),
            'default'  => 'properties-slider',
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_module_below_header', '=', 'slider' ),
        ),
        array(
            'id'       => 'inspiry_home_slides_number',
            'type'     => 'select',
            'title'    => __( 'Number of slides to display', 'inspiry' ),
            'options'  => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
                6 => '6',
                7 => '7',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider', 'properties-slider-two', 'properties-slider-three' ) ),
        ),
        array(
            'id'       => 'inspiry_slide_button_text',
            'type'     => 'text',
            'title'    => __( 'Slider Button Text', 'inspiry' ),
            'default'  => __( 'More Details', 'inspiry' ),
            'required' => array( 'inspiry_slider_type', '=', array( 'properties-slider-two', 'properties-slider-three' ) ),
        ),
        array(
            'id'        => 'inspiry_revolution_slider_alias',
            'type'      => 'text',
            'title'     => __( 'Revolution Slider Alias', 'inspiry' ),
            'required'  => array( 'inspiry_slider_type', '=', array( 'revolution-slider' ) )
        ),

    ) ) );

/*
 * Layout Sub Section
 */
Redux::setSection( $opt_name, array(
    'title' => __( 'Layout', 'inspiry'),
    'id'    => 'layout-section',
    'desc'  => __('This section contains homepage layout related options.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(
        array(
            'id'       => 'inspiry_home_sections_width',
            'type'     => 'button_set',
            'title'    => __( 'Home sections width', 'inspiry' ),
            'subtitle' => __( 'Some section can appear in full width.', 'inspiry' ),
            'options'  => array(
                'boxed'   => __( 'Keep Boxed', 'inspiry' ),
                'wide'    => __( 'Allow Full Width', 'inspiry' ),
            ),
            'default'  => 'wide',
        ),
        array(
            'id'       => 'inspiry_home_search',
            'type'     => 'switch',
            'title'    => __( 'Property Search Form', 'inspiry' ),
            'desc'     => __( 'The 1st header variation already includes it, So this applies only with other header variations.', 'inspiry' ),
            'default'  => 0,
            'on'       => __( 'Show', 'inspiry' ),
            'off'      => __( 'Hide', 'inspiry' ),
            'required' => array( 'inspiry_header_variation', '=', array( '2', '3' ) ),
        ),
        array(
            'id'      => 'inspiry_home_sections',
            'type'    => 'sorter',
            'title'   => __('Homepage layout manager', 'inspiry'),
            'desc'    => __('Organize homepage sections in the way you want them to appear.', 'inspiry'),
            'options' => array(
                'enabled'  => array(
                    'content'       => __( 'Page Contents', 'inspiry' ),
                ),
                'disabled' => array(
                    'properties'    => __( 'Properties', 'inspiry' ),
                    'featured'      => __( 'Featured', 'inspiry' ),
                    'how-it-works'  => __( 'How It Works', 'inspiry' ),
                    'partners'      => __( 'Partners', 'inspiry' ),
                    'news'          => __( 'News', 'inspiry' ),
                ),
            )
        ),
    ) ) );


if ( class_exists( 'Inspiry_Real_Estate' ) ) {

/*
 * Properties Sub Section
 */
Redux::setSection( $opt_name, array(
    'title' => __( 'Properties', 'inspiry'),
    'id'    => 'properties-section',
    'desc'  => __('This section contains homepage properties related options.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(

        array(
            'id'        => 'inspiry_home_properties_variation',
            'type'      => 'image_select',
            'title'     => __( 'Properties design variation', 'inspiry' ),
            'subtitle'  => __( 'Select the design variation that you want to use for homepage properties.', 'inspiry' ),
            'options'   => array(
                '1' => array(
                    'title' => __('1st Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/properties-variation-1.png',
                ),
                '2' => array(
                    'title' => __('2nd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/properties-variation-2.png',
                ),
                '3' => array(
                    'title' => __('3rd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/properties-variation-3.png',
                ),
            ),
            'default'   => '1',
        ),
        array(
            'id'       => 'inspiry_home_properties_number_1',
            'type'     => 'select',
            'title'    => __( 'Number of properties to display', 'inspiry' ),
            'options'  => array(
                2  => '2',
                4  => '4',
                6  => '6',
                8  => '8',
                10 => '10',
                12 => '12',
            ),
            'default'  => 4,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_properties_variation', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_home_properties_gallery',
            'type'     => 'switch',
            'title'    => __( 'Multiple Photos', 'inspiry' ),
            'subtitle' => __( '* This can slow website performance', 'inspiry' ),
            'desc'     => __( 'Each property can display multiple photos sliding over each other', 'inspiry' ),
            'default'  => 0,
            'on'       => __('Enabled', 'inspiry'),
            'off'      => __('Disabled', 'inspiry'),
            'required' => array( 'inspiry_home_properties_variation', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_home_properties_gallery_limit',
            'type'     => 'select',
            'title'    => __( 'Max number of photos', 'inspiry' ),
            'options'  => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_properties_gallery', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_home_properties_number_2',
            'type'     => 'select',
            'title'    => __( 'Number of properties to display', 'inspiry' ),
            'options'  => array(
                4  => '4',
                8  => '8',
                12 => '12',
                16 => '16',
                20 => '20',
            ),
            'default'  => 8,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_properties_variation', '=', 2 ),
        ),
        array(
            'id'       => 'inspiry_welcome_title',
            'type'     => 'text',
            'title'    => __( 'Welcome Board Title', 'inspiry' ),
            'default'  => __( 'We are Offering the Best Real Estate Deals', 'inspiry' ),
            'required' => array( 'inspiry_home_properties_variation', '=', 3 ),
        ),
        array(
            'id'           => 'inspiry_welcome_text',
            'type'         => 'textarea',
            'title'        => __( 'Welcome Board Text', 'inspiry' ),
            'desc'         => __( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array(),
                    'target' => array(),
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array()
            ), //see http://codex.wordpress.org/Function_Reference/wp_kses
            'required' => array( 'inspiry_home_properties_variation', '=', 3 ),
        ),
        array(
            'id'       => 'inspiry_home_properties_number_3',
            'type'     => 'select',
            'title'    => __( 'Number of properties to display', 'inspiry' ),
            'options'  => array(
                3  => '3',
                6  => '6',
                9  => '9',
                12 => '12',
                15 => '15',
            ),
            'default'  => 8,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_properties_variation', '=', 3 ),
        ),
        array(
            'id'       => 'inspiry_home_properties_order',
            'type'     => 'select',
            'title'    => __( 'Sort Order', 'inspiry' ),
            'options'  => array(
                'price-asc'     => __( 'Sort by Price Low to High', 'inspiry' ),
                'price-desc'    => __( 'Sort by Price High to Low', 'inspiry' ),
                'date-asc'      => __( 'Sort by Date Old to New', 'inspiry' ),
                'date-desc'     => __( 'Sort by Date New to Old', 'inspiry' ),
            ),
            'default'  => 'date-desc',
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_home_properties_kind',
            'type'     => 'radio',
            'title'    => __( 'Select the kind of properties you want to display', 'inspiry' ),
            'options'  => array(
                'default'   => __( 'Default ( No Filtration )', 'inspiry' ),
                'featured'  => __( 'Featured', 'inspiry' ),
                'selection' => __( 'Based on my selection of Locations, Statuses and Types.', 'inspiry' ),
            ),
            'default'  => 'default'
        ),
        array(
            'id'    =>'inspiry_home_properties_locations',
            'type'  => 'select',
            'title' => __( 'Locations', 'inspiry' ),
            'multi' => true,
            'data'  => 'terms',
            'args'  => array(
                'taxonomies' => 'property-city',
                'args' => array()
            ),
            'required' => array( 'inspiry_home_properties_kind', '=', 'selection' ),
        ),
        array(
            'id'    =>'inspiry_home_properties_statuses',
            'type'  => 'select',
            'title' => __( 'Statuses', 'inspiry' ),
            'multi' => true,
            'data'  => 'terms',
            'args'  => array(
                'taxonomies' => 'property-status',
                'args' => array()
            ),
            'required' => array( 'inspiry_home_properties_kind', '=', 'selection' ),
        ),
        array(
            'id'    =>'inspiry_home_properties_types',
            'type'  => 'select',
            'title' => __( 'Types', 'inspiry' ),
            'multi' => true,
            'data'  => 'terms',
            'args'  => array(
                'taxonomies' => 'property-type',
                'args' => array()
            ),
            'required' => array( 'inspiry_home_properties_kind', '=', 'selection' ),
        ),

    ) ) );

}


/*
 * How it Works Sub Section
 */
Redux::setSection( $opt_name, array(
    'title' => __( 'How it Works', 'inspiry'),
    'id'    => 'how-it-works-section',
    'desc'  => __('This section contains options related to "How It Works" section.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(

        array(
            'id'       => 'inspiry_hiw_welcome',
            'type'     => 'text',
            'title'    => __( 'Welcome Text', 'inspiry' ),
            'default'  => __( 'Welcome', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_hiw_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'inspiry' ),
            'default'  => __( 'An Awesome title', 'inspiry' ),
        ),
        array(
            'id'           => 'inspiry_hiw_description',
            'type'         => 'textarea',
            'title'        => __( 'Description', 'inspiry' ),
            'desc'         => __( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array()
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
            )
        ),
        array(
            'id'        => 'inspiry_hiw_section_bg',
            'type'      => 'switch',
            'title'     => __('Background Image', 'inspiry'),
            'default'   => 1,
            'on'        => __('Enable','inspiry'),
            'off'       => __('Disable','inspiry'),
        ),
        array(
            'id'       => 'inspiry_hiw_bg_image',
            'type'     => 'media',
            'url'      => false,
            'title'    => '',
            'desc' => __( 'Provide a background image for "How it Works" section.', 'inspiry' ),
            'compiler' => 'true',
            'required' => array( 'inspiry_hiw_section_bg', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_hiw_columns',
            'type'     => 'button_set',
            'title'    => __( 'Number of Columns', 'inspiry' ),
            'desc' => __( 'Choose the number of columns to display below basic introduction on "How it Works" section.', 'inspiry' ),
            'options'  => array(
                '0' => __('None', 'inspiry'),
                '1' => __('1 Column', 'inspiry'),
                '2' => __('2 Columns', 'inspiry'),
                '3' => __('3 Columns', 'inspiry'),
            ),
            'default'  => '3',
        ),
        array(
            'id'       => 'inspiry_hiw_column_alignment',
            'type'     => 'button_set',
            'title'    => __( 'Content alignment in a column', 'inspiry' ),
            'options'  => array(
                'left' => __('Left', 'inspiry'),
                'center' => __('Center', 'inspiry'),
            ),
            'default'  => 'left',
            'required' => array( 'inspiry_hiw_columns', '=', array( '1', '2', '3' ) ),
        ),

        /*
         * 1st Column
         */
        array(
            'id'       => 'inspiry_hiw_1st_col_icon',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( '1st Column Icon', 'inspiry' ),
            'compiler' => 'true',
            'default'  => array( 'url' => get_template_directory_uri() . '/images/register-icon.svg' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '1', '2', '3' ) ),
        ),
        array(
            'id'       => 'inspiry_hiw_1st_col_title',
            'type'     => 'text',
            'title'    => __( '1st Column Title', 'inspiry' ),
            'default'  => __( 'Register', 'inspiry' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '1', '2', '3' ) ),
        ),
        array(
            'id'           => 'inspiry_hiw_1st_col_description',
            'type'         => 'textarea',
            'title'        => __( '1st Column Description', 'inspiry' ),
            'desc'         => __( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array()
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
            ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '1', '2', '3' ) ),
        ),

        /*
         * 2nd Column
         */
        array(
            'id'       => 'inspiry_hiw_2nd_col_icon',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( '2nd Column Icon', 'inspiry' ),
            'compiler' => 'true',
            'default'  => array( 'url' => get_template_directory_uri() . '/images/fill-details-icon.svg' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '2', '3' ) ),
        ),
        array(
            'id'       => 'inspiry_hiw_2nd_col_title',
            'type'     => 'text',
            'title'    => __( '2nd Column Title', 'inspiry' ),
            'default'  => __( 'Fill Up Property Details', 'inspiry' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '2', '3' ) ),
        ),
        array(
            'id'           => 'inspiry_hiw_2nd_col_description',
            'type'         => 'textarea',
            'title'        => __( '2nd Column Description', 'inspiry' ),
            'desc'         => __( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array()
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
            ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '2', '3' ) ),
        ),

        /*
         * 3rd Column
         */
        array(
            'id'       => 'inspiry_hiw_3rd_col_icon',
            'type'     => 'media',
            'url'      => true,
            'title'    => __( '3rd Column Icon', 'inspiry' ),
            'compiler' => 'true',
            'default'  => array( 'url' => get_template_directory_uri() . '/images/done-icon.svg' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '3' ) ),
        ),
        array(
            'id'       => 'inspiry_hiw_3rd_col_title',
            'type'     => 'text',
            'title'    => __( '3rd Column Title', 'inspiry' ),
            'default'  => __( 'You are Done!', 'inspiry' ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '3' ) ),
        ),
        array(
            'id'           => 'inspiry_hiw_3rd_col_description',
            'type'         => 'textarea',
            'title'        => __( '3rd Column Description', 'inspiry' ),
            'desc'         => __( 'Following html tags are allowed: a, br, em and strong.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => '',
            'allowed_html' => array(
                'a'      => array(
                    'href'  => array(),
                    'title' => array()
                ),
                'br'     => array(),
                'em'     => array(),
                'strong' => array(),
            ),
            'required' => array( 'inspiry_hiw_columns', '=', array( '3' ) ),
        ),
        array(
            'id'        => 'inspiry_hiw_submit_button',
            'type'      => 'switch',
            'title'     => __('Submit Property Button', 'inspiry'),
            'default'   => 1,
            'on'        => __('Display','inspiry'),
            'off'       => __('Hide','inspiry'),
        ),
        array(
            'id'       => 'inspiry_hiw_button_text',
            'type'     => 'text',
            'title'    => __( 'Button Text', 'inspiry' ),
            'default'  => __( 'Submit Your Property', 'inspiry' ),
            'required' => array( 'inspiry_hiw_submit_button', '=', true ),
        ),
        array(
            'id'       => 'inspiry_hiw_button_url',
            'type'     => 'text',
            'title'    => __( 'Button Target URL', 'inspiry' ),
            'validate' => 'url',
            'default'  => '',
            'required' => array( 'inspiry_hiw_submit_button', '=', true ),
        ),

    ) ) );

/*
 * Featured properties sub section
 */
Redux::setSection( $opt_name, array(
    'title' => __( 'Featured Properties', 'inspiry'),
    'id'    => 'featured-section',
    'desc'  => __('This section contains options related to featured properties on homepage.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(

        array(
            'id'        => 'inspiry_home_featured_variation',
            'type'      => 'image_select',
            'title'     => __( 'Featured properties design variation', 'inspiry' ),
            'subtitle'  => __( 'Select the design variation that you want to use for featured properties.', 'inspiry' ),
            'options'   => array(
                '1' => array(
                    'title' => __('1st Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/featured-variation-1.png',
                ),
                '2' => array(
                    'title' => __('2nd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/featured-variation-2.png',
                ),
                '3' => array(
                    'title' => __('3rd Variation', 'inspiry'),
                    'img' => get_template_directory_uri() . '/inc/theme-options/images/featured-variation-3.png',
                ),
            ),
            'default'   => '1',
        ),
        array(
            'id'       => 'inspiry_home_featured_columns',
            'type'     => 'select',
            'title'    => __( 'Number of columns', 'inspiry' ),
            'options'  => array(
                2  => '2',
                3  => '3',
                4  => '4',
            ),
            'default'  => 4,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_featured_variation', '=', array( 1 , 2 )  ),
        ),
        array(
            'id'       => 'inspiry_home_featured_number_1',
            'type'     => 'select',
            'title'    => __( 'Number of properties', 'inspiry' ),
            'options'  => array(
                2  => '2',
                3  => '3',
                4  => '4',
                6  => '6',
                8  => '8',
                9  => '9',
                10 => '10',
                12 => '12',
            ),
            'default'  => 4,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),
        array(
            'id'       => 'inspiry_home_featured_number_2',
            'type'     => 'select',
            'title'    => __( 'Number of properties', 'inspiry' ),
            'options'  => array(
                2  => '2',
                3  => '3',
                4  => '4',
                6  => '6',
                8  => '8',
                9  => '9',
                10 => '10',
                12 => '12',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),
        array(
            'id'       => 'inspiry_home_featured_number_3',
            'type'     => 'select',
            'title'    => __( 'Number of properties', 'inspiry' ),
            'options'  => array(
                2  => '2',
                4  => '4',
                6  => '6',
                8  => '8',
                10 => '10',
                12 => '12',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),
        array(
            'id'       => 'inspiry_home_featured_title',
            'type'     => 'text',
            'title'    => __( 'Title', 'inspiry' ),
            'default'  => __( 'Featured Properties', 'inspiry' ),
            'required' => array( 'inspiry_home_featured_variation', '=', array( 2, 3 ) ),
        ),

    ) ) );


/*
 * partners sub section
 */
Redux::setSection( $opt_name, array(
    'title' => __( 'Partners', 'inspiry'),
    'id'    => 'partners-section',
    'desc'  => __('This section contains options related to partners on homepage.', 'inspiry'),
    'subsection' => true,
    'fields'=> array(
        array(
            'id'       => 'inspiry_home_partners_number',
            'type'     => 'select',
            'title'    => __( 'Number of partners', 'inspiry' ),
            'options'  => array(
                -1  => 'All',
                1  => '1',
                2  => '2',
                3  => '3',
                4  => '4',
                5  => '5',
                6  => '6',
                7  => '7',
                8  => '8',
                9  => '9',
                10 => '10',
            ),
            'default'  => 5,
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'           => 'inspiry_home_partners_title',
            'type'         => 'textarea',
            'title'        => __( 'Partners Title', 'inspiry' ),
            'desc'         => __( 'You can use span tag to highlight a part of title.', 'inspiry' ),
            'validate'     => 'html_custom',
            'default'      => 'Partners Title <span>With Highlighted</span> Text.',
            'allowed_html' => array(
                'span'     => array(),
            ),
        ),

    ) ) );



/*
 * news sub section
 */
Redux::setSection( $opt_name, array(
    'title' => __( 'News', 'inspiry'),
    'id'    => 'news-section',
    'desc'  => __('This section contains options related to news on homepage.', 'inspiry' ),
    'subsection' => true,
    'fields'=> array(
        array(
            'id'       => 'inspiry_home_posts_number',
            'type'     => 'select',
            'title'    => __( 'Number of posts to display', 'inspiry' ),
            'options'  => array(
                2  => '2',
                3  => '3',
                4  => '4',
                5  => '5',
                6  => '6',
                7  => '7',
                8  => '8',
                9  => '9',
                10 => '10',
            ),
            'default'  => 3,
            'select2'  => array( 'allowClear' => false ),
        ),
        array(
            'id'       => 'inspiry_home_news_title',
            'type'     => 'text',
            'title'    => __( 'News Title', 'inspiry' ),
            'default'  => __( 'Latest News', 'inspiry' ),
        ),
        array(
            'id'       => 'inspiry_home_news_type',
            'type'     => 'button_set',
            'title'    => __( 'Type of News Posts', 'inspiry' ),
            'desc' => __( 'Choose the type of news posts to display on homepage.', 'inspiry' ),
            'options'  => array(
                'recent' => __('Recent', 'inspiry'),
                'category' => __('Based on Category', 'inspiry'),
                'tag' => __('Based on Tag', 'inspiry'),
            ),
            'default'  => 'recent',
        ),
        array(
            'id'       => 'inspiry_home_news_category',
            'type'     => 'select',
            'data'     => 'categories',
            'title'    => __( 'Select a Category', 'inspiry' ),
            'required' => array( 'inspiry_home_news_type', '=', 'category' ),
        ),
        array(
            'id'       => 'inspiry_home_news_tag',
            'type'     => 'select',
            'data'     => 'tags',
            'title'    => __( 'Select a Tag', 'inspiry' ),
            'required' => array( 'inspiry_home_news_type', '=', 'tag' ),
        ),
        array(
            'id'       => 'inspiry_home_news_link_text',
            'type'     => 'text',
            'title'    => __( 'More Link Text', 'inspiry' ),
            'default'  => __( 'More', 'inspiry' ),
        ),

    ) ) );