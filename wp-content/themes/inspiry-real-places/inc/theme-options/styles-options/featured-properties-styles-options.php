<?php
/*
 * Featured Properties Styles Options
 */
global $opt_name;

Redux::setSection( $opt_name, array(
    'title' => __( 'Featured Properties', 'inspiry'),
    'id'    => 'featured-properties-styles',
    'desc'  => __('This section contains featured properties styles options.', 'inspiry' ),
    'subsection' => true,
    'fields'=> array (

        /**********************
          Featured Properties One Styles
         ***********************/

        // @abbreviation featured_properties_one = fp_1
        array(
            'id'        => 'inspiry_fp_1_odd_post_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-property-post-odd' ),
            'title'     => __( 'Background Color for Odd Properties', 'inspiry' ),
            'desc'      => 'default: #f1f5f8',
            'default'   => '#f1f5f8',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_fp_1_even_post_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-property-post-even' ),
            'title'     => __( 'Background Color for Even Properties', 'inspiry' ),
            'desc'      => 'default: #e9edf1',
            'default'   => '#e9edf1',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_fp_1_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array(
                '.featured-properties-one .featured-property-post:hover .property-description'
            ),
            'title'     => __( 'Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #50b848',
            'default'   => '#50b848',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_fp_1_hover_color',
            'type'      => 'color',
            'output'    => array(
                '.featured-properties-one .featured-property-post:hover a',
                '.featured-properties-one .featured-property-post:hover .price',
            ),
            'title'     => __( 'Overall Text Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_fp_1_title_color',
            'type'      => 'color',
            'output'    => array( '.featured-properties-one .entry-title a' ),
            'title'     => __( 'Title Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_fp_1_title_hover_color',
            'type'      => 'color',
            'output'    => array(
                '.featured-properties-one .featured-property-post:hover a:hover',
            ),
            'title'     => __( 'Title Color on Hover', 'inspiry' ),
            'desc'      => 'default: #285d24',
            'default'   => '#285d24',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_fp_1_price_color',
            'type'      => 'color',
            'output'    => array( '.featured-properties-one .price' ),
            'title'     => __( 'Price Color', 'inspiry' ),
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_fp_1_status_tag_color',
            'type'      => 'link_color',
            'output'    => array( '.featured-properties-one .property-status-tag', ),
            'title'     => __( 'Status Tag Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_fp_1_status_tag_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-one .property-status-tag' ),
            'title'     => __( 'Status Tag Background Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),

        array(
            'id'        => 'inspiry_fp_1_status_tag_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-one .property-status-tag:hover' ),
            'title'     => __( 'Status Tag Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #285d24',
            'default'   => '#285d24',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 1 ),
        ),


        /**********************
           Featured Properties Two Styles
         ***********************/

        // @abbreviation featured_properties_one = fp_2
        array(
            'id'        => 'inspiry_fp_2_section_title_color',
            'type'      => 'color',
            'output'    => array( '.featured-properties-two .section-title' ),
            'title'     => __( 'Section Title Color', 'inspiry' ),
            'desc'      => 'default: #4a525d',
            'default'   => '#4a525d',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),

        array(
            'id'        => 'inspiry_fp_2_background',
            'type'      => 'color_rgba',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-two .property-description' ),
            'title'     => __( 'Description Background Color', 'inspiry' ),
            'desc'      => 'default: rgba(74, 82, 93, 0.9)',
            'default'   => array(
                'color'     => '#4a525d',
                'alpha'     => 0.9
            ),
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),

        array(
            'id'        => 'inspiry_fp_2_color',
            'type'      => 'color',
            'output'    => array( '.featured-properties-two .property-description' ),
            'title'     => __( 'Description Text Color', 'inspiry' ),
            'desc'      => 'default: #bfcad9',
            'default'   => '#bfcad9',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),

        array(
            'id'        => 'inspiry_fp_2_title_color',
            'type'      => 'link_color',
            'output'    => array( '.featured-properties-two a' ),
            'title'     => __( 'Title Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),

        array(
            'id'        => 'inspiry_fp_2_border',
            'type'      => 'color',
            'mode'      => 'border-color',
            'output'    => array( '.featured-properties-two .entry-title' ),
            'title'     => __( 'Title Bottom Border Color', 'inspiry' ),
            'desc'      => 'default: #5c646e',
            'default'   => '#5c646e',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),

        array(
            'id'        => 'inspiry_fp_2_price_color',
            'type'      => 'color',
            'output'    => array( '.featured-properties-two .price' ),
            'title'     => __( 'Price Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),

        array(
            'id'        => 'inspiry_fp_2_status_tag_color',
            'type'      => 'link_color',
            'output'    => array( '.featured-properties-two .property-status-tag' ),
            'title'     => __( 'Status Tag Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),

        array(
            'id'        => 'inspiry_fp_2_status_tag_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-two .property-status-tag' ),
            'title'     => __( 'Status Tag Background Color', 'inspiry' ),
            'desc'      => 'default: #2a3139',
            'default'   => '#2a3139',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),

        array(
            'id'        => 'inspiry_fp_2_status_tag_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-two .property-status-tag:hover' ),
            'title'     => __( 'Status Tag Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #ff8000',
            'default'   => '#ff8000',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),

        // css generation code reside in css/dynamic-css.php
        array(
            'id'        => 'inspiry_fp_2_meta_icon_color',
            'type'      => 'color',
            'title'     => __( 'Meta Icons Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 2 ),
        ),


        /**********************
        Featured Properties Three Styles
         ***********************/

        // @abbreviation featured_properties_one = fp_3
        array(
            'id'        => 'inspiry_fp_3_section_background_color',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-three' ),
            'title'     => __( 'Section Background Color', 'inspiry' ),
            'desc'      => 'default: #e9edf1',
            'default'   => '#e9edf1',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_section_title_color',
            'type'      => 'color',
            'output'    => array( '.featured-properties-three .section-title' ),
            'title'     => __( 'Section Title Color', 'inspiry' ),
            'desc'      => 'default: #191c20',
            'default'   => '#191c20',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_description_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-three .property-description' ),
            'title'     => __( 'Description Background Color', 'inspiry' ),
            'desc'      => 'default: #ffffff',
            'default'   => '#ffffff',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_text_color',
            'type'      => 'color',
            'output'    => array(
                '.featured-properties-three .featured-property-post p',
                '.featured-properties-three .featured-property-post .meta-wrapper:before',
                '.featured-properties-three .featured-property-post .meta-unit',
                '.featured-properties-three .featured-property-post .meta-label',
            ),
            'title'     => __( 'Description and Meta Text Color', 'inspiry' ),
            'desc'      => 'default: #929ba7',
            'default'   => '#929ba7',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_title_color',
            'type'      => 'link_color',
            'output'    => array( '.featured-properties-three .entry-title a' ),
            'title'     => __( 'Title Color', 'inspiry' ),
            'default'   => array(
                'regular' => '#4a525d',
                'hover'   => '#0dbae8',
                'active'  => '#0dbae8',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_price_color',
            'type'      => 'color',
            'output'    => array( '.featured-properties-three .featured-property-post .price' ),
            'title'     => __( 'Price Color', 'inspiry' ),
            'desc'      => 'default: #0dbae8',
            'default'   => '#0dbae8',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_status_color',
            'type'      => 'link_color',
            'output'    => array( '.featured-properties-three .featured-property-post .property-status' ),
            'title'     => __( 'Status Tag Text Color', 'inspiry' ),
            'active'    => false,
            'default'   => array(
                'regular' => '#ffffff',
                'hover'   => '#ffffff',
            ),
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_status_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-three .featured-property-post .property-status' ),
            'title'     => __( 'Status Tag Background Color', 'inspiry' ),
            'desc'      => 'default: #50b848',
            'default'   => '#50b848',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_status_hover_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-three .featured-property-post .property-status:hover' ),
            'title'     => __( 'Status Tag Background Color on Hover', 'inspiry' ),
            'desc'      => 'default: #48a640',
            'default'   => '#48a640',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_meta_wrapper_background',
            'type'      => 'color',
            'mode'      => 'background-color',
            'output'    => array( '.featured-properties-three .property-meta' ),
            'title'     => __( 'Meta Wrapper Background Color', 'inspiry' ),
            'desc'      => 'default: #f7f8fa',
            'default'   => '#f7f8fa',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

        array(
            'id'        => 'inspiry_fp_3_meta_value_color',
            'type'      => 'color',
            'output'    => array( '.featured-properties-three .featured-property-post .meta-value' ),
            'title'     => __( 'Meta value Color', 'inspiry' ),
            'desc'      => 'default: #50B848',
            'default'   => '#50B848',
            'validate'  => 'color',
            'transparent' => false,
            'required' => array( 'inspiry_home_featured_variation', '=', 3 ),
        ),

    ) ) );